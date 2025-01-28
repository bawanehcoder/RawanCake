@extends('admin.layout.master')
@section('title')
    {{trans('general.sub_categories')}}
@endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.conditional-deliveries.index')}}">{{trans('general.products')}}</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal"  method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="conditional-deliveries">
            <div class=" card table-list-card>


                <div class="container p-2">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group ">
                                <label for="section_title_ar">@langucw('title ar')</label>
                                <input disabled type="text" name="title_ar" value="{{old('title_ar')??$entity->title_ar}}" id="title_ar" class="form-control">
                            </div>

                        </div>
                        <div class="col-6">
                            <div class="form-group ">
                                <label for="title_en">@langucw('title en')</label>
                                <input disabled type="text" name="title_en" value="{{old('title_en')??$entity->title_en}}" id="title_en" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="zones">@langucw('zones')</label>
                            <select disabled name="zones[]" autocomplete="off" id="zones" class="select2 w-100"
                                    multiple>
                                @foreach($zones ??[] as $zone)
                                    <option
                                        {{ in_array($zone->id, $entity->zone_ids??[]  )? 'selected' : '' }} value="{{$zone->id}}">{{$zone->getTitle()}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="products">{{trans('general.products')}}</label>
                            <select disabled name="products[]" autocomplete="off" id="products" class="select2 w-100"
                                    multiple>
                                @foreach($products ??[] as $product)
                                    <option
                                        {{ in_array($product->id, $entity->items??[]  ) ? 'selected' : '' }} value="{{$product->id}}">{{$product->getTitle()}} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-6 ">
                            <div class="form-group ">
                                <label for="purchase_value">@langucw('purchase value')</label>
                                <input disabled type="number" step="any" min="0" max="100" name="purchase_value" value="{{old('purchase_value')??$entity->purchase_value}}"
                                       id="purchase_value" class="form-control" placeholder="0.0">
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class="form-group ">
                                <label for="discount">@langucw('delivery')</label>
                                <input disabled type="number" step="any" min="0" max="100" name="delivery" value="{{old('delivery')??$entity->delivery}}"
                                       id="delivery" class="form-control" placeholder="0.0">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class=" col-6 ">
                            <label for="start_time">@langucw('beginning of reservation')</label>
                            <x-flatpickr disabled value="{{old('start_time')??$entity->start_time}}" name="start_time"
                                         show-time time-format="h:i"/>
                        </div>
                        <div class="col-6">
                            <label for="end_time">@langucw('end of reservation')</label>
                            <x-flatpickr disabled value="{{old('end_time')??$entity->end_time}}" name="end_time" show-time
                                         time-format="h:i"/>
                        </div>
                    </div>



                    <div class=" mt-4">
                        <a href="{{route('dashboard.conditional-deliveries.index')}}" class="btn btn-default">{{trans('general.back')}}</a>
                    </div>


                </div>


            </div>

        </form>
    </section>

@endsection
@section('scripts')
    <script>

    </script>

@endsection
