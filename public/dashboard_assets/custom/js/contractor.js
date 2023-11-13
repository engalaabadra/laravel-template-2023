"use strict"

$(document).on('change', '#companyId', function (e) {
    e.preventDefault();
    var companyId = $(this).val();
    var old_contract = $('#selectContracts').data('old');
    $('#contractor_company_id').val(companyId);
    getContracts(companyId, old_contract);
    getContractors(companyId);
});

var companyId = $('#companyId').val();

var old_contract = $('#selectContracts').data('old');
if (old_contract != null) {
    getContracts(companyId, old_contract);
}

function getContractors(company_id) {
    let users;
    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/get-contractors/${company_id}`,
        type: "GET",
        success: function (data) {
            users = data.data;
            $("#selectUsers").html('');
            for (let i = 0; i < users.length; i++) {
                $("#selectUsers").append(
                    `<option value="${users[i].id}">${users[i].first_name} ${users[i].last_name ?? ''}</option>`
                )
            }
        }
    })
}

function getContracts(companyId, old_contract = null) {
    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/get-contracts/` + companyId,
        type: "GET",
        enctype: 'multipart/form-data',
        success: function (result) {
            var data = result.data;
            $("#selectContracts").html(`<option value="">${langs[LANG].select_contacts}</option>`);
            data.forEach(el => {
                $("#selectContracts").append(
                    `<option value="${el.id}" ${old_contract == el.id ? 'selected' : ''} > ${el.name} </option>`
                );
            });
        },
        error: function () {
            $("#selectContracts").html(`<option value="">${langs[LANG].select_contacts}</option>`);
        }
    })
}


$(document).on('change', '#selectContracts', function (e) {
    e.preventDefault();
    var contractId = $(this).val();
    getContractDates(contractId)
});

