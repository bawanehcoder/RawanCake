@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.zones.index')}}">@langucw('zones')</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{route('dashboard.zones.store')}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="zones" >
            <div class=" card table-list-card>
                <div class=" card table-list-card-header">
                    {{--                    region--}}

                    <div class="form-group col">
                        <div class="form-group col-md-6 p-1">
                            <label for="short_title_en">{{trans('general.region')}}</label>
                            <select name="RegionID" autocomplete="off" class="custom-select select2">
                                @foreach($regions ??[] as $region)
                                    <option   value="{{$region->id}}">{{$region->name_ar}}  | {{$region->name_en}} </option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="row m-2">
                    {{-- AddresAr --}}
                    <div class="col-6">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('AddresAr')</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="AddresAr" value='{{ old('AddresAr') }}' placeholder="@lang('AddresAr')" />
                            </div>
                        </div>
                    </div>
                    {{-- AddresEn --}}
                    <div class="col-6">
                        <div class="form-group row">
                            <div class="col-sm-3 col-form-label">
                                <label for="first-name">@lang('AddresEn')</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="AddresEn" value='{{ old('AddresEn') }}' placeholder="@lang('AddresEn')" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <table class="">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th class="w-25" scope="col">@langucw('today')</th>
                            <th class="w-25" scope="col">@langucw('delivery price')</th>
                            <th class="w-25" scope="col"></th>
                            <th class="w-25" scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td >@langucw('saturday')</td>
                            <td> <input type="text" class="form-control" name="delivery[]" value='{{ old('delivery.0')??0 }}' placeholder="@lang('delivery price')" /></td>
                       <td></td> <td></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td class="w-50">@langucw('sunday')</td>
                            <td> <input type="text" class="form-control" name="delivery[]" value='{{ old('delivery.1')??0 }}' placeholder="@lang('delivery price')" /></td>
                            <td></td> <td></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td class="w-50">@langucw('monday')</td>
                            <td> <input type="text" class="form-control" name="delivery[]" value='{{ old('delivery.2')??0 }}' placeholder="@lang('delivery price')" /></td>
                            <td></td> <td></td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td class="w-50">@langucw('tuesday')</td>
                            <td> <input type="text" class="form-control" name="delivery[]" value='{{ old('delivery.3')??0 }}' placeholder="@lang('delivery price')" /></td>
                            <td></td> <td></td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td class="w-50">@langucw('wednesday')</td>
                            <td> <input type="text" class="form-control" name="delivery[]" value='{{ old('delivery.4')??0 }}' placeholder="@lang('delivery price')" /></td>
                            <td></td> <td></td>
                        </tr>
                        <tr>

                            <th scope="row">6</th>
                            <td class="w-50">@langucw('thursday')</td>
                            <td> <input type="text" class="form-control" name="delivery[]" value='{{ old('delivery.5')??0 }}' placeholder="@lang('delivery price')" /></td>
                            <td></td> <td></td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td class="w-50">@langucw('friday')</td>
                            <td> <input type="text" class="form-control" name="delivery[]" value='{{ old('delivery.6')??0 }}' placeholder="@lang('delivery price')" /></td>
                            <td></td> <td></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-3 mb-3">
                <button type="submit" class="btn btn-site">{{trans('general.create')}}</button>
                <a href="{{route('dashboard.zones.index')}}" class="btn btn-default">{{trans('general.back')}}</a>

                </div>
                </div>


            </div>




        </form>

    </section>

@endsection
@section('scripts')

@endsection
