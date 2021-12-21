<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Log;

class Repository {
	private $model;
    protected $fields;
    protected $primaryKey;

    public function __construct($model) {
        $this->model = $model;
    }

    /**
    * Store record
    * 04/04/2019
    *
    * @param array data: data insert into db
    *
    * @author ntdat <datnt@baokim.vn>
    * @return mixed
    */

    public function store($data) {
        if (empty($this->fields) || empty($data)) {
            return false;
        }
        $object = new $this->model;
        foreach ($this->fields as $field) {
            if (array_key_exists($field, $data)) {
                $object->$field = $data[$field];
            }
        }
        try {
            if ($object->save()) {
                return $object;
            }
        } catch(\Exception $e) {
            Log::info($e->getMessage() . ' - ' . $e->getFile() . ' - ' . $e->getLine());
        }
        return false;
    }

    /**
    * Update record account
    * 04/04/2019
    *
    * @param object object: object will update
    * @param array data: data of object
    *
    * @author ntdat <datnt@baokim.vn>
    * @return mixed
    */

    public function update($object, $data) {
        if (empty($this->fields) || empty($data)) {
            return false;
        }

        foreach ($this->fields as $field) {
            if (array_key_exists($field, $data)) {
                $object->$field = $data[$field];
            }
        }
        try {
            if ($object->save()) {
                return $object;
            }
        } catch(\Exception $e) {
            Log::info($e->getMessage() . ' - ' . $e->getFile() . ' - ' . $e->getLine());
        }
        return false;
    }

    /**
    * Update multiple
    * date: 2019-06-08
    *
    * @param array data
    * @param array filters
    *
    * @author ntdat <datnt@baokim.vn>
    * @return
    */
    public function multipleUpdate($data, $filters) {
        if (empty($this->fields) || empty($data)) {
            return false;
        }

        foreach($data as $key => $value) {
            if(!in_array($key, $this->fields)) {
                unset($data[$key]);
            }
        }

        $query = $this->query([], $filters, []);
        return $query->update($data);
    }

    /**
    * Query to table get all
    * 04/04/2019
    *
    * @param array filters: column name => value of column for query
    * @param array sort: column name => type of sort like asc or desc
    * @param array select: select some fields
    *
    * @author ntdat <datnt@baokim.vn>
    * @return mixed
    */

    public function getAll($select = [], $filters = [], $sort = []) {
        $query = $this->query($select, $filters, $sort);
        $data = $query->get();
        return $data;
    }

    public function getAllLimit($select = [], $filters = [], $sort = [], $offset = 0, $limit = 12) {
        $query = $this->query($select, $filters, $sort);
        $data = $query->offset($offset)->limit($limit)->get();
        return $data;
    }

    /**
    * Query to table get pagination
    * 04/04/2019
    *
    * @param array filters: column name => value of column for query
    * @param integer take: How many record that you want to take
    * @param array sort: column name => type of sort like asc or desc ['columnName' => 'asc/desc']
    * @param array select: column name ***
    *
    * @author ntdat <datnt@baokim.vn>
    * @return mixed
    */
    public function getPaginate($select = [], $filters = [], $take = 20, $sort = []) {
    
    	$query = $this->query($select, $filters, $sort);
        $data = $query->paginate($take);
        return $data;
    }

    // public function getOne($select = [], $filters) {
    //     $query = $this->query($select, $filters, []);
    //     return $query->first();
    // }

    /**
    * Query to count record table
    * 04/04/2019
    *
    * @param array filters: column name => value of column for query
    *
    * @author ntdat <datnt@baokim.vn>
    * @return integer
    */
    public function count($filters = []) {
        $query = $this->query([], $filters, []);
        $data = $query->count();
        return $data;
    }

    /**
    * Sum by col
    * date:
    *
    * @param
    *
    * @author ntdat <datnt@baokim.vn>
    * @return int sum
    */
    // public function sum($filters = [], $colName) {
    //     $query = $this->query([], $filters, []);
    //     $data = $query->sum($colName);
    //     return $data;
    // }

