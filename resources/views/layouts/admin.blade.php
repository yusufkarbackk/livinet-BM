<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminLTE Dashboard</title>
    <!-- In your layout or view -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
    </div>

    <!-- Scripts -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('/chart-summary')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('tenantChart').getContext('2d');

                    new Chart(ctx, {
                        type: 'bar', // You can change this to 'pie', 'line', etc.
                        data: {
                            labels: ['Total Tenants', 'Active Services'],
                            datasets: [{
                                label: 'Summary',
                                data: [data.total_tenants, data.active_services],
                                backgroundColor: ['#3498db', '#2ecc71'],
                                borderColor: ['#2980b9', '#27ae60'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        });
    </script>

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