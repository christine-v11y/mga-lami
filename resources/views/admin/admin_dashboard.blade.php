@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome Admin!</h1>
    <p>Hello <strong>{{ Auth::user()->name }}</strong>, You are logged in!</p>
@endsection