
@foreach($resources as $resourceItem)

    <tr class="bgc-1">
            <td class="bgc-1" >
                {{ date("d/m/Y", strtotime($resourceItem->tanggal)) }}
            </td>
            <td class="bgc-2" >
                {{ date( "H:i", strtotime($resourceItem->masuk)) }}
            </td>
            <td class="bgc-3" >
                {{ date( "H:i", strtotime($resourceItem->pulang)) }}
            </td>
            <td class="bgc-3" >
                {{ date( "H:i", strtotime($resourceItem->pulang)-(strtotime($resourceItem->masuk))) }}
            </td>
    </tr>
@endforeach
