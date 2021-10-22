$(function(){
    $("#username").focus();
    $("#form-login").ajaxForm({
        dataType: "JSON",
        beforeSubmit : function(){
            $("#form-login").addClass("loading-idocs");
        },
        success: function(data){
            if ( data.type == "failed" ){
                swal("Gagal!", data.response, "error");
                return false;
            }
            window.location.reload();
        },
        error: function(){
            swal("Gagal!", "Terjadi error, harap refresh browser anda.", "error");
        },
        complete: function(){
            $("#form-login").removeClass("loading-idocs");
        },
    });
})