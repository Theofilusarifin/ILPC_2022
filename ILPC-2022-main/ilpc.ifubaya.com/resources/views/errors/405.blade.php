@extends('errors::main', ['backToRoute' => 'pemain.contest', 'backToName' => 'Contest Page'])

@section('title', __('Page Not Found'))
@section('message', __($exception->getMessage() ?: 'Page Not Found'))
