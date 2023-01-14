@extends('admin._layouts.index')

@push('cssScript')
@include('admin._layouts.css.css')
@endpush

@push('dashboard')
active
@endpush

@section('content')


<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Admin</h4>
                    </div>
                    <div class="card-body">
                        {{ Helper::get_data('users')->count() }} Orang
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Guru</h4>
                    </div>
                    <div class="card-body">
                        {{ Helper::get_data('users')->count() }} Orang
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Siswa</h4>
                    </div>
                    <div class="card-body">
                        {{ Helper::get_data('students')->count() }} Orang
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Tahun Ajar</h4>
                    </div>
                    <div class="card-body">
                        {{ Helper::get_data('school_years')->count() }} Semester
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Statistics</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart2" height="180"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('jsScript')
@include('admin._layouts.js.js')
<script>
    data = "{{ Helper::statisticData() }}";
    // string to array
    data = data.split(',');

    // slice array into 2 array in total
    label = data.slice(0, data.length / 2);
    dataset = data.slice(data.length / 2, data.length);

    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: label,
            datasets: [{
                label: 'Statistics',
                data: dataset,
                borderWidth: 2,
                backgroundColor: 'rgba(63,82,227,.8)',
                borderColor: 'transparent',
                borderWidth: 0,
                pointBackgroundColor: '#999',
                pointRadius: 4,
            }]
        },
        options: {
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                    },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 10
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            },
        }
    });
</script>
@endpush