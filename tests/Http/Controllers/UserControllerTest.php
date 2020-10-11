<?php

namespace Test\Http\Controllers;

use TestCase;

class UserControllerTest extends TestCase
{
    public function testShouldReturnAllUsers()
    {
        $this->get('api/v1/users');

        $this->assertEquals(
            'all', $this->response->getContent()
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
