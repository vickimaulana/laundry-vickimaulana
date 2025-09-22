@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Edit Level</h3>
                <form action="{{ route('level.update', $level->id) }}" method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="level_name" value="{{ $level->level_name }}" required>
                        <div class="invalid-feedback">Please enter your level name</div>
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
