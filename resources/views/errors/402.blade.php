@extends('errors::minimal')

@section('title', __('Pago requerido'))
@section('code', '402')
@section('message', __($exception->getMessage() ?: 'Pago requerido'))

