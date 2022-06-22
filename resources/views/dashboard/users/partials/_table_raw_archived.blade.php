<tr>
    <td>{{ ($users ->currentpage()-1) * $users ->perpage() + $loop->index + 1 }}</td>
    <td>{!! $user->name !!}</td>
    <td>{!! $user->email !!}</td>
    <td>

                @component('dashboard.layouts.partials.buttons._restore_button',[
                                'id'=>$user->id,
                                'route' => route('dashboard.restore-user',$user->id) ,
                                'tooltip' => __('Restore'),
                                 ])
                @endcomponent

    </td>
</tr>

