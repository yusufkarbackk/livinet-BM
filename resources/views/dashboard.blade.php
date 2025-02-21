@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h1>Tenant Data</h1>
        <div class="container" width="400" height="200">
            <canvas id="tenantChart" width="400" height="200"></canvas>
        </div>
        <table id="" class="table table-bordered table-striped mb-4">
            <thead>
                <tr>
                    <th>client ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>name</th>
                    <th>Service ID</th>
                    <th>amount</th>
                    <th>location</th>
                    <th>status</th>
                    <th>termination_Date</th>
                </tr>
            </thead>
            <tbody>
            <tbody>
                @foreach ($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->clientid }}</td>
                    <td>{{ $tenant->firstname }}</td>
                    <td>{{ $tenant->lastname }}</td>
                    <td>{{ $tenant->serviceid }}</td>
                    <td>{{ $tenant->name }}</td>
                    <td>{{ $tenant->amount }}</td>
                    <td>{{ $tenant->location }}</td>
                    <td>{{ $tenant->status }}</td>
                    <td>{{ $tenant->temrination_date }}</td>
                </tr>
                @endforeach
            </tbody>
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $tenants->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    $(document).ready(function() {
        console.log("initilize data tables")
        $('#apiTable').DataTable({
            processing: true,
            serverSide: false, // Use `true` if you want server-side processing
            paging: true,
            searching: true,
            ajax: {
                url: "{{ route('getTenantData') }}", // Generate URL for the named route
                dataSrc: "",
                type: "GET",
            },
            "columns": [{
                    data: 'clientid',
                },
                {
                    data: 'firstname'
                },
                {
                    data: 'lastname'
                },
                {
                    data: 'name'
                },
                {
                    data: 'serviceid'
                },
                {
                    data: 'amount'
                },
                {
                    data: 'location'
                },
                {
                    data: 'status'
                },
                {
                    data: 'termination_date'
                }
            ]
        });
    });
</script>
@endpush