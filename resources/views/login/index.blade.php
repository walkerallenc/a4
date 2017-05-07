@extends('layouts.master')

@section('title')
    Login form
@endsection

@section('content')
    <form method='GET' action='/security'>
        <div class='/css/acw.css'>
{{--            <p>--}}
{{--                <label for="login">Login</label><br>--}}
{{--                <input type="text" name="login" id=login value='username'}}><br>--}
{{--                <input type='submit' class='/css/acw.css' value='submit username'>--}}
{{--            </p>--}}
{{--            @foreach($books as $book)           --}}
{{--                <h2>{{ $book->title }}</h2>     --}}
{{--                <img src='{{ $book->cover }}'>  --}} 
{{--            @endforeach                         --}}

        <label for='employee_id'>Employee:</label>    
        <select id='employee_id' name='id'>   
            <option value='0'>Choose</option>
            @foreach($employees as $employee)
                <option value='{{ $employee->id }}'>
                    {{ $employee->first_name }}
                    {{ $employee->last_name }}
                </option>
            @endforeach
        </select><br>
        <input type='submit' class='/css/acw.css' value='Edit selected employee'>

{{--             @foreach($employees as $employee)                    --}}
{{--                 <h2>{{ $employee->title }}</h2>                  --}} 
{{--                 <h2>{{ $employee->first_name }}</h2>             --}}
{{--                 <h2>{{ $employee->last_name }}</h2><br>          --}} 
{{--                     <img src='{{ $employee->last_name }}'>       --}}
{{--            @endforeach                                           --}}
        </div>
    </form>

{{--#################################################################################--}}
{{--#If validation error are generated, they are diplayed in the section.           #--}}          
{{--#If validation error are not generated, the calculated word value is displayed. #--}}          
{{--#################################################################################--}}
@if(count($errors) > 0)                                                                                
{{--#    <ul>                                                                                               #--}}
{{--#        @foreach ($errors->all() as $error)                                                            #--}}
{{--#            <li>{{ $error }}</li>                                                                      #--}}
{{--#        @endforeach                                                                                    #--}}
{{--#    </ul>                                                                                              #--}}
@else                                                                                                                                                        {{--#    @if($login != null)                                                                                #--}}
{{--#        <h3>logged in !!!</h3>                                                                         #--}}
{{--#    @endif                                                                                             #--}}
@endif                                                                                                 

@endsection