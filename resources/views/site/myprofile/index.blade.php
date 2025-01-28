@extends('site.layout.master')
@section('title')
    @langucw('my account')
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li>@langucw('my account')</li>
@endsection
@section('content')

    <!-- My Account Section Start -->
    <div class="section section-padding-03">
        <div class="container custom-container">
            <div class="row g-lg-10 g-6">

                <!-- My Account Tab List Start -->
                @include('site.myprofile.tab-list')
                <!-- My Account Tab List End -->

                <!-- My Account Tab Content Start -->
                <div class="col-lg-8 col-12">
                    <div class="tab-content">

                        <!-- Single Tab Content Start -->
                        @include('site.myprofile.dashboad')
                        <!-- Single Tab Content End -->

                        <!-- Single Tab orders Start -->
                        @include('site.myprofile.orders')
                        <!-- Single Tab orders End -->

                        <!-- Single Tab referral Start -->
                        @include('site.myprofile.referral')
                        <!-- Single Tab referral End -->
                        <!-- Single Tab referral Start -->
                        @include('site.myprofile.points')
                        <!-- Single Tab referral End -->
                         <!-- Single Tab referral Start -->
                        @include('site.myprofile.user-occasion')
                        <!-- Single Tab referral End -->


                        <!-- Single Tab address Start -->
{{--                        @include('site.myprofile.address')--}}
                        <!-- Single Tab address End -->

                        <!-- Single Tab account-info Start -->
                        <div class="tab-pane fade" id="account-info">
                             @include('site.myprofile.account-info')
                        </div>

                        <!-- Single Tab account-info End -->

                    </div>
                </div> <!-- My Account Tab Content End -->

            </div>
        </div>
    </div>
    <!-- My Account Section End -->

@endsection

    <script>
        function updateProfile(){

            $.ajax({
                type: 'POST',
                url: '{{route('myprofile.update')}}',
                data: {"name":$('#name').val(),
                    "phone": $('#phone').val(),
                    "email": $('#email').val(),
                    "gender": $('#gender').val(),
                    "zone": $('#zone').val(),
                    "current-pwd": $('#current-pwd').val(),
                    "new-pwd": $('#new-pwd').val(),

                },
                // dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {

                },
                success: function (response) {

                $('#account_info').html(response)
                    if($('#current-pwd').val()!=''){
                        document.getElementById('logout-form').submit();
                    }
                },
                complete: function (response) {

                }
                ,
                error: function (xhr, status, error) {
                    if (xhr.responseJSON.message != undefined && xhr.responseJSON.message != null) {
                        toastr.error(xhr.responseJSON.message)
                    } else {
                        toastr.error("@langucw('an error occurred')")
                    }
                }
            });
        }
    </script>
