<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Service implements ServiceInterface
{
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 
     * Get list all of models
     * 
     * @return Collection
     */
    public function getAll()
    {
        return $this->repository->all();
    }

    /**
     * 
     * Get list models with relations
     * 
     * @param  array|string  $relations
     * @return Collection
     */
    public function getWithRelations($relations): Collection
    {
        return $this->repository->with($relations);
    }

     /**
     * 
     * Get list models by conditions
     * 
     * @param  array  $conditions
     * @return Collection
     */
    public function getByConditions($conditions): Collection
    {
        return $this->repository->where($conditions);
    }

    /**
     * 
     * Create new model
     * 
     * @param $attributes
     * @return Model
     */
    public function create($attributes): Model
    {
        return $this->repository->create($attributes);
    }

    /**
     * 
     * Find a model by id
     * 
     * @param string $id
     * @return Model
     */
    public function find($id): Model
    {
        return $this->repository->find($id);
    }

    /**
     * 
     * Update a model in database
     * 
     * @param string $id
     * @param array $attributes
     * @return bool
     */
    public function update($id, $attributes): bool
    {
        return $this->repository->update($id, $attributes);
    }

    /**
     * 
     * Remove the specified model from storage.
     * 
     * @param string $id
     * @return bool|null
     */
    public function delete($id): bool|null
    {
        return $this->repository->delete($id);
    }
}