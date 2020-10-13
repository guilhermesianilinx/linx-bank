<?php

namespace Test\Http\Controllers;

use App\Repositories\UserAccountTransactionRepositoryInterface;
use Laravel\Lumen\Testing\DatabaseTransactions as TestingDatabaseTransactions;
use TestCase;

class UserAccountTransactionControllerTest extends TestCase
{
    use TestingDatabaseTransactions;

    private UserAccountTransactionRepositoryInterface $userAccountTransactionRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userAccountTransactionRepository = app(UserAccountTransactionRepositoryInterface::class);
    }

    public function testShouldCreateNewDepositTransaction()
    {
        $this->post(
            'api/v1/users/1/accounts/1/deposit',
            [
                'amount' => 100
            ]
        );
        $expectedResult = 201;

        $this->assertEquals(
            $expectedResult,
            $this->response->getStatusCode()
        );
    }

    public function testShouldCreateNewWithDrawTransaction()
    {
        $this->post(
            'api/v1/users/1/accounts/1/withdraw',
            [
                'amount' => 100
            ]
        );
        $expectedResult = 201;

        $this->assertEquals(
            $expectedResult,
            $this->response->getStatusCode()
        );
    }

    public function testShouldReturnInvalidHttpStatusCodeWhenWithdrawIsInvalid()
    {
        $this->post(
            'api/v1/users/1/accounts/1/withdraw',
            [
                'amount' => 19
            ]
        );
        $expectedResult = 422;

        $this->assertEquals(
            $expectedResult,
            $this->response->getStatusCode()
        );
    }
}
