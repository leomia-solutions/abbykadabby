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

	public function testAuthenticate(): void
	{
		$this->specify($this->class.'::authenticate()', function () {
			$this->describe('when passed a user and incorrect password', function () {
				$this->should('throw a NotFoundHttpException and return a 404', function () {
					$this->expectException(NotFoundHttpException::class);

					$this->service->authenticate($this->defaultUser->email, 'incorrect_password');
				});
			});

			$this->describe('when passed a user and correct password', function () {
				$this->should('log the user in using Auth::loginUsingId();', function () {
					$password = $this->faker->password(8);

					$this->defaultUser->password = $password;
					$this->defaultUser->save();

					Auth::shouldReceive('loginUsingId')
						->with($user->id);

					$this->service->authenticate($this->defaultUser->email, $password);
				});
			});
		});
	}
}
