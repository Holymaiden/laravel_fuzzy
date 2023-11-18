@foreach ($data as $key => $v)
<tr>
    <td>{{ ++$i }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['spiritual']['sangat_baik'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['spiritual']['perlu_bimbingan'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['sosial']['sangat_baik'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['sosial']['perlu_bimbingan'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['pengetahuan']['sangat_baik'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['pengetahuan']['baik'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['pengetahuan']['cukup'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['pengetahuan']['perlu_bimbingan'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['keterampilan']['sangat_baik'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['keterampilan']['baik'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['keterampilan']['cukup'] }}</td>
    <td>{{ $v['fuzzy']['fuzzifikasi']['keterampilan']['perlu_bimbingan'] }}</td>
</tr>
@endforeach