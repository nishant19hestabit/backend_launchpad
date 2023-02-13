@if(session()->has('error'))
<span class="text-danger">{{session()->get('error')}}</span>
@endif
@if(session()->has('success'))
<span class="text-success">{{session()->get('success')}}</span>
@endif