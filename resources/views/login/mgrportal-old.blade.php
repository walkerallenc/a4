@extends('layouts.master')

@section('title')
    Manager Portal
@endsection

@section('content')
    <form method='GET' action='/mgrportal'>

        <div class='book'>
            <h3>logged in !!!</h3>        
            <p>
                <label for="login">Login</label><br>
                <input type="text" name="login" id=login value='username'}}><br>
                <input type='submit' class='/css/acw.css' value='submit username'>
            </p>
            @foreach($employees as $employee)
                <h2>{{ $employee->title }}</h2>
                <h2>{{ $employee->first_name }}</h2>
                <h2>{{ $employee->last_name }}</h2><br>
            @endforeach
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
@else                                                                                                  
{{--#    @if($login != null)                                                                                #--}}
{{--#        <h3>logged in !!!</h3>        
{{--#    @endif                                                                                             #--}}
@endif                                                                                                 

@endsection