<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    /**
     * 
     * Get list all of models
     * 
     * @return Collection
     */
    public function getAll();

    /**
     * 
     * Get list models with relations
     * 
     * @param  array|string  $relations
     * @return Collection
     */
    public function getWithRelations($relations): Collection;

    /**
     * 
     * Get list models by conditions
     * 
     * @param  array|string  $conditions
     * @return Collection
     */
    public function getByConditions($conditions): Collection;


    /**
     * 
     * Create new model
     * 
     * @param array $attributes
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
    public function find($id): Model;

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