@extends('errors::minimal')

@section('title', __('No encontrado'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'No encontrado'))
