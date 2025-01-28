@extends('site.layout.master')
@section('title')
    @langucw('cart')
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('home')}}">@langucw('home')</a></li>
    <li aria-current="page" class="breadcrumb-item active">@langucw('referral')</li>
@endsection
@section('content')
    @include('components.referral-header')
    {{-- referral statistics --}}
    <div class="statistics-numbers row">
        <div class="col-6 col-md-3 mb-20">
            <div class="statistics-number-box">
                <span class="title">@langucw('referrals count')</span>
                <span class="number">{{ $countOfReferrals }}</span>
            </div>
        </div>

        <div class="col-6 col-md-3 mb-20">
            <div class="statistics-number-box">
                <span class="title">@langucw('profits')</span>
                <span class="number">${{ $profits }}</span>
            </div>
        </div>
    </div>


    <div class="block statistics-table-block">
        <div class="block-head">
            <p class="title">
                <i class="far fa-list-alt"></i>
                @langucw('referrals')
            </p>

            <div class="left">
                {{--                                 <select name="" id="" class="normal-select">
                                                    <option value="">ترتيب الاحدث</option>
                                                </select>
                                                <input type="text" class="daterange large" name="daterange" value="01/01/2018 - 01/15/2018" /> --}}
            </div>
        </div>

        <div class="statistics-table">
            <table id="table_id" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
                    <th>{{trans('general.id')}}</th>
                    <th>@langucw('user')</th>
                    <th>@langucw('date')</th>

                </tr>
                </thead>
                <tbody>
                @foreach ($usersIReferred ?? [] as $referral)


                    <tr>
                        <td>{{ $referral->id }}</td>
                        <td><span class="name">{{ ($referral->referrer->name) }}</span></td>
                        <td><span class="date">{{ $referral->created_at->format('Y-m-d') }}</span></td>


                    </tr>

                @endforeach


                </tbody>
            </table>
            {{-- paginations --}}
            @if($usersIReferred->lastPage() > 1)
                <div class="block p-2">
                    {{ $usersIReferred->links() }}
                </div>
            @endif
        </div>
    </div>


@endsection
@section('scripts') @endsection
