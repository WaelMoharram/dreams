<tr>
    <td>{{ ($providers ->currentpage()-1) * $providers ->perpage() + $loop->index + 1 }}</td>
    <td>{!! $provider->name !!}</td>
    <td>{!! $provider->email !!}</td>
    <td>{!! $provider->mobile !!}</td>
    <td>{!! optional($provider->city)->name !!}</td>
    <td>
        <div class="btn-group" role="group" aria-label="Vertical button group">
            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._show_button',[
                        'route' => route('dashboard.providers.show',$provider->id),
                        'tooltip' => __('Show').' '.$provider['name'],
                         ])
                @endcomponent
            </div>

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.providers.edit',$provider->id),
                            'tooltip' => __('Edit').' '.$provider['name'],
                             ])
                @endcomponent
            </div>

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._delete_button',[
                                'id'=>$provider->id,
                                'route' => route('dashboard.providers.destroy',$provider->id) ,
                                'tooltip' => __('Delete'),
                                 ])
                @endcomponent
            </div>

        </div>

        <div class="btn-group" role="group" aria-label="Vertical button group">
            <div class="btn-group" role="group">
                @if($provider->status == \App\Models\User::STATUS_NEW)
                    @component('dashboard.layouts.partials.buttons._suspend',[
                                'id'=>$provider->id,
                                'route' => route('dashboard.providers.disapprove',$provider->id) ,
                                'tooltip' => __('Suspend'),
                                'name' => __('Disapprove'),
                                 ])
                    @endcomponent
                    @component('dashboard.layouts.partials.buttons._activate',[
                        'id'=>$provider->id,
                        'route' => route('dashboard.providers.approve',$provider->id) ,
                        'tooltip' => __('Active'),
                        'name' =>__('Approve')
                         ])
                    @endcomponent
                @endif
            </div>
        </div>

        <div class="btn-group" role="group" aria-label="Vertical button group">
            <div class="btn-group" role="group">
                @if($provider->status == \App\Models\User::STATUS_ACTIVE)
                    @component('dashboard.layouts.partials.buttons._suspend',[
                                'id'=>$provider->id,
                                'route' => route('dashboard.providers.suspend',$provider->id) ,
                                'tooltip' => __('Suspend'),
                                'name' => __('Suspend'),
                                 ])
                    @endcomponent
                @elseif($provider->status == \App\Models\User::STATUS_SUSPEND)
                    @component('dashboard.layouts.partials.buttons._activate',[
                        'id'=>$provider->id,
                        'route' => route('dashboard.providers.suspend',$provider->id) ,
                        'tooltip' => __('Active'),
                        'name' =>__('Active')
                         ])
                    @endcomponent
                @endif
            </div>
        </div>


    </td>
</tr>

