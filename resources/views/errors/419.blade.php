@extends('errors::minimal')

@section('title', __('Pagina expirada'))
@section('code', '419')
@section('message', __($exception->getMessage() ?: 'Pagina expirada'))
