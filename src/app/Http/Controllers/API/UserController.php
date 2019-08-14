<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Requests\API\Users\CreateRequest;
use App\Http\Requests\API\Users\LoginRequest;
use App\Http\Requests\API\Users\UpdateRequest;
use App\Http\Resources\UserCollection;
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
     * @return \App\Http\Resources\UserCollection
     */
    public function list(): UserCollection
    {
        return new UserCollection(User::query()->paginate());
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
     * @return \Illuminate\Http\Resposne
     */
    public function me(): Response
    {
        $user = Auth::user();

        if (!$user) {
            abort(404);
        }

        return response(['data' => new UserResource($user)], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id, UserService $service): Response
    {
        return response(['data' => new UserResource($service->findOrFail($id))], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\UpdateRequest  $request
     * @param  \App\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
