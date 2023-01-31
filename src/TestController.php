<?php

namespace Oguz\ResponsePackage;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function helloWorld()
    {
        return resolve_response(meta: [
            'code' => 232323,
        ], data: [
            'name' => 'Oguz',
            'surname' => 'Kurukaya']);
        echo "Hello World";
    }
}
