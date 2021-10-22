@extends('admin.layouts.app')
@section('title') Dashboard @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>{{ $users_count }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-book fa-3x"></i>
                <div class="info">
                    <h4>Book</h4>
                    <p><b>{{ $books_count }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-angle-double-down fa-3x"></i>
                <div class="info">
                    <h4>Submitting</h4>
                    <p><b>{{ $orders_submitting }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-spinner fa-3x"></i>
                <div class="info">
                    <h4>Checkout</h4>
                    <p><b>{{ $orders_checkout }}</b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Number of Order per month</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <h3 class="tile-title">Order Status</h3>
                <div class="embed-responsive embed-responsive-16by9">
                    <canvas class="embed-responsive-item" id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/chart.js') }}"></script>

    <script>

        var data = {
            labels: [
                @foreach($orders_data as $data)
                    {{$data->month}},
                @endforeach
            ],
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [
                        @foreach($orders_data as $data)
                            {{$data->count_submitting}},
                        @endforeach
                    ]
                },
            ]
        };
        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);

        var pdata = [
            {
                value: {{ $orders_submitting }},
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Submitting"
            },
            {
                value: {{ $orders_checkout }},
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "Checkout"
            },
            {
                value: {{ $orders_returned }},
                color:"#46BFBD",
                highlight: "#5AD3D1",
                label: "Returned"
            }
        ];
        var ctxp = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
@endpush
