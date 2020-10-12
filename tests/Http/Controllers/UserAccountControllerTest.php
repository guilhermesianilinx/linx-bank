<?php

namespace Test\Http\Controllers;

use App\Models\UserAccountType;
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

    private function mountEndpoint(int $userId, string $accountType)
    {
        return 'api/v1/users/'. $userId  .'/accounts/'. $accountType;
    }

    public function testShouldCreateANewSavingsAccountWithInitialBalance()
    {

        $newAccount = [
            'user_id' => 1,
            'account_type' =>'savings',
            'initial_balance' => 100
        ];

        $this->post(
            $this->mountEndpoint($newAccount['user_id'], $newAccount['account_type']),
            [
                'initial_balance' => $newAccount['initial_balance']
            ]
        );
        $response = json_decode($this->response->getContent());
        $this->assertEquals(
            201,
            $this->response->getStatusCode(),
            'Asset status http'
        );

        $this->assertEquals(
            $newAccount['initial_balance'],
            $response->balance,
            'Assert Saldo'
        );

        $this->assertEquals(
            $newAccount['user_id'],
            $response->user_id,
            'Assert usuário'
        );

        $this->assertEquals(
            UserAccountType::SAVINGS,
            $response->account_type_id,
            'Assert tipo de conta'
        );

    }

    public function testShouldCreateANewCheckingAccountWithInitialBalance()
    {
        $newAccount = [
            'user_id' => 1,
            'account_type' =>'checking',
            'initial_balance' => 100
        ];

        $this->post(
            $this->mountEndpoint($newAccount['user_id'], $newAccount['account_type']),
            [
                'initial_balance' => $newAccount['initial_balance']
            ]
        );
        $response = json_decode($this->response->getContent());
        $this->assertEquals(
            201,
            $this->response->getStatusCode(),
            'Asset status http'
        );

        $this->assertEquals(
            $newAccount['initial_balance'],
            $response->balance,
            'Assert Saldo'
        );

        $this->assertEquals(
            $newAccount['user_id'],
            $response->user_id,
            'Assert usuário'
        );

        $this->assertEquals(
            UserAccountType::CHECKING,
            $response->account_type_id,
            'Assert tipo de conta'
        );
    }
}
