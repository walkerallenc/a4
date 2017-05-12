@extends('layouts.master')
{{--#################################################################################--}}
{{--#   CSCI E-15 Dynamic We Applications.                                          #--}}          
{{--#   Developer: Allen C. Walker                                                  #--}}          
{{--#################################################################################--}}

@section('title')
    Confirm deletion: {{ $employee->title }}
@endsection

@section('content')

    <h1>Confirm deletion</h1>

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

    <form method='POST' action='/delete'>

        {{ csrf_field() }}

        <ul>
            <input type='hidden' name='id' value='{{ $employee->id }}'?>

            <h2>Are you sure you want to delete employee: <em>{{ $employee->first_name }} {{ $employee->last_name }}</em>?</h2>

            <input type='submit' value='Yes, delete this employee.' class='btn btn-danger'>
        </ul>

    </form>

@endsection
