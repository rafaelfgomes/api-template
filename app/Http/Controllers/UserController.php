<?php

namespace App\Http\Controllers;

use App\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     *
     */
    public function __construct()
    {
        //
    }

     /**
     * Show all users.
     *
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function index()
    {

        $users = User::all();
        return $this->successResponse($users);

    }

    /**
     * Create an resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function store(Request $request)
    {

        $user = User::create($request->all());
        return $this->successResponse($user, Response::HTTP_CREATED);

    }

    /**
     * Show one or all resources
     *
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function show($id)
    {

        $user = User::findOrFail($id);
        return $this->successResponse($user);

    }

    /**
     * Update a resource
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->fill($request->all());

        if ($user->isClean()) {

            return $this->errorResponse('É preciso atualizar pelo menos 1 campo', Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        $user->save();

        return $this->successResponse($user);

    }

    /**
     * Delete a resource
     *
     * @param int $id
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function delete($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return $this->successResponse($user);

    }

}
