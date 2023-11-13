$(document).on("click", "#tasksModalActive", function (e) {
    e.preventDefault();
    $("#taskModal .modal-body").html('')
    $("#taskModal").modal()
    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/task/${$(this).data('id')}`,
        type: 'GET',
        beforeSend: function(){
            addLoader('.modal-body');
        },
        success: function (data) {
            $(".modal-body").append(data);

            $('#CustomTable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                lengthChange: true,
                pageLength: 10,
                language: {
                    url: locale
                },
            });
        },
        complete: function(){
            removeLoader();
        },
    });
})

$(document).on("click", "#contractorsModalActive", function (e) {
    e.preventDefault();
    $("#contractorTaskModal .modal-body").html('')
    $("#contractorTaskModal").modal()

    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/contractor-task/${$(this).data('id')}`,
        type: 'GET',
        beforeSend: function () {
            addLoader('.modal-body');
        },
        success: function (data) {
            $("#contractorTaskModal .modal-body").append(data);
        },
        complete: function () {
            removeLoader();
        },
    });
})
$(document).on("click", "#MaterialsModalActive", function (e) {
    e.preventDefault();

    $("#materialTaskModal .modal-body").html('')
    $("#materialTaskModal").modal()
    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/material-task/${$(this).data('id')}`,
        type: 'GET',
        beforeSend: function () {
            addLoader('.modal-body');
        },
        success: function (data) {
            $("#materialTaskModal .modal-body").append(data);

            $('#CustomTable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                lengthChange: true,
                pageLength: 10,
                language: {
                    url: locale
                },
            });
        },
        complete: function () {
            removeLoader();
        },
    });
})
$(document).on("click", "#CarsModalActive", function (e) {
    e.preventDefault();
    $("#carTaskModal .modal-body").html('');
    $("#carTaskModal").modal()

    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/car-task/${$(this).data('id')}`,
        type: 'GET',
        beforeSend: function () {
            addLoader('.modal-body');
        },
        success: function (data) {
            $("#carTaskModal .modal-body").append(data);

            $('#CustomTable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                lengthChange: true,
                pageLength: 10,
                language: {
                    url: locale
                },
            });
        },
        complete: function () {
            removeLoader();
        },
    });
})
$(document).on("click", "#contractTask", function (e) {
    e.preventDefault();

    $("#contractTaskModal .modal-body").html('')
    $("#contractTaskModal").modal()
    $.ajax({
        url: `${HOST_URL}/${LANG}/dashboard/contract-task/${$(this).data('id')}`,
        type: 'GET',
        beforeSend: function () {
            addLoader('.modal-body');
        },
        success: function (data) {
            // console.log(data);
            $("#contractTaskModal .modal-body").append(data);

            $('#CustomTable').DataTable({
                dom: 'Bfrtip',
                responsive: true,
                lengthChange: true,
                pageLength: 10,
                language: {
                    url: locale
                },
            });
        },
        complete: function () {
            removeLoader();
        },
    });
})
