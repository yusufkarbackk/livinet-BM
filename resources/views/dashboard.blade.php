@extends('layouts.admin')

@section('content')
<div class="card">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div class="card-body">
        <h1>Tenant Data</h1>
        <div class="container d-flex justify-content-center" width="400" style="height: 400px;">
            <canvas id="tenantChart" width="400" height="200"></canvas>
        </div>
        <table id="apiTable" class="my-3 table table-bordered table-striped mb-4">
            <thead>
                <tr>
                    <th>client ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Product Name</th>
                    <th>Amount</th>
                    <th>Location
                    <th>Status</th>
                    <th>Termination Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->clientid }}</td>
                    <td>{{ $tenant->firstname }}</td>
                    <td>{{ $tenant->lastname }}</td>
                    <td>{{ $tenant->name }}</td>
                    <td>{{ $tenant->amount }}</td>
                    <td>{{ $tenant->location }}</td>
                    <td>{{ $tenant->status }}</td>
                    <td>{{ $tenant->termination_date }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
@push('script')
<script>
    $(document).ready(function() {
        console.log("initilize data tables")
        $('#apiTable').DataTable({
            layout: {
                topStart: {
                    buttons: [{
                        extend: 'csv',
                        className: 'btn btn-success',
                        fieldSeparator: ';'
                    }, 'excel', 'pdf']
                }
            },
        });
    });
</script>
@endpush
