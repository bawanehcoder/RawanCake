@extends('admin.layout.master')
@section('title')
    {{ trans('general.update') }} {{ trans('general.discount_on_a_product') }}
@endsection
@section('css')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a
            href="{{ route('dashboard.discounts.index') }}">{{ trans('general.offers_and_discounts') }}</a></li>
    <li class="breadcrumb-item active">{{ trans('general.discount_on_a_product') }}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal" action="{{ route('dashboard.discounts.update', $entity) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="discounts">
            <div class=" card ">
                <div class=" card-body table-list-card-body">
                <div class="row">
                    <div class="form-group col-6">
                        <label for="section_title_ar">{{ trans('general.categories') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                style="border-radius: 0">{{ trans('general.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                style="border-radius: 0">{{ trans('general.deselect_all') }}</span>
                        </div>
                        <select name="categories[]" autocomplete="off" id="categories" class="select2 w-100" multiple>
                            @foreach ($categories ?? [] as $category)
                                <option
                                    {{ in_array($category->id, old('$category') ?? ($categories_select ?? [])) ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->Name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 " style="margin-top: 28px;">
                        <div class="form-group ">
                            <label for="discount">{{ trans('general.discount') }}</label>
                            <input type="number" min="1" max="100" name="discount"
                                value="{{ old('discount') ?? $entity->Value }}" id="discount" class="form-control"
                                placeholder="%">
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class=" col-6 ">
                        <label for="beginning_of_reservation">@langucw('beginning of reservation')</label>
                        <x-flatpickr value="{{ old('beginning_of_reservation') ?? $entity->BeginDate }}"
                            name="beginning_of_reservation" show-time time-format="h:i" />
                    </div>
                    <div class="col-6">
                        <label for="end_of_reservation">@langucw('end of reservation')</label>
                        <x-flatpickr value="{{ old('end_of_reservation') ?? $entity->EndDate }}" name="end_of_reservation"
                            show-time time-format="h:i" />
                    </div>
                </div>
                <div class="row mt-4">
                    <div class=" col-6 ">
                        <label for="beginning_of_receipt">@langucw('beginning of receipt')</label>
                        <x-flatpickr value="{{ old('beginning_of_receipt') ?? $entity->BeginDelivery }}"
                            name="beginning_of_receipt" show-time time-format="h:i" />
                    </div>
                    <div class="col-6">
                        <label for="end_of_receipt">@langucw('end of receipt')</label>
                        <x-flatpickr value="{{ old('end_of_receipt') ?? $entity->EndDelivery }}" name="end_of_receipt"
                            show-time time-format="h:i" />
                    </div>
                </div>
                <div class=" mt-4">
                    <button type="submit" class="btn btn-danger">{{ trans('general.update') }}</button>
                </div>
            </div>
            </div>
        </form>
    </section>
@endsection
