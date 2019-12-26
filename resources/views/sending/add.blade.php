@extends('layouts.app')
<!--begin::Page Custom Styles(used by this page) -->
<link href="{{url('assets/css/pages/wizard/wizard-4.css')}}" rel="stylesheet" type="text/css"/>
<style>
    .alert {
        display: block !important;
    }
</style>
<!--end::Page Custom Styles -->
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

            <!-- begin:: Content -->
            <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
                <div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="step-first">


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
                                            Sending Message
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
                                    <form class="kt-form" id="" method="POST" action="{{url('/sending-store')}}">
                                    @csrf
                                    <!--begin: Form Wizard Step 1-->
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                             data-ktwizard-state="current">
                                            <div class="kt-heading kt-heading--md">Sending Message Details:</div>
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-lg-3 col-sm-12">Select
                                                                        sending Type </label>
                                                                    <div class=" col-lg-9 col-md-9 col-sm-12">
                                                                        <select class="form-control kt-select2"
                                                                                id="kt_select2_3" name="sendingTypeId">
                                                                            <option value="0">Select sending Type
                                                                            </option>
                                                                            @foreach($sendingTypes as $type)
                                                                                <option value="{{$type['id']}}">{{$type['name']}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Sender </label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="" name="senderId"
                                                                               class="form-control"
                                                                               type="text"
                                                                               value="{{ old('senderId') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Message </label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input id="" name="body" class="form-control"
                                                                               type="text" value="{{ old('body') }}">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label class="col-form-label col-lg-3 col-sm-12">Select
                                                                        Type </label>
                                                                    <div class=" col-lg-9 col-md-9 col-sm-12">
                                                                        <select class="form-control kt-select2"
                                                                                id="kt_select2_3" name="type">
                                                                            <option value="0">Select Type</option>
                                                                            <option value="email">Email</option>
                                                                            <option value="sms">Sms</option>

                                                                        </select>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="kt-form__actions">
                                            <div class="row">
                                                <div class="col-lg-9 ml-lg-auto">
                                                    <button type="submit"
                                                            class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
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

    </div>
    <!-- end:: Page -->
@endsection


