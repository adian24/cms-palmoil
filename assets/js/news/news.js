$(function(){
    var bo = $(".box");
    var md = $("#modal-default");

    // md.on("hidden.bs.modal", function(){
	// 	fd[0].reset();
    // });

    $("#dt").dataTable({
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        // aaSorting: [[0, 'asc']],
    })
    .on("click", ".btn-view-detail", function(){
        var id  = $(this).data("id"),
            uri = $(this).data("uri");
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
                    swal( "Gagal!", data.data_news, "error" );
                else{

                    let d  = new Date(data.data_news[0].expired_at);
                    let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                    let mo = new Intl.DateTimeFormat('en', { month: 'long' }).format(d);
                    let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                    let expred_date = `${da} ${mo} ${ye}`;

                    $("#id").val ( id );
                    $("#title").text ( data.data_news[0].title_news != null ? data.data_news[0].title_news : '-');
                    $("#desc").text ( data.data_news[0].description_news != null ? data.data_news[0].description_news : '-');
                    $("#expired_at").text ( data.data_news[0].expired_at != null ? expred_date : '-');
                    $("#image_news").html ( data.data_news[0].image_news != '' ? '<img src="./../assets_tbs/news/'+data.data_news[0].image_news+'" style="width: 100%"></img>' : '<img src="./../assets_tbs/no_image_available.jpg" style="width: 100%"></img>');
                    
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