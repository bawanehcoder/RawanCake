@extends('admin.layout.master')
@section('title')
    {{trans('general.users')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}">{{trans('general.users')}}</a></li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <div class=" card table-list-card>
        <div class=" card table-list-card-header">
            <h3class=" card table-list-card-title">{{ $user->name }}</h3>
        </div>

        <div class=" card-body table-list-card-body">
            <form method="POST" action="{{ route("dashboard.users.update", [$user->id]) }}"
                  enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" id="id" name="id" value="{{$user->id}}"/>
                <div class="form-group">
                    <label class="required" for="name">{{ trans('general.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                           id="name" value="{{ old('name', $user->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="required" for="email">{{ trans('general.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                           name="email" id="email" value="{{ old('email', $user->email) }}" required>
                    @if($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone"
                           class="  col-form-label text-md-end">{{ __('Phone number') }}</label>
                    <input id="phone" type="text"
                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                           value="{{ old('phone', $user->phone) }}" required autocomplete="phone">

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ZoneID" class=" form-label text-md-end">{{ __('ZoneID') }}</label>
                    <select  autocomplete="off" id="zone"  name="zone" class="form-select select2 w-100">
                        @foreach(\App\Models\Zones::all() ??[] as $zone)
                            <option
                                value="{{$zone->id}}" {{$user->ZoneID==$zone->id?'selected':''}}>{{$zone->AddresAr}}   </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="gender" class="  form-label text-md-end">{{ __('Gender') }}</label>
                    <select name="gender" autocomplete="off" id="gender" class="form-select select2 w-100">
                        <option value="0" {{$user->gender=="0"?'selected':''}}>{{__('Male')}}     </option>
                        <option value="1" {{$user->gender=="1"?'selected':''}}>{{__('Female')}}   </option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">
                        {{ trans('general.save') }}
                    </button>
                    <a href="{{route('dashboard.users.index' )}}" class="btn btn-default">{{trans('general.back')}}</a>
                </div>
            </form>
        </div>
    </div>

@endsection