function getContractDates(contractId) {
    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/get-contract-dates/` + contractId,
        type: "GET",
        enctype: 'multipart/form-data',
        success: function (result) {
            var data = result.data;
            $("#fromdate").val(data.from_date).attr('min', data.from_date).attr('max', data.to_date)
            $("#todate").val(data.to_date).attr('min', data.from_date).attr('max', data.to_date)
        },
        error: function () {
        }
    })
}

// Class definition
var KTWizard6 = function () {
    // Base elements
    var _wizardEl;
    var _formEl;
    var _wizardObj;
    var _validations = [];

    // Private functions
    var _initWizard = function () {
        // Initialize form wizard
        _wizardObj = new KTWizard(_wizardEl, {
            startStep: 1, // initial active step number
            clickableSteps: false  // allow step clicking
        });

        // Validation before going to next page
        _wizardObj.on('change', function (wizard) {
            if (wizard.getStep() > wizard.getNewStep()) {
                return; // Skip if stepped back
            }

            // Validate form before change wizard step
            var validator = _validations[wizard.getStep() - 1]; // get validator for current step

            if (validator) {
                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        wizard.goTo(wizard.getNewStep());

                        KTUtil.scrollTop();
                    } else {
                        Swal.fire({
                            text: langs[LANG].sorry_you_cant_leave_required_input,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: langs[LANG].ok_got_it,
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-light"
                            }
                        })
                    }
                });
            }

            return false;  // Do not change wizard step, further action will be handled by he validator
        });

        // Change event
        _wizardObj.on('changed', function (wizard) {
            KTUtil.scrollTop();
        });

        // Submit event
        _wizardObj.on('submit', function (wizard) {
            Swal.fire({
                text: langs[LANG].all_good_please_confirm_form,
                icon: "success",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: langs[LANG].yes_submit,
                cancelButtonText: langs[LANG].no_cancel,
                customClass: {
                    confirmButton: "btn font-weight-bold btn-primary",
                    cancelButton: "btn font-weight-bold btn-default"
                }
            }).then(function (result) {

                if (result.value) {
                    var form = document.querySelector('#contractor_form');
                    var formData = new FormData(form);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                
                    $.ajax({
                        url: `${HOST_URL}/${LANG}/dashboard/visitors`,
                        type: "POST",
                        processData: false,
                        contentType: false,
                        data: formData,
                        enctype: 'multipart/form-data',
                        beforeSend: function () {
                            addLoader('.modal-body');
                            $('#userForm .card-body').css('display', 'none');
                        },
                        success: function (data) {
                            toastr.success(data.message);
                            $("#selectUsers").append(
                                "<option value='" + data.id + "' selected>" + data.name + "</option>"
                            );

                            setTimeout((result) => {
                                $("#userForm").slideUp();
                                //  result.goFirst();

                                $("#userForm").html('');

                                $.get(`${HOST_URL}/${LANG}/dashboard/modal-content`, function (data) {
                                    $("#userForm").html(data);
                                    KTWizard6.init();
                                    $('#kt_wizard .select2').select2({});
                                    $('#kt_wizard .nice-select').select2({
                                        minimumResultsForSearch: -1
                                    });

                                    $(function () {
                                        $(".select3").select2({});
                                        $.ajax({
                                            url: `${HOST_URL}/${LANG}/dashboard/get-nationality/${LANG}`,
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function (data) {
                                                Object.entries(data).forEach((value) => {
                                                    $("#nationality").append($("<option></option>")
                                                        .attr("value", value[0])
                                                        .text(value[1]));
                                                })
                                            }
                                        });
                                    });
                                    // $('#contractor_company_id').val($('#companyId').val());
                                    // $('#contractor_company_id').val(companyId);
                                    $(function () {
                                        if(isSupervisor){
                                            $('#contractor_company_id').val(companyId);
                                        }else {
                                            $('#contractor_company_id').val($('#companyId').val());
                                        }
                                    });


                                    $("#id_type").on('change', function () {
                                        let idName = $("#id_type").val();
                                        $("#myId").val('');

                                        if (!idName) {
                                            $("#idName").html('ID Number')
                                        } else {
                                            $("#idName").html(idName).attr(idName);
                                            $("#myId").attr("placeholder", idName);

                                        }
                                        let length = $(this).find(':selected').attr('data-length');

                                        if (length) {
                                            if (length.trim().length !== 0) {
                                                $("#myId").attr('oninput',
                                                    `javascript:if (this.value.length > ${length}) this.value = this.value.slice(0, ${length});`
                                                );
                                            }
                                        }
                                    });
                                    $('#kt_wizard .file').on('change', function () { //on file input change
                                        if (window.File && window.FileReader && window.FileList && window.Blob) {
                                            $(this).parent().parent().siblings('.image').find('.thumb-output').html('');
                                            var data = $(this)[0].files;
                                            var self = $(this);
                                            $.each(data, function (index, file) {
                                                if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                                                    var fRead = new FileReader();
                                                    fRead.onload = (function (file) {
                                                        return function (e) {
                                                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result);
                                                            // console.log(  $(this).parent().parent());
                                                            self.parent().parent().siblings('.image').children('.thumb-output').append(img);
                                                        };
                                                    })(file);
                                                    fRead.readAsDataURL(file);
                                                }
                                            });
                                        } else {
                                            alert("Your browser doesn't support File API!");
                                        }
                                    });
                                });
                            }, 200);
                        },
                        complete: function () {
                            removeLoader();
                            $('#userForm .card-body').css('display', 'block');
                        },
                        error: function (xhr, ajaxOptions, thrownError) {

                            var errors = xhr.responseJSON.errors;
                            Swal.fire({
                                text: errors[Object.keys(errors)[0]][0] ?? langs[LANG].sorry_looks_like_some_errors_detected_try_again,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: langs[LANG].ok_got_it,
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light"
                                }
                            })
                        }
                    })

                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: langs[LANG].your_form_has_been_submitted,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: langs[LANG].ok_got_it,
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    var _initValidation = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        // Step 1
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    first_name: {
                        validators: {
                            notEmpty: {
                                message: langs[LANG].first_name_required,
                            }
                        }
                    },
                    id_type: {
                        validators: {
                            notEmpty: {
                                message: langs[LANG].id_type_required
                            }
                        }
                    },
                    id_number: {
                        validators: {
                            notEmpty: {
                                message: langs[LANG].id_number_required
                            },
                            regexp: {
                                regexp: /^[0-9]+|not_in:0/,
                                message: langs[LANG].id_number_must_be_positive,
                            }
                        }
                    },
                    mobile: {
                        validators: {
                            notEmpty: {
                                message: langs[LANG].mobile_required
                            },
                            regexp: {
                                regexp: /^[0-9][0-9]/,
                                message: langs[LANG].mobile_number_must_be_valid,
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: langs[LANG].email_is_required
                            },
                            emailAddress: {
                                message: langs[LANG].value_is_not_valid_email_address
                            }, regexp: {
                                regexp: /(.*)@(.*)\.(.*)/,
                                message: langs[LANG].email_must_be_valid,
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        ));

        // Step 2
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    id_copy: {
                        validators: {
                            notEmpty: {
                                message: langs[LANG].personal_photo_required,
                            },
                            regexp: {
                                regexp: /(.*)\.(jpg|jpeg|png|gif|bmp)/,
                                message: langs[LANG].file_must_be_img,
                            }
                        }
                    },
                    personal_photo: {
                        validators: {
                            notEmpty: {
                                message: langs[LANG].id_copy_required,
                            },
                            regexp: {
                                regexp: /(.*)\.(jpg|jpeg|png|gif|bmp)/,
                                message: langs[LANG].file_must_be_img,
                            }
                        }
                    },

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    // Bootstrap Framework Integration
                    bootstrap: new FormValidation.plugins.Bootstrap({
                        //eleInvalidClass: '',
                        eleValidClass: '',
                    })
                }
            }
        ));
    }

    return {
        // public functions
        init: function () {
            _wizardEl = KTUtil.getById('kt_wizard');
            _formEl = KTUtil.getById('contractor_form');

            _initWizard();
            _initValidation();
        }
    };
}();

jQuery(document).ready(function () {
    KTWizard6.init();
});

