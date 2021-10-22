$(function(){
    var fd = $("#form-default"),
        md = $("#modal-default"),
        bo = $(".box");
    md.on("hidden.bs.modal", function(){
		fd[0].reset();
    });
    fd.ajaxForm({
        dataType: "JSON",
        beforeSubmit : function(){
            fd.addClass("loading-idocs");
        },
        success: function(data){
            var sa_title = (data.type == 'done') ? "Berhasil!" : "Gagal!";
			var sa_type = (data.type == 'done') ? "success" : "warning";
			swal({ title:sa_title, type:sa_type, html:data.response }).then(function(){ 
				if (data.type == 'done') window.location.reload(); 
			});
        },
        error: function(){
            swal("Gagal!", "Terjadi error, harap refresh browser anda.", "error");
        },
        complete: function(){
            fd.removeClass("loading-idocs");
        },
    });
    var t = $("#dt").dataTable({
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
    })
    .on("click", ".btn-edit", function(){
        var id = $(this).data("id"),
            uri= $(this).data("uri");
        $.ajax({
            url : uri,
            type : "POST",
            dataType : "JSON",
            data : {"id" : id},
            beforeSend: function(){
                bo.addClass("loading-idocs");
            },
            success: function(data){
                if ( data.type == "error" )
                    swal( "Gagal!", data.response, "error" );
                else{
                    $("#id").val ( id );
                    $("#name").val ( data.response[0].iso_name);
                    $("#type").val ( data.response[0].iso_type);
                    md.modal("show");
                }
            },
            error: function(){
                swal("Gagal!", "Terjadi error, harap refresh browser anda.", "error");
            },
            complete: function(){
                bo.removeClass("loading-idocs");
            }
        });
    })
    .on("click", ".btn-delete", function(){
        var id = $(this).data('id'),
			name = $(this).data('name'),
			uri = $(this).data("uri");
		MM.swal_remove(uri, id, name, bo);
    })
});