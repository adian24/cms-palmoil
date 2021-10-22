$(function(){
    var md = $("#modal-default"),
        bo = $(".box");
    md.on("hidden.bs.modal", function(){
		fd[0].reset();
    });
    var t = $("#dt").dataTable({
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
    })
    .on("click", ".btn-delete", function(){
        var id = $(this).data('id'),
			name = $(this).data('name'),
			uri = $(this).data("uri");
		MM.swal_remove(uri, id, name, bo);
    })
});