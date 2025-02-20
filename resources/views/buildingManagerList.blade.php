@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-body">
        <h1>Building Manager Data</h1>
        <table id="buildingManagerTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

@endsection