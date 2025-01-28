//##########    Subscription   ##########
$(".subscription-btn").click(function(e){
    e.preventDefault();
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $.ajax({
        type: 'POST',
        url: "/newsletters/subscription",
        data: {'email':$('.subscription-email').val()},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function(){
            $('.subscription-email').val('....Please wait');
            $('.subscription-email').prop('disabled', true);
            $('.subscription-btn').prop('disabled', true);
        },
        success: function(response){
            Command:toastr["success"](response['data'][0])

        },
        complete: function(response){
            $('.subscription-email').val('');
            $('.subscription-btn').prop('disabled', false);
            $('.subscription-email').prop('disabled', false);
        }
        ,
        error: function (xhr, status, error)
        {
            if(xhr.responseJSON.message!=undefined && xhr.responseJSON.message!=null){
                toastr.error(xhr.responseJSON.message)
            }else{
                toastr.error("@langucw('an error occurred')")
            }
            $('.subscription-email').val('');
            $('.subscription-btn').prop('disabled', false);
            $('.subscription-email').prop('disabled', false);

        }
    });
});
