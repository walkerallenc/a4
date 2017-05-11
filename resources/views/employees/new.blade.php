{{-- /resources/views/books/new.blade.php --}}
@extends('layouts.master')

@section('title')
    New employee
@endsection

@push('head')
    <link href='/css/books.css' rel='stylesheet'>
@endpush

<div>{{ Session::get('message') }}</div><br>    

@section('content')
    <h1>Add a new book</h1>

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

{{--        <label for='teamID'>* Team ID</label>                                                 --}}
{{--        <input type='text' name='teamID' id='teamID' value='{{ old('teamID', '') }}'><br><br> --}}

{{--        <label for='published'>* Published Year</label> --}}
{{--        <input type='text' name='published' id='published' value='{{ old('published', 1960) }}'> --}}

{{--        <label for='cover'>* URL to a cover image</label> --}}
{{--        <input type='text' name='cover' id='cover' value='{{ old('cover', 'http://prodimage.images-bn.com/pimages/9780394800165_p0_v4_s192x300.jpg') }}'>   --}}

{{--        <label for='purchase_link'>* Published Year</label> --}}
{{--        <input type='text' name='purchase_link' id='purchase_link' value='{{ old('purchase_link', 'http://www.barnesandnoble.com/w/green-eggs-and-ham-dr-seuss/1100170349') }}'> --}}

{{--        <label for='author_id'>* Author:</label> --}}
{{--        <select id='author_id' name='author_id'> --}}
{{--            <option value='0'>Choose</option> --}}
{{--            @foreach($authorsForDropdown as $author_id => $authorName) --}}
{{--                <option value='{{ $author_id }}'> --}}
{{--                    {{ $authorName }} --}}
{{--                </option> --}}
{{--            @endforeach --}}
{{--        </select> --}}

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


{{--        <label>Tags</label> --}}
{{--        <ul id='tags'>      --}}
{{--            @foreach($tagsForCheckboxes as $id => $name) --}}
{{--                <li><input  --}}             
{{--                    type='checkbox' --}}
{{--                    value='{{ $id }}' --}}
{{--                    id='tag_{{ $id }}' --}}
{{--                    name='tags[]' --}}
{{--                >&nbsp; --}}
{{--                <label for='tag_{{ $id }}'>{{ $name }}</label></li> --}}
{{--            @endforeach --}}
{{--        </ul> --}}

        {{-- Extracted error code to its own view file --}}
{{--        @include('errors') --}}

        <input class='btn btn-primary' type='submit' value='Add new book'>
    </form>




@endsection
