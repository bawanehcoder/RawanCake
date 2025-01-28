<div class="quickview-product-modal modal fade " id="newAddressModal">
    <div class="modal-dialog modal-dialog-centered  modal-lg">
        <div class="custom-content">
            <div class="modal-header"><h5 class="modal-title" id="newAddressModalLabel">@langucw('address')</h5></div>
            <div class="modal-body">
                <form method="POST" action="{{route('shipping_info.save')}}">
                    <div class="modal-body m-2 mar-right-10 mar-left-10">
                        <input type="hidden" id="id_hidden" name="id" value="">
                        @csrf
                        <div class="col-12">
                            {{-- Title--}}
                            <div class="form-group row">
                                <div class="col-4 col-form-label"><label for="phone">@langucw('title')</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" required class="form-control" id="title" name="title"
                                           value='{{ old('title')  }}' placeholder="@langucw('title')"/></div>
                            </div>
                            {{-- name--}}
                            <div class="form-group row">
                                <div class="col-4 col-form-label"><label for="name">{{trans('general.name')}}</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" required class="form-control" id="name" name="name"
                                           value='{{ old('name')  }}' placeholder="{{trans('general.name')}}"/></div>
                            </div>





                            <div class="form-group row">
                                <div class="col-4 col-form-label"><label for="first-name">@langucw('the region')</label></div>
                                <div class="select-wrapper w-50 col">
                                    <select required class="form-field"  id="zone" name="zone">
                                        @foreach($zones??[] as $index=>$zone)
                                            <option value="{{$zone->id}}">{{$zone['Addres'.getLang()]}}</option>
                                        @endforeach
                                    </select>
                                </div></div>
                            {{-- Phone--}}
                            <div class="form-group row">
                                <div class="col-4 col-form-label"><label for="phone">@langucw('additional number')</label></div>
                                <div class="col-8">
                                    <input required type="text" class="form-control" id="phone" name="phone"
                                           value='{{ old('phone')  }}' placeholder="@langucw('phone')"/></div>
                            </div>
                            {{-- shipping info--}}
                            <div class="form-group row">
                                <div class="col-4 col-form-label"><label for="shipping_info">@langucw('shipping info')</label></div>
                                <div class="col-8">
                                            <textarea required rows="10" class="form-control" id="shipping_info_text"
                                                      name="shipping_info"
                                                      placeholder="@langucw('shipping info')">{{ old('shipping_info')  }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-primary " data-bs-dismiss="modal" aria-label="Close">@langucw('close')</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary ">{{trans('general.save')}}</button>
                            </div>

                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')

    <script>

        function update(id) {

            var zone = $("#zone_" + id).attr('att');
            var phone = $("#phone_" + id).html();
            var title = $("#title_" + id).html();

            var name = $("#name_" + id).html();
            var shipping_info = $("#shipping_info_text_" + id).html();
            $('#zone option').prop('selected', false);
            $('#zone option').eq(zone - 1).prop('selected', true);
            $('#id_hidden').val(id)
            $('#phone').val(phone)
            $('#title').val(title)
            $('#name').val(name)
            $('#shipping_info_text').val(shipping_info)
            $('#newAddressModal').modal('show');
        }

        function newAddressModalFun() {
            $('#id_hidden').val('')
            $('#phone').val('')
            $('#title').val('')
            $('#name').val('')
            $('#shipping_info_text').val('')
            $('#newAddressModal').modal('show');
        }

        function nextFun() {

            var _href = $("input[name='address_id']:checked").attr('_href');
            if (_href != undefined) {
                window.location.href = _href;
            } else {
                toastr.error("@langucw('the address must be specified')")
            }

        }

        $(".personal_delivery").on('change', function (e) {
            if ($(this).attr('id') == 'delivery2') {
                $('#zone_personal').prop('disabled', true);
                $("#shipping_info").show();
                $("#personal_delivery").hide()
            } else {
                $('#zone_personal').prop('disabled', false);
                $("#personal_delivery").show();
                $("#shipping_info").hide()
            }
        });

    </script>

@endpush
