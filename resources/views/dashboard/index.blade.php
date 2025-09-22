@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title" align="center">Dashboard</h3>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" align="center">Data User</h3>
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <tr>
                                            <th>Name</th>
                                            <td>:</td>
                                            <td>{{ auth()->user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Level</th>
                                            <td>:</td>
                                            <td>{{ auth()->user()->level->level_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>:</td>
                                            <td>{{ auth()->user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Login</th>
                                            <td>:</td>
                                            <td>{{ auth()->user()->created_at->format('d F Y H:i:s') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" align="center">Data Order</h3>
                                <div class="table-responsive">
                                    <table class="table table-stripped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Code</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $index => $order)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $order->order_code }}</td>
                                                    <td>{{ $order->customer->customer_name }}</td>
                                                    <td class="{{ $order->order_status == 0 ? 'text-info' : 'text-success' }}">{{ $order->status_text }}</td>
                                                    <td>Rp {{ number_format($order->total) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" align="center">Data Customer</h3>
                                <h1 class="text-center">{{ $customers->count() }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" align="center">Data Service</h3>
                                <h1 class="text-center">{{ $services->count() }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title" align="center">Data User</h3>
                                <h1 class="text-center">{{ $users->count() }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection