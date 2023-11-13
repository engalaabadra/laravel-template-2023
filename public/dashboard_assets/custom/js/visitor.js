"use strict";

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
    if (length > 0) {
        $("#myId").attr('oninput',
            `javascript:if (this.value.length > ${length}) this.value = this.value.slice(0, ${length});`
        );
    }

});

//Get gates based on site
var select_site = $("#site_id").val();
var old_host = $("#host_id").data('old');
var old_gate = $("#gate_id").data('old');
var old_floor = $("#floor_id").data('old');
var old_building = $("#building_id").data('old');

getGates(select_site, old_gate);
getBuildings(select_site, old_building);
getHosts(select_site, old_host);
getFloors(old_building, old_floor);

//based on current site
$("#current_site").on('change', function (e) {
    if ($('input[name="current_site"]').is(':checked')) {
        $("#site_id").prop('disabled', true);
        getGates(current_site);
        getBuildings(current_site);
        getHosts(select_site);
    } else {
        $("#site_id").prop('disabled', false);
        getGates($("#site_id").val());
        getBuildings($("#site_id").val());
        getHosts($("#site_id").val());
    }
});

//based on select site change
$("#site_id").on('change', function (e) {

    let select_site = $("#site_id").val();
    getGates(select_site);
    getBuildings(select_site);
    getHosts(select_site);
});

$("#building_id").on('change', function (e) {
    getFloors($(this).val());
});


function getFloors(building_id, old_floor = null) {

    if (building_id == '' || building_id == null) {
        $("#floor_id").html(`<option value="">${langs[LANG].select_building_first}</option>`);
    }else {

        var floor_option = [`<option value="">${langs[LANG].select_floor}</option>`];
        if (floors[building_id].length != 0) {
            floors[building_id].forEach((el) => {
                floor_option.push(`<option value="${el.id}"  ${old_floor == el.id ? 'selected' : ''} >${el.name}</option>`);
            });
            $("#floor_id").html(floor_option);
        } else {
            $("#floor_id").html(`<option value="">${langs[LANG].no_floor}</option>`);
        }
    }


}

function getBuildings(site_id, old_building = null) {

    if (site_id == '' || site_id == null) {
        return;
    }

    var buildings = [`<option value="">${langs[LANG].select_building}</option>`];
    if (sites[site_id].buildings.length != 0) {
        sites[site_id].buildings.forEach((el) => {
            buildings.push(`<option value="${el.id}" ${old_building == el.id ? 'selected' : ''} >${el.name}</option>`);
        });
        $("#building_id").html(buildings);
    } else {
        $("#building_id").html(`<option value=''>${langs[LANG].no_building_in_site}</option>`);
    }
}
function getGates(site_id, old_gate = null) {

    if (site_id == '' || site_id == null) {
        return;
    }
    var gates = [`<option value="">${langs[LANG].select_gate}</option>`];
    if (sites[site_id].gates.length != 0) {
        sites[site_id].gates.forEach((el) => {
            gates.push(`<option value="${el.id}" ${old_gate == el.id ? 'selected' : ''} >${el.name}</option>`);
        });
        $("#gate_id").html(gates);
    } else {
        $("#gate_id").html(`<option value=''>${langs[LANG].no_gate_in_site}</option>`);
    }
}

function getHosts(site_id, old_host = null) {
    if (site_id == '' || site_id == null) {
        return;
    }
    var hosts = [`<option value="">${langs[LANG].select_host}</option>`];

    if (sites[site_id].users.length != 0) {
        sites[site_id].users.forEach((el) => {
            hosts.push(`<option value="${el.id}"  ${old_host == el.id ? 'selected' : ''} >${el.full_name}</option>`);
        });
        $("#host_id").html(hosts);
    } else {
        $("#host_id").html(`<option value=''>${langs[LANG].no_host_in_site}</option>`);
    }
}

$(document).on('click', '#AddVisitor', function (e) {
    e.preventDefault();
    var contract = $('#contract_id').val()
    var company = $('#companyId').val();

    if ((contract == '' || contract == undefined) && $('#type').val()=='supervisor') {
        toastr.error(langs[LANG].you_have_to_choose_a_contract)
    }else if(!($('#form_date').val() || $('#to_date').val())){
        toastr.error(langs[LANG].you_have_to_chose_a_date_first)
    }
    else {
        $('#create_visitor_modal').modal();
    }
});

$(document).on('click', '#addNewUser', function (e) {
    $("#userForm").css('display', 'block');
    e.preventDefault();
});

$(document).on('click', '#submitVisitForm', function (e) {
    e.preventDefault();

    var selectVisitors = $('#visitors_id').val();

    if (selectVisitors == null) {
        toastr.error(langs[LANG].you_have_to_choose_least_one_visitor)
    } else if (selectVisitors.length >= 1) {
        $("#visitForm").submit();

        $(this).prop('disabled', true)
            .addClass('spinner spinner-white spinner-right')
            .text(langs[LANG].please_wait);

    } else {
        toastr.error(langs[LANG].you_have_to_choose_least_one_visitor);
    }


});


$(document).on('click', '.delete_visitor', function (e) {
    e.preventDefault();
    var item_id = $(this).data('visitor_id');
    $(`#visitorSelectedTable #row-${item_id}`).remove();
    $(`#visitors_id option[value=${item_id}]`).remove();
});

function pluckTruthy(obj, key) {
    var result = [];
    for (var i = 0; i < obj.length; i++) {
        if (obj[i][key]) {
            result.push(obj[i][key]);
        }
    }
    return result;
}

$(document).on('click', '#saveVisitors', function (e) {
    e.preventDefault();

    var selectUsers = $('#selectUsers').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val() ;

    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/visitor/check-request`,
        method: 'GET',
        data: {
            ids: selectUsers,
            visitor_type: visitor_type,
            from_date : from_date ,
            to_date : to_date ,
        },
        success: function (data) {
            if (data.length != 0) {
                Object.keys(data).forEach(el => {
                    toastr.error(`${data[el]} ${langs[LANG].visitor_have_active_request}`);
                });

                return true;

            } else {
                if (selectUsers.length >= 1) {
                    selectUsers.forEach(item => {
                        $("#visitors_id").append(
                            `<option value=${parseInt(item)} selected></option>`
                        );
                    });

                    $.get({
                        url: `${HOST_URL}/${LANG}/dashboard/visitors-by-id`,
                        data: {ids: selectUsers},
                        method: 'GET',
                        success: function (visitors) {
                            if (visitors.length >= 1) {
                                $("#visitors_head").show();
                                $("#visitorSelectedTable").empty();
                                visitors.forEach(visitor => {
                                    $("#visitorSelectedTable").append(
                                        `<tr id="row-${visitor.id}">
                                <td>${visitor.full_name}</td>
                                <td>${visitor.company.name ?? '---'}</td>
                                <td>${visitor.id_number ?? '---'}</td>
                                <td>${visitor.email ?? '---'}</td>
                                <td>${visitor.nationality ?? '---'}</td>
                                <td><b style="color:#FFA800;">${langs[LANG].pending}</b></td>
                                <td class="justify-content-between">
                                    <span style="cursor: pointer; display: inline-block; margin-left: 15px;" class="showVisitor text-primary"  data-id="${visitor.id}">
                                        <i class="flaticon-eye text-primary" style="font-size: 2rem"></i>
                                    </span>
                                    <span style="cursor: pointer;" class="delete_visitor " data-visitor_id="${visitor.id}">
                                        <i class="fas fa-times-circle text-danger" style="font-size: 1.6rem"></i>
                                    </span>
                                </td>
                                </td>
                            </tr>`
                                    );
                                });
                            }
                        }
                    })

                    toastr.success(langs[LANG].visitors_saved_successfully);

                    setTimeout(() => {
                        $('#create_visitor_modal').modal('hide');
                    }, 200);

                } else {
                    toastr.error(langs[LANG].you_have_to_choose_least_one_visitor);
                }
            }
        }
    });
});

function getVisitors(visitor_type) {
    let users;
    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/get-visitor?type=${visitor_type}`,
        method: 'GET',
        success: function (data) {
            users = data.data;
            $("#selectUsers").html('');
            for (let i = 0; i < users.length; i++) {
                $("#selectUsers").append(
                    `<option data-name="${users[i].full_name}" value="${users[i].id}">${users[i].full_name ?? ''}</option>`
                )
            }
        }
    })
}

