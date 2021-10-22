$(function(){
    var bo = $(".box");
    var md = $("#modal-default");

    $("#dt").dataTable({
        "bLengthChange": true,
        "bFilter": true,
        "bInfo": true,
        // aaSorting: [[0, 'desc']],
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
                    swal( "Gagal!", data.data_map, "error" );
                else{
                    $("#id").val ( id );
                    $("#name").text ( data.data_map[0].name != null ? data.data_map[0].name : '-');
                    $("#desc").text ( data.data_map[0].body != null ? data.data_map[0].body : '-');
                    $("#jam_oprational").text ( data.data_map[0].duration != null ? data.data_map[0].duration : '-');

                    var str      = data.data_map[0].website;
                    var get_http = str != null ? str.split(":") : '';
                    // console.log(get_http);
                    if(get_http[0] == 'http'){
                        $("#website").attr("href", data.data_map[0].website);
                    }else{
                        $("#website").attr("href", '//'+data.data_map[0].website);
                    }

                    $("#website").text ( data.data_map[0].website != null ? data.data_map[0].website : '-');
                    $("#phone1").text ( data.data_map[0].phone1 != null ? data.data_map[0].phone1 : '-');
                    $("#phone2").text ( data.data_map[0].phone2 != null ? data.data_map[0].phone2 : '-');
                    $("#latitude").text ( data.data_map[0].latitude != null ? data.data_map[0].latitude : '-');
                    $("#longitude").text ( data.data_map[0].longitude != null ? data.data_map[0].longitude : '-');
                    $("#alamat").text ( data.data_map[0].location != null ? data.data_map[0].location : '-');
                    $("#photo_hotel").html ( data.data_map[0].photo != null ? '<img src="./../assets/hotel/'+data.data_map[0].photo+'" style="width: 100%"></img>' : '-');
                    
                    
                    var format_sert = `<table style="width:100%" class="table table-bordered">
                                        <thead>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Sertifikat</th>
                                            <th class="text-center">Masa Berlaku</th>
                                            <th class="text-center">Jenis ISO</th>
                                            <th class="text-center">Dokumen Terlampir</th>
                                        </thead>
                                        <tbody>`;
                    var nomor = 1;
                    $.each(data.data_certificate_and_iso, function(index2, value2){
                        // console.log(value2);
                        format_sert += `<tr>
                                            <td class="text-center">
                                                <div id="no">${nomor}</div>
                                            </td>
                                            <td class="text-center">
                                                <div id="nama_sertifikat">${value2 != '' ? value2.nama_sertifikat : '-'}</div>
                                            </td>
                                            <td class="text-center">
                                                <div id="masa_berlaku">${value2 != '' ? value2.masa_berlaku_sertifikat : '-'}</div>
                                            </td class="text-center">
                                            <td class="text-center">
                                                <div id="jenis_iso">${value2 != '' ? value2.nama_iso : '-'}</div>
                                            </td>
                                            <td class="text-center">
                                                <div id="dokumen_terlampir">
                                                    <a href="./../assets/certificate/${value2 != '' ? value2.file_certifikat : '-'}" target="_blank">
                                                        <img src="./../assets/certificate/${value2 != '' ? value2.file_certifikat : '-'}" style="width: 5ex"></img>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>`
                        nomor++;
                    })

                    format_sert += `</tbody>
                                </table>`;

                    $('.sertifikat').html(format_sert);


                    var format = '';
                    $.each(data.facility_arr, function(index1, value){
                        var checked = false;
                        if ( data.data_facility != '' ){
                            $.each(data.data_facility, function(index,value_fc){
                                if ( value_fc.facility_num == index1 ) {
                                    var checked = true;   
                                    // console.log(value);
                                    var val_checked = (checked) ? 'checked' : '';
                                    format  += `<div class="col-md-3 form-group">
                                                    <div class="checkbox"><label><input type="checkbox" ${val_checked}> ${value} </label></div>
                                                </div>`;
                                }  

                            })
                        }
                    })
                    $('.fasilitas').html(format);


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