@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v['name'] }}</td>
    <td>{{ $v['kelas'] }}</td>
    <td>{{ $v['fuzzy']['spiritual'] }}</td>
    <td>{{ $v['fuzzy']['sosial'] }}</td>
    <td>{{ $v['fuzzy']['pengetahuan'] }}</td>
    <td>{{ $v['fuzzy']['keterampilan'] }}</td>
    <td>{{ $v['fuzzy']['sugeno']['hasil'] }}</td>
</tr>
@endforeach