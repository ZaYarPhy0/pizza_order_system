@extends('admin.layouts.master')
@section("section")
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-8 offset-2 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('account#adminList') }}" class="ms-3"><i class="fa-solid fa-arrow-left"></i></a>
                            <h3 class="text-center title-2 fs-3">Change Role</h3>
                            </div>

                            <form action="{{ route('account#changeRole',$account->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="row mt-5">
                                <div class="col-6 mt-3">
                                    <div class="row">
                                        <div class="d-flex justify-content-center">
                                            @if ($account->image==null)
                                            <img src="{{ asset('image/default.png') }}" class="img-thumbnail col-8"/>
                                            @else
                                            <img src="{{ asset('storage/'.$account->image) }}" class="img-thumbnail col-8"/>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div class="row mt-5">
                                        <div class="col-8 offset-2">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="mt-5 col-6 offset-3">
                                            <a href="">
                                                <button class="btn btn-primary text-white"><i class="fa-solid fa-circle-right me-3"></i>Update Role</button>
                                            </a>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-6 mt-3">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="au-input au-input--full" type="text" name="name" placeholder="Name" value="{{ $account->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                                <select class="form-control" name="role">
                                                    <option value="">Choose Role....</option>
                                                    <option value="admin" @if ($account->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user">user</option>
                                                </select>
                                </div>
                                <div class="form-group">
                                <label>Email</label>
                                <input class="au-input au-input--full" type="text" name="email" placeholder="Email" value="{{ $account->email }}" disabled>
                             </div>
                                 <div class="form-group">
                                <label>Phone</label>
                                <input class="au-input au-input--full" type="text" name="phone" placeholder="Phone" value="{{ $account->phone }}" disabled>
                                    </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                    <textarea class="form-control" name="address" disabled>{{ $account->address }}</textarea>
                                            </div>
                                    <div class="form-group">
                                     <label>Gender</label>
                                            <select class="form-control" name="gender" disabled>
                                                <option value="">Choose gender....</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                            </select>
                                    </div>
                                </div>

                        </form>
                </div>
        </div>
    </div>
</div>

@endsection
