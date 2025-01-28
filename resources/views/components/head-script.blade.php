<script type="text/javascript">
    //##########    buyNowDetails   ##########;
    function buyNowDetails($id) {
        var optin = $("#OptID").find(":selected").val();
        var _data = [];
        $('.selectCom').each(function() {
            _data.push($(this).find(":selected").val());
        });
        const form_data = new FormData();
        if ($('#image_product_user') != undefined && $('#image_product_user').prop('files') != undefined) {
            var name = $('#image_product_user').prop('files')[0].name;
            var ext = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                Command: toastr["success"]('Invalid Image File');

                return;
            }
            form_data.append("image", $('#image_product_user').prop('files')[0]);
        }

        form_data.append('data', JSON.stringify(_data));


        $.ajax({
            type: 'POST',
            url: `/cart/addtocart/${$id}`,
            dataType: 'json',
            data: form_data,
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {

            },
            success: function(response) {

                if (response.status == 200) {
                    window.location.href = ("{{ config('app.url') }}/cart/index");
                } else {
                    toastr.error("@langucw('an error occurred')");
                }
            },
            complete: function(response) {},
            error: function(xhr, status, error) {
                if (xhr.responseJSON.message != undefined && xhr.responseJSON.message != null) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("@langucw('an error occurred')");
                }
            }
        });
    }



    //##########    addtocart   ##########;
    function addToCart($id) {
        var optin = $("#OptID").find(":selected").val();
        var _data = [];
        $('.selectCom').each(function() {
            _data.push($(this).find(":selected").val());
        });

        const form_data = new FormData();
        if ($('#image_product_user') != undefined && $('#image_product_user').prop('files') != undefined) {
            if ($('#image_product_user').prop('files')[0] != undefined) {
                var name = $('#image_product_user').prop('files')[0].name;
                var ext = name.split('.').pop().toLowerCase();

                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    Command: toastr["success"]('Invalid Image File');
                    return;
                }
                form_data.append("image", $('#image_product_user').prop('files')[0]);
            }
        }
        if ($('#productImage').val()) {
            form_data.append('productImage', $('#productImage').val());
        }
        form_data.append('data', JSON.stringify(_data));
        form_data.append('price', $('.d-price').data('price'));
        // alert($('.d-price').data('price'));
        form_data.append('note', $("#note").val());
        form_data.append('quantity', $("#qty").val());
        @if (auth()?->user()?->id)
            form_data.append('user_id', "{{ auth()->user()->id }}");
        @endif
        $.ajax({
            type: 'POST',
            url: `/cart/addtocart/${$id}`,
            data: form_data,
            dataType: 'json',
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {

            },
            success: function(response) {

                if (response.status == 200) {
                    Command: toastr["success"]('added successfully');

                    $("#cart_count").html(response.data.count)
                    window.location.reload();
                    // window.history.back(); // Go back to the previous page
                    // setTimeout(function() {
                    //     location.reload(); // Refresh the page after going back
                    // }, 100);
                    try {
                        $("#cart_count").html(response.data.count);
                    } catch (err) {

                    }


                }
            },
            complete: function(response) {},
            error: function(xhr, status, error) {
                if (xhr.responseJSON.message != undefined && xhr.responseJSON.message != null) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("@langucw('an error occurred')");
                }
            }
        });
    }

    //##########    addToFavorite   ##########;

    function addToFavorite($id) {
        @if (isLogged())
            var optin = $("#OptID").find(":selected").val();
            $.ajax({
                type: 'POST',
                url: `/favorites/addtofavorite/${$id}`,
                data: {
                    'OptID': optin
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {

                },
                success: function(response) {
                    if (response.status == 200) {
                        if (response.data.hasFavorite == false) {
                            $(".favorite_" + $id).removeClass('lastudioicon-heart-1')
                            $(".favorite_" + $id).addClass('lastudioicon-heart-2')
                            $(".favorite_" + $id).removeClass('active')


                            toastr["success"]('@langucw('remove successfully')');
                            window.location.reload();

                        } else {
                            $(".favorite_" + $id).removeClass('lastudioicon-heart-2')
                            $(".favorite_" + $id).addClass('lastudioicon-heart-1')
                            $(".favorite_" + $id).addClass('active')
                            toastr["success"]('@langucw('added successfully')');
                            window.location.reload();

                        }
                        try {
                            $("#cart_count").html(response.data.count);
                        } catch (err) {}
                    }
                },
                complete: function(response) {},
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message != undefined && xhr.responseJSON.message != null) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error("@langucw('an error occurred')");
                    }
                }
            });
        @else
            toastr.info("@langucw('you must log in first')");
        @endif
    }

    //##########    addToFavorite   ##########;
    function AddToRate($id, $rate) {
        @if (isLogged())
            $.ajax({
                type: 'POST',
                url: `/rating/addtorate/${$id}`,
                data: {
                    'rate': $rate
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {

                },
                success: function(response) {
                    $("#rateDiv").html(response);

                },
                complete: function(response) {},
                error: function(xhr, status, error) {
                    if (xhr.responseJSON.message != undefined && xhr.responseJSON.message != null) {
                        toastr.error(xhr.responseJSON.message);
                    } else {
                        toastr.error("@langucw('an error occurred')");
                    }
                }
            });
        @else
            toastr.info("@langucw('you must log in first')");
        @endif
    }

    //##########    Coupon Code   ##########;
    function couponCode() {
        var code = $("#coupon_code").val();
        if (code == '' || code == null || code == undefined) {
            toastr.error("@langucw('invalid coupon!')");
            return false;
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('coupons.check') }}",
            data: {
                'code': code
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {

            },
            success: function(response) {

                if (response.status == 200) {
                    if (response.data && response.data.coupons != false) {
                        Command: toastr["success"]('valid coupon');
                        var msg = "@langucw('additional discount of')";
                        if (response.data.coupons.FixedDiscount != '' && response.data.coupons
                            .FixedDiscount != null && response.data.coupons.FixedDiscount != undefined) {
                            msg += " ( " + response.data.coupons.FixedDiscount + " ) ";
                            $("#coupon_discount").html(msg);
                        } else if (response.data.coupons.RelativeDiscount != '' && response.data.coupons
                            .RelativeDiscount != null && response.data.coupons.RelativeDiscount != undefined
                            ) {
                            msg += " ( " + response.data.coupons.RelativeDiscount + " % ) ";;
                            ("#coupon_discount").html(msg);
                        }
                    }
                    else {
                        toastr.error("@langucw('invalid coupon!')");
                    }

                }
            },
            complete: function(response) {},
            error: function(xhr, status, error) {

                if (xhr.responseJSON.message != undefined && xhr.responseJSON.message != null) {
                    toastr.error(xhr.responseJSON.message);
                } else {
                    toastr.error("@langucw('an error occurred')");
                }
            }
        });


    }
</script>
