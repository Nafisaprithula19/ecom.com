@component('mail::message')
hi <b>{{$user->name}}<b>,
    <p>We understand it happens</p>
   

    <p>@component('mail::button',['url'=>url('reset/'.$user->remember_token)])
        Reset Your Password
        @endcomponent
    </p>
    <p>In case if you have any issues please contact us.</p>
    Thanks, <br>
    {{config('app.name')}}
    @endcomponent