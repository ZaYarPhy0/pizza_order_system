@extends('user.layout.master')

@section('section')






    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5 offset-2">
                <table class="table table-light table-borderless table-hover text-center mb-2">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle data-table">
                        @foreach ($order as $o)
                        <tr>
                           <td>{{ $o->created_at->format('F-j-Y') }}</td>
                           <td>{{ $o->order_code }}</td>
                           <td>{{ $o->total_price }} Kyats</td>
                           <td>
                            @if ($o->status==0)
                            <span class="text-warning"><i class="fa-regular fa-clock me2"></i>Pending...</span>
                            @elseif ($o->status==1)
                            <span class="text-success"><i class="fa-solid fa-check me2"></i>Success...</span>
                            @elseif ($o->status==2)
                            <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me2"></i>Reject...</span>

                            @endif
                           </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="">
                    {{ $order->links() }}</div>
            </div>
        </div>
    </div>
    <!-- Cart End -->



@endsection
