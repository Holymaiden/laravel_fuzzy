@foreach ($data as $key => $v )
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->name }}</td>
    <td>{{ $v->nisn }}</td>
    <td>{{ $v->nis }}</td>
    <td>{{ $v->jkl }}</td>
    <td>
        <span class="badge {{ $v->value->evaluation->count() > 0 ? 'badge-success' : 'badge-danger'}}">
            {{ $v->value->evaluation->count() > 0 ? 'Selesai' : 'Belum Terisi'}}
        </span>
    </td>
    <td><a onclick="editForm(' . $v->id . ','{{$v->value->school_year_id}}','{{$v->value->class_id}}', '{{$v->value->schoolYear->semester}}')" class="">
            <button type="button" class="btn btn-icon btn-round btn-warning btn-sm">
                <i class="fa fa-pencil-alt"></i>
            </button>
        </a> <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $v->value->id . '" title="Delete" class="deleteData">
            <button type="button" class="btn btn-icon btn-round btn-danger btn-sm">
                <i class="fa fa-trash-alt"></i>
            </button>
        </a>
    </td>
</tr>
@endforeach