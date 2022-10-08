@extends('errors::main', ['backToRoute' => 'pemain.rally', 'backToName' => 'Semifinal Page'])

@section('title', __('Unauthorized Access'))
@section('message', __($exception->getMessage() ?: 'Unauthorized Access'))
