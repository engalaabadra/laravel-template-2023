// slick carousel
$('.item-section.slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: true,
    nextArrow: '<a href="#" class=" left"><i class="fas fa-chevron-right"></i></a>',
    prevArrow: '<a href="#" class=" right"><i class="fas fa-chevron-left"></i></a>',
    responsive: [{
        breakpoint: 1400,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            arrows: true,
        }
    },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                arrows: true,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

let selectedRow = null;
// handle toggling setting and screenshot tabs
$(".setting-icon-sho").on("click", () => {
    let wrapper = $(".row.wrapper");
    if (!wrapper.hasClass("right-100")) {
        $(".show-image-icon-sho").click()
    }
    wrapper.toggleClass("left-100")
    $('.area-section.slider').slick('refresh')
});

$(".show-image-icon-sho").on("click", () => {
    let wrapper = $(".row.wrapper");
    if (!wrapper.hasClass("left-100")) {
        $(".setting-icon-sho").click()
    }
    wrapper.toggleClass("right-100");
    $('.area-section.slider').slick('refresh');
    $('.show-image .new-img').css("display", "none")
})

$('#car_table_data').on('draw.dt', function (e) {
    $('#car_table_data tr').on("click", openModalPhoto)

    $(".action_cars").on("click", confirmationFunction);
    $(".view_invitaion").on('click', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        let carRequestId = $(this).attr('data-carRequestId');
        let url = `${HOST_URL}/${LANG}/dashboard/get-car-request/${carRequestId}`;

        $("#carInvitation .modal-body").html('')
        $("#carInvitation").modal()

        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function () {
                addLoader('.modal-body');
            },
            success: function (data) {
                $("#carInvitation .modal-body").append(data);
            },
            error: function (jqXhr, textStatus, errorMessage) {
                removeLoader();
                $("#carInvitation").modal('hide');
                toastr.error(jqXhr.responseJSON.message ?? errorMessage);
            },
            complete: function () {
                removeLoader();
            },
        });
    });
});

let filtered = false;
let status = null;
// Change Notification number to 0
$(".notification-btn").on("click", function (e) {
    let NotificationNumber = parseInt($(this).find(".notification-number").text().trim(0));
    if (NotificationNumber && NotificationNumber > 0) {
        $(this).find(".notification-number").html(0)
    }
});

var DataTablesColumns = [
    {
        data: 'plate_en',
        class: LANG == 'ar' ? 'direction_rtl status_message' : 'status_message',
        render: function (data, data2, row) {
            let content = '';

            if (row.car_message?.id) {
                let className = 'label-light-danger';

                if (row.car_message.status_action == 'closed') {
                    className = 'label-light-primary';
                }

                content += `<span class="label ${className} font-weight-bold label-inline tooltipAlert"
                            data-toggle="tooltip" data-placement="top" title="${row.car_message.message}">رسالة جديدة</span>
                            </span>`;

                $('.tooltipAlert').tooltip();
            }

            return `${content} ${data}`;
        },
    },
    {data: 'plate_ar', name: 'plate_ar'},
    {
        data: 'camID', render: function (data, data2, row, type) {
            return row.camera?.name ? (row.camera?.id + ' - ' + row.camera?.name) : '---';
        }
    },
    {
        data: 'type', render: function (data, data2, row) {
            return (row.type != null) ? (langs[LANG][row.type] ?? '---') : '---';
        }
    },
    {
        data: 'date', render: function (data, data2, row, type) {
            let locale = LANG === "ar" ? "ar-EG" : "en-GB"

            return new Date(row.created_at).toLocaleDateString(locale, {
                day: "numeric",
                month: "long",
                year: "numeric"
            });
        }
    },
    {
        data: 'time', render: function (data, data2, row, type) {
            let locale = LANG === "ar" ? "ar-EG" : "en-GB"

            return new Date(row.created_at).toLocaleTimeString(locale, {
                hour: "2-digit",
                minute: "2-digit"
            });
        }
    },
    {
        data: 'status', class: "invitation_status-td", render: function (data, data2, row, type) {
            if (row.status) {
                if (row.car_request?.type == 'admin') {
                    return `<span class="badge badge-success">${langs[LANG].has_employee_invitation}</span>`
                } else {
                    return `<span class="badge" style="background-color: #402d68; color: #ffffff">${langs[LANG].has_visitor_invitation}</span>`
                }
            } else {
                return `<span class="badge badge-danger">${langs[LANG].no_invitation}</span>`
            }
        }
    },
    {
        data: 'notice_time', class: "status-td", render: function (data, data2, row, type) {
            if (row.notice_time != null) {
                return `<span class="badge badge-success">${langs[LANG].noticed}</span>`
            } else {
                return `<span class="badge badge-danger">${langs[LANG].not_noticed}</span>`
            }
        }
    },
    {
        data: 'detection_status', class: "detection_status-td", render: function (data, data2, type, row) {
            if (data == 'pending') {
                return `<span class="badge badge-warning" style="color:white">${langs[LANG].pending}</span>`
            } else if (data == 'success') {
                return `<span class="badge badge-success">${langs[LANG].success}</span>`
            } else if (data == 'error') {
                return `<span class="badge badge-danger">${langs[LANG].error}</span>`
            }else {
                return `<span class="badge badge-dark" style="color:white">${langs[LANG].pass}</span>`
            }
        }
    },
    {
        data: 'id', render: function (data, data2, row, type) {
            if (row.notice_time != null) {
                let result = `<button class="ml-1 mt-1 btn btn-sm btn-primary" disabled >${langs[LANG].update_detection}</button>`;
                if (row.status) {
                    result += `<button data-carRequestId="${row.car_request_id}" class="ml-1 mt-1 btn btn-sm btn-success view_invitaion">${langs[LANG].view_invitaion}</button>`;
                }
                return result;
            } else {
                let result = `<button data-id='${data}' data-status="${row.status}" href="javascript:void(0);" class="ml-1 mt-1 btn btn-sm btn-primary action_cars">${langs[LANG].update_detection}</button>`;
                if (row.status) {
                    result += `<button data-carRequestId="${row.car_request_id}"  class="ml-1 mt-1 btn btn-sm btn-success view_invitaion">${langs[LANG].view_invitaion}</button>`;
                }
                return result;
            }
        }
    }
]


