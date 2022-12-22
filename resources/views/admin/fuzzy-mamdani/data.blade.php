@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v['name'] }}</td>
    <td>{{ $v['value'][0]['value'] }} ({{ $v['eval'][0]['value'] }})</td>
    <td>{{ $v['value'][1]['value'] }} ({{$v['eval'][1]['value'] }})</td>
    <td>{{ $v['value'][2]['value'] }} ({{$v['eval'][2]['value'] }})</td>
    <td>{{ $v['value'][3]['value'] }} ({{$v['eval'][3]['value'] }})</td>
    <td>{{ $v['total'] }}</td>
    <td>{{ $v['rule'] }}</td>
    <td>
        {!! Helper::btn_action('1','1',$v['id']) !!}
    </td>
</tr>
@endforeach