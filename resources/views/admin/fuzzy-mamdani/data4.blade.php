@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][4]['a'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][4]['z'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][5]['a'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][5]['z'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][6]['a'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][6]['z'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][7]['a'] }}</td>
    <td>{{ $v['fuzzy']['defuzzifikasi'][7]['z'] }}</td>
</tr>
@endforeach