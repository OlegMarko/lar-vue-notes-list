<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\NoteRepository\NoteRepository;
use Illuminate\Http\Request;

class FavouriteController extends Controller
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
     * Note toggle favourite.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleFavourite($id)
    {
        $note = $this->noteRepository->getById($id);

        $note = $this->noteRepository->update($id, ['is_favourite' => $note->is_favourite ? 0 : 1]);

        return response()->json($note);
    }
}
