@extends('admin.layouts.master')
@section('title')
<title>Admin List Page</title>
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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Category
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



               <div class="row">
                <div class="col-4">
                    <h5>Search Key:<span class="ms-1 text-danger">{{ request('key') }}</span></h5>

                </div>
                <div class="col-3 offset-5">
                    <form action="{{ route('category#list') }}" method="get">
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
                   <h3 class="bg-white shadow-sm px-1 text-center py-1"> <i class="fa-solid fa-database"></i> | {{ $admin->total() }}</h3>
                </div>
               </div>
                {{-- start data table --}}

                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $a)
                            <tr class="tr-shadow">
                               <td class="col-2">
                                    <div class="image">
                                         @if ($a->image==null)
                                                <img src="{{ asset('image/default.png') }}" class="img-thumbnail"/>
                                            @else
                                                <img src="{{ asset('storage/'.$a->image) }}" class="img-thumbnail"/>
                                         @endif

                                    </div>
                                </td>
                               <td>{{ $a->name }}</td>
                               <td>{{ $a->email }}</td>
                               <td>{{ $a->gender }}</td>
                               <td>{{ $a->phone }}</td>
                               <td>{{ $a->address }}</td>

                                <td>
                                    <div class="table-data-feature">

                                        @if (Auth::user()->id==$a->id)
                                        @else
                                        <a href="{{ route('account#adminChangeRole',$a->id) }}" class="mr-2">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="change Role">
                                                <i class="fa-solid fa-person-circle-minus"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('account#adminDelete',$a->id) }}"><button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button></a>


                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="">{{ $admin->links() }}</div>
                </div>
                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>

@endsection
