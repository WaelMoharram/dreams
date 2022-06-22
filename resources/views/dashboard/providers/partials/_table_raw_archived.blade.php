<tr>
    <td>{{ ($providers ->currentpage()-1) * $providers ->perpage() + $loop->index + 1 }}</td>
    <td>{!! $provider->name !!}</td>
    <td>{!! $provider->email !!}</td>
    <td>{!! $provider->mobile !!}</td>
    <td>{!! optional($provider->city)->name !!}</td>
    <td>
        @component('dashboard.layouts.partials.buttons._restore_button',[
                                'id'=>$provider->id,
                                'route' => route('dashboard.restore-provider',$provider->id) ,
                                'tooltip' => __('Restore'),
                                 ])
        @endcomponent

    </td>
</tr>

