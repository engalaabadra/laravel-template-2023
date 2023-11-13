// // open action modal
$(document).on("click", "#takeAction", function () {
    console.log('oh')
    $("#actionModal").modal()
})

function setActionValue(value, count) {
    var note = $('#notes').val();

    if (!note) {
        if (value == 'rejected') {
            $('.require_note').show();
            return;
        }
    }

    $('.set-action').attr('disabled', true).addClass('spinner spinner-white spinner-right')
        .text(langs[LANG].please_wait);

    $('.modal').off('click');
    $('.close[data-dismiss="modal"]').off('click');
    $('body').off('click');
    $("#formAction").append("<input type='hidden' name='status_action' class='form-control' value='" + value + "'/>")
    if(typeof action_type === 'undefined'){
        $("#target").submit();
    }else if(action_type == 'car_action'){
        var formData=new FormData($('#target')[0]);
        $.ajax({
            type:'post',
            enctype:'multipart/form-data',
            url:`${HOST_URL}/${LANG}/dashboard/car-guard/action`,
            data:formData,
            processData:false,
            contentType:false,
            cache:false,
            success:function (data){
                $('#CarFastActionModal').modal('hide');
                guardCarsServerSideDataTable.ajax.reload();
                toastr.success(data.message);
            },
            error:function (reject){
                toastr.error(reject.message);
            }
        });
    }else if(action_type == 'material_action'){
        var formData=new FormData($('#target')[0]);
        $.ajax({
            type:'post',
            enctype:'multipart/form-data',
            url:`${HOST_URL}/${LANG}/dashboard/material-guard/action`,
            data:formData,
            processData:false,
            contentType:false,
            cache:false,
            success:function (data){
                $('#matrialActionModal').modal('hide');
                guardExpectedMaterialServerSideDataTable.ajax.reload();
                toastr.success(data.message);
            },
            error:function (reject){
                toastr.error(reject.message);
            }
        });
    }else if(action_type == 'visit_action'){
        var formData=new FormData($('#target')[0]);
        $.ajax({
            type:'post',
            enctype:'multipart/form-data',
            url:`${HOST_URL}/${LANG}/dashboard/visit-guard/action`,
            data:formData,
            processData:false,
            contentType:false,
            cache:false,
            success:function (data){
                $('#visitorFastActionModal').modal('hide');
                guardVisitsServerSideDataTable.ajax.reload();
                toastr.success(data.message);
            },
            error:function (reject){
                toastr.error(reject.message);
            }
        });
    }



}

// materials
$(document).on("click", "#guardtakeAction", function () {
    $("#matrialactionModal").modal()
})

// cars
$(document).on("click", "#guardtakeCarAction", function () {
    $("#carActionModal").modal()
})

// cars
$(document).on("click", "#contractTakeAction", function () {
    $("#contractActionModal").modal()
})

