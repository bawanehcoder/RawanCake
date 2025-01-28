@extends('admin.layout.master')
@section('title')
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard.main-categories.index') }}">{{ trans('general.categories') }}</a>
    </li>
    <li class="breadcrumb-item active">@langucw('show')</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ trans('general.categories') }}</h5>
                </div>
                <div class="card-body">
                    <div class="form-row p-1">
                        <div class="form-group col-md-6">
                            <img src="{{ $entity->getFirstMediaUrl('categories', 'small') ?? '' }}" class="img-thumbnail">
                        </div>
                    </div>
    
                    <div class="form-row row p-1">
                        <div class="form-group col-md-6">
                            <!-- Default input -->
                            <label for="section_title_ar">@langucw('section title ar')</label>
                            <input type="text" name="section_title_ar" id="section_title_ar" readonly
                                value="{{ $entity->Name ?? '' }}" class="form-control">
                        </div>
                        <div class="form-group col-md-6 p-1">
                            <!-- Default input -->
                            <label for="section_title_en">@langucw('section title en')</label>
                            <input type="text" name="section_title_en" readonly value="{{ $entity->NameEN ?? '' }}"
                                id="section_title_en" class="form-control">
                        </div>
                    </div>
    
                    <div class="form-row row p-1">
                        <div class="form-group col-md-6">
                            <!-- Default input -->
                            <label for="short_title_ar">@langucw('short title ar')</label>
                            <input type="text" name="ShortcutName" readonly value="{{ $entity->ShortcutName ?? '' }}"
                                id="short_title_ar" class="form-control">
                        </div>
                        <div class="form-group col-md-6 p-1">
                            <!-- Default input -->
                            <label for="short_title_en">@langucw('short title en')</label>
                            <input type="text" name="ShortcutNameEN" readonly value="{{ $entity->ShortcutNameEN ?? '' }}"
                                id="short_title_en" class="form-control">
                        </div>
                    </div>
    
                    <div class="form-row row p-1">
                        <div class="form-group col-md-6">
                            <!-- Default input -->
                            <label for="short_title_ar">@langucw('sortindex')</label>
                            <input type="text" name="SortIndex" readonly value="{{ $entity->SortIndex ?? 0 }}" id="sortindex"
                                class="form-control">
                        </div>
                        <div class="form-group col-md-6 p-1">
                            <!-- Default input -->
                            <label for="short_title_en">{{ trans('general.available') }}</label>
                            <select name="Visible" autocomplete="off" class="custom-select form-control" disabled>
                                <option {{ $entity->Visible == 0 ? 'selected' : '' }} value="0">
                                    {{ trans('general.available') }}</option>
                                <option {{ $entity->Visible == 1 ? 'selected' : '' }} value="1">@langucw('unavailable')</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <section id="basic-horizontal-layouts">
        <div class=" card table-list-card">
            <div class="card-body">
               
            </div>
        </div>
    </section>
@endsection
@section('scripts')
@endsection
