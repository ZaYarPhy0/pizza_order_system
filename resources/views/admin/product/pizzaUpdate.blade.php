@extends('admin.layouts.master')
@section("section")
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-10 offset-1 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2 fs-3">Edit Pizza</h3>
                            </div>

                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="pizzaId" value="{{ $product->id }}">
                            <div class="row mt-5">
                                <div class="col-6 mt-3">
                                    <div class="row">
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ asset('storage/'.$product->image) }}" class="img-thumbnail shadow-sm w-75"/>
                                        </div>
                                    </div>
                                    <div class="row mt-5">
                                        <div class="col-8 offset-2">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mt-5 col-6 offset-3">
                                            <a href="">
                                                <button class="btn btn-primary text-white"><i class="fa-solid fa-circle-right me-3"></i>Update Pizza</button>
                                            </a>
                                        </div>
                                    </div>

                            </div>
                            <div class="col-6 mt-3">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="au-input au-input--full" type="text" name="pizzaName" placeholder="Enter Pizza Name" value="{{ $product->name }}">
                                </div>
                                @error('pizzaName')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label>Category</label>
                                <select class="form-control" name="categoryId">
                                    <option value="">Choose Category....</option>
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}" @if ($c->id==$product->id)
                                            selected

                                        @endif>{{ $c->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                @error('categoryId')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label>Description</label>
                                        <textarea class="form-control" name="description" placeholder="Enter description">{{ $product->description }}</textarea>
                                </div>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label>Waiting Time</label>
                                    <input class="au-input au-input--full" type="number" name="waitingTime" placeholder="Enter waiting time..." value="{{ $product->waiting_time }}">
                                </div>
                                @error('waitingTime')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="au-input au-input--full" type="number" name="price" placeholder="Enter pizza price" value="{{ $product->price }}">
                                </div>
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label>View_count</label>
                                    <input class="au-input au-input--full text-left" type="button"  value="{{ $product->view_count }}">
                                </div>
                            </div>
                         </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection
