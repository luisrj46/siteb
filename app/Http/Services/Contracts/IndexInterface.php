<?php

namespace App\Http\Services\Contracts;

use Illuminate\Http\Request;

interface IndexInterface {

    public function index(): object;
    
}