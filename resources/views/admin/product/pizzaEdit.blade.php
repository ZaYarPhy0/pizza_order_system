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



            <div class="col-lg-10 offset-1 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <a href="{{ route('product#pizzaListPage') }}" class="ms-3"><i class="fa-solid fa-arrow-left"></i></a>
                        </div>
                        <div class="row mt-5">
                            <div class="col-5 mt-3">
                               <div class="row">
                                <div class=" d-flex justify-content-center">
                                    <img src="{{ asset('storage/'. $product->image) }}" alt="" class="img-thumbnail shadow-sm w-75">
                                </div>
                               </div>
                            </div>
                            <div class="col-7 mt-3">
                                <h4 class="mb-3 btn btn-danger text-white">{{ $product->name }}</h4>
                                <div class="mb-3 d-flex flex-wrap gap-2" >
                                    <div class="mr-1 btn btn-dark text-white"><i class="fa-solid fa-money-bill mr-2"></i>{{ $product->price }} Kyats</div>
                                    <div class="mr-1 btn btn-dark text-white"><i class="fa-solid fa-clock mr-2"></i>{{ $product->waiting_time }} min</div>
                                    <div class="mr-1 btn btn-dark text-white"><i class="fa-solid fa-eye mr-2"></i>{{ $product->view_count }}</div>
                                    <div class="mr-1 btn btn-dark text-white"><i class="fa-solid fa-clone me-2"></i>{{ $product->category_name }}</div>
                                    <div class=" btn btn-dark text-white"><i class="fa-solid fa-calendar-days me-2"></i>{{ $product->created_at->format('j F Y') }}</div>
                                </div>
                               <div class="mt-3">
                                <h5 class="mt-3 mb-3"><i class="fa-solid fa-file me-2"></i>Description</h5>
                                <span>{{ $product->description }}</span>
                               </div>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5">
                            <div class="col-5 offset-1">
                                <a href="{{ route('product#updatePage',$product->id) }}">
                                    <button class="btn btn-primary text-white"><i class="fa-solid fa-pen-to-square me-3"></i>Edit Pizza</button>
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
