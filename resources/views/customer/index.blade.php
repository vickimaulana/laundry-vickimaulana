@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data Customer</h3>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="{{ route('customer.create') }}" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $index => $customer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $customer->customer_name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>
                                    <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('customer.destroy', $customer->id) }}" method="post" id="delete-form-{{ $customer->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmAndDelete({{ $customer->id }})">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
