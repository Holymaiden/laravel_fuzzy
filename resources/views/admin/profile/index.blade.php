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
    {{ $title }}
    @endcomponent

    <div class="section-body">

        <h2 class="section-title">Hi, {{ auth()->user()->name }}!</h2>
        <p class="section-lead">

        </p>

        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <form id="formInput" name="formInput" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="POST" id="methodId">
                        <input type="hidden" name="id" id="formId">

                        <div class="card-header">
                            <h4>Profile</h4>
                            <div class="card-header-form">
                                <div class="form-group">
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input" id="myCheck" value="">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">edit</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="" required="" id="name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="" required="" id="username">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Ex: admin@gmail.com" value="" id="email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" value="" id="password">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary" id="updateBtn" value="">
                                Update Changes
                            </button>
                            <button type="submit" class="btn btn-success" id="saveBtn" value="">
                                Save Changes
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>

</section>

@endsection

@push('jsScript')
@include('admin._layouts.js.js-table')

<script type="text/javascript">
    $(document).ready(function() {
        let title = "../admin/users";
        getData(title);

        function getData(title) {
            $.ajax({
                url: title + '/{{ auth()->user()->id }}/edit',
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    if (data.id == undefined) {
                        $('#methodId').val('POST');
                    } else {
                        $('#methodId').val('PUT');
                    }
                    $("#myCheck").prop("checked", false);
                    $('#formId').val(data.id);
                    $("#name").val(data.name);
                    $("#email").val(data.email);
                    $("#username").val(data.username);
                    $("#password").val(data.password);
                    cekDisable();
                },
                error: function() {
                    iziToast.error({
                        title: 'Failed,',
                        message: 'Unable to display data!',
                        position: 'topRight'
                    });
                }
            });
        }

        $("#myCheck").on('change', function(event) {
            let cek = $("#myCheck").val();
            cek == 0 ? cekEnable() : cekDisable();
        });

        function cekDisable() {
            $("#myCheck").val(0);
            $("#logo").prop("disabled", true);
            $("#name").prop("disabled", true);
            $("#email").prop("disabled", true);
            $("#username").prop("disabled", true);
            $("#password").prop("disabled", true);
            $("#saveBtn").hide()
            $("#updateBtn").hide()
        }

        function cekEnable() {
            $("#myCheck").val(1);
            $("#logo").prop("disabled", false);
            $("#name").prop("disabled", false);
            $("#email").prop("disabled", false);
            $("#username").prop("disabled", false);
            $("#password").prop("disabled", false);
            let idData = $("#formId").val();
            idData >= 1 ? $("#updateBtn").show() : $("#saveBtn").show();

        }

        // proses simpan
        $('#saveBtn').click(function(e) {
            $('input:checkbox').removeAttr('checked');
            e.preventDefault();
            let formData = new FormData(formInput);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: title + "/store",
                data: formData,
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    getData(title)
                    iziToast.success({
                        title: 'Successfull.',
                        message: 'Create it data!',
                        position: 'topRight'
                    });
                },
                error: function(data) {
                    getData(title)
                    iziToast.error({
                        title: 'Failed.',
                        message: 'Create it data!',
                        position: 'topRight'
                    });
                }
            });
        });

        // proses update
        $('#updateBtn').click(function(e) {
            let id = $('#formId').val();
            e.preventDefault();
            let formData = new FormData(formInput);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: title + "/" + id,
                data: formData,
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data) {
                    getData(title)
                    iziToast.success({
                        title: 'Successfull.',
                        message: 'Update it data!',
                        position: 'topRight'
                    });
                },
                error: function(data) {
                    getData(title)
                    iziToast.error({
                        title: 'Failed.',
                        message: 'Update it data!',
                        position: 'topRight'
                    });
                }
            });
        });

    });
</script>

@endpush