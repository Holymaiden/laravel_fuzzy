@extends('admin._layouts.index')

@push('cssScript')
@include('admin._layouts.css.css-table')
@endpush

@push($title)
active
@endpush

@section('content')

<section class="section">

    @component('_card.head')
    Penilaian Siswa
    @endcomponent

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-form">
                            <a class="">
                                <button id="btn-export" class="btn btn-success btn-rounded btn-sm">
                                    <span class="btn-label">
                                        <i class="fas fa-file-excel"></i>
                                    </span>
                                    Export
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="card-sub">
                            <div class="btn-toolbar justify-content-between">
                                <div class="form-row">
                                    <div class="form-group mr-2">
                                        <select class="form-control form-control-sm selectric" name="" id="jumlah">
                                            <option selected="selected">5</option>
                                            <option>10</option>
                                            <option>15</option>
                                            <option>25</option>
                                            <option>50</option>
                                            <option>100</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select class="form-control form-control-sm selectric" name="school_year_filter" id="school_year_filter">
                                            <option value="" selected="selected">Tahun Ajaran</option>
                                            @foreach(Helper::get_school_year() as $v)
                                            <option value="{{$v->name}}">{{$v->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select class="form-control form-control-sm selectric" name="semester_filter" id="semester_filter">
                                            <option value="" selected="selected">Semester</option>
                                            <option value="Genap">Genap</option>
                                            <option value="Ganjil">Ganjil</option>
                                        </select>
                                    </div>
                                    <div class="form-group mr-2">
                                        <select class="form-control form-control-sm selectric" name="classes_filter" id="classes_filter">
                                            <option value="" selected="selected">Kelas</option>
                                            @foreach(Helper::get_data('classes') as $v)
                                            <option value="{{$v->id}}">{{$v->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <input type="text" name="" placeholder="Search..." class="form-control" id="pencarian">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" width="8%">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Nilai Spiritual</th>
                                        <th scope="col">Nilai Sosial</th>
                                        <th scope="col">Nilai Pengetahuan</th>
                                        <th scope="col">Nilai Keterampilan</th>
                                    </tr>
                                </thead>
                                <tbody class="datatabel">
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="text-center">
                                <div id="contentx"></div>
                            </div>
                            <div class="text-center">
                                <ul class="pagination twbs-pagination">
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Fuzzifikasi</h4>
                        <div class="card-header-form">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span>Spritual</span>
                                <canvas id="myChart1" height="170"></canvas>
                            </div>
                            <div class="col-4">
                                <span>Sosial</span>
                                <canvas id="myChart2" height="170"></canvas>
                            </div>
                            <div class="col-4">
                                <span>Pengetahuan</span>
                                <canvas id="myChart3" height="170"></canvas>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <span>Keterampilan</span>
                                <canvas id="myChart4" height="170"></canvas>
                            </div>
                            <div class="col-6">
                                <span>Output</span>
                                <canvas id="myChart5" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Fuzzifikasi</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2" width="8%">No</th>
                                    <th scope="col" colspan='2' class="text-center">Nilai Spiritual</th>
                                    <th scope="col" colspan='2' class="text-center">Nilai Sosial</th>
                                    <th scope="col" colspan="4" class="text-center">Nilai Akademik</th>
                                    <th scope="col" colspan="4" class="text-center">Nilai Ekstrakurikuler</th>
                                </tr>
                                <tr>
                                    <th scope="col">Sangat Baik</th>
                                    <th scope="col">Perlu Bimbingan</th>
                                    <th scope="col">Sangat Baik</th>
                                    <th scope="col">Perlu Bimbingan</th>
                                    <th scope="col">Sangat Baik</th>
                                    <th scope="col">Baik</th>
                                    <th scope="col">Cukup</th>
                                    <th scope="col">Perlu Bimbingan</th>
                                    <th scope="col">Sangat Baik</th>
                                    <th scope="col">Baik</th>
                                    <th scope="col">Cukup</th>
                                    <th scope="col">Perlu Bimbingan</th>
                                </tr>
                            </thead>
                            <tbody class="datatabel2">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Defuzzifikasi</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2" width="8%">No</th>
                                    <th scope="col" colspan="2" class="text-center">R1</th>
                                    <th scope="col" colspan="2" class="text-center">R2</th>
                                    <th scope="col" colspan="2" class="text-center">R3</th>
                                    <th scope="col" colspan="2" class="text-center">R4</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="text-center">a</th>
                                    <th scope="col" class="text-center">z</th>
                                    <th scope="col" class="text-center">a</th>
                                    <th scope="col" class="text-center">z</th>
                                    <th scope="col" class="text-center">a</th>
                                    <th scope="col" class="text-center">z</th>
                                    <th scope="col" class="text-center">a</th>
                                    <th scope="col" class="text-center">z</th>
                                </tr>
                            </thead>
                            <tbody class="datatabel3">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Defuzzifikasi</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2" width="8%">No</th>
                                    <th scope="col" colspan="2" class="text-center">R5</th>
                                    <th scope="col" colspan="2" class="text-center">R6</th>
                                    <th scope="col" colspan="2" class="text-center">R7</th>
                                    <th scope="col" colspan="2" class="text-center">R8</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="text-center">a</th>
                                    <th scope="col" class="text-center">z</th>
                                    <th scope="col" class="text-center">a</th>
                                    <th scope="col" class="text-center">z</th>
                                    <th scope="col" class="text-center">a</th>
                                    <th scope="col" class="text-center">z</th>
                                    <th scope="col" class="text-center">a</th>
                                    <th scope="col" class="text-center">z</th>
                                </tr>
                            </thead>
                            <tbody class="datatabel4">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Hasil Akhir</h4>
                    <div class="card-header-form">
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" rowspan="2" width="8%">No</th>
                                    <th scope="col" rowspan="2" class="text-center">Nama</th>
                                    <th scope="col" rowspan="2" class="text-center">Rata-Rata</th>
                                    <th scope="col" colspan="2" class="text-center">Fuzzy Mamdani</th>
                                    <th scope="col" colspan="2" class="text-center">Fuzzy Sugeno</th>
                                </tr>
                                <tr>
                                    <th scope="col" class="text-center">Nilai</th>
                                    <th scope="col" class="text-center">Hasil</th>
                                    <th scope="col" class="text-center">Nilai</th>
                                    <th scope="col" class="text-center">Hasil</th>
                                </tr>
                            </thead>
                            <tbody class="datatabel5">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>

</section>

@include('admin.'.$title.'._form')

@endsection

@push('jsScript')
<script src="{{ url('stisla') }}/node_modules/chart.js/dist/Chart.min.js"></script>
<script src="{{ url('stisla') }}/component.js"></script>
@include('admin._layouts.js.js-table')

<script type="text/javascript">
    $(document).ready(function() {
        let urlx = "{{ $title }}";

        $("#pilihan").on('change', function(event) {
            let pilih = $('#pilihan').val();
            if (pilih == '0') {
                $('#option').show();
            } else {
                $('#option').hide();
            }
        });

        loadpage('', "{{config('constants.PAGINATION')}}", "", "", "");

        var $pagination = $('.twbs-pagination');
        var defaultOpts = {
            totalPages: 1,
            prev: '&#8672;',
            next: '&#8674;',
            first: '&#8676;',
            last: '&#8677;',
        };
        $pagination.twbsPagination(defaultOpts);

        function loaddata(page, cari, jml, tahun, kelas, semester) {
            $.ajax({
                url: urlx + '/data',
                data: {
                    "page": page,
                    "cari": cari,
                    "jml": jml,
                    "tahun": tahun,
                    "kelas": kelas,
                    "semester": semester

                },
                type: "GET",
                datatype: "json",
                success: function(data) {
                    $(".datatabel").html(data.html);
                    $(".datatabel2").html(data.html2);
                    $(".datatabel3").html(data.html3);
                    $(".datatabel4").html(data.html4);
                    $(".datatabel5").html(data.html5);
                }
            });
        }

        function loadpage(cari, jml, tahun, kelas, semester) {
            $.ajax({
                url: urlx + '/data',
                data: {
                    "cari": cari,
                    "jml": jml,
                    "tahun": tahun,
                    "kelas": kelas,
                    "semester": semester
                },
                type: "GET",
                datatype: "json",
                success: function(response) {
                    console.log(response);
                    if ($pagination.data("twbs-pagination")) {
                        $pagination.twbsPagination('destroy');
                        $(".datatabel").html('<tr><td colspan="9">Mohon Gunakan Filter Agar Data Dapat Ditemukan</td></tr>');
                    }
                    $pagination.twbsPagination($.extend({}, defaultOpts, {
                        startPage: 1,
                        totalPages: response.total_page,
                        visiblePages: 8,
                        prev: '&#8672;',
                        next: '&#8674;',
                        first: '&#8676;',
                        last: '&#8677;',
                        onPageClick: function(event, page) {
                            if (page == 1) {
                                var to = 1;
                            } else {
                                var to = page * jml - (jml - 1);
                            }
                            if (page == response.total_page) {
                                var end = response.total_data;
                            } else {
                                var end = page * jml;
                            }
                            $('#contentx').text('Showing ' + to + ' to ' + end + ' of ' + response.total_data + ' entries');
                            loaddata(page, cari, jml, tahun, kelas, semester);
                        }

                    }));
                }
            });
        }

        $("#pencarian, #jumlah, #school_year_filter, #classes_filter, #semester_filter").on('change', function(event) {
            let cari = $('#pencarian').val();
            let jml = $('#jumlah').val();
            let tahun = $('#school_year_filter').val();
            let kelas = $('#classes_filter').val();
            let semester = $('#semester_filter').val();
            loadpage(cari, jml, tahun, kelas, semester);
        });

        // btn export
        $('#btn-export').on('click', function(event) {
            let cari = $('#pencarian').val();
            let tahun = $('#school_year_filter').val();
            let kelas = $('#classes_filter').val();
            let semester = $('#semester_filter').val();
            window.open(urlx + '/export?cari=' + cari + '&tahun=' + tahun + '&kelas=' + kelas + '&semester=' + semester, '_blank');

        });
    });
</script>
@endpush