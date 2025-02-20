@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h1>Tenant Data</h1>
        <div class="container" width="400" height="200">
            <canvas id="tenantChart" width="400" height="200"></canvas>
        </div>
        <table id="apiTable" class="table table-bordered table-striped">
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
            <tbody></tbody>
        </table>
    </div>
</div>

@endsection