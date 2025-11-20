@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome to Student!</h1>
    <p>Hello <strong>{{ Auth::user()->name }}</strong>, You are logged in!</p>
@endsection