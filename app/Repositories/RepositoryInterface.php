<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{

    /**
     * Get list all of models
     * 
     * @return Collection
     */
    public function all(): Collection;

    /**
     * Get list models with eager loading
     *
     * @param  array|string  $relations
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function with($relations): Collection;

    /**
     * Get list models by conditions
     *
     * @param  array  $conditions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function where($conditions);
    
    /**
     * Store new model in database
     * 
     * @param $attributes
     * @return Model
     */
    public function create($attributes): Model;

    /**
     * 
     * Find a model by id
     * 
     * @param string $id
     * @return Model
     */
    public function find($id):Model;

    /**
     * 
     * Update a model in database
     * 
     * @param string $id
     * @param array $attributes
     * @return bool
     */
    public function update($id, $attributes): bool;

    /**
     * 
     * Remove the specified model from storage.
     * 
     * @param string $id
     * @return bool|null
     */
    public function delete($id): bool|null;
}