if (gateID == 'all') {
    DataTablesColumns.splice(2, 0, {
        data: 'gate_id', render: function (data, data2, row) {
            return row.gate?.name;
        }
    });
}
var dataTable = $('#car_table_data').DataTable({
    createdRow: function (row, data, dataIndex) {
        $(row).attr('id', 'cat-' + data.id);
        $(row).attr('title', langs[LANG].click_to_show_image);
        $(row).attr('data-toggle', 'modal');
        $(row).attr('data-target', '#imagePreviewModal');
        $(row).attr('data-car_image', data.car_image);
        $(row).attr('data-plate_image', data.plate_image);
        $(row).attr('data-request_type', data.car_request?.type);
        $(row).attr('data-parking_number', data.car_request?.parking_number);
        $(row).attr('data-driver', data.car_request?.driver?.contact_person_name);
        $(row).addClass('data-record');
    },
    language: {
        url: locale,
        search: langs[LANG].search,
        searchPlaceholder: langs[LANG].search_placeholder,
    },
    "searching": false,
    "processing": true,
    "serverSide": true,
    "ordering": false,
    "bPaginate": true,
    ajax: {
        url: `${HOST_URL}/${LANG}/dashboard/cars/table/${siteID}/${gateID}?redirect_id=${redirect_id}`,
        type: "GET",
        data: function (d) {
            d.start_date = start_date;
            d.end_date = end_date;
            d.plate_en = plate_en_search;
            d.camera = $('#camera-select :selected').val()
            d.status = $('#status-select :selected').val()
            d.car_type = $('#car_type-select :selected').val()
            d.gate_id = $('#gates-select :selected').val()
            d.type = $('#type_select :selected').val()
            d.invitation_status = $('#invitation_status :selected').val()
            d.detection_status = $('#detection_status :selected').val()
        }
    },
    columns: DataTablesColumns
});

//Filter Option
$('#camera-select').on("change", function (e) {
    dataTable.ajax.reload();
});
$('#car_type-select').on("change", function (e) {
    dataTable.ajax.reload();
});
$('#status-select').on("change", function (e) {
    dataTable.ajax.reload();
});
$('#gates-select').on("change", function (e) {
    dataTable.ajax.reload();
});
$('#invitation_status').on("change", function (e) {
    dataTable.ajax.reload();
});
$('#detection_status').on("change", function (e) {
    dataTable.ajax.reload();
});

if (redirect_id != '') {
    setTimeout(() => {
        $(`tr#cat-${redirect_id}`).trigger('click');
    }, 500);
}

if (redirect_id != '') {
    setTimeout(() => {
        $(`tr#cat-${redirect_id}`).trigger('click');
    }, 100);
}

if (redirect_id == '' && start_date == '' && REALTIME == true) {
    if (gateID == 'all') {
        gates.forEach((gate) => {

            window.Echo.channel(`cars.${gate}`).listen('.CarEvent', ({data}) => {
                updateData(data);
            });
        })
    } else {

        window.Echo.channel(`cars.${gateID}`).listen('.CarEvent', ({data}) => {
            updateData(data);
        });
    }
}

