@component('mail::message')
hi <b>{{$user->name}}<b>,
    <p>you are almost ready to start enjoyable the benefits of IB CODE</p>
    <P>Simply click the button below to verify your email address.</P>

    <p>@component('mail::button',['url'=>url('activate/'.base64_encode($user->id))])
        verify
        @endcomponent
    </p>
    <p>this will verify your emal address.and then youll officially be a part of the IBCODE</p>
    @endcomponent