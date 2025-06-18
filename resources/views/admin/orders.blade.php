@extends('admin.layout.app')
@section('main-content')

<div class="wrapper d-flex flex-column min-vh-100">
    <main class="flex-grow-1">
        <div class="container mt-4">
            <h3>Orders</h3>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Product(s)</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $index => $order)
                        @php
                            $statusClass = match($order->status) {
                                'Completed' => 'bg-success',
                                'Pending' => 'bg-warning',
                                'Cancelled' => 'bg-danger',
                                default => 'bg-secondary',
                            };
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ implode(', ', $order->product_names ?? []) }}</td>
                            <td>{{ number_format($order->total_price, 2) }}</td>
                            <td><span class="badge {{ $statusClass }}">{{ $order->status }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
