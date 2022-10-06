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
     * Get list all of models
     * 
     * @param  array  $columns
     * @return Collection
     */
    public function getAll(array $columns = null): Collection
    {
        return $this->repository->get($columns ?? '*');
    }

    /**
     * Get list models by conditions
     * 
     * @param array $conditions
     * @param array $options
     * @return Collection
     */
    public function getBy(array $conditions, array $options = null): Collection
    {
        $query = $this->repository->query();
        
        foreach($conditions as $condition)
        {
            if(isset($condition['value']) && is_array($condition['value']))
            {
                $query->whereIn($condition['column'], $condition['value']);
            }
            else
            {
                $query->where($condition['column'], $condition['operator'] ?? "=", $condition['value']);
            }
        }

        if(isset($options['relations']))
        {
            $query->with($options['relations']);
        }

        if(isset($options['sorts']))
        {
            foreach($options['sorts'] as $sort)
            {
                $query->orderBy($sort['column'], $sort['type']);
            }
        }

        return $query->get($options['columns'] ?? '*');
    }

    /**
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
     * Update a model in database
     * 
     * @param array|string $id
     * @param array $attributes
     * @return bool
     */
    public function update($id, $attributes): bool
    {
        if(is_array($id))
        {
            $query = $this->repository->query();
            $query->whereIn($this->repository->getKeyName(), $id);
            
            return $query->update($attributes);
        }

        return $this->repository->update($id, $attributes);
    }

    /**
     * Update a model in database
     * 
     * @param array $ids
     * @param array $attributes
     * @return bool
     */
    public function updateMultipleRecord(array $ids, $attributes): bool
    {
        return $this->repository->update($ids, $attributes);
    }

    /**
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