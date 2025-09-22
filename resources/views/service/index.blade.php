@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data Service</h3>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="{{ route('service.create') }}" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $index => $service)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->description }}</td>
                                <td>
                                    <a href="{{ route('service.edit', $service->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('service.destroy', $service->id) }}" method="post" id="delete-form-{{ $service->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmAndDelete({{ $service->id }})">Delete</button>
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
