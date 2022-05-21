@php
$id = $place->id ?? '@id@';
@endphp
<tr>
    <td>
        @include('admin.commons.components.html.text', ['id' => null, 'fieldName' => "places[{$id}][name]", 'default' => $place->name])
    </td>
    <td>
        @include('admin.commons.components.html.text', ['id' => null, 'fieldName' => "places[{$id}][official_site_url]", 'default' => $place->official_site_url])
    </td>
    <td>
        @include('admin.commons.components.html.text', ['id' => null, 'fieldName' => "places[{$id}][google_map_url]", 'default' => $place->google_map_url])
    </td>
    <td>
        {{-- 場所IDが正の数=DBに登録されているのでチェックボックスを表示 --}}
        @if($place->id && 0 < $place->id)
            @include('admin.commons.components.html.checkbox', ['id' => null, 'fieldName' => "places[{$id}][delete]", 'class' => 'icheck-red'])
        @else
            <i class="fas fa-trash-alt delete-icon"></i>
        @endif
    </td>
</tr>
