<button data-toggle="modal" data-target="#usersSuspend{{$id}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif
class="btn btn-md btn-danger" >
    <i class="fa fa-close"></i>{{$name ?? ''}}
</button>

<!-- Modal -->
<div class="modal fade text-left" id="usersSuspend{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel1">{{$name ?? $tooltip}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action={{$route}}>
                {{ csrf_field() }}
            <div class="modal-body row">
                <div class="form-group py-1 col-md-12">
                    <label for="first_name"> {{__('Reason')}}</label>
                    {!! Form::textarea('first_name',null,['id'=>'first_name','class'=>'form-control col','placeholder'=>__("First name"),isset($readOnly)?$readOnly:null,disable_on_show()]) !!}
                    {{input_error($errors,'first_name')}}
                </div>
            </div>
            <div class="modal-footer">


                    <button type="submit" class="btn btn-danger">{{$name ?? $tooltip}}</button>


                <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Close')}}</button>
            </div>
        </form>
        </div>
    </div>
</div>
