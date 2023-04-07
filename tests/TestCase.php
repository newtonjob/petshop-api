<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signInAsAdmin()
    {
        $this->be(User::factory()->admin()->create(), 'api');
    }

    public function signIn()
    {
        $this->be(User::factory()->create(), 'api');
    }
}
