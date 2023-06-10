@extends('layout.master')
@section('title')
<title>Login Page</title>
@endsection
@section('content')
<div class="login-form">
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="Email" autocomplete="off">
        </div>
        @error('email')
        <small class="text-danger">{{ $message }}</small>

        @enderror

        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password" id="password">
        </div>
        @error('password')
        <small class="text-danger">{{ $message }}</small>

        @enderror
        <div class="form-group">
            <input type="checkbox" onclick="myFunction()" class="form-conrrol">
            show password
        </div>
        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

    </form>
    <div class="register-link">
        <p>
            Don't you have account?
            <a href="{{route('Auth#registerPage')}}">Sign Up Here</a>
        </p>
    </div>
</div>
@endsection
@section('script')
    <script>
        function myFunction(){
        let x= document.querySelector('#password');
        if(x.type==="password"){
            x.type="text";
    }else{
        x.type="password";
    }
}
    </script>
@endsection
