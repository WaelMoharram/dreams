
@if(isset($id))
<a href="{{route('dashboard.'.$route.'.create',['id'=>$id])}}" class="btn-icon btn btn-primary btn-round btn-sm" ><i class="feather icon-plus"></i> {{$name ?? ('Add new '.$route)}}</a>
@else
    <a href="{{route('dashboard.'.$route.'.create')}}" class="btn-icon btn btn-primary btn-round btn-sm" ><i class="feather icon-plus"></i> {{$name ?? ('Add new '.$route)}}</a>
@endif
<div class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="#">Chat</a>
    <a class="dropdown-item" href="#">Email</a>
    <a class="dropdown-item" href="#">Calendar</a>
</div>
