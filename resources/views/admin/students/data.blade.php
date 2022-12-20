@foreach ($data as $key => $v )
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->name }}</td>
    <td>{{ $v->nisn }}</td>
    <td>{{ $v->nis }}</td>
    <td>{{ $v->jkl }}</td>
    <td><a onclick="editForm(' . $v->id . ','{{$v->value->school_year_id}}','{{$v->value->class_id}}')" class="">
            <button type="button" class="btn btn-icon btn-round btn-warning btn-sm">
                <i class="fa fa-pencil-alt"></i>
            </button>
        </a> <a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $v->value->id . '" title="Delete" class="deleteData">
            <button type="button" class="btn btn-icon btn-round btn-danger btn-sm">
                <i class="fa fa-trash-alt"></i>
            </button>
        </a>'
    </td>
</tr>
@endforeach