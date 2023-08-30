function sendAjaxRequest(url,data, type){
    $.ajax({
        url : url,
        type: type,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data){
            console.log(data)
            if ( data.status ) createToast('success', data.message);
            else createToast('error', 'Something went wrong');
        } ,
        error: function(data){
            createToast('error', 'Something went wrong');
        }
    });
}


function createToast(type, message){
    if ( type == 'success' ) toastr.success(message);
    else if ( type == 'error' ) toastr.error(message);
    else if ( type == 'warning' ) toastr.warning(message);
    else if ( type == 'info' ) toastr.info(message);
}
