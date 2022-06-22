<tr>
    <td>{!! $loop->index +1 !!}</td>
    <td>{!! optional($order->user)->name !!}</td>
    <td>{!! optional($order->provider)->name !!}</td>
    <td>{!! optional($order->equipmentUser)->name !!}</td>

    <td>{!! $order->price !!}</td>
    <td>{!! $order->status !!}</td>
    <td>{!! $order->payment_method !!}</td>


</tr>

