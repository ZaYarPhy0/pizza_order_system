@extends('user.layout.master')
@section('section')
<div class="row col-8 offset-2 mt-5">
    <form action="{{ route('user#contact') }}" method="POST">
        @csrf
        <div class="bg-light p-3 shadow-sm">

            <div class="row" >
                <h2 class="text-center col-8 offset-2 pb-3" style="border-bottom: 1px solid rgb(39, 37, 37)">Contact Us</h2>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="userName" class="form-control @error('userName') is-invalid @enderror" id="" placeholder="Enter Your Name">
                    @error('userName')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <label for="" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="" placeholder="Enter Your Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="" class="form-label">Message</label>
                        <textarea name="message" id="" cols="30" rows="10" class="form-control @error('message') is-invalid @enderror" placeholder="Enter your message"></textarea>
                    </div>
                    @error('message')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="row mt-3">
                    <div class="col-1 offset-11">
                        <input type="submit" value="Send" class="btn btn-primary text-white">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
