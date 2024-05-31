<?php

namespace Core;

class Model
{
    protected $fields_array;
    public $primary_key = 'id';

    public function __construct()
    {
        $this->fields_array = [];
    }
    public function __set($name, $value)
    {
        $this->fields_array[$name] = $value;
    }

    public function __get($name)
    {
        return $this->fields_array[$name];
    }

    public function save()
    {
        $value = $this->{$this->primary_key};
        if (empty($value)) {
            Core::get()->db->insert($this->table, $this->fields_array);
        } else {
            Core::get()->db->update(
                $this->table,
                $this->fields_array,
                [
                    $this->primary_key => $this->{$this->primary_key}
                ]
            );
        }
    }
}
