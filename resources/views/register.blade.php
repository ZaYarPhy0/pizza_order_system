@extends('layout.master')
@section('title')
<title>Register Page</title>
@endsection
@section('content')
<div class="login-form">
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input class="au-input au-input--full" type="text" name="name" placeholder="Name">
        </div>
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        <div class="form-group">
            <label>Email Address</label>
            <input class="au-input au-input--full" type="email" name="email" placeholder="example@gmail.com">
        </div>
        @error('email')
        <small class="text-danger">{{ $message }}</small>
    @enderror
        <div class="form-group">
            <label>Password</label>
            <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
        </div>
        @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror
        <div class="form-group">
            <label>Confirm Password</label>
            <input class="au-input au-input--full" type="password" name="password_confirmation" placeholder="Confirm Password">
        </div>
        @error('password_confirmation')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    <div class="form-group">
        <label>Gender</label>
       <select class="form-control" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>

       </select>
    </div>
    @error('gender')
    <small class="text-danger">{{ $message }}</small>
@enderror

        <div class="form-group">
            <label>Phone</label>
            <input class="au-input au-input--full" type="number" name="phone" placeholder="09xxxxxxx">
        </div>
        @error('phone')
        <small class="text-danger">{{ $message }}</small>
    @enderror
        <div class="form-group">
            <label>Address</label>
            <input class="au-input au-input--full" type="text" name="address" placeholder="Address">
        </div>
        @error('address')
        <small class="text-danger">{{ $message }}</small>
    @enderror


        <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>

    </form>
    <div class="register-link">
        <p>
            Already have account?
            <a href="{{ route('Auth#loginPage') }}">Sign In</a>
        </p>
    </div>
</div>
@endsection
