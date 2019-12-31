<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

@include("layouts.head")
<!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .alert {
            display: block !important;
        }

    </style>
    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{url('assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css"/>

</head>
<body>
{{--<div class="flex-center position-ref full-height">--}}
{{--@if (Route::has('login'))--}}
{{--<div class="top-right links">--}}
{{--@auth--}}
{{--<a href="{{ url('/') }}">Home</a>--}}
{{--@else--}}
{{--<a href="{{ route('login') }}">Login</a>--}}
{{--@endauth--}}
{{--</div>--}}
{{--@endif--}}

<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="step-first">
                <div class="alert alert-danger" style="display:none">

                </div>

                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav">
                    <div class="kt-wizard-v4__nav-items nav">

                        <!--doc: Replace A tag with SPAN tag to disable the step link click -->
                        <div class="kt-wizard-v4__nav-item nav-item" data-ktwizard-type="step"
                             data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body">
                                <div class="kt-wizard-v4__nav-number">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label">
                                    <div class="kt-wizard-v4__nav-label-title">
                                        New Client
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc">
                                        Information
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end: Form Wizard Nav -->
                <div class="kt-portlet">
                    <div class="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                <!--begin: Form Wizard Form-->
                                <form class="kt-form" id="kt_user_add_form" action="{{url('/client-landing-page')}}">
                                    <!--begin: Form Wizard Step 1-->
                                    @csrf
                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                         data-ktwizard-state="current">
                                        <div class="kt-heading kt-heading--md"> Client Details:</div>
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="kt-section__body">
                                                            <input name="roleId" hidden class="form-control"
                                                                   type="text" value="5">

                                                            <input name="createdBy" hidden class="form-control"
                                                                   type="text" value="0">

                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input id="name" name="name"
                                                                           class="form-control"
                                                                           type="text" value="{{ old('name') }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">Contact
                                                                    Phone</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend"><span
                                                                                    class="input-group-text"><i
                                                                                        class="la la-phone"></i></span>
                                                                        </div>
                                                                        <!-- country codes (ISO 3166) and Dial codes. -->
                                                                        <select class="form-control" name="countryCode"
                                                                                id="">
                                                                            <option data-countryCode="EG" value="20"
                                                                                    Selected>Egypt (+20)
                                                                            </option>
                                                                            <optgroup label="Other countries">
                                                                                <option data-countryCode="SA"
                                                                                        value="966">Saudi Arabia (+966)
                                                                                </option>
                                                                                <option data-countryCode="BH"
                                                                                        value="973">Bahrain (+973)
                                                                                </option>
                                                                                <option data-countryCode="IQ"
                                                                                        value="964">Iraq (+964)
                                                                                </option>
                                                                                <option data-countryCode="JO"
                                                                                        value="962">Jordan (+962)
                                                                                </option>
                                                                                <option data-countryCode="KW"
                                                                                        value="965">Kuwait (+965)
                                                                                </option>
                                                                                <option data-countryCode="LB"
                                                                                        value="961">Lebanon (+961)
                                                                                </option>
                                                                                <option data-countryCode="LY"
                                                                                        value="218">Libya (+218)
                                                                                </option>
                                                                                <option data-countryCode="OM"
                                                                                        value="968">Oman (+968)
                                                                                </option>
                                                                                <option data-countryCode="QA"
                                                                                        value="974">Qatar (+974)
                                                                                </option>
                                                                                <option data-countryCode="AE"
                                                                                        value="971">United Arab Emirates
                                                                                    (+971)
                                                                                </option>
                                                                                <option data-countryCode="YE"
                                                                                        value="967">Yemen (South)(+967)
                                                                                </option>
                                                                                <option data-countryCode="TN"
                                                                                        value="216">Tunisia (+216)
                                                                                </option>
                                                                                <option data-countryCode="SI"
                                                                                        value="963">Syria (+963)
                                                                                </option>
                                                                                <option data-countryCode="SD"
                                                                                        value="249">Sudan (+249)
                                                                                </option>
                                                                                <option data-countryCode="DZ"
                                                                                        value="213">Algeria (+213)
                                                                                </option>
                                                                                <option data-countryCode="KM"
                                                                                        value="269">Comoros (+269)
                                                                                </option>
                                                                                <option data-countryCode="MA"
                                                                                        value="212">Morocco (+212)
                                                                                </option>

                                                                            </optgroup>
                                                                        </select>
                                                                        <input type="text" class="form-control"
                                                                               id="phone"
                                                                               name="phone"
                                                                               value="{{ old('phone') }}"
                                                                               aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">Email
                                                                    Address</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend"><span
                                                                                    class="input-group-text"><i
                                                                                        class="la la-at"></i></span>
                                                                        </div>
                                                                        <input id="email" type="text"
                                                                               class="form-control"
                                                                               value="{{ old('email') }}"
                                                                               name="email"
                                                                               aria-describedby="basic-addon1">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">Job
                                                                    Title</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control" type="text"
                                                                           name="jobTitle"
                                                                           value="{{ old('jobTitle') }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                                    Notes</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control" type="text"
                                                                           name="notes"
                                                                           value="{{ old('notes') }}">
                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">Interest
                                                                    Project</label>

                                                                <select id="projectId" name="projectId"
                                                                        aria-describedby="basic-addon1"
                                                                        class="form-control col-lg-9 col-xl-9">
                                                                    <option selected value="">Select Project</option>
                                                                    @foreach($projects as $project)
                                                                        <option value="{{$project['id']}}">{{$project['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!--end: Form Wizard Step 1-->


                                    <!--begin: Form Actions -->
                                    <div class="kt-form__actions">
                                        {{--<div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"--}}
                                        {{--data-ktwizard-type="action-prev">--}}
                                        {{--Previous--}}
                                        {{--</div>--}}
                                        <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                             data-ktwizard-type="action-submit">
                                            Submit
                                        </div>
                                        {{--<div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"--}}
                                        {{--data-ktwizard-type="action-next">--}}
                                        {{--Next Step--}}
                                        {{--</div>--}}
                                    </div>

                                    <!--end: Form Actions -->
                                </form>

                                <!--end: Form Wizard Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>

    @include("layouts.footer")

</div>
<!-- end:: Page -->
@include("layouts.scripts")

<script> window.HREF = "{{ url('/') }}"; </script>
<script src="{{url('assets/js/pages/custom/user/add-user.js')}}" type="text/javascript"></script>


</body>
</html>
