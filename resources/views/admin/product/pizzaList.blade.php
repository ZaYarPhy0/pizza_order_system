@extends('admin.layouts.master')
@section('title')
<title>Product Page</title>
@endsection
@section('section')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('product#pizzaCreatePage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Pizza
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                {{-- delete alert --}}
                <div class="col-4 offset-8">
                    @if(session('deleteSuccess'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h5>{{ session('deleteSuccess') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
                </div>
                  {{-- create alert --}}
                <div class="col-4 offset-8">
                    @if(session('createSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <h5>{{ session('createSuccess') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                </div>
                {{-- update alert --}}
                <div class="col-4 offset-8">
                    @if(session('updateSuccess'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <h5>{{ session('updateSuccess') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                </div>


               <div class="row">
                <div class="col-4">
                    <h5>Search Key:<span class="ms-1 text-danger">{{ request('key') }}</span></h5>

                </div>
                <div class="col-3 offset-5">
                    <form action="" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" class="form-control" name="key" value="{{ request('key') }}" placeholder="Search......">
                            <button class="btn bg-danger text-white" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
               </div>
               <div class="row mt-3">
                <div class="col-1">
                   <h3 class="bg-white shadow-sm px-1 text-center py-1"> <i class="fa-solid fa-database"></i> |  {{ $products->total() }}</h3>
                </div>
               </div>
               @if (count($products))


                {{-- start data table --}}
                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Pizza Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $p)
                            <tr class="tr-shadow">
                                <td class="col-2">
                                    <img src="{{ asset('storage/'.$p->image) }}" class="img-thumbnail shadow-sm">
                                </td>
                                <td class="col-3">
                                    {{ $p->name }}
                                </td>
                                <td  class="col-2">
                                    {{ $p->price }} Kyats
                                </td>
                                <td class="col-2">
                                    {{ $p->category_name }}
                                </td>

                                <td>
                                    <div class="table-data-feature">
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
                                            <i class="zmdi zmdi-mail-send"></i>
                                        </button> --}}
                                        <a href="{{ route('product#detailsPage',$p->id) }}" class="mr-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('product#deletePizza',$p->id) }}"><button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button></a>
                                        {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="More">
                                            <i class="zmdi zmdi-more"></i>
                                        </button> --}}
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>

                            @endforeach
                        </tbody>
                    </table>
                    <div class="">{{ $products->links() }}</div>
                </div>
                @else
                <div class="mt-3">
                    <h3 class="text-center">There is no product...</h3>
                </div>
                <!-- END DATA TABLE -->
                @endif



            </div>
        </div>
    </div>
</div>

@endsection
