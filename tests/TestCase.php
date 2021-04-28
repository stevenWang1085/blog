<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker;

    public function setArticleInit()
    {
        $this->withoutExceptionHandling();

        $this->seed('RootSeeder');
        $this->seed('BoardSeeder');
    }
}
