@extends('layouts.public')

@section('title', 'Registrazione')

@section('content')
<div class="login-hero">
<div class="login-container">
    <h3>Login</h3> 
        <div class="wrap-contact1">
            {{ html()->form()->route('login')->class(['contact-form'])->open() }}
                       
             <div  class="wrap-input">
                {{ html()->label('Username', 'username')->class(['label-input']) }}
                {{ html()->text('username')->class(['input'])->id('username') }}
                @if ($errors->first('username'))
                <ul class="errors">
                    @foreach ($errors->get('username') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            
             <div  class="wrap-input">
                {{ html()->label('Password', 'password')->class(['label-input']) }}
                {{ html()->password('password')->class(['input'])->id('password') }}
             @if ($errors->first('password'))
                <ul class="errors">
                    @foreach ($errors->get('password') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            
            <div class="container-form-btn">                
                {{ html()->submit('Login')->class(['form-btn1']) }}
            </div>
                  
            
            {{ html()->form()->close() }}   
        </div>
    </div>

</div>
@endsection
