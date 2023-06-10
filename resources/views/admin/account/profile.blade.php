@extends('admin.layouts.master')
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
                            <h3 class="text-center title-2 fs-3">Account Profile</h3>
                        </div>
                        <div class="row mt-5">
                            <div class="col-6 mt-3">
                               <div class="row">
                                <div class=" d-flex justify-content-center">
                                    @if (Auth::user()->image==null)
                                    <img src="{{ asset('image/default.png') }}" class="img-thumbnail w-75"/>
                                    @else
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="John Doe" class="img-thumbnail w-75"/>
                                    @endif
                                </div>
                               </div>
                            </div>
                            <div class="col-6 mt-3">
                                <h4 class="mb-3"><i class="fa-solid fa-user me-3"></i>{{ Auth::user()->name }}</h4>
                                <h4 class="mb-3"><i class="fa-solid fa-envelope mr-3"></i>{{ Auth::user()->email }}</h4>
                                <h4 class="mb-3"><i class="fa-solid fa-phone mr-3"></i>{{ Auth::user()->phone }}</h4>
                                <h4 class="mb-3"><i class="fa-solid fa-address-book mr-3"></i>{{ Auth::user()->address }}</h4>
                                <h4 class="mb-3"><i class="fa-solid fa-mars-and-venus me-3"></i>{{ Auth::user()->gender }}</h4>
                                <h4 class="mb-3"><i class="fa-solid fa-calendar-days me-3"></i>{{ Auth::user()->created_at->format('j F Y') }}</h4>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5">
                            <div class="col-8 offset-2">
                                <a href="{{ route('account#edit') }}">
                                    <button class="btn btn-primary text-white"><i class="fa-solid fa-pen-to-square me-3"></i>Edit Profile</button>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
