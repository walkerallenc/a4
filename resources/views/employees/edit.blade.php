@extends('layouts.master')

@section('title')
   Edit employee: {{ $employee->title }}
@endsection

@push('head')
    <link href='/acw/acw.css' rel='stylesheet'>
@endpush

@section('content')
    <h1>Edit</h1>

    <div>{{ Session::get('message') }}</div><br>    

    <b>Title:</b> {{ $employee->title }}  <br>
    <b>Last name:</b> {{ $employee->last_name }} <br>
    <b>First name:</b> {{ $employee->first_name }}

   {{--<form method='POST' action='/employees/edit'>--}}
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

     <form method='POST' action='/save'>

        {{ csrf_field() }}

        <input type='hidden' name='id' value='{{$employee->id}}'>                                                    
        <label><b>Categories</b></label>
        <ul id='tags'>
            @foreach($categoriesForCheckboxes as $id => $name)
                <li><input
                    type='checkbox'
                    value='{{ $id }}'
                    id='tag_{{ $id }}'
                    name='tags[]'
                    {{ (in_array($name, $categoriesForThisEmployee)) ? 'CHECKED' : '' }}
                >&nbsp;
                <label for='tag_{{ $id }}'>{{ $name }}</label></li>
            @endforeach
        </ul>

        {{-- Extracted error code to its own view file --}}
        {{-- @include('errors')                        --}} 

        <br><input class='btn btn-primary' type='submit' value='Save changes'><br><br>

    </form>



@endsection
