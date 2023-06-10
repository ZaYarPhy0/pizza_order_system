@extends('admin.layouts.master')
@section("section")
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('product#pizzaListPage') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>

            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create Your Pizza </h3>
                        </div>
                        <hr>
                        <form action="{{ route('product#pizzaCreate') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="pizzaName" type="text" class="form-control @error('pizzaName')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="pizza name....." value="{{old('pizzaName')}}">
                                @error('pizzaName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1 @error('categoryId')
                                is-invalid
                            @enderror">Category</label>
                                <select name="categoryId" class="form-control">
                                    <option value="">Choose category</option>
                                    @foreach ($categories as $c)
                                    <option value="{{ $c->id }}" {{ old('categoryId')==$c->id ? "selected" : ""}}>{{ $c->name }}</option>

                                    @endforeach
                                </select>
                                @error('categoryId')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1 @error('description')
                                is-invalid
                            @enderror">Description</label>
                                <textarea name="description" class="form-control" cols="30" rows="10" placeholder="Enter description...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input id="cc-pament" name="image" type="file" class="form-control @error('image')
                                is-invalid
                            @enderror" aria-required="true" aria-invalid="false" value="{{ old('image') }}">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" name="waitingTime" type="number" class="form-control @error('waitingTime')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="waiting time....." value="{{ old('waitingTime') }}">
                                @error('waitingTime')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" type="number" class="form-control @error('price')
                                    is-invalid
                                @enderror" aria-required="true" aria-invalid="false" placeholder="pizza price....." value="{{ old('price') }}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mt-3">
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block mt-3">
                                    <span id="payment-button-amount">Create</span>
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
