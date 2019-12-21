<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

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

    public static function validationFormRules($isUserUpdate = false)
    {

        $emailRule = (!$isUserUpdate) ? 'required|email' : 'required|email|unique:users';

        $rules = [

            'name' => 'required|string',
            'email' => $emailRule,

        ];

        if (!$isUserUpdate) {

            $rules['password'] = 'required|string|min:6';

        }

        return $rules;

    }

    public static function setUserData($data, $isUserUpdate = false)
    {

        $userData = [

            'name' => $data->input('name'),
            'email' => $data->input('email')

        ];

        if (!$isUserUpdate) {

            $userData['password'] = Hash::make($data->input('password'));

        }

        return $userData;

    }

}
