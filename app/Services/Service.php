<?php

namespace App\Services;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Service implements ServiceInterface
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
    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    /**
     * 
     * Create new model
     * @param $attributes
     * @return Model
     */
    public function create($attributes): Model
    {
        return $this->repository->create($attributes);
    }
}