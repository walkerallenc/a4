@extends('layouts.master')

@section('title')
    Login form
@endsection

@section('content')
    <form method='GET' action='/security'>
        <div class='/css/acw.css'>
            <label for='employee_id'>Employee:</label>    
            <select id='employee_id' name='id'>   
                <option value='0'>Add Employee</option>
                @foreach($employees as $employee)
                    <option value='{{ $employee->id }}'>
                        {{ $employee->first_name }}
                        {{ $employee->last_name }}
                    </option>
                @endforeach
            </select><br>
        <input type='radio' name='edit_delete' id='edit' value='edit' 'CHECKED'> Edit employee<br>
        <input type='radio' name='edit_delete' id='delete' value='delete' > Delete employee<br>
        <input type='submit' class='/css/acw.css' name='processaction' value='submit'>
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