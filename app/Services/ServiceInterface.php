<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    /**
     * Get list all of models
     * 
     * @param  array  $columns
     * @return Collection
     */
    public function getAll(array $columns = null): Collection;

    /**
     * Get list models by conditions
     * 
     * @param array $conditions
     * @param array $options
     * @return Collection
     */
    public function getBy(array $conditions, array $options = null): Collection;

    /**
     * Create new model
     * 
     * @param array $attributes
     * @return Model
     */
    public function create($attributes): Model;

    /**
     * Find a model by id
     * 
     * @param string $id
     * @return Model
     */
    public function find($id): Model;

    /**
     * Update a model in database
     * 
     * @param array|string $id
     * @param array $attributes
     * @return bool
     */
    public function update($id, $attributes): bool;

    /**
     * Remove the specified model from storage.
     * 
     * @param string $id
     * @return bool|null
     */
    public function delete($id): bool|null;
}