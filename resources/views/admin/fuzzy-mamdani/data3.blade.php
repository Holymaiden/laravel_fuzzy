@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][0]['a'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][0]['z'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][1]['a'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][1]['z'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][2]['a'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][2]['z'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][3]['a'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][3]['z'] }}</td>
</tr>
@endforeach