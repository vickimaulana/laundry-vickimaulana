@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data Level</h3>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="{{ route('level.create') }}" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($levels as $index => $level)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $level->level_name }}</td>
                                <td>
                                    <a href="{{ route('level.edit', $level->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('level.destroy', $level->id) }}" method="post" id="delete-form-{{ $level->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmAndDelete({{ $level->id }})">Delete</button>
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