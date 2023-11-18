@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v['name'] }}</td>
    <td>{{ $v['fuzzy']['rata'] }}</td>
    <td>{{ $v['fuzzy']['mamdani']['nilai'] }}</td>
    <td>{{ $v['fuzzy']['mamdani']['hasil'] }}</td>
    <td>{{ $v['fuzzy']['sugeno']['nilai'] }}</td>
    <td>{{ $v['fuzzy']['sugeno']['hasil'] }}</td>
</tr>
@endforeach