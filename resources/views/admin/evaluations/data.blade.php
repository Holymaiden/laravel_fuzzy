@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v->value }}</td>
    <td>{{ $v->description }}</td>
    <td>
        {!! Helper::btn_action('1','1',$v->id) !!}
    </td>
</tr>
@endforeach