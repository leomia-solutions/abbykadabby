<?php

namespace Tests\Unit\Services;

use App\Services\UserService;
use Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    /** @var string */
    protected $class = UserService::class;

    /** @var \App\Services\UserService */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = app(UserService::class);
    }

    public function findOrFail(): void
    {
        $this->specify($this->class.'::findOrFail', function () {
            $this->describe('when passed an unknown uuid', function () {
                $this->should('throw a NotFoundHttpException', function () {
                    $this->expectException(NotFoundHttpException::class);

                    $this->service->findOrFail(uuid());
                });
            });

            $this->describe('when passed the uuid of a deleted model', function () {
                $this->should('throw a NotFoundHttpException', function () {
                    $this->expectException(NotFoundHttpException::class);

                    $user = $this->createUser();
                    $user->delete();
                    $user->save();

                    $this->service->findOrFail($user->id);
                });
            });

            $this->describe('when passed a valid uuid', function () {
                $this->should('return the user object', function () {
                    $user = $this->service->findOrFail($this->defaultUser->id);

                    $this->assertEquals($this->defaultUser, $user);
                });
            });
        });
    }

    public function testAuthenticate(): void
    {
        $this->specify($this->class.'::authenticate()', function () {
            $this->describe('when passed a user and incorrect password', function () {
                $this->should('throw a NotFoundHttpException', function () {
                    $this->expectException(NotFoundHttpException::class);

                    $this->service->authenticate($this->defaultUser->email, 'incorrect_password');
                });
            });

            $this->describe('when passed a user and correct password', function () {
                $this->should('log the user in using Auth::loginUsingId();', function () {
                    $password = $this->faker->password(8);

                    $this->defaultUser->password = $password;
                    $this->defaultUser->save();

                    $this->service->authenticate($this->defaultUser->email, $password);
                });
            });
        });
    }
}