//change status button handler
function confirmationFunction(e) {
    e.stopImmediatePropagation();
    $("#notesTextArea").val('');
    $("#file").val('');
    $('input:radio[name="detection_status"]').prop('checked', false);

    $("#confirmationModal").modal("show").on('hidden.bs.modal', function (e) {
        $("#confirmationModal .confirm-btn").off();
    });

    let id = $(this).data("id");
    let currentTr = $(this).closest("tr");
    let actionBtn = $(this);

    $("#confirmationModal .confirm-btn").on("click", function (e) {
        e.stopImmediatePropagation();
        let uploadedFile = $('#file')[0].files[0];
        let textNotes = $("#notesTextArea").val();
        let that = $(this);
        let detection_status = that.data('type');
        let text = that.text();
        // if ($(this).data('type') == 'error') {
        //     detection_status = 'error';
        // }


        let fd = new FormData();
        uploadedFile && fd.append("file", uploadedFile);
        textNotes && fd.append('textNotes', textNotes);
        detection_status && fd.append('detection_status', detection_status);
        fd.append('_token', $('meta[name="csrf-token"]').attr("content"));
        currentTr.find(".status-td").html('<div class="spinner spinner-primary"></div>')
        currentTr.find(".detection_status-td").html('<div class="spinner spinner-primary ml-30"></div>')

        actionBtn.prop('disabled', true);

        toastr.clear();
        toastr.options = {
            "positionClass": LANG === "ar" ? "toast-top-left" : "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
        }

        $.ajax({
            url: `${HOST_URL}/${LANG}/dashboard/cars/takeAction/${id}`,
            type: 'post',
            processData: false,
            contentType: false,
            cache: false,
            data: fd,
            enctype: 'multipart/form-data',
            beforeSend: function () {
                that.addClass('spinner spinner-white spinner-right').text(langs[LANG].please_wait);
                $('.confirm-btn').prop('disabled', true);
            },
            success: function (data) {
                $("#notesTextArea").val('');
                $("#file").val('');
                $("#confirmationModal").modal("hide")
                $("#no_risk").text(data.no_risk_duration);
                $("#risk_duration").text(data.risk_duration);
                $('input:radio[name="detection_status"]').prop('checked', false);
                var badge = 'badge-warning'
                if (detection_status == 'error'){
                    badge = 'badge-danger'
                } else if (detection_status == 'pass'){
                    badge = 'badge-dark'
                } else if (detection_status == 'success'){
                    badge = 'badge-success'
                }

                toastr.options.onclick = function () {
                    window.location.href = `${HOST_URL}/${LANG}/dashboard/car/notes?site_id=${siteID}`;
                };

                toastr.success(`${langs[LANG].toastr_success_update_state}`);

                currentTr.find(".status_message span").removeClass('label-light-danger').addClass('label-light-primary');

                setTimeout(function () {
                    currentTr.find(".status-td").html(`<span class="badge badge-success" style="color:#fff">${langs[LANG].noticed}</span>`)
                    currentTr.find(".detection_status-td").html(`<span class="badge ${badge}">${langs[LANG][detection_status]}</span>`)

                    if (data.car_status) {
                        $(".car-card").addClass("risk")
                        $(".item-status .status-cont-text").html(`<span class="text-danger text">${langs[LANG].car_waiting}</span>`);
                    } else {
                        $(".car-card").removeClass("risk")
                        $(".item-status .status-cont-text").html(`<span class="text" style="color: green">${langs[LANG].no_car_waiting}</span>`);
                    }
                }, 500);

                setTimeout(function () {
                    if (redirect_id == '' && start_date == '' && $('#status-select :selected').val() == 'not_noticed') {
                        currentTr.remove();
                        let img = $(`#img-${id}`);
                        if (img) {
                            img.remove()
                        }
                    }
                }, 4000);

                $("#confirmationModal .confirm-btn").off();
            },
            error: function (data) {
                $("#confirmationModal").modal("hide");
                actionBtn.prop("disabled", false);
                currentTr.find(".status-td").html(`<span class="badge badge-danger">${langs[LANG].failed}</span>`)
                currentTr.find(".detection_status-td").html(`<span class="badge badge-danger">${langs[LANG].failed}</span>`)

                $("#confirmationModal .confirm-btn").off();
                toastr.error(`${langs[LANG].toastr_error_fail_update_state}`);
            },
            complete: function () {
                that.removeClass('spinner').text(text);
                $('.confirm-btn').prop('disabled', false);
            }
        })
    })
}

