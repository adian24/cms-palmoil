$(function(){
    var fd = $("#form-default");
    fd[0].reset();
    $("#content").wysihtml5();
    fd.ajaxForm({
        dataType: "JSON",
        beforeSubmit : function(){
            fd.addClass("loading-idocs");
        },
        success: function(data){
            var sa_title = (data.type == 'done') ? messages.glob_scs_title : messages.glob_err_title;
			var sa_type = (data.type == 'done') ? "success" : "warning";
			swal({ title:sa_title, type:sa_type, html:data.response }).then(function(){ 
				if (data.type == 'done') window.location.replace(data.uri);
			});
        },
        error: function(){
            swal(messages.glob_err_title, messages.glob_err, "error");
        },
        complete: function(){
            fd.removeClass("loading-idocs");
        },
    });
})