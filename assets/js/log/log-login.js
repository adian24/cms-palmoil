$(function(){
    var t = $("#dt").dataTable({
        "bLengthChange": false,
        "bInfo": false,
        "pageLength": 25,
        "processing"    : true,
		"serverSide"    : true,
		"ajax"          : {
            url : base + "log-login.datalist",
            type : "POST",
        }
    })
});