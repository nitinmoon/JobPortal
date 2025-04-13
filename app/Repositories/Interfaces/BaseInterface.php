<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseInterface
{
    // public function createBaseBuilder(array $options = []);
    public function create(array $data);
    public function update(Model $model, array $data);
    //  public function get(array $options = [], $paginate = null);
    public function getBuilderQuery(array $clauses, array $options = []);
    public function getWhereNot($columns, $values, array $options = []);
    public function getWhereArray(array $clauses, array $options = []);
    public function getFirstWhereArray(array $clauses, array $options = []);
    public function getCount(array $options = []);
    public function getWhereIn($column, array $values, array $options = []);
    public function getWhere($column, $value, array $options = []);
    public function getById($id, array $options = []);
}
