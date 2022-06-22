<tr>
    <td>{{ ($clients ->currentpage()-1) * $clients ->perpage() + $loop->index + 1 }}</td>
    <td>{!! $client->name !!}</td>
    <td>{!! $client->email !!}</td>
    <td>{!! $client->mobile !!}</td>
    <td>{!! optional($client->city)->name !!}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Vertical button group">
            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._show_button',[
                        'route' => route('dashboard.clients.show',$client->id),
                        'tooltip' => __('Show').' '.$client['name'],
                         ])
                @endcomponent
            </div>

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.clients.edit',$client->id),
                            'tooltip' => __('Edit').' '.$client['name'],
                             ])
                @endcomponent
            </div>

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._delete_button',[
                                'id'=>$client->id,
                                'route' => route('dashboard.clients.destroy',$client->id) ,
                                'tooltip' => __('Delete'),
                                 ])
                @endcomponent
            </div>

        </div>

        <div class="btn-group" role="group" aria-label="Vertical button group">
            <div class="btn-group" role="group">
                @if($client->status == \App\Models\User::STATUS_ACTIVE)
                    @component('dashboard.layouts.partials.buttons._suspend',[
                                'id'=>$client->id,
                                'route' => route('dashboard.clients.suspend',$client->id) ,
                                'tooltip' => __('Suspend'),
                                'name' => __('Suspend'),
                                 ])
                    @endcomponent
                @elseif($client->status == \App\Models\User::STATUS_SUSPEND)
                    @component('dashboard.layouts.partials.buttons._activate',[
                        'id'=>$client->id,
                        'route' => route('dashboard.clients.suspend',$client->id) ,
                        'tooltip' => __('Active'),
                        'name' =>__('Active')
                         ])
                    @endcomponent
                @endif
            </div>
        </div>


    </td>
</tr>

