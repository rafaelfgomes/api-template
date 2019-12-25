<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public static function validationFormRules()
    {

        $rules = [

            'name' => 'required|string',

        ];

        return $rules;

    }

    public static function setData($data)
    {

        $fields = [

            'name' => $data->input('name'),

        ];

        return $fields;

    }

}
