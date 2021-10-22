$(function(){
    var t = $("#dt").dataTable({
        "bLengthChange": false,
        "bInfo": false,
        "pageLength": 25,
        "processing"    : true,
		"serverSide"    : true,
		"ajax"          : {
            url : base + "log-query.datalist",
            type : "POST",
        }
    })
});