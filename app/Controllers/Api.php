<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Api extends ResourceController
{
    public function index()
    {
        return $this->respond(['message' => 'API Works!'], 200);
    }
}
