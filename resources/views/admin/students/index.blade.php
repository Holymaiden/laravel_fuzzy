@extends('admin._layouts.index')

@push('cssScript')
@include('admin._layouts.css.css-table')
@endpush

@push('user-settings')
active
@endpush

@push($title)
active
@endpush

@section('content')

<section class="section">

    @component('_card.head')
    Siswa
    @endcomponent

    <div class="section-body">

        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-form">
                            {!! Helper::btn_create() !!}
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
                                        <th width="8%">No</th>
                                        <th>Nama</th>
                                        <th>Nisn</th>
                                        <th>Nis</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Penilaian</th>
                                        <th width="12%">Aksi</th>
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
    </div>

</section>

@include('admin.'.$title.'._form')
@include('admin.'.$title.'._penilaianForm')

@endsection

@push('jsScript')
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

        loadpage('', "{{config('constants.PAGINATION')}}", '', '', '');

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
                        $(".datatabel").html('<tr><td colspan="8">Data not found</td></tr>');
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

        // proses simpan
        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $.ajax({
                data: $('#formInput').serialize(),
                url: "{{ route($title.'.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#formInput').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    loadpage('', "{{config('constants.PAGINATION')}}", '', '', '');
                    iziToast.success({
                        title: 'Successfull.',
                        message: 'Save it data!',
                        position: 'topRight',
                        timeout: 1500
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#formInput').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    iziToast.error({
                        title: 'Failed,',
                        message: 'Save it data!',
                        position: 'topRight',
                        timeout: 1500
                    });
                }
            });
        });

        // proses update
        $('#updateBtn').click(function(e) {
            let id = $('#formId').val();
            e.preventDefault();
            $.ajax({
                data: $('#formInput').serialize(),
                url: urlx + '/' + id,
                type: "PUT",
                dataType: 'json',
                success: function(data) {
                    $('#formInput').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    loadpage('', "{{config('constants.PAGINATION')}}", '', '', '');
                    iziToast.success({
                        title: 'Successfull,',
                        message: 'Update it data!',
                        position: 'topRight',
                        timeout: 1500
                    });
                },
                error: function(data) {
                    $('#formInput').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    iziToast.error({
                        title: 'Failed.',
                        message: 'Update it data!',
                        position: 'topRight',
                        timeout: 1500
                    });
                }
            });
        });

        $('body').on('click', '.deleteData', function() {
            var id = $(this).data("id");
            swal({
                    title: 'Are you sure?',
                    text: 'You want to delete this data!',
                    icon: 'warning',
                    dangerMode: true,
                    buttons: {
                        confirm: {
                            text: 'Yes, delete it!',
                            className: 'btn btn-success'
                        },
                        cancel: {
                            visible: true,
                            className: 'btn btn-danger'
                        }
                    }
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "DELETE",
                            url: urlx + '/' + id,
                            success: function(data) {
                                loadpage('', "{{config('constants.PAGINATION')}}", '', '', '');
                                iziToast.success({
                                    title: 'Successfull.',
                                    message: 'Delete it data!',
                                    position: 'topRight',
                                    timeout: 1500
                                });
                            },
                            error: function(data) {
                                iziToast.error({
                                    title: 'Failed,',
                                    message: 'Delete it data!',
                                    position: 'topRight',
                                    timeout: 1500
                                });
                            }
                        });
                    } else {
                        swal.close();
                    }
                });
        });

        // proses simpan
        $('#saveBtn1').click(function(e) {
            e.preventDefault();
            $.ajax({
                data: $('#formInput1').serialize(),
                url: "{{ route($title.'.evaluation') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#formInput1').trigger("reset");
                    $('#ajaxModel1').modal('hide');
                    loadpage('', "{{config('constants.PAGINATION')}}", '', '', '');
                    iziToast.success({
                        title: 'Successfull.',
                        message: 'Save it data!',
                        position: 'topRight',
                        timeout: 1500
                    });
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#formInput1').trigger("reset");
                    $('#ajaxModel1').modal('hide');
                    iziToast.error({
                        title: 'Failed,',
                        message: 'Save it data!',
                        position: 'topRight',
                        timeout: 1500
                    });
                }
            });
        });
    });
</script>
@endpush