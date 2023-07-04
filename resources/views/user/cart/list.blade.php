@extends('user.layout.master')

@section('section')






    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle data-table">
                        @foreach ($cart as $c)
                        <tr>
                            <td><img src="{{ asset('storage/'.$c->pizza_image) }}" alt="" style="width: 50px;" class="img-thumbnail shadow-sm"></td>
                            <td class="align-middle">{{$c->pizza_name}}</td>
                            <input type="hidden" id="productId" value="{{ $c->product_id}}">
                            <input type="hidden" id="orderId" value="{{ $c->id}}">
                            <input type="hidden" id="userId" value={{ Auth::user()->id }}>
                            <td class="align-middle" id="price">{{ $c->pizza_price }} Kyats</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm border-0 text-center" value="{{ $c->qty }}" id="qty">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle col-4" id="total">{{ $c->pizza_price * $c->qty }} Kyats</td>
                            <td class="align-middle"><button class="btn btn-sm btn-danger remove"><i class="fa fa-times"></i></button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $total }} Kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">3000 Kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalOrder">{{ $total + 3000 }} Kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 order"><span class="text-white">Proceed To Checkout</span></button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearCart"><span class="text-white">Clear Cart</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->



@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.btn-plus').click(function() {
            $parentNode=$(this).parents('tr');
            $price=$parentNode.find('#price').text().replace('Kyats','');
            $qty=$parentNode.find('#qty').val();
            $total=$parentNode.find('#total').html($price * $qty +'Kyats');
            summation();

        });
        $('.btn-minus').click(function() {
            $parentNode=$(this).parents('tr');
            $price=$parentNode.find('#price').text().replace('Kyats','');
            $qty=$parentNode.find('#qty').val();
            $total=$parentNode.find('#total').html($price * $qty +'Kyats');
            summation();

        });
        $('.remove').click(function() {

            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/user/ajax/clear/product',
                data:{'productId':$('#productId').val(),
                'orderId':$('#orderId').val()},
                dataType:'json',

            })
            $parentNode=$(this).parents('tr');
            $parentNode.remove();
            summation();

        });
        function summation(){
            $totalPrice=0;
            $('.data-table tr').each(function(index,row){
                $totalPrice +=Number($(row).find('#total').text().replace('Kyats',''));
            });

            $('#subTotal').html(`${$totalPrice} Kyats`);
            $('#totalOrder').html(`${$totalPrice +3000} Kyats`);

        }

        //ajax request
        $('.order').click(function(){
            $array=[];
            $random=Math.floor(Math.random()*100001);
            $('.data-table tr').each(function(index,row){
                $array.push({
                    user_id:$(row).find('#userId').val(),
                    product_id:$(row).find('#productId').val(),
                    qty:$(row).find('#qty').val(),
                    total:$(row).find('#total').text().replace('Kyats','')*1,
                    order_code:'POS'+$random
                });
            });

            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/user/ajax/order',
                data:Object.assign({},$array),
                dataType:'json',
                success:function(response){
                    if(response.status=='success'){
                        window.location.href='http://127.0.0.1:8000/user/home';
                    }
                }

            })
        });
        //clear cart
        $('#clearCart').click(function(){
            $.ajax({
                type:'get',
                url:'http://127.0.0.1:8000/user/ajax/clear/cart',
                dataType:'json',

            })
            $('.data-table tr').remove();
            $('#subTotal').html('0 Kyats');
            $('#totalOrder').html('3000 Kyats');
        });
    });

</script>

@endsection



