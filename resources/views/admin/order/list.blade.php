@extends('admin.layouts.master')
@section('title')
<title>Order Page</title>
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
                            <h2 class="title-1">Order List</h2>

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


               <div class="row">
                <div class="col-4">
                    <h5>Search Key:<span class="ms-1 text-danger">{{ request('key') }}</span></h5>

                </div>
                <div class="col-3 offset-5">
                    <form action="{{ route('order#listPage') }}" method="get">
                        @csrf
                        <div class="d-flex">
                            <input type="text" class="form-control" name="key" value="{{ request('key') }}" placeholder="Search......">
                            <button class="btn bg-danger text-white" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
               </div>
               <div class="row mt-3">
                <form action="{{ route('order#statusChange') }}" class="col-3" method="get">
                    <div class=" d-flex">

                <div class="me-2">
                    <span class="btn btn-primary shadow-sm text-center"> <i class="fa-solid fa-database"></i> | {{ count($order) }}</span>
                 </div>
                        {{-- <div class="mt-2 me-2"><span class="text-center">Status :</span></div> --}}
                        <select name="searchStatus" id="" class="form-control col-6">
                            <option value="" @if(request('searchStatus')=='')selected @endif>ALL</option>
                            <option value="0" @if(request('searchStatus')=='0')selected @endif>Pending</option>
                            <option value="1" @if(request('searchStatus')=='1')selected @endif>Success</option>
                            <option value="2" @if(request('searchStatus')=='2')selected @endif>Reject</option>
                        </select>
                        <div class=""><button class="btn btn-success" type="submit">Change</button></div>
                     </div>
                   </div>
                </form>
                {{-- start data table --}}
                @if (count($order))
                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Order Code</th>
                                <th>Created Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dataList">
                            @foreach ($order as $o)
                            <tr class="tr-shadow">
                                <td>{{ $o->user_id }}</td>
                                <td>{{ $o->user_name }}</td>
                                <td>
                                    <a href="{{ route('order#orderCodeListPage',$o->order_code) }}"><span class="block-email text-primary">{{ $o->order_code }}</span></a>
                                </td>
                                <td class="">{{ $o->created_at->format('j-F-Y') }}</td>
                                <input type="hidden" name="" class="orderId" value="{{ $o->id }}">

                                <td class="col-4">
                                    <select name="" id="" class="form-control col-4 offset-4 status @if($o->status==0)bg-warning
                                        @elseif($o->status==1)
                                        bg-success
                                        @elseif ($o->status==2)
                                        bg-danger
                                        @else
                                        bg-secondary
                                        @endif text-white">
                                        <option value="0" @if($o->status==0)selected @endif>Pending</option>
                                        <option value="1" @if($o->status==1)selected @endif>Success</option>
                                        <option value="2" @if($o->status==2)selected @endif>Reject</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="">{{ $order->links() }}</div> --}}
                </div>
                @else
                <div class="mt-3">
                    <h3 class="text-center">There is no Orders</h3>
                </div>
                @endif
                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>

@endsection
@section('scriptSource')
<script>
    $(document).ready(function() {
        $('.status').change(function(){
            $parentNode=$(this).parents('tr');
            $childNode=$parentNode.find('.status').val();
            $orderId=$parentNode.find('.orderId').val();
            $.ajax({
                type: 'get',
                url:'http://127.0.0.1:8000/order/list/ajax/status',
                data:{'status':$childNode,
            'orderId':$orderId},
                dataType: "json",
                success: function(response){
                    if(response.message=='success'){
                        window.location.reload();
                    }
                }
            });
        });
    });
</script>
@endsection
