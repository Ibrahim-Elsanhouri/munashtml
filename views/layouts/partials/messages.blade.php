@if((session()->has('messages')))
    <div class="alert alert-{{session()->has('status')?session('status'):'danger'}}" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul class="message-alert">
            @foreach(session('messages') as $message)
                <li>{{$message}}</li>
            @endforeach
        </ul>
    </div>
@endif
        @if (session()->has('package'))
<div class="alert alert-danger">
{{ session()->get('package')}}
</div>
@endif
       @if (session()->has('msg'))
<div class="alert alert-succcess">
{{ session()->get('msg')}}
</div>
@endif