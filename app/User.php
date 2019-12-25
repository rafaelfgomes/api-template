<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{

    use HasApiTokens, Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static function validationFormRules($isUpdate = false, $id = null)
    {

        $emailRule = ($isUpdate) ? 'required|email|unique:users,email' . $id : 'required|email';

        $rules = [

            'name' => 'required|string',
            'email' => $emailRule,

        ];

        if (!$isUpdate) {

            $rules['password'] = 'required|string|min:6';

        }

        return $rules;

    }

    public static function setData($data, $isUpdate = false)
    {

        $fields = [

            'name' => $data->input('name'),
            'email' => $data->input('email')

        ];

        if (!$isUpdate) {

            $fields['password'] = Hash::make($data->input('password'));

        }

        return $fields;

    }

}