if (old_visitors != null) {
    if (old_visitors.length >= 1) {
        old_visitors.forEach(item => {
            $("#visitors_id").append(
                `<option value=${parseInt(item)} selected></option>`
            );
        });

        $.get({
            url: `${HOST_URL}/${LANG}/dashboard/visitors-by-id`,
            data: {ids: old_visitors},
            method: 'GET',
            success: function (visitors) {
                if (visitors.length >= 1) {
                    $("#visitors_head").show();
                    $("#visitorSelectedTable").empty();
                    visitors.forEach(visitor => {
                        $("#visitorSelectedTable").append(
                            `<tr id="row-${visitor.id}">
                                <td>${visitor.full_name}</td>
                                <td>${visitor.company.name ?? '---'}</td>
                                <td>${visitor.id_number ?? '---'}</td>
                                <td>${visitor.email ?? '---'}</td>
                                <td>${visitor.nationality ?? '---'}</td>
                                <td><b style="color: #FFA800;">${langs[LANG].pending}</b></td>
                                <td class="justify-content-between">
                                    <span style="cursor: pointer; display: inline-block; margin-left: 15px;" class="showVisitor text-primary"  data-id="${visitor.id}">
                                        <i class="flaticon-eye text-primary" style="font-size: 2rem"></i>
                                    </span>
                                    <span style="cursor: pointer;" class="delete_visitor " data-visitor_id="${visitor.id}">
                                        <i class="fas fa-times-circle text-danger" style="font-size: 1.6rem"></i>
                                    </span>
                                </td>
                                </td>
                            </tr>`
                        );

                        $("#selectUsers").append(
                            `<option data-name="${visitor.full_name}" value='${visitor.id} ' selected>${visitor.full_name}</option>`
                        );
                    });
                }
            }
        });
    }
}

// Class definition
var KTWizard7 = function () {
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
            var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step

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
                    var bodyFormData = $("#visitor_form")[0]
                    var formData = new FormData(bodyFormData);

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
                                `<option value='${data.id}' data-name='${data.name}' selected>${data.name}</option>`
                            );

                            setTimeout((result) => {
                                $("#userForm").slideUp().html('');

                                $.get(`${HOST_URL}/${LANG}/dashboard/modal-content`, function (data) {
                                    $("#userForm").html(data);
                                    KTWizard7.init();
                                    $('#kt_wizard .select2').select2({});
                                    $('#kt_wizard .nice-select').select2({
                                        minimumResultsForSearch: -1
                                    });
                                    $('#id_type').on('change', function () {
                                        let idName = $("#id_type").val();
                                        $('#myId').val('');

                                        if (!idName) {
                                            $('#idName').html('ID Number')
                                        } else {
                                            $('#idName').html(idName).attr(idName);
                                            $('#myId').attr("placeholder", idName);

                                        }
                                        let length = $(this).find(':selected').attr('data-length');
                                        if (length > 0) {
                                            $('#myId').attr('oninput',
                                                `javascript:if (this.value.length > ${length}) this.value = this.value.slice(0, ${length});`
                                            );
                                        }

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
                                            }, error: function (reject) {
                                                console.log(reject)
                                            }
                                        });
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
                            removeLoader();
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
                                message: langs[LANG].first_name_required
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
                    },
                    company: {
                        validators: {
                            notEmpty: {
                                message: langs[LANG].company_required
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

        // Step 2
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    country: {
                        validators: {
                            notEmpty: {
                                message: langs[LANG].country_required
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
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    id_copy: {
                        validators: {
                            regexp: {
                                regexp: /(.*)\.(jpg|jpeg|png|gif|bmp)/,
                                message: langs[LANG].file_must_be_img,
                            }
                        }
                    },
                    personal_photo: {
                        validators: {
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
            _formEl = KTUtil.getById('visitor_form');

            _initWizard();
            _initValidation();
        }
    };
}();


jQuery(document).ready(function () {
    KTWizard7.init();
});

//dynamic ID number length



