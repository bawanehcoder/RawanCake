<div class='row'>
{{--    login-with-provider-container--}}
    {{--login with twitter--}}
    @if(in_array('twitter', config('socialLogin.allowed_providers')))
        <div class="col">
            <a href="{{route('social_login.redirect_to_provider')}}?guard={{$guard}}&provider=twitter" class='twitter login-with-provider-button'>
                <i class='fa fa-twitter' class='icon' style='color:white; font-size: 20px;'></i>
                <span class='button-text'>
                @lang('Login With Twitter')
            </span>
            </a>
        </div>
    @endif

    {{--login with google--}}
    @if(in_array('google', config('socialLogin.allowed_providers')))
        <div class="col">
            <a href="{{route('social_login.redirect_to_provider')}}?guard={{$guard}}&provider=google" class='google login-with-provider-button'>
                <i class='fa fa-google ' class='icon' style='font-size: 20px;'></i>
                <span class='button-text'>
                @lang('Login With Google')
            </span>
            </a>
        </div>
    @endif

    {{--login with facebook--}}
         @if(in_array('facebook', config('socialLogin.allowed_providers')))
        <div class="col">
            <a href="{{route('social_login.redirect_to_provider')}}?guard={{$guard}}&provider=facebook" class='fb login-with-provider-button'>
                <i class='fa fa-facebook' class='icon' style='font-size: 20px;'></i>
                <span class='button-text' style='width:85%;'>
                    @lang('Login With Facebook')
                </span>
            </a>
        </div>
        @endif
{{--    login with instagram--}}
{{--    @if(in_array('instagram', config('socialLogin.allowed_providers')))--}}
{{--        <div class="col">--}}
{{--            <a href="{{route('social_login.redirect_to_provider')}}?guard={{$guard}}&provider=instagram" class='fb login-with-provider-button'>--}}
{{--                <i class='fa fa-instagram' class='icon' style='font-size: 20px;'></i>--}}
{{--                <span class='button-text' style='width:85%;'>--}}
{{--                    @lang('Login With instagram')--}}
{{--                </span>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    @endif--}}


</div>

@push('css')
    <style>
        .login-with-provider-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .login-with-provider-button {
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 7px;
            border-radius: 2px;
            margin: 20px 0;
            width: 240px;
            border-radius: 20px;
        }

        .fb {
            background-color: #3B5898;
        }

        .fb:hover {
            background-color: #337ab7;
            color: white;
        }

        .google:hover {
            background-color: #f06e60;
            color: white;
        }

        .google {
            background-color: #DD4C39;
        }

        .twitter {
            background-color: #00abee;
        }

        .twitter:hover {
            background-color: #4cbde6;
            color: white;
        }

        .login-with-provider-button .icon {
            font-size: 25px;
        }

        .button-text {
            font-size: 18px;
            margin: 0px 5px;
            text-align: center;
            display: inline-block;
            width: 80%;
        }
    </style>
@endpush

@section('scripts')

@endsection

