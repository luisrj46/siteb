@extends('errors::minimal')

@section('title', __('Servicio No Disponible'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Servicio No Disponible'))
