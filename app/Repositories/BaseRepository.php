<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Interfaces\BaseInterface;

abstract class BaseRepository implements BaseInterface
{

    protected $limit = 50;

    protected $database;

    protected $sortProperty = null;

    protected $sortDirection = 0;

    protected $model;

    abstract protected function getModel();

    final public function __construct()
    {
        $this->model = $this->getModel();
    }

    protected function createBaseBuilder(array $options = [])
    {
        $query = $this->createQueryBuilder();
        if (! empty($options['limit'])) {
            if ($options['limit'] < $this->limit) {
                $this->limit = $options['limit'];
            }
        }

        if (empty($options['sort'])) {
            $this->defaultSort($query, $options);
        }

        // $this->applyResourceOptions($query, $options);
        return $query;
    }

    /**
     * Order query by the specified sorting property
     *
     * @param  Builder $query
     * @param  array   $options
     * @return void
     */
    protected function defaultSort($query, array $options = [])
    {
        if (isset($this->sortProperty)) {
            $direction = $this->sortDirection === 1 ? 'DESC' : 'ASC';
            $query->orderBy($this->sortProperty, $direction);
        }
    }

    public function create(array $data)
    {
        $model = $this->getModel();
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function update(Model $model, array $data)
    {
        $model->fill($data);
        $model->save();
        return $model;
    }

    // public function get(array $options = [], $paginate = null)
    // {
    //     $query = $this->createBaseBuilder($options);
    //     $size = (!empty($options['size'])) ? $options['size'] : null;
    //     if ($paginate === true && !is_null($size)) {
    //         return $query->paginate($size);
    //     }
    //     return parent::get($options, $paginate);
    // }

    public function getBuilderQuery(array $clauses, array $options = [])
    {
        $query = $this->createBaseBuilder($options);
        $query->where($clauses);
        return $query;
    }

    public function getWhereNot($columns, $values, array $options = [])
    {
        $update = $this->getModel();
        $query = $update->where($columns, '!=', $values);
        return $query->get();
    }

    public function getWhereArray(array $clauses, array $options = [])
    {
        return $this->getBuilderQuery($clauses, $options)->get();
    }

    public function getFirstWhereArray(array $clauses, array $options = [])
    {
        return $this->getBuilderQuery($clauses, $options)->first();
    }

    public function getCount(array $options = [])
    {
        $query = $this->createBaseBuilder($options);
        return $query->count();
    }

    public function getWhereIn($column, array $values, array $options = [])
    {
        $query = $this->createBaseBuilder($options);
        $query->whereIn($column, $values);
        return $query->paginate(25);
    }

    public function getWhere($column, $value, array $options = [])
    {
        $query = $this->createBaseBuilder($options);
        $query->where($column, $value);
        return $query->paginate(25);
    }

    public function getById($id, array $options = [])
    {
        $query = $this->createBaseBuilder($options);
        return $query->find($id);
    }

    /**
     * Creates a new query builder
     *
     * @return Builder
     */
    protected function createQueryBuilder()
    {
        return $this->model->newQuery();
    }
}
