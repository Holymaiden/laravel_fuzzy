@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->name }}</td>
    <td>{{ $v->semester }}</td>
    <td>
        {!! Helper::btn_action('1','1',$v->id) !!}
    </td>
</tr>
@endforeach