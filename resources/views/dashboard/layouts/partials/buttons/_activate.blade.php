<button data-toggle="modal" data-target="#usersActivate{{$id}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif
class="btn btn-md btn-success" >
    <i class="fa fa-check"></i> {{$name ?? ''}}
</button>

<!-- Modal -->
<div class="modal fade text-left" id="usersActivate{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">{{$name ?? $tooltip}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>{{__('Are you sure ?')}}</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" action=
                    {{$route}}>
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">{{$name ?? $tooltip}}</button>

                </form>
                <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </div>
    </div>
</div>
