<?php

namespace App\Http\Controllers;

use App\Example;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExampleController extends Controller
{

    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        $this->validate($request, Example::validationFormRules());

        $example = Example::create(Example::setUserData($request));
        return $this->successResponse($example, Response::HTTP_CREATED);

    }

    /**
     * Show a resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function show($id = null)
    {

        $examples = (is_null($id)) ? Example::all() : Example::findOrFail($id);
        return $this->successResponse($examples);

    }

    /**
     * Update one resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, Example::validationFormRules());

        $example = Example::findOrFail($id);
        $example->fill(Example::setData($request));

        if ($example->isClean()) {

            return $this->errorResponse('É preciso atualizar pelo menos 1 campo', Response::HTTP_UNPROCESSABLE_ENTITY);

        }

        $example->save();

        return $this->successResponse($example);

    }

    /**
     * Delete one resource.
     *
     * @return Illuminate\Http\JsonResponse
     *
     */
    public function delete($id)
    {

        $example = Example::findOrFail($id);
        $example->delete();

        return $this->successResponse($example);

    }

}
