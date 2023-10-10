<?php

namespace App\Http\Services\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface ServiceInterface {

    public function index(Request $request): object;
    
    public function form(Request $request, Model $model): array;
    
    public function store(Request $request): void;

    public function show(Model $model): Model;

    public function update(Request $request, Model $model): void;
    
    public function destroy(Model $model): void;

}