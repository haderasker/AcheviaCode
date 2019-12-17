"use strict";

// Class definition
var KTUserAdd = function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    var avatar;

    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_user_add_user', {
            startStep: 1, // initial active step number
            clickableSteps: true  // allow step clicking
        });

        // Validation before going to next page
        wizard.on('beforeNext', function (wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }
        })

        // Change event
        wizard.on('change', function (wizard) {
            var name = $('#name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var campaign = $('#campaignId').children("option:selected").html();
            var marketer = $('#marketerId').children("option:selected").html();
            var sale = $('#saleId').children("option:selected").html();
            var project = $('#projectId').children("option:selected").html();
            var interest = $('#projectId').children("option:selected").val();
            var property = $('#property').children("option:selected").html();
            var date = $('#date').children("option:selected").html();
            var from = $('#from').val();
            var to = $('#to').val();
            var budget = $('#budget').val();
            var area = from + ' - ' + to;


            $('#myName').text(name);
            $('#myPhone').text(phone);
            $('#myEmail').text(email);
            $('#myCampaign').text(campaign);
            $('#myMarketer').text(marketer);
            $('#mySale').text(sale);
            $('#myProject').text(project);
            $('#interest').val(interest);
            $('#myProperty').text(property);
            $('#myDate').text(date);
            $('#myArea').text(area);
            $('#myBudget').text(budget);

            KTUtil.scrollTop();

        });
    }

    var initValidation = function () {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
                // Step 1
                profile_avatar: {
                    //required: true
                },
                name: {
                    required: true
                },
                phone: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                countryCode: {
                    required: true,
                },
                projectId: {
                    required: true,
                    number: true,
                },
                platform: {
                    required: true,
                    lettersonly: true,
                },
            },

            messages: {
                platform: {
                    lettersonly: "Select Platform",
                },
                projectId: {
                    number: "Select Project",
                },
            },

            // Display error
            invalidHandler: function (event, validator) {
                KTUtil.scrollTop();

                swal.fire({
                    "title": "",
                    "text": "There are some errors in your submission. Please correct them.",
                    "type": "error",
                    "buttonStyling": false,
                    "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                });
            },

            // Submit valid form
            submitHandler: function (form) {

            }
        });
    }

    var initSubmit = function () {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function (e) {
            e.preventDefault();

            if (validator.form()) {
                // See: src\js\framework\base\app.js
                KTApp.progress(btn);
                //KTApp.block(formEl);

                // Get some values from elements on the page:
                var form = $(this);
                var url = form.attr('action');
                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                    type: "POST",
                    url: url,
                    data: form.serialize(), // serializes the form's elements.
                    success: function (data) {
                        console.log(data);
                        KTApp.unprogress(btn);
                        //KTApp.unblock(formEl);
                        swal.fire({
                            "title": "",
                            "text": "The application has been successfully submitted!",
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary"
                        }).then((success) => {
                            if (success) {
                                window.location.href = window.HREF;
                            }
                        });
                    },

                    error: function (data) {
                        $('.alert-danger').empty();
                        $.each(data.responseJSON.errors, function (key, value) {
                            $('.alert-danger').append('<p>' + value + '</p>');
                            $('.alert-danger').show();
                        });
                    }
                });
            }
        });
    };

    var initUserForm = function () {
        avatar = new KTAvatar('kt_user_add_avatar');
    };

    return {
        // public functions
        init: function () {
            formEl = $('#kt_user_add_form');

            initWizard();
            initValidation();
            initSubmit();
            initUserForm();
        }
    };
}();

jQuery(document).ready(function () {

    KTUserAdd.init();

});
