<tr>
    <td>{{ ($clients ->currentpage()-1) * $clients ->perpage() + $loop->index + 1 }}</td>
    <td>{!! $client->name !!}</td>
    <td>{!! $client->email !!}</td>
    <td>{!! $client->mobile !!}</td>
    <td>{!! optional($client->city)->name !!}</td>
    <td>
        @component('dashboard.layouts.partials.buttons._restore_button',[
                                'id'=>$client->id,
                                'route' => route('dashboard.restore-client',$client->id) ,
                                'tooltip' => __('Restore'),
                                 ])
        @endcomponent

    </td>
</tr>

