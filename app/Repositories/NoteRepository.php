<?php

namespace App\Repositories\NoteRepository;

use App\Models\Note;
use App\Repositories\BaseRepository;

class NoteRepository implements BaseRepository
{
    /**
     * @var Note
     */
    protected $model;

    /**
     * NoteRepository constructor.
     *
     * @param Note $model
     */
    public function __construct(Note $model)
    {
        $this->model = $model;
    }

    /**
     * Get all Notes.
     *
     * @return \Illuminate\Database\Eloquent\Collection|mixed|static[]
     */
    public function getAll()
    {
        return $this->model->latest()->get();
    }

    /**
     * Get Note by id.
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create new Note.
     *
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Update Note by id.
     *
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        return $this->model->findOrFail($id)->update($attributes);
    }

    /**
     * Delete note by id.
     *
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * Get all favorite Notes.
     *
     * @return mixed
     */
    public function getFavorites()
    {
        return $this->model->where('is_favourite', 1)->latest()->get();
    }
}