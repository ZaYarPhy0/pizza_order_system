@extends('user.layout.master')
@section('section')


<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div id="product-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="{{ asset('storage/'.$product->image) }}" alt="Image">
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="" value="{{ $product->id }}" id="pizzaId">
        <input type="hidden" name="" value="{{ Auth::user()->id }}" id="userId">

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3>{{ $product->name }}</h3>
                <div class="mb-3">
                    <small class="pt-1">{{ $product->view_count +1 }} <i class="fa-solid fa-eye"></i></small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{ $product->price }} Kyats</h3>
                <p class="mb-4">{{$product->description}}</p>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-warning btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control border-0 text-center" value="1" id="pizzaCount">
                        <div class="input-group-btn">
                            <button class="btn btn-warning btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-warning px-3" id="addBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                        Cart</button>
                </div>
                <div class="d-flex pt-2">
                    <strong class="text-dark mr-2">Share on:</strong>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <h2 class="text-uppercase mx-xl-5 mb-4"><span class=" pr-3">You May Also Like</span></h2>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($productList as $p)
                <div class="product-item bg-light">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image) }}" alt="" style="height: 250px">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="{{ route('pizza#detail',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5>{{ $p->price }} Kyats</h5>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Products End -->


@endsection
@section('script')
<script>
    $(document).ready(function(){
        // cart btn
        $('#addBtn').click(function(){
            $source={
                'pizzaCount':$('#pizzaCount').val(),
                'userId':$('#userId').val(),
                'pizzaId':$('#pizzaId').val()
            };
            $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/count',
            data:$source,
            dataType:'json',
                success:function(response){
                    if(response.status=='success'){
                        window.location.href='http://127.0.0.1:8000/user/home';
                    }
                }
            })
        })

        // view count
        $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/view/count',
            data:{'productId':$('#pizzaId').val()},
            dataType:'json'
                // success:function(response){
                //     if(response.status=='success'){
                //         window.location.href='http://127.0.0.1:8000/user/home';
                //     }
                // }
            })



    });
</script>
@endsection
