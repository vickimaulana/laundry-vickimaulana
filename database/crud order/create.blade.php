@extends('app')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Add Order</h3>
                <form action="{{ route('order.store') }}" method="post" class="row needs-validation" novalidate>
                    @csrf
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input readonly type="text" name="order_code" class="form-control" value="{{ $code }}">
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Estimation</label>
                            <input type="date" name="order_end_date" class="form-control" required>
                            <div class="invalid-feedback">Please choose estimation date!</div>
                        </div>
                        <div class="mb-3">
                            <label for="id_service" class="form-label">Service</label>
                            <select id="id_service" class="form-control">
                                <option value="">Choose Service</option>
                                @foreach ($services as $service)
                                <option data-price="{{ $service->price }}" value="{{ $service->id }}">{{ $service->service_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="id_customer" class="form-label">Customer</label>
                            <select name="id_customer" id="id_custoer" class="form-control" required>
                                <option value="">Choose Customer</option>
                                @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select customer!</div>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea id="note" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-12" align="right">
                        <button type="button" class="btn btn-primary" id="addRow">Add Service</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-stripped" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Service</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <p><strong>Total : <span class="textTotal"></span></strong></p>
                    <input type="hidden" name="total" id="totalValue">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const addRow = document.querySelector('#addRow');
    const tbody = document.querySelector('#myTable tbody');
    const selectService = document.querySelector('#id_service');
    const selectNotes = document.querySelector('#note');

    addRow.addEventListener('click', (e)=>{
        const optionService = selectService.options[selectService.selectedIndex];
        if (!selectService.value) {
            alert('Please select a service first!');
            return;
        }
        const priceService = parseInt(optionService.dataset.price);

        const tr = document.createElement('tr');
        let no = 1;
        tr.innerHTML = `
            <td>${no}</td>
            <td><input type="hidden" class="id_services" name="id_service[]" value="${optionService.value}">${optionService.textContent}</td>
            <td>
                <input type="number" class="form-control qtys" step="any" min="1" name="qty[]" value="1" required>
                <div class="invalid-feedback">Invalid quantity!</div>
                <input type="hidden" class="notess" name="notes[]" value="${selectNotes.value}">
            </td>
            <td><input type="hidden" class="prices" value="${priceService}">Rp ${priceService.toLocaleString('id-ID')}</td>
            <td><input type="hidden" class="subtotals" name="subtotal[]" value="${priceService}"><span class="textSubtotal">Rp ${priceService.toLocaleString('id-ID')}</span></td>
            <td><button type="button" class="btn btn-danger btn-sm delRow">Remove</button></td>
        `;
        tbody.appendChild(tr);
        no++;

        selectService.value = '';
        selectNotes.value = '';
        updateNo();
        updateTotal();

    });

    tbody.addEventListener('click', (e) => {
        if (e.target.classList.contains('delRow')) {
            e.target.closest('tr').remove();
            updateNo();
            updateTotal();
        }
    });

    tbody.addEventListener('input', (e) => {
        if (e.target.classList.contains('qtys')) {
            const qty = parseFloat(e.target.value);
            const price = parseInt(e.target.closest('tr').querySelector('.prices').value);
            const subtotal = qty * price;
            e.target.closest('tr').querySelector('.subtotals').value = subtotal;
            e.target.closest('tr').querySelector('.textSubtotal').textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
            updateTotal();
        }
    });

    function updateNo(){
        const rows = tbody.querySelectorAll('tr');
        rows.forEach((row, index) => {
            row.cells[0].textContent = index + 1;
        });

        no = rows.length + 1;
    }

    function updateTotal() {
        const subtotals = document.querySelectorAll('.subtotals');
        let sum = 0;
        subtotals.forEach(subtotal => {
            sum += parseInt(subtotal.value);
        });
        document.querySelector('.textTotal').textContent = `Rp ${sum.toLocaleString('id-ID')}`;
        document.querySelector('#totalValue').value = sum;
    }

</script>
@endsection