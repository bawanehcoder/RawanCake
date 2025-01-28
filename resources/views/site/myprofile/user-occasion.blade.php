<div class="tab-pane fade" id="user-occasion">
    <div class="myaccount-content user-occasion">
        <div class="-responsive">
            <div class="team-3-content">
                 <div class="team-3-head">
                     <a class="btn btn-outline-dark btn-primary-hover rounded-0" href="{{route('user_occasions.create')}}">{{trans('general.create')}}</a>
                 </div>
            </div>
            <div id="user_occasion_content">
                @include('site.myprofile.user-occasion-widget')
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function deleteItemInUserOccasions($url){

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        var confirmButtonText="@langucw('delete')";
        swalWithBootstrapButtons.fire({
            title: "@langucw('are you sure?')",
            text:  "@langucw('you won`t be able to revert this')",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText:"@langucw('cancel')",
            confirmButtonText:confirmButtonText ,
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: $url,
                    type: "post",
                    data: '',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response, textStatus, jqXHR) {


                            $("#user_occasion_content").html(response);


                    },
                    error: function (XHR, textStatus, errorThrown) {
                        alert("@langucw('an error occurred')")
                    },
                    complete: function (xhr, status) {
                    },
                });




            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {

            }
        })
    }


</script>


