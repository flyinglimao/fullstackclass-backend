@component('mail::message')
 {{--Greeting--}}

@if ($level == 'error')
# @lang('Whoops!')
@else
# @lang('親愛的用戶您好: ')
@endif


 {{--Intro Lines--}}
@foreach ($introLines as $line)
{{ $line }}
@endforeach

 {{--Action Button--}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

 {{--Outro Lines--}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

 {{--Salutation--}}

@lang('預祝購物愉快'),<br>貓咪書店



{{--@isset($actionText)--}}
{{--@component('mail::subcopy')--}}
{{--@lang(--}}
    {{--"If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".--}}
    {{--'into your web browser: [actionURL](:actionURL)',--}}
    {{--[--}}
        {{--'actionText' => $actionText,--}}
        {{--'actionUrl' => $actionUrl--}}
    {{--]--}}
{{--)--}}
{{--@endcomponent--}}
{{--@endisset--}}
@endcomponent
