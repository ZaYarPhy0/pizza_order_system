@extends('admin.layouts.master')
@section('title')
<title>Order code Page</title>
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
                            <a href="{{ route('order#listPage') }}" class="text-decoration-none text-black">
                                <span class="title-1"><i class="fa-solid fa-arrow-left-long me-2"></i>back</span>
                            </a>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        {{-- <a href="{{ route('category#createPage') }}">
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>add Category
                            </button>
                        </a> --}}
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="card col-4">
                        <div class="card-body" style="border-bottom:1px solid black">
                            <h3 class=''><i class="fa-solid fa-clipboard me-2"></i>Order Info</h3>
                            <span class='text-warning'>Include delivery charges</span>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-6 font-weight-bold"><i class="fa-solid fa-user me-2"></i>Name</div>
                                <div class="col-6 text-secondary">{{ strtoupper($orderList[0]->user_name) }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6 font-weight-bold"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                                <div class="col-6 text-secondary">{{ $orderList[0]->order_code }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6 font-weight-bold"><i class="fa-solid fa-clock me-2"></i>Order Date</div>
                                <div class="col-6 text-secondary">{{ $orderList[0]->created_at->format('j-F-Y') }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-6 font-weight-bold"><i class="fa-solid fa-money-bill-wave me-2"></i>Total</div>
                                <div class="col-6 text-secondary">{{ $order->total_price }} Kyats</div>
                            </div>
                        </div>
                    </div>
                </div>

               <div class="row mt-3">

                {{-- start data table --}}
                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order Id</th>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($orderList as $o)
                            <tr class="tr-shadow">
                                <td></td>
                                <td>{{ $o->id }}</td>
                                <td class="col-3"><img src="{{ asset('storage/'.$o->product_image) }}" alt="" class="img-thumbnail shadow-sm"></td>
                                <td>{{ $o->product_name }}</td>
                                <td class="">{{ $o->qty }}</td>
                                <td>{{ $o->total }}</td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="">
                        {{ $orderList->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>

@endsection
@section('scriptSource')

@endsection
