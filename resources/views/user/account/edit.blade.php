@extends('user.layout.master')
@section("section")
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-4 offset-6">
                @if(session('updateSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h5>{{ session('updateSuccess') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
            </div>

            <div class="col-lg-8 offset-2 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 fs-3">Edit Account</h3>
                            </div>

                            <form action="{{ route('user#accountUpdate',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="row mt-5">
                                <div class="col-6 mt-3">
                                    <div class="row">
                                        <div class="d-flex justify-content-center">
                                            @if (Auth::user()->image==null)
                                            <img src="{{ asset('image/default.png') }}" class="img-thumbnail col-8"/>
                                            @else
                                            <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="John Doe" class="img-thumbnail col-8"/>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-8 offset-2">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                    @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="row">
                                        <div class="mt-5 col-6 offset-3">
                                            <a href="">
                                                <button class="btn btn-secondary text-white"><i class="fa-solid fa-circle-right me-3"></i>Update Profile</button>
                                            </a>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-6 mt-3">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" type="text" name="name" placeholder="Name" value="{{ Auth::user()->name }}">
                                </div>
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="text" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                             </div>
                             @error('email')
                                <small class="text-danger">{{ $message }}</small>
                             @enderror
                                 <div class="form-group">
                                <label>Phone</label>
                                <input class="form-control" type="text" name="phone" placeholder="Phone" value="{{ Auth::user()->phone }}">
                                    </div>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="form-group">
                                            <label>Address</label>
                                    <textarea class="form-control" name="address">{{ Auth::user()->address }}</textarea>
                                            </div>
                                        @error('address')
                                <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <div class="form-group">
                                 <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="">Choose gender....</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>

                                        </select>
                         </div>



                            <div class="form-group">
                        <label>Role</label>
                        <input class="form-control" type="button" name="role" value="{{ Auth::user()->role }}">
                        </div>


                         </div>

                        </form>
                </div>
        </div>
    </div>
</div>
@endsection
