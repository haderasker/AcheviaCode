@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile"
                     id="kt_page_portlet">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <a href="{{url('/home')}}" class="btn btn-clean kt-margin-r-10">
                                <i class="la la-arrow-left"></i>
                                <span class="kt-hidden-mobile">Back</span>
                            </a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-brand" id="updateClient">
                                    <i class="la la-check"></i>
                                    <span class="kt-hidden-mobile">Save</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <form class="kt-form" id="updateForm" method="POST" action="{{url('/client-update')}}">
                            @csrf
                            <div class="row">
                                <div class="col-xl-2"></div>
                                <div class="col-xl-8">
                                    <div class="kt-section kt-section--first">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Customer Info:</h3>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Name</label>
                                                <div class="col-9">
                                                    <input class="form-control" type="text" readonly
                                                           value="{{$requestData['name']}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Contact Phone</label>
                                                <div class="col-9">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span
                                                                    class="input-group-text"><i
                                                                        class="la la-phone"></i></span></div>
                                                        <input type="text" class="form-control" readonly
                                                               value="{{$requestData['phone']}}" placeholder="Phone"
                                                               aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Email Address</label>
                                                <div class="col-9">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span
                                                                    class="input-group-text"><i
                                                                        class="la la-at"></i></span></div>
                                                        <input type="text" class="form-control" readonly
                                                               value="{{$requestData['email']}}" placeholder="Email"
                                                               aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Job Title</label>
                                                <div class="col-9">
                                                    @if($requestData['detail']['jobTitle'])
                                                        <input class="form-control" type="text" name="jobTitle" readonly
                                                               value="{{$requestData['detail']['jobTitle']}}">
                                                    @else
                                                        <input class="form-control" type="text"
                                                               value="" name="jobTitle">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Address</label>
                                                <div class="col-9">
                                                    @if($requestData['detail']['address'])
                                                        <input class="form-control" type="text" readonly
                                                               value="{{$requestData['detail']['address']}}">
                                                    @else
                                                        <div class="kt-wizard-v4__form">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input id="add" type="text" class="form-control" name="address"
                                                                       placeholder="" value="{{old('address')}}">
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Postcode</label>
                                                                        <input type="text" class="form-control" name="ZipCode"
                                                                               placeholder="" value="{{old('ZipCode')}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                    <div class="form-group">
                                                                        <label>Country:</label>
                                                                        <select  id="country" name="country" class="form-control">
                                                                            <option value="">Select</option>
                                                                            <option value="AF">Afghanistan</option>
                                                                            <option value="AX">Åland Islands</option>
                                                                            <option value="AL">Albania</option>
                                                                            <option value="DZ">Algeria</option>
                                                                            <option value="AS">American Samoa</option>
                                                                            <option value="AD">Andorra</option>
                                                                            <option value="AO">Angola</option>
                                                                            <option value="AI">Anguilla</option>
                                                                            <option value="AQ">Antarctica</option>
                                                                            <option value="AG">Antigua and Barbuda</option>
                                                                            <option value="AR">Argentina</option>
                                                                            <option value="AM">Armenia</option>
                                                                            <option value="AW">Aruba</option>
                                                                            <option value="AU">Australia</option>
                                                                            <option value="AT">Austria</option>
                                                                            <option value="AZ">Azerbaijan</option>
                                                                            <option value="BS">Bahamas</option>
                                                                            <option value="BH">Bahrain</option>
                                                                            <option value="BD">Bangladesh</option>
                                                                            <option value="BB">Barbados</option>
                                                                            <option value="BY">Belarus</option>
                                                                            <option value="BE">Belgium</option>
                                                                            <option value="BZ">Belize</option>
                                                                            <option value="BJ">Benin</option>
                                                                            <option value="BM">Bermuda</option>
                                                                            <option value="BT">Bhutan</option>
                                                                            <option value="BO">Bolivia, Plurinational State of
                                                                            </option>
                                                                            <option value="BQ">Bonaire, Sint Eustatius and
                                                                                Saba
                                                                            </option>
                                                                            <option value="BA">Bosnia and Herzegovina</option>
                                                                            <option value="BW">Botswana</option>
                                                                            <option value="BV">Bouvet Island</option>
                                                                            <option value="BR">Brazil</option>
                                                                            <option value="IO">British Indian Ocean Territory
                                                                            </option>
                                                                            <option value="BN">Brunei Darussalam</option>
                                                                            <option value="BG">Bulgaria</option>
                                                                            <option value="BF">Burkina Faso</option>
                                                                            <option value="BI">Burundi</option>
                                                                            <option value="KH">Cambodia</option>
                                                                            <option value="CM">Cameroon</option>
                                                                            <option value="CA">Canada</option>
                                                                            <option value="CV">Cape Verde</option>
                                                                            <option value="KY">Cayman Islands</option>
                                                                            <option value="CF">Central African Republic</option>
                                                                            <option value="TD">Chad</option>
                                                                            <option value="CL">Chile</option>
                                                                            <option value="CN">China</option>
                                                                            <option value="CX">Christmas Island</option>
                                                                            <option value="CC">Cocos (Keeling) Islands</option>
                                                                            <option value="CO">Colombia</option>
                                                                            <option value="KM">Comoros</option>
                                                                            <option value="CG">Congo</option>
                                                                            <option value="CD">Congo, the Democratic Republic of
                                                                                the
                                                                            </option>
                                                                            <option value="CK">Cook Islands</option>
                                                                            <option value="CR">Costa Rica</option>
                                                                            <option value="CI">Côte d'Ivoire</option>
                                                                            <option value="HR">Croatia</option>
                                                                            <option value="CU">Cuba</option>
                                                                            <option value="CW">Curaçao</option>
                                                                            <option value="CY">Cyprus</option>
                                                                            <option value="CZ">Czech Republic</option>
                                                                            <option value="DK">Denmark</option>
                                                                            <option value="DJ">Djibouti</option>
                                                                            <option value="DM">Dominica</option>
                                                                            <option value="DO">Dominican Republic</option>
                                                                            <option value="EC">Ecuador</option>
                                                                            <option value="EG" selected="">Egypt</option>
                                                                            <option value="SV">El Salvador</option>
                                                                            <option value="GQ">Equatorial Guinea</option>
                                                                            <option value="ER">Eritrea</option>
                                                                            <option value="EE">Estonia</option>
                                                                            <option value="ET">Ethiopia</option>
                                                                            <option value="FK">Falkland Islands (Malvinas)
                                                                            </option>
                                                                            <option value="FO">Faroe Islands</option>
                                                                            <option value="FJ">Fiji</option>
                                                                            <option value="FI">Finland</option>
                                                                            <option value="FR">France</option>
                                                                            <option value="GF">French Guiana</option>
                                                                            <option value="PF">French Polynesia</option>
                                                                            <option value="TF">French Southern Territories
                                                                            </option>
                                                                            <option value="GA">Gabon</option>
                                                                            <option value="GM">Gambia</option>
                                                                            <option value="GE">Georgia</option>
                                                                            <option value="DE">Germany</option>
                                                                            <option value="GH">Ghana</option>
                                                                            <option value="GI">Gibraltar</option>
                                                                            <option value="GR">Greece</option>
                                                                            <option value="GL">Greenland</option>
                                                                            <option value="GD">Grenada</option>
                                                                            <option value="GP">Guadeloupe</option>
                                                                            <option value="GU">Guam</option>
                                                                            <option value="GT">Guatemala</option>
                                                                            <option value="GG">Guernsey</option>
                                                                            <option value="GN">Guinea</option>
                                                                            <option value="GW">Guinea-Bissau</option>
                                                                            <option value="GY">Guyana</option>
                                                                            <option value="HT">Haiti</option>
                                                                            <option value="HM">Heard Island and McDonald
                                                                                Islands
                                                                            </option>
                                                                            <option value="VA">Holy See (Vatican City State)
                                                                            </option>
                                                                            <option value="HN">Honduras</option>
                                                                            <option value="HK">Hong Kong</option>
                                                                            <option value="HU">Hungary</option>
                                                                            <option value="IS">Iceland</option>
                                                                            <option value="IN">India</option>
                                                                            <option value="ID">Indonesia</option>
                                                                            <option value="IR">Iran, Islamic Republic of
                                                                            </option>
                                                                            <option value="IQ">Iraq</option>
                                                                            <option value="IE">Ireland</option>
                                                                            <option value="IM">Isle of Man</option>
                                                                            <option value="IL">Israel</option>
                                                                            <option value="IT">Italy</option>
                                                                            <option value="JM">Jamaica</option>
                                                                            <option value="JP">Japan</option>
                                                                            <option value="JE">Jersey</option>
                                                                            <option value="JO">Jordan</option>
                                                                            <option value="KZ">Kazakhstan</option>
                                                                            <option value="KE">Kenya</option>
                                                                            <option value="KI">Kiribati</option>
                                                                            <option value="KP">Korea, Democratic People's
                                                                                Republic of
                                                                            </option>
                                                                            <option value="KR">Korea, Republic of</option>
                                                                            <option value="KW">Kuwait</option>
                                                                            <option value="KG">Kyrgyzstan</option>
                                                                            <option value="LA">Lao People's Democratic
                                                                                Republic
                                                                            </option>
                                                                            <option value="LV">Latvia</option>
                                                                            <option value="LB">Lebanon</option>
                                                                            <option value="LS">Lesotho</option>
                                                                            <option value="LR">Liberia</option>
                                                                            <option value="LY">Libya</option>
                                                                            <option value="LI">Liechtenstein</option>
                                                                            <option value="LT">Lithuania</option>
                                                                            <option value="LU">Luxembourg</option>
                                                                            <option value="MO">Macao</option>
                                                                            <option value="MK">Macedonia, the former Yugoslav
                                                                                Republic of
                                                                            </option>
                                                                            <option value="MG">Madagascar</option>
                                                                            <option value="MW">Malawi</option>
                                                                            <option value="MY">Malaysia</option>
                                                                            <option value="MV">Maldives</option>
                                                                            <option value="ML">Mali</option>
                                                                            <option value="MT">Malta</option>
                                                                            <option value="MH">Marshall Islands</option>
                                                                            <option value="MQ">Martinique</option>
                                                                            <option value="MR">Mauritania</option>
                                                                            <option value="MU">Mauritius</option>
                                                                            <option value="YT">Mayotte</option>
                                                                            <option value="MX">Mexico</option>
                                                                            <option value="FM">Micronesia, Federated States of
                                                                            </option>
                                                                            <option value="MD">Moldova, Republic of</option>
                                                                            <option value="MC">Monaco</option>
                                                                            <option value="MN">Mongolia</option>
                                                                            <option value="ME">Montenegro</option>
                                                                            <option value="MS">Montserrat</option>
                                                                            <option value="MA">Morocco</option>
                                                                            <option value="MZ">Mozambique</option>
                                                                            <option value="MM">Myanmar</option>
                                                                            <option value="NA">Namibia</option>
                                                                            <option value="NR">Nauru</option>
                                                                            <option value="NP">Nepal</option>
                                                                            <option value="NL">Netherlands</option>
                                                                            <option value="NC">New Caledonia</option>
                                                                            <option value="NZ">New Zealand</option>
                                                                            <option value="NI">Nicaragua</option>
                                                                            <option value="NE">Niger</option>
                                                                            <option value="NG">Nigeria</option>
                                                                            <option value="NU">Niue</option>
                                                                            <option value="NF">Norfolk Island</option>
                                                                            <option value="MP">Northern Mariana Islands</option>
                                                                            <option value="NO">Norway</option>
                                                                            <option value="OM">Oman</option>
                                                                            <option value="PK">Pakistan</option>
                                                                            <option value="PW">Palau</option>
                                                                            <option value="PS">Palestinian Territory, Occupied
                                                                            </option>
                                                                            <option value="PA">Panama</option>
                                                                            <option value="PG">Papua New Guinea</option>
                                                                            <option value="PY">Paraguay</option>
                                                                            <option value="PE">Peru</option>
                                                                            <option value="PH">Philippines</option>
                                                                            <option value="PN">Pitcairn</option>
                                                                            <option value="PL">Poland</option>
                                                                            <option value="PT">Portugal</option>
                                                                            <option value="PR">Puerto Rico</option>
                                                                            <option value="QA">Qatar</option>
                                                                            <option value="RE">Réunion</option>
                                                                            <option value="RO">Romania</option>
                                                                            <option value="RU">Russian Federation</option>
                                                                            <option value="RW">Rwanda</option>
                                                                            <option value="BL">Saint Barthélemy</option>
                                                                            <option value="SH">Saint Helena, Ascension and
                                                                                Tristan da Cunha
                                                                            </option>
                                                                            <option value="KN">Saint Kitts and Nevis</option>
                                                                            <option value="LC">Saint Lucia</option>
                                                                            <option value="MF">Saint Martin (French part)
                                                                            </option>
                                                                            <option value="PM">Saint Pierre and Miquelon
                                                                            </option>
                                                                            <option value="VC">Saint Vincent and the
                                                                                Grenadines
                                                                            </option>
                                                                            <option value="WS">Samoa</option>
                                                                            <option value="SM">San Marino</option>
                                                                            <option value="ST">Sao Tome and Principe</option>
                                                                            <option value="SA">Saudi Arabia</option>
                                                                            <option value="SN">Senegal</option>
                                                                            <option value="RS">Serbia</option>
                                                                            <option value="SC">Seychelles</option>
                                                                            <option value="SL">Sierra Leone</option>
                                                                            <option value="SG">Singapore</option>
                                                                            <option value="SX">Sint Maarten (Dutch part)
                                                                            </option>
                                                                            <option value="SK">Slovakia</option>
                                                                            <option value="SI">Slovenia</option>
                                                                            <option value="SB">Solomon Islands</option>
                                                                            <option value="SO">Somalia</option>
                                                                            <option value="ZA">South Africa</option>
                                                                            <option value="GS">South Georgia and the South
                                                                                Sandwich Islands
                                                                            </option>
                                                                            <option value="SS">South Sudan</option>
                                                                            <option value="ES">Spain</option>
                                                                            <option value="LK">Sri Lanka</option>
                                                                            <option value="SD">Sudan</option>
                                                                            <option value="SR">Suriname</option>
                                                                            <option value="SJ">Svalbard and Jan Mayen</option>
                                                                            <option value="SZ">Swaziland</option>
                                                                            <option value="SE">Sweden</option>
                                                                            <option value="CH">Switzerland</option>
                                                                            <option value="SY">Syrian Arab Republic</option>
                                                                            <option value="TW">Taiwan, Province of China
                                                                            </option>
                                                                            <option value="TJ">Tajikistan</option>
                                                                            <option value="TZ">Tanzania, United Republic of
                                                                            </option>
                                                                            <option value="TH">Thailand</option>
                                                                            <option value="TL">Timor-Leste</option>
                                                                            <option value="TG">Togo</option>
                                                                            <option value="TK">Tokelau</option>
                                                                            <option value="TO">Tonga</option>
                                                                            <option value="TT">Trinidad and Tobago</option>
                                                                            <option value="TN">Tunisia</option>
                                                                            <option value="TR">Turkey</option>
                                                                            <option value="TM">Turkmenistan</option>
                                                                            <option value="TC">Turks and Caicos Islands</option>
                                                                            <option value="TV">Tuvalu</option>
                                                                            <option value="UG">Uganda</option>
                                                                            <option value="UA">Ukraine</option>
                                                                            <option value="AE">United Arab Emirates</option>
                                                                            <option value="GB">United Kingdom</option>
                                                                            <option value="US">United States</option>
                                                                            <option value="UM">United States Minor Outlying
                                                                                Islands
                                                                            </option>
                                                                            <option value="UY">Uruguay</option>
                                                                            <option value="UZ">Uzbekistan</option>
                                                                            <option value="VU">Vanuatu</option>
                                                                            <option value="VE">Venezuela, Bolivarian Republic
                                                                                of
                                                                            </option>
                                                                            <option value="VN">Viet Nam</option>
                                                                            <option value="VG">Virgin Islands, British</option>
                                                                            <option value="VI">Virgin Islands, U.S.</option>
                                                                            <option value="WF">Wallis and Futuna</option>
                                                                            <option value="EH">Western Sahara</option>
                                                                            <option value="YE">Yemen</option>
                                                                            <option value="ZM">Zambia</option>
                                                                            <option value="ZW">Zimbabwe</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <input id="city" type="text" class="form-control" name="city"
                                                                           placeholder="" value="{{old('city')}}">
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <div class="form-group">
                                                                    <label>Region</label>
                                                                    <input  id="rigion" type="text" class="form-control" name="region"
                                                                            placeholder="" value="{{old('region')}}">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                    <div class="kt-section">
                                        <div class="kt-section__body">
                                            <h3 class="kt-section__title kt-section__title-lg">Project Info:</h3>

                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Project City</label>
                                                <div class="col-9">
                                                    @if($requestData['detail']['projectCity'])
                                                        <input class="form-control" type="text" readonly
                                                               value="{{$cityName}}">
                                                    @else
                                                        <select id="cityId" name="projectCity"
                                                                class="form-control col-lg-9 col-xl-9">
                                                            <option value="0" selected>Select City</option>
                                                            @foreach($cities as $city)
                                                                <option value="{{$city['id']}}">{{$city['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Project</label>
                                                <div class="col-9">
                                                    @if($requestData['detail']['projectId'])
                                                        <input class="form-control" type="text" readonly
                                                               value="{{$projectName}}">
                                                    @else
                                                        <select id="projectId" name="projectId"
                                                                class="form-control col-lg-9 col-xl-9">
                                                            <option selected value="0">Select Project</option>
                                                        </select>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Space</label>
                                                <div class="col-9">
                                                    @if($requestData['detail']['space'])
                                                        <input class="form-control" type="text" name="space" readonly
                                                               value="{{$requestData['detail']['space']}}">

                                                    @else
                                                        <input class="form-control" type="text" name="space"
                                                               value="{{$requestData['detail']['space']}}">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3 col-form-label">Notes</label>
                                                <div class="col-9">
                                                    @if($requestData['detail']['notes'])
                                                        <input class="form-control" type="text" name="notes" readonly
                                                               value="{{$requestData['detail']['notes']}}">
                                                    @else
                                                        <input class="form-control" type="text" name="notes"
                                                               value="{{$requestData['detail']['notes']}}">
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                    <div class="kt-section">
                                        <div class="kt-section__body">
                                            <input name="_id" class="form-control" type="text" hidden
                                                   value="{{$requestData['id']}}">
                                            <h3 class="kt-section__title kt-section__title-lg">Additional Fields
                                                :</h3>
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-3 col-sm-12">Date</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control" readonly
                                                               placeholder="Select date" id="kt_datepicker_2"
                                                               name="notificationDate"/>
                                                        <div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-calendar-check-o"></i>
														</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Time</label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <div class="input-group timepicker">
                                                        <input class="form-control" id="kt_timepicker_2" readonly
                                                               placeholder="Select time" type="text"
                                                               name="notificationTime"/>
                                                        <div class="input-group-append">
														<span class="input-group-text">
															<i class="la la-clock-o"></i>
														</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Action</label>
                                                <select id="cityId" name="actionId"
                                                        class="form-control col-lg-9 col-xl-9">
                                                    <option selected value="0">Select Action</option>
                                                    @foreach($actions as $action)
                                                        <option value="{{$action['id']}}">{{$action['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group form-group-last row">
                                                <label class="col-3 col-form-label">Communication</label>
                                                <div class="col-9">
                                                    <div class="form-group row">
                                                        <div class="kt-radio-inline">
                                                            @foreach($methods as $method)
                                                                <label class="kt-radio">
                                                                    <input type="radio" value="{{$method['id']}}"
                                                                           name="via_method">
                                                                    {{$method['name']}}
                                                                    <span></span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-group-last row">
                                                <label class="col-3 col-form-label">Summery</label>
                                                <div class="col-9">
                                                    <div class="form-group row">
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio">
                                                                <input type="radio" value="1" name="summery">
                                                                Replied
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" value="2" name="summery">
                                                                Switched
                                                                Off

                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" value="3" name="summery"> No
                                                                Answer
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio">
                                                                <input type="radio" value="4" name="summery"> Wrong
                                                                Number
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">
                                                    Assigned To</label>
                                                <select id="" name="assignToSaleManId"
                                                        class="form-control col-lg-9 col-xl-9">
                                                    <option selected>Assigned To</option>
                                                    @foreach($sales as $sale)
                                                        <option value="{{$sale['id']}}" {{ $sale['id'] == $requestData['detail']['assignToSaleManId'] ? 'selected' : '' }}>{{$sale['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                </div>
                                <div class="col-xl-2"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--end::Portlet-->
            </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection
@section('script')
    <script src="{{url('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}" type="text/javascript"></script>
    <script src="{{url('assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#updateClient").click(function () {
                $("#updateForm").submit();
            });

            $('#cityId').change(function () {
                $.get(
                    "{{ url('api/dropdown')}}",
                    {
                        option: $(this).val()
                    },
                    function (data) {
                        var projectId = $('#projectId');
                        projectId.empty();
                        projectId.append("<option value=''> Select Project </option>");
                        $.each(data, function (index, element) {
                            projectId.append("<option value='" + element.id + "'>" + element.name + "</option>");
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
                        saleId.empty();
                        saleId.append("<option value='0'> Assigned To </option>");
                        $.each(data, function (index, element) {
                            saleId.append("<option value='" + element.id + "'>" + element.name + "</option>");
                        });
                    }
                );
            });
        });
    </script>


@endsection