@extends('layouts.master')

@section('title')
    Sales Portal
@endsection

@section('content')

 <div>{{ Session::get('message') }}</div><br>    

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
 <form method='GET' action='/security'>
    <div class='/css/acw.css'>
        <ul> 
            <label for='employee_id'>Employee:</label>    
            <select id='employee_id' name='id'>   
                <option value='0'>*** Choose ***</option>
                @foreach($employees as $employee)
                    <option value='{{ $employee->id }}'>
                        {{ $employee->first_name }}
                        {{ $employee->last_name }}
                    </option>
                @endforeach
            </select><br>
        <input type='radio' name='edit_delete' id='edit' value='edit' checked='CHECKED'> Edit employee<br>
        <input type='radio' name='edit_delete' id='delete' value='delete' > Delete employee<br>
        <input type='submit' class='/css/acw.css' name='processaction' value='submit'>
        </ul>
    </div>
 {{--   <nav>                                                                                          --}}
 {{--       <ul>                                                                                       --}}
 {{--           <li><a href='/'>Home</a></li>                                                          --}} 
 {{--           <li><a href='/search'>Search</a></li>                                                  --}}
 {{--           <li><a href='/books/new'>Add a book</a></li>                                           --}}
 {{--           <li>                                                                                   --}}
 {{--               <form method='POST' id='logout' action='/logout'>                                  --}}
 {{--                   {{csrf_field()}}                                                               --}}
 {{--                   <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>   --}}
 {{--               </form>                                                                            --}} 
 {{--           </li>                                                                                  --}}
 {{--       </ul>                                                                                      --}}
 {{--   </nav>                                                                                         --}}

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