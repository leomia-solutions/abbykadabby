<?php

namespace Tests\Unit\Models;

use App\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected $class = User::class;

    public function testMakeAdmin()
    {
        $this->specify($this->class.'::makeAdmin()', function () {
            $this->describe('for a user that is already an admin', function () {
                $this->should('keep them as an admin and not add an additional admin role', function () {
                    $user = $this->createUser(['roles' => ['admin']]);

                    $this->assertEquals(['admin'], $user->roles);
                    $user->makeAdmin();
                    $this->assertEquals(['admin'], $user->roles);
                });
            });

            $this->describe('for a user that is not an admin', function () {
                $this->should('add the admin role to their list of roles', function () {
                    $user = $this->createUser();

                    $this->assertEmpty($user->roles);
                    $user->makeAdmin();
                    $this->assertEquals(['admin'], $user->roles);
                });
            });
        });
    }

    public function testRevokeAdmin()
    {
        $this->specify($this->class.'::revokeAdmin()', function () {
            $this->describe('for a user who is not an admin', function () {
                $this->should('not change their roles', function () {
                    $user = $this->createUser(['roles' => ['other']]);

                    dd($user->roles);

                    $this->assertFalse(in_array('admin', $user->roles));
                    $user->revokeAdmin();
                    $this->assertEquals(['other'], $user->roles);
                });
            });

            $this->describe('for a user who is an admin only', function () {
                $this->should('empty their roles list', function () {
                    $user = $this->createUser(['roles' => ['admin']]);

                    $this->assertTrue(in_array('admin', $user->roles));
                    $user->revokeAdmin();
                    $this->assertEmpty($user->roles);
                });
            });

            $this->describe('for a user who is an admin and another role', function () {
                $this->should('only remove admin from their list of roles', function () {
                    $user = $this->createUser(['roles' => ['admin', 'other']]);

                    $this->assertTrue(in_array('admin', $user->roles));
                    $this->revokeAdmin();
                    $this->assertEquals(['other'], $user->roles);
                });
            });
        });
    }

    public function testIsAdmin()
    {
        $this->specify($this->class.'::isAdmin()', function () {
            $this->describe('for a user that does not have an admin role', function () {
                $this->should('return false', function () {
                    $this->assertFalse($this->defaultUser->isAdmin());
                });
            });

            $this->describe('for a user that has an admin role', function () {
                $this->should('return true', function () {
                    $this->defaultUser->makeAdmin();
                    $this->defaultUser->save();

                    $this->assertTrue($this->defaultUser->isAdmin());
                });
            });
        });
    }
}
