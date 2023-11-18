<div class="modal fade" id="ajaxModel1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form id="formInput1" name="formInput1" action="">
                @csrf
                <input type="hidden" class="form-control" name="value_id" id="value_id" />
                <div class="modal-header">
                    <h5 class="modal-title"> <label id="headForm1"></label> {{ Helper::head('Penilaian Siswa') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="text-center my-3">
                    <button type="button" class="btn btn-danger">
                        Pemberian Nilai Mulai dari 0 Sampai 100
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nilai Spiritual</label>
                            <input type="number" class="form-control" name="spiritual" id="spiritual" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nilai Sosial</label>
                            <input type="number" class="form-control" name="sosial" id="sosial" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nilai Pengetahuan</label>
                            <input type="number" class="form-control" name="akademik" id="akademik" required />
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nilai Keterampilan</label>
                            <input type="number" class="form-control" name="ekstrakulikuler" id="ekstrakulikuler" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="saveBtn1" value="create">Save</button>
                    <button type="submit" class="btn btn-warning" id="updateBtn1" value="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('jsScriptAjax')
<script type="text/javascript">
    function penilaianForm(id) {
        $('#formInput1').trigger("reset");
        $("#headForm1").empty();
        $("#headForm1").append("Form Input");
        $('#saveBtn1').show();
        $('#formId1').val(id);
        $('#ajaxModel1').modal('show');
        $('#updateBtn1').hide();
    }

    $('#ekstrakulikuler').on('change', function(event) {
        let ekstra = $('#ekstrakulikuler').val();
        if (ekstra > 100) {
            $('#ekstrakulikuler').val(100);
        } else if (ekstra < 0) {
            $('#ekstrakulikuler').val(0);
        }
    })

    $('#akademik').on('change', function(event) {
        let akademik = $('#akademik').val();
        if (akademik > 100) {
            $('#akademik').val(100);
        } else if (akademik < 0) {
            $('#akademik').val(0);
        }
    })

    $('#sosial').on('change', function(event) {
        let sosial = $('#sosial').val();
        if (sosial > 100) {
            $('#sosial').val(100);
        } else if (sosial < 0) {
            $('#sosial').val(0);
        }
    })

    $('#spiritual').on('change', function(event) {
        let spiritual = $('#spiritual').val();
        if (spiritual > 100) {
            $('#spiritual').val(100);
        } else if (spiritual < 0) {
            $('#spiritual').val(0);
        }
    })


    function updatePenilaianForm(id) {
        let urlx = "{{ $title }}"
        $.ajax({
            url: urlx + '/' + id + '/eval',
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#formInput1').trigger("reset");
                $("#headForm1").empty();
                $("#headForm1").append("Form Input");
                $('#ajaxModel1').modal('show');
                $('#saveBtn1').hide();
                $('#updateBtn1').show();
                $('#value_id').val(data[0].value_id);
                $('#spiritual').val(data[0].value);
                $('#sosial').val(data[1].value);
                $('#akademik').val(data[2].value);
                $('#ekstrakulikuler').val(data[3].value);
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
</script>
@endpush