    /**
    * Query to count record table
    * 08/04/2019
    *
    * @param array filters: column name => value of column for query
    * @param array select:
    *
    * @author ntdat <datnt@baokim.vn>
    * @return Eloquent query
    */
    public function query($select, $filters, $sort) {
        $query = $this->model;
        if(!empty($select)) {
            foreach($select as $key => $colName) {
                if(!in_array($colName, $this->fields)) {
                    unset($select[$key]);
                }
            }
            $query = $query->select($select);
        }
        if(!empty($filters)) {
            foreach($filters as $column => $value) {
                if(strcmp($column, 'BETWEEN') == 0) {
                    foreach($value as $colName => $colVal) {
                        if(is_array($colVal) && count($colVal) == 2) {
                            if(in_array($colName, $this->fields)) {
                                $query = $query->whereBetween($colName, $colVal);
                            }
                        }
                    }
                } else if(in_array($column, $this->fields)) {
                    if(strcmp($value, 'NULL') == 0) {
                        $query = $query->whereNull($column);
                    } else if(strcmp($value, 'NOT_NULL') == 0) {
                        $query = $query->whereNotNull($column);
                    } else if(strcmp($value, 'NOT_FILTER') == 0 || strcmp($value, "") == 0) {
                        continue;
                    } else {
                        $query = $query->where($column, $value);
                    }
                } else if(strcmp($column, 'LIKE') == 0) {
                    foreach($value as $colName => $colVal) {
                        if(in_array($colName, $this->fields)) {
                            $query = $query->where($colName, 'LIKE', "%$colVal%");
                        }
                    }
                } else if(strcmp($column, 'NOT_EQUAL') == 0) {
                    foreach($value as $colName => $colVal) {
                        if(in_array($colName, $this->fields)) {
                            $query = $query->where($colName, '!=', $colVal);
                        }
                    }
                } else if(strcmp($column, 'WHERE_IN') == 0) {
                    foreach($value as $colName => $colVal) { // colVal is an array
                        if(in_array($colName, $this->fields)) {
                            if(is_array($colVal)) {
                                $query = $query->whereIn($colName, $colVal);
                            }
                        }
                    }
                } else if(strcmp($column, 'WHERE_NOT_IN') == 0) {
                    foreach($value as $colName => $colVal) { // colVal is an array
                        if(in_array($colName, $this->fields)) {
                            if(is_array($colVal)) {
                                $query = $query->whereNotIn($colName, $colVal);
                            }
                        }
                    }
                } else if(strcmp($column, 'LESS_THAN') == 0) {
                    foreach($value as $colName => $colVal) {
                        if(in_array($colName, $this->fields)) {
                            $query = $query->where($colName, '<', $colVal);
                        }
                    }
                } else if(strcmp($column, 'GREATER_THAN') == 0) {
                    foreach($value as $colName => $colVal) {
                        if(in_array($colName, $this->fields)) {
                            $query = $query->where($colName, '>', $colVal);
                        }
                    }
                } else if(strcmp($column, 'WHERE_DATE') == 0) {
                    foreach($value as $colName => $colVal) {
                        if(in_array($colName, $this->fields)) {
                            $query = $query->whereDate($colName, '=', $colVal);
                        }
                    }
                } else if(strcmp($column, 'WHERE_MONTH') == 0) {
                    foreach($value as $colName => $colVal) {
                        if(in_array($colName, $this->fields)) {
                            $query = $query->where($colName, 'LIKE', $colVal."%");
                        }
                    }
                } else if(strcmp($column, 'WHERE_YEAR') == 0) {
                    foreach($value as $colName => $colVal) {
                        if(in_array($colName, $this->fields)) {
                            $query = $query->whereYear($colName, '=', $colVal);
                        }
                    }
                }
            }
        }
        if(!empty($sort)) {
            foreach($sort as $column => $type) {
                if(in_array($column, $this->fields)) {
                    $query = $query->orderBy($column, $type);
                }
            }
        } else {
            $query = $query->orderBy($this->primaryKey, 'desc');
        }
        return $query;
    }
}

?>
