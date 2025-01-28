@if ($errors->any())
    <div class="">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                <div class="alert-body">
                    <i data-feather="info" class="mr-50 align-middle"></i>
                    <span>{{ $error }}</span>
                </div>
            </div>
        @endforeach
    </div>
@endif

@if(session('message') || session('status'))
    <div class="">
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <div class="alert-body">{{session('message') ?? session('status')}}.</div>
        </div>
    </div>
@endif


@if(session('error') )
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <div class="alert-body">{{session('error') }}</div>
    </div>
@endif
{{--@include('flash::message')--}}
