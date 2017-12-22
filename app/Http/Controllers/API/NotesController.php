<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteRequest;
use App\Repositories\NoteRepository\NoteRepository;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    /**
     * @var NoteRepository
     */
    public $noteRepository;

    /**
     * NotesController constructor.
     *
     * @param NoteRepository $noteRepository
     */
    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestQuery = request()->query();
        $condition = array_key_exists('type', $requestQuery) && $requestQuery['type'] === 'favourite';
        $allNotes = $condition ? $this->noteRepository->getFavorites() : $this->noteRepository->getAll();

        return response()->json($allNotes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateNoteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateNoteRequest $request)
    {
        $requestData = $request->only([
            'title',
            'is_favourite'
        ]);

        $note = $this->noteRepository->create($requestData);

        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->only([
            'title'
        ]);

        $note = $this->noteRepository->update($id, $requestData);

        return response()->json($note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = $this->noteRepository->delete($id);

        return response()->json($note);
    }
}
