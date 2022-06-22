<tr>
    <td>{{ ($users ->currentpage()-1) * $users ->perpage() + $loop->index + 1 }}</td>
    <td>{!! $user->name !!}</td>
    <td>{!! $user->email !!}</td>
    <td>

        <div class="btn-group" role="group" aria-label="Vertical button group">
            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._show_button',[
                        'route' => route('dashboard.users.show',$user->id),
                        'tooltip' => __('Show').' '.$user['name'],
                         ])
                @endcomponent
            </div>
            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._edit_button',[
                            'route' => route('dashboard.users.edit',$user->id),
                            'tooltip' => __('Edit').' '.$user['name'],
                             ])
                @endcomponent
            </div>

{{--            <div class="btn-group" role="group">--}}
{{--                @if($user->status == \App\Models\User::STATUS_ACTIVE)--}}
{{--                    @component('dashboard.layouts.partials.buttons._suspend',[--}}
{{--                                'id'=>$user->id,--}}
{{--                                'route' => route('dashboard.users.suspend',$user->id) ,--}}
{{--                                'tooltip' => __('Suspend'),--}}
{{--                                'name' => __('Suspend'),--}}
{{--                                 ])--}}
{{--                    @endcomponent--}}
{{--                @elseif($user->status == \App\Models\User::STATUS_SUSPEND)--}}
{{--                    @component('dashboard.layouts.partials.buttons._activate',[--}}
{{--                        'id'=>$user->id,--}}
{{--                        'route' => route('dashboard.users.suspend',$user->id) ,--}}
{{--                        'tooltip' => __('Active'),--}}
{{--                        'name' =>__('Active')--}}
{{--                         ])--}}
{{--                    @endcomponent--}}
{{--                @endif--}}
{{--            </div>--}}
        </div>
    </td>
</tr>

