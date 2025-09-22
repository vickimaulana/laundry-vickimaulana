@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Add Service</h3>
                <form action="{{ route('service.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="service_name" placeholder="Enter your service name" required>
                        <div class="invalid-feedback">Please enter your service name</div>
                        @error('service_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" placeholder="Enter your service price" required>
                        <div class="invalid-feedback">Please enter your service price</div>
                        @error('price')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                        <div class="invalid-feedback">Please enter your service description</div>
                        @error('description')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
