@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Customer</h3>
                <form action="{{ route('customer.update', $customer->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="customer_name" value="{{ $customer->customer_name }}" required>
                        <div class="invalid-feedback">Please enter your customer name</div>
                        @error('customer_name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}">
                        <div class="invalid-feedback">Please enter your customer phone</div>
                        @error('phone')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="10">{{ $customer->address }}</textarea>
                        <div class="invalid-feedback">Please enter your customer address</div>
                        @error('address')
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
