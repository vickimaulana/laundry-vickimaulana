@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data Customer</h3>
                <div class="table-rasponsive">
                    <table class="table table-stripped">
                        <tr>
                            <th>Name</th>
                            <td>:</td>
                            <td>{{ $order->customer->customer_name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>:</td>
                            <td>{{ $order->customer->phone }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>:</td>
                            <td>{{ $order->customer->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Data Order</h3>
                <div class="table-responsive">
                    <table class="table table-stripped">
                        <tr>
                            <th>Code</th>
                            <td>:</td>
                            <td>{{ $order->order_code }}</td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td>:</td>
                            <td>{{ date('d F Y', strtotime($order->order_date)) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>{{ $order->status_text }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Detail Order</h3>
                <form action="{{ route('order.update', $order->id) }}" method="post" class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="table-responsive col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Service</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->details as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->service->service_name }}</td>
                                    <td>Rp {{ number_format($detail->service->price) }}</td>
                                    <td>{{ $detail->qty/1000 }} kg</td>
                                    <td>Rp {{ number_format($detail->subtotal) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" align="right" class="pe-3"><strong>Total</strong></td>
                                    <td><input type="hidden" class="total" value="{{ $order->total }}">Rp {{ number_format($order->total) }}</td>
                                </tr>
                                @if ($order->order_status == 0)
                                <tr>
                                    <td colspan="4" align="right" class="pe-3"><strong>Pay</strong></td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-text" id="inputGroupPrepend">Rp</span>
                                            <input type="number" class="form-control pay" min="{{ $order->total }}" name="order_pay" required>
                                            <div class="invalid-feedback">Total pay must be greater than total!</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right" class="pe-3"><strong>Change</strong></td>
                                    <td><input type="hidden" class="change" name="order_change"><span class="textChange"></span></td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="4" align="right" class="pe-3"><strong>Pay</strong></td>
                                    <td><input type="hidden" value="{{ $order->order_pay }}">Rp {{ number_format($order->order_pay) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="right" class="pe-3"><strong>Change</strong></td>
                                    <td><input type="hidden" value="{{ $order->order_change }}">Rp {{ number_format($order->order_change) }}</td>
                                </tr>
                                @endif
                                
                            </tfoot>
                        </table>
                    </div>
                    @if ($order->order_status == 0)
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Pay</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const selectTotal = document.querySelector('.total');
    const selectPay = document.querySelector('.pay');
    const selectChange = document.querySelector('.change');

    selectPay.addEventListener('input', (e)=>{
        const total = parseInt(selectTotal.value);
        const pay = parseInt(e.target.value) || 0;
        const change = pay - total;
        selectChange.value = change;
        document.querySelector('.textChange').textContent = `Rp ${change.toLocaleString('id-ID')}`;
    });
</script>
@endsection
