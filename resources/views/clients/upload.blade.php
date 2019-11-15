@extends('layouts.app')

@section('content')

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        File Upload
                    </h3>
                </div>
            </div>
            <div class="alert alert-danger" style="display:none">

            </div>
            <form class="kt-form kt-form--label-right"  method="POST" action="{{url('client-upload')}}" enctype="multipart/form-data" >
                @csrf
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">Client Upload</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropzone dropzone-default" id="kt_dropzone_1">
                                <input type="file" name="file" class = 'dropzone'>
                                <div class="dropzone-msg dz-message needsclick">
                                    <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                    <span class="dropzone-msg-desc"> Upload  CVS only </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xl-4 col-lg-4">
                            <label class="col-xl-3 col-lg-3 col-form-label">Name Column</label>
                            <div class="col-lg-9 col-xl-9">
                                <div class="input-group">
                                    <input id="" type="number" class="form-control" value="" name="nameCol"
                                           aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4">
                            <label class="col-xl-3 col-lg-3 col-form-label">Phone Column</label>
                            <div class="col-lg-9 col-xl-9">
                                <div class="input-group">
                                    <input id="" type="number" class="form-control" value="" name="phoneCol"
                                           aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4">
                            <label class="col-xl-3 col-lg-3 col-form-label">Email Column</label>
                            <div class="col-lg-9 col-xl-9">
                                <div class="input-group">
                                    <input id="" type="number" class="form-control" value="" name="emailCol"
                                           aria-describedby="basic-addon1">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <button type="submit" class="btn btn-brand">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>

@endsection
@section('script')
    {{--<script> window.HREF ="{{ url('client-upload') }}"; </script>--}}
    <!--begin::Page Scripts(used by this page) -->
    <script src="{{url('assets/js/pages/crud/file-upload/dropzonejs.js')}}" type="text/javascript"></script>

    <!--end::Page Scripts -->
@endsection