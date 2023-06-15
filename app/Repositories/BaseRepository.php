<?php

namespace App\Repositories;

use App\Traits\Sortable;
use App\Traits\Filterable;
use App\Traits\Relationable;
use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

/**
 * Class BaseRepository.
 */
abstract class BaseRepository implements RepositoryContract
{
    /**
     * The repository model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    private $query;
    use Relationable, Sortable ,Filterable ;

    /**
     * BaseRepository constructor.
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    abstract public function model();

    /**
     * @return Model|mixed
     *
     * @throws GeneralException
     */
    public function makeModel()
    {
        $model = app()->make($this->model());

        // if (!$model instanceof Model) {
        //     throw new GeneralException("Class {$this->model()} must be an instance of " . Model::class);
        // }

        return $this->model = $model;
    }

    public function newQuery()
    {
        $this->query = $this->model->newQuery();
        return $this;
    }

    /**
     * Get all the model records in the database.
     *
     * @param array $columns
     *
     * @return Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        $this->newQuery();
        if(!empty($this->filters)){
            $this->query->filter($this->filters);
        }

        if(isset($this->search)){
            $this->query->search($this->search);
        }

        if(isset($this->relations)){
            $this->query->with($this->relations);
        }
        $this->query->orderBy($this->sortBy,$this->sortOrder);
        $models = $this->query->get($columns);
        // $models =  $this->query::with($this->relations)
        //     ->orderBy($this->sortBy, $this->sortOrder)
        //     ->get($columns);
        return $models;
    }

    public function pagination(array $columns=['*'])
    {
        $this->newQuery();
        if(!empty($this->filters)){
            $this->query->filter($this->filters);
        }

        if(isset($this->search)){
            $this->query->search($this->search);
        }

        if(isset($this->relations)){
            $this->query->with($this->relations);
        }
        if(isset($this->groupBy)){
            $this->query->with($this->groupBy);
        }

        $this->query->orderBy($this->sortBy,$this->sortOrder);
        $models=$this->query->paginate($this->pagination,$columns);
        return $models;
    }
}