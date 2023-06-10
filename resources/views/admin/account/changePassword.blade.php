@extends('admin.layouts.master')
@section("section")
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            {{-- password change alert --}}
            <div class="col-lg-3 offset-6">
                @if(session('changePassword'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h5>{{ session('changePassword') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
            </div>
            {{-- password does not match --}}
            <div class="col-lg-5 offset-4">
                @if (session('notMatch'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h5>{{ session('notMatch') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>



            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Your Password</h3>
                        </div>
                        <hr>
                        <form action="{{ route('account#changePassword') }}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password" class="form-control @if (session('notMatch')) is-invalid @endif @error('oldPassword')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="Old Password..">
                                @error('oldPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="New Password...">
                                @error('newPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="Confirm Password...">
                                @error('confirmPassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Change</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
