var MM = {};
$(function(){
    var pf = $("#pass-form"),
        pm = $("#pass-modal");
    /*** Numeric function ***/
    $('.num-only').on('input', function (event) { 
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    $(".num-only").on("keyup", function(event) {
        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40) return;
    });
    /*** Numeric function ***/
	$('.numeric').on('input', function (event) { 
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	$(".numeric").on("keyup", function(event) {
		// skip for arrow keys
		if(event.which >= 37 && event.which <= 40) return;
		// format number
		$(this).val(function(index, value) {
			return value
			.replace(/\D/g, "")
			.replace(/\B(?=(\d{3})+(?!\d))/g, ".")
			;
		});
    });
    $(".modal-header").on("mousedown", function(mousedownEvt) {
        var $draggable = $(this);
        var x = mousedownEvt.pageX - $draggable.offset().left,
            y = mousedownEvt.pageY - $draggable.offset().top;
        $("body").on("mousemove.draggable", function(mousemoveEvt) {
            $draggable.closest(".modal-dialog").offset({
                "left": mousemoveEvt.pageX - x,
                "top": mousemoveEvt.pageY - y
            });
        });
        $("body").one("mouseup", function() {
            $("body").off("mousemove.draggable");
        });
        $draggable.closest(".modal").one("bs.modal.hide", function() {
            $("body").off("mousemove.draggable");
        });
    });
    $(".change-pass").on("click", function(){
        pm.modal( "show" );
    });
    pm.on("click", ".click-to-view", function(){
        $(this).toggleClass("fa fa-eye-slash").toggleClass("fa fa-eye");
        var type = $(this).parent().parent().find("input").attr("type");
        if ( type == "text" )
            $(this).parent().parent().find("input").attr("type", "password");
        else
            $(this).parent().parent().find("input").attr("type", "text");
    });
    pf.ajaxForm({
        dataType: "JSON",
        beforeSubmit : function(){
            pf.addClass("loading-idocs");
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
            pf.removeClass("loading-idocs");
        },
    });
    MM.swal_remove = function (uri="", id="0", name="", animation_class="", direct=""){
        if ( uri != "" && id != "0" && name != "" && animation_class != "" ){
            swal({
                title: "Hapus Data!",
                type: 'warning',
                html: `<span class="italic">Apakah anda yakin untuk menghapus "<strong>${name}</strong>" ?</span>`,
                showCancelButton: true,
                confirmButtonText: "Ya, Hapuskan!!",
                confirmButtonColor: '#d33',
                cancelButtonColor: 'grey',
                showLoaderOnConfirm: true,
                preConfirm: function () {
                    return new Promise(function (resolve, reject) {
                        setTimeout(function(){
                            $.ajax({
                                url: uri,
                                type: 'post',
                                data: { 'id' : id},
                                dataType: 'json',
                                beforeSend: function(){
                                    animation_class.addClass("loading-idocs");
                                },
                                success: function(data){
                                    var sa_title = (data.type == 'done') ? "Berhasil!" : "Gagal!";
                                    var sa_type = (data.type == 'done') ? "success" : "error";
                                    swal({ title:sa_title, type:sa_type, html:data.response }).then(function(){
                                        if (data.type == 'done') (direct.trim() == "") ? window.location.reload() : direct;;
                                    });
                                },
                                error: function(){
                                    swal("Gagal!", "Terjadi error, harap refresh browser anda.", "error");
                                },
                                complete: function(){
                                    animation_class.removeClass("loading-idocs");
                                }
                            });
                        }, 1000);
                    })
                },
                allowOutsideClick: false
            }).catch(swal.noop);
        }
    }
    MM.addCommas = function(nStr){
        nStr += '';
        x = nStr.split(',');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    MM.addDots = function(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }
    MM.titleErr = "Gagal!";
    MM.titleScs = "Berhasil!";
    MM.globErr  = "Terjadi error, harap refresh browser anda.";
    MM.typeErr  = "error";
    MM.typeWrn  = "warning";
    MM.typeScs  = "success";
    MM.loader   = "loading-idocs";
    $(".select2").select2({
        width: '100%'
    });
})