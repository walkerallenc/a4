@extends('layouts.master')

@push('head')
    <link href='/css/books.css' rel='stylesheet'>
@endpush

@section('title')
    {{ $employee->title }}
@endsection

@section('content')

    <div class='book cf'>

        <h1>{{ $employee->title }}</h1>

       {{-- <a href='/books/{{ $book->id }}'><img class='cover' src='{{ $book->cover }}' alt='Cover for {{ $book->title }}'></a> --}}

        <p>First Name: {{ $employee->first_name }}</p>

        <p>Last Name: {{ $employee->last_name }}</p>

        <p>Last updated: {{ $employee->team_id }}</p>

        <p>Created at: {{ $employee->created_at }}</p>

        <p>Last updated: {{ $employee->updated_at }}</p>

    </div>
@endsection
