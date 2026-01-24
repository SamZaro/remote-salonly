<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\Feature\FeatureTest;

class RegisterControllerTest extends FeatureTest
{
    public function test_register_route_is_disabled()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->withoutExceptionHandling()->get('/register');
    }
}
