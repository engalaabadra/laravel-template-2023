$(document).ready(function () {
    var d = Date(Date.now());
    a = d.toString()
    document.getElementsByClassName("date").min = a;
});

$('#file').on('change', function () { //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        $('#thumb-output').html('');
        $('#thumb-output').css('margin-top', '2px');
        var data = $(this)[0].files;
        $.each(data, function (index, file) {
            if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                var fRead = new FileReader();
                fRead.onload = (function (file) {
                    return function (e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result);
                        $('#thumb-output').append(img);
                    };
                })(file);
                fRead.readAsDataURL(file);
            }
        });
    } else {
        alert("Your browser doesn't support File API!");
    }
});

// $('#file').on('change', function () { //on file input change
//     if (window.File && window.FileReader && window.FileList && window.Blob) {
//         $('#thumb-output').html('');
//         var data = $(this)[0].files;
//         $.each(data, function (index, file) {
//             if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
//                 var fRead = new FileReader();
//                 fRead.onload = (function (file) {
//                     return function (e) {
//                         var img = $('<img/>').addClass('thumb').attr('src', e.target.result);
//                         $('#thumb-output').append(img);
//                     };
//                 })(file);
//                 fRead.readAsDataURL(file);
//             }
//         });
//     } else {
//         alert("Your browser doesn't support File API!");
//     }
// });

$('.file_slider').on('change', function () { //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        $(".thumb-slider").html('');
        var data = $(this)[0].files;
        $.each(data, function (index, file) {

            if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                var fRead = new FileReader();
                fRead.onload = (function (file) {
                    return function (e) {
                        var img = $('<img/>').addClass('mr-3').attr('src', e.target.result);

                        $(".thumb-slider").append(img);
                    };
                })(file);
                fRead.readAsDataURL(file);
            }
        });
    } else {
        alert("Your browser doesn't support File API!");
    }
});

$(document).on("change", ".file_icon", function () {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var imgPath = $(this).parentsUntil('col-md-1').siblings('.col-md-2').find('.thumb-icon');
        imgPath.html('');

        var data = $(this)[0].files;
        $.each(data, function (index, file) {

            if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                var fRead = new FileReader();
                fRead.onload = (function (file) {
                    return function (e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result);

                        imgPath.append(img);
                    };
                })(file);
                fRead.readAsDataURL(file);
            }
        });
    } else {
        alert("Your browser doesn't support File API!");
    }
});

$(document).on("change", ".file_person", function () {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var imgPath = $(this).parentsUntil('col-md-1').siblings('.image_background').find('.image-input-wrapper');
        imgPath.html('');

        var data = $(this)[0].files;
        $.each(data, function (index, file) {

            if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                var fRead = new FileReader();
                fRead.onload = (function (file) {
                    return function (e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result);

                        imgPath.append(img);
                    };
                })(file);
                fRead.readAsDataURL(file);
            }
        });
    } else {
        alert("Your browser doesn't support File API!");
    }
});

$(document).on("change", ".file_service", function () {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var imgPath = $(this).parentsUntil('col-md-1').siblings('.col-md-2').find('.thumb-person');
        imgPath.html('');

        var data = $(this)[0].files;
        $.each(data, function (index, file) {

            if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                var fRead = new FileReader();
                fRead.onload = (function (file) {
                    return function (e) {
                        var img = $('<img/>').attr('src', e.target.result);

                        imgPath.append(img);
                    };
                })(file);
                fRead.readAsDataURL(file);
            }
        });
    } else {
        alert("Your browser doesn't support File API!");
    }
});

$('.file').on('change', function () { //on file input change
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        $(this).parent().parent().siblings('.image').find('.thumb-output').html('');
        var data = $(this)[0].files;
        $.each(data, function (index, file) {
            if (/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)) {
                var fRead = new FileReader();
                fRead.onload = (function (file) {
                    return function (e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result);
                        $(this).parent().parent().siblings('.image').find('.thumb-output').append(img);
                    };
                })(file);
                fRead.readAsDataURL(file);
            }
        });
    } else {
        alert("Your browser doesn't support File API!");
    }
});

