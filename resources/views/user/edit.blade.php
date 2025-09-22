@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Add User</h3>
                <form action="{{ route('user.update', $user->id) }}" method="post" class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-sm-12">
                        <label for="level" class="form-label">Level</label>
                        <select name="id_level" id="level" class="form-control" required>
                            <option value="">Choose Level</option>
                            @foreach ($levels as $level)
                            <option {{ $user->id_level == $level->id ? 'selected' : '' }} value="{{ $level->id }}">{{ $level->level_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please enter your name!</div>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" class="form-control" value="{{ $user->name }}" required>
                        <div class="invalid-feedback">Please enter your name!</div>
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control" value="{{ $user->email }}" required>
                        <div class="invalid-feedback">Please enter your email!</div>
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" class="form-control">
                        <div class="invalid-feedback">Please enter your password!</div>
                        @error('password')
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
