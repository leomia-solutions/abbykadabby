<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Http\Requests\API\Users\CreateRequest;
use App\Http\Requests\API\Users\LoginRequest;
use App\Http\Requests\API\Users\UpdateRequest;
use App\Http\Resources\UserResource;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController
{
    use AuthenticatesUsers;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
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
    public function create(CreateRequest $request)
    {
        $data = $request->validated();

        unset($data['password_confirmation']);

        $data['api_token'] = Str::random(60);

        return response(['data' => new UserResource(User::create($data))], 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!($user && Hash::check($data['password'], $user->password))) {
            abort(404);
        }

        Auth::loginUsingId($user->id);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(UpdateRequest $request, $id)
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
