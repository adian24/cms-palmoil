$(function(){
    var fd = $("#form-default"),
        tc = $("#tab-cert");
    fd[0].reset();
    $("#btn-add-sert").on("click", function(){
        let html = `
        <tr>
            <td><input type="text" class="form-control" name="cert_name[]" placeholder="Nama Sertifikat" maxlength="100" /></td>
            <td><input type="text" class="form-control" name="cert_year[]" placeholder="Masa Berlaku" maxlength="100" /></td>
            <td><select name="cert_iso[]" class="form-control">${data_iso}</select></td>
            <td><input type="file" name="cert_file[]" class="form-control" /></td>
            <td><input type="hidden" name="cert_oldfile[]" value="" /><button type="button" class="btn btn-sm btn-danger btn-rem-cert"><i class="fa fa-close"></i></button></td>
        </tr>`;
        tc.find("tbody").append(html);
    })
    $(tc).on("click", ".btn-rem-cert", function(){
        $(this).closest("tr").remove();
    })
    fd.ajaxForm({
        dataType: "JSON",
        beforeSubmit : function(){
            fd.addClass("loading-idocs");
        },
        success: function(data){
            var sa_title = (data.type == 'done') ? "Berhasil!" : "Gagal!";
            var sa_type  = (data.type == 'done') ? "success" : "warning";
            var sa_title = (data.type == 'gagal') ? "Gagal!" : "Berhasil";
            var sa_type  = (data.type == 'gagal') ? "error" : "success";
            swal({ title:sa_title, type:sa_type, html:data.response }).then(function(){ 
                if (data.type == 'done') window.location.replace(data.uri);
            });
        },
        error: function(){
            swal("Gagal!", "Terjadi error, harap refresh browser anda.", "error");
        },
        complete: function(){
            fd.removeClass("loading-idocs");
        },
    });
})