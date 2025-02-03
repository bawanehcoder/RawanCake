@extends('site.layout.master')
@section('title')
    @langucw('contact us')
@endsection
@section('css') @endsection
@section('breadcrumb')
    <li><a href="{{route('home')}}">@langucw('home')</a></li>
    <li>@langucw('contact us')</li>
@endsection
@section('content')

    <!-- Contact form section Start -->
    <div class="section-padding-03 contact-section2 contact-section2_bg">
        <div class="container custom-container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-section2_content">
                        <h2 class="contact-section2__title">@langucw('informations')</h2>
                        <ul class="contact-section2_list">
                            <li>
                                <span class="contact-section2_list__icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                <span class="contact-section2_list__text" style="padding-left: 20px; padding-right: 20px;">065001888</span>
                            </li>
                            <li>
                                <span class="contact-section2_list__icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                                <span class="contact-section2_list__text" style="padding-left: 20px; padding-right: 20px;">support@rawancake.jo</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('components.messagesAndErrors')
                    <div class="contact-section2_formbg">
                        <h2 class="contact-section2_form__title">@langucw('say something') ...</h2>
                        <form class="contact-section2_form" method="POST" action="{{ route('contact_us.send') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 form-p">
                                    <div class="form-group">
                                        <label>{{trans('general.name')}} <span>*</span></label>
                                        <input class="form-field" type="text" name="name" value='{{ old('name') }}' placeholder="{{trans('general.name')}}">
                                    </div>
                                </div>

                                <div class="col-md-12 form-p">
                                    <div class="form-group">
                                        <label>@langucw('your email') *</label>
                                        <input class="form-field" type="email" name="email" value="{{ old('email') }}" 
                                               placeholder="@langucw('your email')" style="text-align: right; direction: rtl;">
                                    </div>
                                </div>

                                <div class="col-md-12 form-p">
                                    <div class="form-group">
                                        <label><span>@langucw('phone') *</span></label>
                                        <input class="form-field" type="text" name="phone" value='{{ old('phone') }}' placeholder="@langucw('phone')">
                                    </div>
                                </div>

                                <div class="col-md-12 form-p">
                                    <div class="form-group">
                                        <label>@langucw('message') *</label>
                                        <textarea class="form-control text-area" name="message" 
                                        placeholder="@langucw('message')" 
                                        style="text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }}; direction: {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }};">
                                  {{ old('message') }}
                              </textarea>
                              
                                    </div>
                                </div>
                                <div class="col-md-12 form-p">
                                    <div class="form-group mb-0 d-flex justify-content-center">
                                        <button class="btn btn-secondary btn-hover-primary" type="submit" value="send message">@langucw('send message')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- Message Notification -->
                        <div class="form-messege"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact form section End -->

    <!-- Contact Map Start -->
    <div class="section">
        <div class="google-map-area w-100" data-aos="fade-up" data-aos-duration="1000">
            <iframe class="contact-map" src="{{\App\Services\BranchesService::getFirstBracheLocation()}}"></iframe>
        </div>
    </div>
    <!-- Contact Map End -->

@endsection
@section('scripts') @endsection