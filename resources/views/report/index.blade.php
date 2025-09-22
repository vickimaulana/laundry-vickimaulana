@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Report Transaction Order</h5>
                <div class="table-responsive">
                    <div class="mb-3">
                        <form action="{{ route('report') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Date Start</label>
                                    <input type="date" name="date_start" class="form-control" value="" required>
                                    <div class="invalid-feedback">Please select start date!</div>
                                </div>
                                <div class="col-sm-3">
                                    <label for="" class="form-label">Date End</label>
                                    <input type="date" name="date_end" class="form-control" value="" required>
                                    <div class="invalid-feedback">Please select end date!</div>
                                </div>
                                <div class="col-sm-3 mt-4">
                                    <button type="submit" name="filter" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-datatable pt-0">
                        <div class="mb-3" align="right">
                            <a href="{{ route('print_laporan') }}" class="btn btn-secondary">Print</a>
                        </div>
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $order)

                                <tr>
                                    <td>{{ $order->order_code ?? ''}}</td>
                                    <td>{{ $order->customer->customer_name  ?? ''}}</td>
                                    <td>{{ date('d F Y', strtotime($order->order_date)) ?? ''}}</td>
                                    <td>{{ $order->status_text ?? '' }}</td>
                                    <td>Rp {{ number_format($order->total) ?? '' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection