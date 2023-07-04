@extends('admin.layouts.master')
@section('title')
<title>Contact List Page</title>
@endsection
@section('section')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->




                {{-- start data table --}}

                    <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2 text-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact as $c)
                            <tr>
                                <td></td>
                                <td>{{ $c->name }}</td>
                                <td>{{ $c->email }}</td>
                                <td class="col-7">{{ $c->message }}</td>
                            </tr>
                            <tr class="spacer"></tr>

                            @endforeach
                        </tbody>
                    </table>
                    <div class="">{{ $contact->links() }}</div>
                </div>
                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>

@endsection
