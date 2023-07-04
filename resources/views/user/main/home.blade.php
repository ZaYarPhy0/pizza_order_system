@extends('user.layout.master')
@section('title')
<title>Pizza Order Website</title>
@endsection
@section('section')


<!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class=" position-relative text-uppercase mb-3"><span class="pr-3">Filter by Categories</span></h5>
            <div class="bg-light p-4 mb-30 shadow-sm">
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3 px-3 py-2 btn btn-dark">
                        {{-- <input type="checkbox" class="custom-control-input" checked id="price-all"> --}}
                        <label class="" for="price-all">Categories</label>
                        <span class="badge border font-weight-normal">{{ count($category) }}</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">

                        <a href="{{route('user#home')}}"><label class="" for="price-1">All</label></a>
                    </div>


                    @foreach ($category as $c)
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">

                        <a href="{{route('user#filter',$c->id)}}"><label class="" for="price-1">{{ $c->name }}</label></a>
                    </div>

                    @endforeach

                </form>

            </div>
            <!-- Price End -->



        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <a href="{{ route('cart#list') }}">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{ count($cart) }}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                  </button>
                            </a>
                            <a href="{{ route('cart#history') }}" class="ms-3">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="fa-solid fa-clock-rotate-left me-2"></i>History
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{ count($order) }}

                                    </span>
                                  </button>
                            </a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">

                                <select name="sorting" id="sortingOption" class="form-control">
                                    <option value="">Choose option..</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            @if (count($product))
            <div class="d-flex flex-wrap" id="dataList">
                @foreach ($product as $p)
            <a href="detail.html">
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">

                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 250px" src="{{ asset('storage/'. $p->image) }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#detail',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                </div>

                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $p->price }} kyats</h5>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>

                </div>
            </a>
            @endforeach
        </div>
        @else
         <h2 class="text-center mt-5 text-danger">There is no pizza product<i class="fa-solid fa-pizza-slice ms-3"></i></h2>

            @endif
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection
@section('script')
<script>


$(document).ready(function(){

$('#sortingOption').change(function(){
    $eventOption=$('#sortingOption').val();
    if($eventOption=='asc'){
        $.ajax({
            type:'get',

            url:'http://127.0.0.1:8000/user/ajax/data',
            data:{'status':'asc'},
            dataType:'json',
            success:function(response){
                $list='';
                for($i=0;$i<response.length;$i++){
                    $list+=`<a href="detail.html">
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">

                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 250px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="http://127.0.0.1:8000/user/pizza/detail/${response[$i].id}"><i class="fa-solid fa-circle-info"></i></i></a>
                                    </div>

                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>

                    </div>
                </a>`;
                }
                // console.log($list);
                $('#dataList').html($list);
            }
        })

    }else if($eventOption=='desc'){
        $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/data',
            data:{'status':'desc'},
            dataType:'json',
            success:function(response){
                $list='';
                for($i=0;$i<response.length;$i++){
                    $list+=`<a href="detail.html">
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">

                            <div class="product-item bg-light mb-4">
                                <div class="product-img position-relative overflow-hidden">
                                    <img class="img-fluid w-100" style="height: 250px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                    <div class="product-action">
                                        <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-outline-dark btn-square" href="http://127.0.0.1:8000/user/pizza/detail/${response[$i].id}"><i class="fa-solid fa-circle-info"></i></a>
                                    </div>

                                </div>
                                <div class="text-center py-4">
                                    <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                    <div class="d-flex align-items-center justify-content-center mt-2">
                                        <h5>${response[$i].price} kyats</h5>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-1">
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                        <small class="fa fa-star text-primary mr-1"></small>
                                    </div>
                                </div>
                            </div>

                    </div>
                </a>`;
                }
                $('#dataList').html($list);
            }
        })
    }
})
});


</script>
@endsection
