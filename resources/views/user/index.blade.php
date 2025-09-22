@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data User</h3>
                <div class="table-responsive">
                    <div class="mb-3" align="right">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">Add</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->level->level_name }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="post" id="delete-form-{{ $user->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmAndDelete({{ $user->id }})">Delete</button>
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