let file_excel = "";
let file_pdf = "";
let file_csv = "";
let custom_column = "";
let copy_table = "";
let locale = "";
let action = "";

var KTDatatablesBasicPaginations = function () {
    var initTable1 = function () {
        var table = $('#dataTable');

        table.DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text: `<a href="" class="btn btn-brand btn-elevate btn-icon-sm">
                                <img src="${HOST_URL}/dashboard_assets/media/svg/files/xml.svg" alt="" style="width: 18px; height: 18px">
                           ${file_excel}
                        </a>`,
                    },
                    {
                        extend: 'pdf',
                        text: `<a href="" class="btn btn-brand btn-elevate btn-icon-sm">
                                <img src="${HOST_URL}/dashboard_assets/media/svg/files/pdf.svg" alt="" style="width: 18px; height: 18px">
                           ${file_pdf}
                        </a>`,
                    },
                    {
                        extend: 'csv',
                        text: `<a href="" class="btn btn-brand btn-elevate btn-icon-sm">
                                <img src="${HOST_URL}/dashboard_assets/media/svg/files/csv.svg" alt="" style="width: 18px; height: 18px">
                           ${file_csv}
                        </a>`,
                    }, {
                        extend: 'copy',
                        text: `<a href="" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="flaticon-clipboard"></i>
                           ${copy_table}
                        </a>`,
                    }, {
                        extend: 'colvis',
                        text: `<a href="" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="flaticon-list-2"></i>
                           ${custom_column}
                        </a>`,
                    },
                ],
                responsive: true,
                columnDefs: [
                    {
                        targets: -1,
                        orderable: false,
                    },
                ],
                language: {
                    url: locale
                },
            },
        );
    };
    return {
        //main function to initiate the module
        init: function () {
            initTable1();
        },
    };
}();
jQuery(document).ready(function () {
    // KTDatatablesBasicPaginations.init();
});


$(document).ready(function () {
    $('.select2').select2({});

    $('.nice-select').select2({
        minimumResultsForSearch: -1
    });

});

var _initChartsWidget5 = function (data) {
    var element = document.getElementById("kt_charts_widget_5_chart");

    if (!element) {
        return;
    }

    var options = {
        series: [{
            name: 'Net Profit',
            data: [40, 50, 65, 70, 50, 30]
        }, {
            name: 'Revenue',
            data: [-30, -40, -55, -60, -40, -20]
        }],
        chart: {
            type: 'bar',
            stacked: true,
            height: 350,
            toolbar: {
                show: false
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: ['12%'],
                endingShape: 'rounded'
            },
        },
        legend: {
            show: false
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            axisBorder: {
                show: false,
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                }
            }
        },
        yaxis: {
            min: -80,
            max: 80,
            labels: {
                style: {
                    colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                }
            }
        },
        fill: {
            opacity: 1
        },
        states: {
            normal: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: 'none',
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'none',
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: '12px',
                fontFamily: KTApp.getSettings()['font-family']
            },
            y: {
                formatter: function (val) {
                    return "$" + val + " thousands"
                }
            }
        },
        colors: [KTApp.getSettings()['colors']['theme']['base']['info'], KTApp.getSettings()['colors']['theme']['base']['primary']],
        grid: {
            borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: true
                }
            }
        }
    };

    var chart = new ApexCharts(element, options);
    chart.render();
}


// var KTWidgets = function () {
//     return {
//         init: function () {
//             _initDaterangepicker();
//         }
//     }
// }();


// jQuery(document).ready(function () {
//     KTWidgets.init();
// });

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('.select2').select2({});

    $('.nice-select').select2({
        minimumResultsForSearch: -1
    });

    var d = Date(Date.now());
    a = d.toString()
    document.getElementsByClassName("date").min = a;

    $('.add_loading').on('click', function (e) {

        $(this)
            .addClass('spinner spinner-white spinner-right')
            .text(langs[LANG].please_wait)
            .prop('disabled', true);

        $(".form").submit();
    });

    $.fn.dataTable.ext.errMode = 'throw';
});

function logout() {
    $("#LogoutForm").submit();
}
