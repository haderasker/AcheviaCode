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

            <form class="kt-form kt-form--label-right" method="POST" action="{{url('client-upload')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">Client Upload</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <div class="dropzone dropzone-default" id="kt_dropzone_1">
                                <input type="file" name="file" class='dropzone'>
                                <div class="dropzone-msg dz-message needsclick">
                                    <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
                                    <span class="dropzone-msg-desc"> Upload  CVS only </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-1 col-lg-1  col-lg-offset-1 col-xs-offset-1"></div>
                        <div class="col-xl-2 col-lg-2">
                            <div class="input-group">
                                <input id="" type="text" class="form-control" value="" name="nameCol"
                                       aria-describedby="basic-addon1" placeholder="Name">
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2">

                            <div class="input-group">
                                <input id="" type="text" class="form-control" value="" name="codeCol"
                                       aria-describedby="basic-addon1" placeholder="CountryCode">
                                <input id="" type="text" class="form-control" value="" name="phoneCol"
                                       aria-describedby="basic-addon1" placeholder="phone">
                            </div>

                        </div>
                        <div class="col-xl-2 col-lg-2">
                            <div class="input-group">
                                <input id="" type="text" class="form-control" value="" name="emailCol"
                                       aria-describedby="basic-addon1" placeholder="Email">
                            </div>

                        </div>
                        <div class="col-xl-2 col-lg-2">
                            <div class="input-group">
                                <input id="" type="text" class="form-control" value="" name="jobCol"
                                       aria-describedby="basic-addon1" placeholder="JobTitle">
                            </div>
                        </div>

                        <div class="col-xl-2 col-lg-2">
                            <div class="input-group">
                                <input id="" type="text" class="form-control" value="" name="notesCol"
                                       aria-describedby="basic-addon1" placeholder="Notes">
                            </div>
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-xs-1 col-lg-1  col-lg-offset-1 col-xs-offset-1"></div>

                        <div class="col-lg-2 col-xl-2">
                            <select id="projectId" name="projectCol" class="form-control">
                                <option selected value="0">Select Project</option>
                                @foreach($projects as $project)
                                    <option value="{{$project['id']}}">{{$project['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <select id="campaignId" name="campaignCol"
                                    class="form-control">
                                <option selected value="0">Select Campaign</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <select id="marketerId" name="marketerCol"
                                    class="form-control">
                                <option selected value="0">Select Marketer</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <select id="" name="platformCol"
                                    class="form-control">
                                <option selected value="0">Select Platform</option>
                                <option value="facebook"> FaceBook</option>
                                <option value="google"> Google</option>
                                <option value="instgram"> Instagram</option>
                                <option value="linkedin"> LinkedIn</option>
                                <option value="twitter"> Twitter</option>
                                <option value="youtube"> YouTube</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-xl-2">
                            <select id="saleId" name="saleCol"
                                    class="form-control">
                                <option selected value="0">Assigned To</option>
                            </select>
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
    <script>
        jQuery(document).ready(function (e) {

            {{--$('#cityId').change(function () {--}}
            {{--$.get(--}}
            {{--"{{ url('api/dropdown')}}",--}}
            {{--{--}}
            {{--option: $(this).val()--}}
            {{--},--}}
            {{--function (data) {--}}
            {{--var projectId = $('#projectId');--}}
            {{--projectId.empty();--}}
            {{--projectId.append("<option value=''> Select Project </option>");--}}
            {{--$.each(data, function (index, element) {--}}
            {{--projectId.append("<option value='" + element.id + "'>" + element.name + "</option>");--}}
            {{--});--}}
            {{--}--}}
            {{--);--}}
            {{--});--}}

            $('#campaignId').change(function () {
                $.get(
                    "{{ url('api/dropdown/marketer')}}",
                    {
                        option: $(this).val()
                    },
                    function (data) {
                        var marketerId = $('#marketerId');
                        marketerId.empty();
                        marketerId.append("<option value='0'> Select Marketer </option>");
                        $.each(data, function (index, element) {
                            marketerId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                    }
                );
            });


            $('#projectId').change(function () {
                $.get(
                    "{{ url('api/dropdown/sales')}}",
                    {
                        option: $(this).val()
                    },
                    function (data) {
                        console.log(data);

                        var saleId = $('#saleId');
                        var campaignId = $('#campaignId');

                        campaignId.empty();
                        campaignId.append("<option value='0'> Select Campaign </option>");
                        $.each(data.campaigns, function (index, element) {
                            campaignId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });

                        saleId.empty();
                        saleId.append("<option value='0'> Assigned To </option>");
                        $.each(data.sales, function (index, element) {
                            saleId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                    }
                );
            });

        });
    </script>

    <!--end::Page Scripts -->
@endsection