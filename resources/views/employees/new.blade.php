@extends('layouts.master')
{{--#################################################################################--}}
{{--#   CSCI E-15 Dynamic We Applications.                                          #--}}          
{{--#   Developer: Allen C. Walker                                                  #--}}          
{{--#################################################################################--}}

@section('title')
    New employee
@endsection

@push('head')
    <link href='/acw/acw.css' rel='stylesheet'>
@endpush

<div>{{ Session::get('message') }}</div><br>    

@section('content')
    <h1>Add a new employee</h1>

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

    <form method='POST' action='/save/new'>
        {{ csrf_field() }}

{{--        <small>* Required fields</small>  --}}

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' readonly value='{{ old('title', 'salesperson') }}'><br>

        <label for='firstName'>* First Name</label>
        <input type='text' name='firstName' id='firstName' value='{{ old('firstName', '') }}'><br>

        <label for='lastName'>* Last Name</label>
        <input type='text' name='lastName' id='lastName' value='{{ old('lastName', '') }}'><br>

        <label><b>Categories</b></label>
        <ul id='tags'>
            @foreach($categoriesForCheckboxes as $id => $name)
                <li><input
                    type='checkbox'
                    value='{{ $id }}'
                    id='tag_{{ $id }}'
                    name='tags[]'
                >&nbsp;
                <label for='tag_{{ $id }}'>{{ $name }}</label></li>
            @endforeach
        </ul>



        {{-- Extracted error code to its own view file --}}
{{--        @include('errors') --}}

        <input class='btn btn-primary' type='submit' value='Add new employee.'>
    </form>




@endsection
