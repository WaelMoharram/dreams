<tr>
    <td>
        {{ ($contacts ->currentpage()-1) * $contacts ->perpage() + $loop->index + 1 }}
    </td>
    <td>{!! $contact->name !!}</td>
    <td>{!! $contact->email !!}</td>
    <td>{!! $contact->mobile !!}</td>

    <td>
        <div class="btn-group" role="group" aria-label="Vertical button group">

            <div class="btn-group" role="group">
                @component('dashboard.layouts.partials.buttons._show_button',[
                        'route' => route('dashboard.contacts.show',$contact->id),
                        'tooltip' => __('Show').' '.$contact['name'],
                         ])
                @endcomponent
            </div>
            <div class="btn-group" role="group">

                @component('dashboard.layouts.partials.buttons._delete_button',[
                            'id'=>$contact->id,
                            'route' => route('dashboard.contacts.destroy',$contact->id) ,
                            'tooltip' => __('Delete contact'),
                             ])
                @endcomponent
            </div>
        </div>



    </td>
</tr>

