@extends('admin.layout.master')
@section('title') @endsection
@section('css') @endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard.user-admin.index')}}">@langucw('departments and
            products')</a></li>
    <li class="breadcrumb-item active">{{trans('general.create')}}</li>
@endsection

@section('content')
    @include('components.messagesAndErrors')
    <section id="basic-horizontal-layouts">
        <form class="form form-horizontal"  action="{{route('dashboard.user-admin-permission.update',$entity)}}" method="POST"
              enctype="multipart/form-data" >
            <input type="hidden" name="_token" value="{{csrf_token()}}">


            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="user-admin">
            <input type="hidden" class="custom-file-input" name="id" id="id" value="{{$entity->id}}">
            <div class=" card table-list-card>

                <div class=" card table-list-card-header">

                </div>
                <div class="form-row p-1">
                    <div class="form-group col-md-6">
                        <!-- Default input -->
                        <label for="name">{{trans('general.name')}}</label>
                        <input disabled type="text" name="name" value="{{old('name')??$entity->name}}" id="name"
                               class="form-control">
                    </div>
                    <div class='row'>
                        @foreach ($permissions ?? [] as $groupName => $groupPermissions)

                            <div class='col-12 col-lg-4'>

                                <div class="-responsive border rounded mt-1">
                                    <h6 class="py-1 mx-1 mb-0 font-medium-2">
                                        <i data-feather="lock" class="font-medium-3 mr-25"></i>
                                        <span class="align-middle">@langucw(strtolower($groupName))</span>
                                    </h6>
                                    <table class=" table-striped table-borderless">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>@langucw('permission')</th>
                                            <th>#</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($groupPermissions ?? [] as $groupPermission)
                                            <tr>
                                                <td>{{$groupPermission->name}}</td>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name='permissions_ids[]' value="{{ $groupPermission->name }}" class="custom-control-input" id="permission-{{ $groupPermission->id }}" {{ $entity->hasPermissionTo($groupPermission->id) ? 'checked' : '' }}  />
                                                        <label class="custom-control-label" for="permission-{{ $groupPermission->id }}"></label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        @endforeach
                    </div>


                </div>

                <div class="form-group col-md-3 p-1">
                    <button type="submit" class="btn btn-danger">{{trans('general.update')}}</button>
                    <a class="btn btn-site" href="{{route('dashboard.user-admin.index')}}">{{trans('general.back')}}</a>
                </div>
            </div>
        </form>
    </section>

@endsection
@section('scripts') @endsection
