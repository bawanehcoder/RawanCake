<form class="form form-horizontal" action="{{route('dashboard.zone-options.store',$entity)}}" method="POST"
              enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="custom-file-input" name="blob" id="blob" value="zone-options" >
            <input type="hidden" class="custom-file-input" name="zone_id" id="zone_id" value="{{$entity->id}}" >
            <div class=" card table-list-card>
                <div class=" card table-list-card-header">
                    <button type="button" onclick="divAddFun()" class="btn btn-site">@langucw('add delivery')</button>
                </div>

                <div style="display:none;"  id="div_add" class="row m-2">



                    {{-- start time --}}

                    <div class="col-3">
                        <div class="form-group">
                            <label for="start_time">@langucw('start time')</label>
                            <x-flatpickr  value="{{old('start_time')??$entity->start_time}}"
                                         name="start_time"/>
                        </div>
                    </div>
                    {{-- end time --}}
                    <div class="col-3">
                        <div class="form-group">
                            <label for="end_time">@langucw('end time')</label>
                            <x-flatpickr  value="{{old('end_time')??$entity->end_time}}"
                                         name="end_time"/>
                        </div>
                    </div>
                    {{-- delivery --}}
                    <div class="col-3">
                        <div class="form-group">
                            <label for="delivery">@langucw('delivery')</label>
                            <input type="text" class="form-control" name="delivery" value='' placeholder="@lang('delivery')" />
                        </div>
                    </div>
                    <div class="col-1 mt-4 ">
                        <button type="submit" class="btn btn-site">{{trans('general.create')}}</button>
                    </div>
                </div>


            </div>
        </form>

