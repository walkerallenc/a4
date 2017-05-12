@extends('layouts.master')
{{--#################################################################################--}}
{{--#   CSCI E-15 Dynamic We Applications.                                          #--}}          
{{--#   Developer: Allen C. Walker                                                  #--}}          
{{--#################################################################################--}}

@push('head')
    <link href='/acw/acw.css' rel='stylesheet'>
@endpush

@section('title')
    {{ $employee->title }}
@endsection

@section('content')

    <nav>
        <ul>
            <a href='/'>Home</a><br>
            <a href='/security/new'>Add an employee</a><br>
            <form method='POST' id='logout' action='/logout'>
                {{csrf_field()}}
                <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
            </form>
        </ul>
    </nav> 

    <div class='book cf'>

        <h1>{{ $employee->title }}</h1>

        <p>First Name: {{ $employee->first_name }}</p>

        <p>Last Name: {{ $employee->last_name }}</p>

        <p>Last updated: {{ $employee->team_id }}</p>

        <p>Created at: {{ $employee->created_at }}</p>

        <p>Last updated: {{ $employee->updated_at }}</p>

    </div>
@endsection
