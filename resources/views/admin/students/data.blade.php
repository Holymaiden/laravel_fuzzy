@foreach ($data as $key => $v )
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->name }}</td>
    <td>{{ $v->nisn }}</td>
    <td>{{ $v->nis }}</td>
    <td>{{ $v->value->classes->name }}</td>
    <td>{{ $v->jkl }}</td>
    <td>
        {!! Helper::btn_action('1','1',$v->id) !!}
    </td>
</tr>
@endforeach