function ExportFile() {
    var type = "xls";
    var start = $('#start_date_ex').val();
    var end = $('#end_date_ex').val();
    var last_child = $('#site_id').val();
    var gate_id = $('#gate_id').val();

    if (start == '') {
        toastr.error(langs[LANG].select_start_date);
        return;
    }

    if (end == '') {
        toastr.error(langs[LANG].select_end_date);
        return;
    }

    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/cars/export`,
        type: 'post',
        data: {
            "_token": $('meta[name="csrf-token"]').attr("content"),
            "type": type,
            "start": start,
            "end": end,
            "last_child": last_child,
            "gate_id": gate_id,
        },
        success: function (data) {
            toastr.options.onclick = function () {
                window.location.href = `${HOST_URL}/${LANG}/dashboard/report/carModel/files?site_id=${siteID}`;
            };
            toastr.success(data.message);
        },
        error: function (data) {
            toastr.error("Failed To Export File");
        }
    })
}

function openModalPhoto() {
    let rowData = $(this).find('td');

    $("#imagePreviewModal .car_image").attr("src", $(this).data('car_image'));
    $("#imagePreviewModal .plate_image").attr("src", $(this).data('plate_image'));
    let request_type = $(this).data('request_type');
    let newData = '';

    if (request_type === 'admin') {
        let driver = $(this).data('driver');
        let parking_number = $(this).data('parking_number');

        newData = `<div>
            <h6>${langs[LANG].employee_name}</h6>
            <p>${driver}</p>
        </div>
        <div>
            <h6>${langs[LANG].parking_number}</h6>
            <p>${parking_number == 0 ? '---' : parking_number}</p>
        </div>`;
    } else if (request_type === 'visitor') {
        let driver = $(this).data('driver');

        newData = `<div class="col-12">
            <h6>${langs[LANG].visitor_name}</h6>
            <p>${driver}</p>
        </div>
        <div>
            <h6>${langs[LANG].parking_number}</h6>
            <p>${langs[LANG].visitor_parking}</p>
        </div>`;
    }

    if (gateID == 'all') {
        newData += `<div class="modal-action">
          <h6>${langs[LANG].manage}</h6>
           <p>${rowData[10].innerHTML}</p>
       </div>`;

        var dataColumns = `<div>
          <h6>${langs[LANG].plate_en}</h6>
          <p style="direction: ltr !important;">${rowData[0].innerHTML}</p>
       </div>
       <div>
          <h6>${langs[LANG].plate_ar}</h6>
          ${rowData[1].innerHTML}
       </div>
       <div>
          <h6>${langs[LANG].gate}</h6>
          ${rowData[2].innerHTML}
       </div>
        <div>
          <h6>${langs[LANG].camera}</h6>
          ${rowData[3].innerHTML}
       </div>
         <div>
          <h6>${langs[LANG].type}</h6>
          ${rowData[4].innerHTML}
       </div>
        <div>
          <h6>${langs[LANG].status}</h6>
           <p>${rowData[7].innerHTML}</p>
       </div>
       <div>
           <h6>${langs[LANG].date}</h6>
            <p>${rowData[5].innerHTML}</p>
        </div>
       <div>
           <h6>${langs[LANG].timing}</h6>
           <p>${rowData[6].innerHTML}</p>
       </div>${newData}`;
    } else {
        newData += `<div class="modal-action">
          <h6>${langs[LANG].manage}</h6>
           <p>${rowData[9].innerHTML}</p>
       </div>`;

        var dataColumns = `<div>
          <h6>${langs[LANG].plate_en}</h6>
          <p style="direction: ltr !important;">${rowData[0].innerHTML}</p>
       </div>
       <div>
          <h6>${langs[LANG].plate_ar}</h6>
          ${rowData[1].innerHTML}
       </div>
       <div>
           <h6>${langs[LANG].date}</h6>
            <p>${rowData[4].innerHTML}</p>
        </div>
       <div>
           <h6>${langs[LANG].timing}</h6>
           <p>${rowData[5].innerHTML}</p>
       </div>
        <div>
          <h6>${langs[LANG].camera}</h6>
          ${rowData[2].innerHTML}
       </div>
       <div>
          <h6>${langs[LANG].type}</h6>
          ${rowData[3].innerHTML}
       </div>
       <div>
          <h6>${langs[LANG].status}</h6>
           <p>${rowData[6].innerHTML}</p>
       </div>${newData}`;
    }

    $("#imagePreviewModal .data-cont").html(dataColumns);
    selectedRow = $(this);
}

$(".takeAction").on("click", confirmationFunction)

$("#imagePreviewModal").on("shown.bs.modal", function (e) {
    $("#imagePreviewModal .data-cont .modal-action .action_cars").on("click", () => {
        selectedRow.find(".action_cars").click()
        // $("#imagePreviewModal").modal("hide");
    });

    $("#imagePreviewModal .data-cont .modal-action .view_invitaion").on("click", () => {
        selectedRow.find(".view_invitaion").click()
        // $("#imagePreviewModal").modal("hide");
    });
})

$("#imagePreviewModal").on("hide.bs.modal", function (e) {
    selectedRow = null;
    scale = 1;
    $('#imagePreviewModal.show .img-cont').css('transform', 'scale(' + scale + ')');
})

$('.settingImagesControle .fa-ellipsis-v').on('click', function () {
    $('.menuSettings').toggle();
});

$('.menuSettings .fa-times').on('click', function () {
    $('.menuSettings').hide();
})

function playSound() {
    let soundUrl = `${HOST_URL}/dashboard_assets/media/sound/Notification.mp3`;
    var audio = new Audio(soundUrl);
    audio.play();
}

function updateData(data) {

    playSound();
    $("#imagePreviewModal").modal('hide');
    let {id, created_at, plate_en, invitation_type} = data;

    $('.dataTables_empty').hide();

    dataTable.ajax.reload(() => {
        $("#cat-" + id).trigger('click');
    });


    let locale = LANG === "ar" ? "ar-EG" : "en-GB"
    let created_at_date = new Date(created_at).toLocaleDateString(locale, {
        day: "numeric",
        month: "long",
        year: "numeric"
    });

    let created_at_time = new Date(created_at).toLocaleTimeString("en-US", {
        hour: "2-digit",
        minute: "2-digit"
    }).replace("AM", "am").replace("PM", "pm");

    if (LANG === "ar") {
        created_at_time = created_at_time.replace("am", "ص").replace("pm", "م");
    }

    // handle new Notification
    let NotificationElm = $(".notification-number");
    NotificationElm.html(+NotificationElm.text().trim() + 1)

    if ($(".notification-img").length !== 0) {
        $(".notification-img").parent().remove();
        $(".notification-footer").css("display", "block");
    }

    let NotificationMarkup = `<a href="javascript:;" class="dropdown-item">
            <div class="content-cont">
                <h4 class=" title">${langs[LANG].toastr_error_car_detect}</h4>
                <p class="content">${langs[LANG].toastr_error_car_detect_desc} ${plate_en}</p>
                <div class="time">
                    <span class="text-muted  mt-1">
                        <i class="flaticon-event-calendar-symbol"></i>
                      ${created_at_date}
                    </span>
                    <span class="text-muted  mt-1">
                        <i class="fa fa-clock" aria-hidden="true"></i>
                        ${created_at_time}
                    </span>
                </div>
            </div>
        </a>`;

    $('body').delegate('.topbar-item .dropdown-item', 'click', function () {
        let id = $(this).attr('data-Modal-id');
        $("tr" + id).trigger('click');
    });

    let notification_selector = $(".notification-dropdown .dropdown-items-container");
    if (notification_selector.children().length >= 15) {
        notification_selector.children().last().remove()
    }
    // $notification_selector.prepend(NotificationMarkup)
    let no_invitation = parseInt($('#no_invitation').html());
    let invitation_visitor = parseInt($('#invitation_visitor').html());
    let invitation_employee = parseInt($('#invitation_employee').html());
    let entry_car_site = parseInt($('#entry_car_site').html());

    if (data.camera.type === 'checkin') {
        $("#entry_car_site").text(entry_car_site + 1);
    }

    if (invitation_type === 'invitation_visitor') {
        $("#invitation_visitor").text(invitation_visitor + 1);
    } else if (invitation_type === 'invitation_employee') {
        $("#invitation_employee").text(invitation_employee + 1);
    } else {
        $("#no_invitation").text(no_invitation + 1);
    }

    if (!$(".car-card").hasClass("risk")) {
        $(".car-card").addClass("risk")
        $(".item-status .status-cont-text").html(`<span class="text-danger text">${langs[LANG].car_waiting}</span>`);
    }

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": LANG === "ar" ? "toast-bottom-left" : "toast-bottom-right",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    toastr.options.onclick = function () {
        $("tr#cat-" + id).trigger("click");
        let num = +$(".notification-number").text().trim()
        if (num > 0) {
            $(".notification-number").html(num - 1)
        }
    };

    toastr.success(`${langs[LANG].toastr_error_car_detect_desc} ${plate_en}`, `${langs[LANG].toastr_error_car_detect}`);
}
