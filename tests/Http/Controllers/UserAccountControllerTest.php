<?php

namespace Test\Http\Controllers;

use App\Repositories\UserAccountRepositoryInterface;
use Laravel\Lumen\Testing\DatabaseTransactions as TestingDatabaseTransactions;
use TestCase;

class UserAccountControllerTest extends TestCase
{
    use TestingDatabaseTransactions;

    private UserAccountRepositoryInterface $userAccountRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userAccountRepository = app(UserAccountRepositoryInterface::class);
    }

    public function testShouldNewUserCreated()
    {
        $this->post('api/v1/users/1/accounts/savings-account');
        $expectedResult = 201;

        $this->assertEquals(
            $expectedResult,
            $this->response->getStatusCode()
        );
    }
}
