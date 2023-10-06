<!--begin::Card-->
@extends('errors::minimal')
@section('title', __('Url invalida'))
@section('code', '403')
@section('message', __($exception->getMessage() != 'Invalid signature.' ? $exception->getMessage() : 'Url invalida'))