<?php

namespace Test\Http\Controllers;

use App\Repositories\UserRepository;
use TestCase;

class UserControllerTest extends TestCase
{

    private UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = app(UserRepository::class);
    }

    public function testShouldReturnAllUsers()
    {
        $this->get('api/v1/users');

        $users = $this->userRepository->getAllUsers();
        $expectedResult = json_encode($users->toArray());

        $this->assertEquals(
            $expectedResult,
            $this->response->getContent()
        );
    }

    public function testShouldReturnUserRelatedToGivenId()
    {
        $userId = 1;
        $this->get("api/v1/users/{$userId}");

        $this->assertEquals(
            "show {$userId}", $this->response->getContent()
        );
    }

    public function testShouldNewUserCreated()
    {
        $this->post('api/v1/users');

        $this->assertEquals(
            'store', $this->response->getContent()
        );
    }

}
