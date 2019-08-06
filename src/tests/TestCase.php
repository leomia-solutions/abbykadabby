<?php

namespace Tests;

use App\User;
use Codeception\Specify;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, Specify;

    /** @var App\User */
    protected $defaultUser;

    public function setUp(): void
    {
        $this->setUpBaseModels();

        parent::setUp();
    }

    /**
     * Sets up the basic models needed for most tests
     */
    public function setUpBaseModels()
    {
        $this->defaultUser = $this->createUser();
    }

    /**
     * Creates a basic User
     *
     * @param array $params
     *
     * @return User
     */
    public function createUser(array $params = []): User
    {
        return app(User::class, array_merge([
            // todo
        ], $params));
    }
}
