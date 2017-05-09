@extends('layouts.master')

@section('title')
    Confirm deletion: {{ $employee->title }}
@endsection

@section('content')

    <h1>Confirm deletion</h1>
    <form method='POST' action='/delete'>

        {{ csrf_field() }}

        <input type='hidden' name='id' value='{{ $employee->id }}'?>

        <h2>Are you sure you want to delete employee: <em>{{ $employee->first_name }} {{ $employee->last_name }}</em>?</h2>

        <input type='submit' value='Yes, delete this employee.' class='btn btn-danger'>

    </form>

@endsection
