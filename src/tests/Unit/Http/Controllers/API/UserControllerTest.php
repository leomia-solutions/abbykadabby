<?php

namespace Tests\Unit;

use App\User;
use App\Http\Controllers\API\UserController;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected $class = UserController::class;

    public function testCreate()
    {
        $this->specify($this->class.'::create()', function () {
            $this->describe('when passed invalid parameters', function () {
                $this->should('result in a 422 response', function ($firstName, $lastName, $email, $password) {
                	$data = [
                		'first_name' => $firstName,
                		'last_name' => $lastName,
                		'email' => $email,
                		'password' => $password,
                	];

                	$response = $this->post(route('apiUserCreate'), $data);

                    $response->assertStatus(422);
                }, ['examples' => [
                	[null, $this->faker->lastName, $this->faker->email, $this->faker->password(8)],
                	['', $this->faker->lastName, $this->faker->email, $this->faker->password(8)],
                	[$this->faker->firstName, null, $this->faker->email, $this->faker->password(8)],
                	[$this->faker->firstName, '', $this->faker->email, $this->faker->password(8)],
                	[$this->faker->firstName, $this->faker->lastName, null, $this->faker->password(8)],
                	[$this->faker->firstName, $this->faker->lastName, '', $this->faker->password(8)],
                	[$this->faker->firstName, $this->faker->lastName, $this->faker->email, null],
                	[$this->faker->firstName, $this->faker->lastName, $this->faker->email, ''],
                	[$this->faker->firstName, $this->faker->lastName, $this->faker->email, 'passwor'],
                ]]);
            });

            $this->describe('when passed valid parameters', function () {
                $this->should('result in a 201 response and return the user created', function () {
                	$password = $this->faker->password(8);
                	$requestData = [
                		'first_name' => $this->faker->firstName,
                		'last_name' => $this->faker->lastName,
                		'email' => $this->faker->email,
                		'password' => $password,
                	];
                	$response = $this->post(route('apiUserCreate'), $requestData);

                	$response->assertStatus(201);

                	$data = json_decode($response->getContent(), true);

                	$id = $data['data']['id'];

                	$user = User::find($id);

                	$this->assertEquals([
			            'id' => $user->id,
			            'first_name' => $user->first_name,
			            'last_name' => $user->last_name,
			            'full_name' => $user->full_name,
			            'email' => $user->email,
			        ], $data['data']);

			        $this->assertNotNull($user->api_token);
                });
            });
        });
    }

    public function testLogin()
    {
    	$this->specify($this->class.'::login()', function () {
    		$this->describe('when passed a valid email and password', function () {
    			$this->should('log the user in and return the user object', function () {
					$email = $this->defaultUser->email;
					$password = $this->defaultUser->password;

					$response = $this->post(route('apiUserLogin'), [
						'email' => $email,
						'password' => $password,
					]);

					$response->assertStatus(200);

					$data = $this->responseData($response);

					$this->assertEquals([
						'id' => $this->defaultUser->id,
						'first_name' => $this->defaultUser->first_name,
						'last_name' => $this->defaultUser->last_name,
						'email' => $this->defaultUser->email,
					], $this->responseData($response));
    			});
    		});

    		$this->describe('when passed a username or password that is not in our system', function () {
    			$this->should('return a 404', function () {
    				$email = $this->defaultUser->email;
    				$password = $this->defaultUser->password;

    				$response = $this->post(route('apiUserLogin'), [
    					'email' => $email,
    					'password' => $this->faker->password(9),
    				]);

    				$response->assertStatus(404);

    				$response = $this->post(route('apiUserLogin'), [
    					'email' => $this->faker->email,
    					'password' => $this->faker->password(9),
    				]);

    				$response->assertStatus(404);
    			});
    		});

    		$this->describe('when passed a username and password for a user that has been deleted', function () {
    			$this->should('return a 404', function () {
    				$email = $this->defaultUser->email;
    				$password = $this->defaultUser->password;

    				$this->defaultUser->delete();

    				$response = $this->post(route('apiUserLogin'), [
    					'email' => $email,
    					'password' => $password,
    				]);

    				$response->assertStatus(404);
    			});
    		});
    	});
    }
}
