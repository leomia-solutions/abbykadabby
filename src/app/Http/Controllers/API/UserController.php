<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Requests\API\Users\CreateRequest;
use App\Http\Requests\API\Users\LoginRequest;
use App\Http\Requests\API\Users\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UserController
{
    use AuthenticatesUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Users\CreateRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRequest $request): Response
    {
        $data = $request->validated();

        unset($data['password_confirmation']);

        $data['api_token'] = Str::random(60);

        return response(['data' => new UserResource(User::create($data))], 201);
    }

    /**
     * @param \App\Http\Requests\API\Users\LoginRequest $request
     * @param \App\Services\UserService $service
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request, UserService $service): Response
    {
        $data = $request->validated();

        $user = $service->authenticate($data['email'], $data['password']);

        return response(['data' => new UserResource($user)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\UpdateRequest  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
