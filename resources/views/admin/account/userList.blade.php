@extends('admin.layouts.master')
@section('title')
<title>User List Page</title>
@endsection
@section('section')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
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
                   <h3 class="bg-white shadow-sm px-1 text-center py-1"> <i class="fa-solid fa-database"></i> | {{ $user->total() }}</h3>
                </div>
               </div>
                {{-- start data table --}}
                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($user as $u)
                                <td></td>
                                <input type="hidden" id="userId" value="{{ $u->id }}">
                                <td>{{ $u->name }}</td>
                                <td class="col-3"><div class="image">
                                    @if ($u->image==null)
                                           <img src="{{ asset('image/default.png') }}" class="img-thumbnail"/>
                                       @else
                                           <img src="{{ asset('storage/'.$u->image) }}" class="img-thumbnail"/>
                                    @endif

                               </div></td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone }}</td>
                                <td>{{ $u->address }}</td>
                                <td>{{ $u->gender }}</td>
                                <td><select name="" id="role" class="form-control changeRole bg-secondary text-white">
                                        <option value="user">user</option>
                                        <option value="admin">admin</option>
                                    </select></td>
                                <td>
                                    <div class="table-data-feature">
                                    <a href="{{ route('account#userDelete',$u->id) }}"><button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button></a>
                                    </div>
                                </td>
                            <tr class="spacer"></tr>
                                @endforeach
                        </tbody>
                    </table>
                    <div class="">{{ $user->links() }}</div>
                </div>
                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>

@endsection
@section('scriptSource')
<script>
    $(document).ready(function() {
        $('.changeRole').change(function(){
            $parentNode=$(this).parents('tr');
            $role=$parentNode.find('#role').val();
            $userId=$parentNode.find('#userId').val();
            $.ajax({
                type: 'get',
                url:'http://127.0.0.1:8000/account/user/ajax',
                data:{'role':$role,
            'userId':$userId}
            });
            location.reload();
        });
    });
</script>
@endsection
