function readURL(input){
	// Mulai membaca inputan gambar
	if(input.files && input.files[0]){
		var reader = new FileReader();
		// Membuat variabel reader untuk API FileReader
		 reader.onload = function (e){
		 	// Mulai pembacaan file
		 	$('#preview_gambar')
		 	// Tampilkan gambar yang dibaca ke area id #preview_gambar
		 	.attr('src', e.target.result)
		 	//.width(150); // Menentukan lebar gambar preview (dalam pixel)
		 	//.height(200); // Jika ingin menentukan lebar gambar silahkan aktifkan perintah pada baris ini
		};
	reader.readAsDataURL(input.files[0]);}
}

// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();

//         reader.onload = function (e) {
//             $('#preview_gambar')
//                 .attr('src', e.target.result)
//                 .width(150)
//                 .height(150);
//             $('#image-preview-b64-circle').val(e.target.result)
//         };
//         $('#preview_gambar').css('display', 'block')
//         reader.readAsDataURL(input.files[0]);
//     }
// }

function readURL1(input1){
	// Mulai membaca inputan gambar
	if(input1.files && input1.files[0]){
		var reader1 = new FileReader();
		// Membuat variabel reader untuk API FileReader
		 reader1.onload = function (e){
		 	// Mulai pembacaan file
		 	$('#preview_gambar_header')
		 	// Tampilkan gambar yang dibaca ke area id #preview_gambar
		 	.attr('src', e.target.result)
		 	//.width(150); // Menentukan lebar gambar preview (dalam pixel)
		 	//.height(200); // Jika ingin menentukan lebar gambar silahkan aktifkan perintah pada baris ini
		};
	reader1.readAsDataURL(input1.files[0]);}
}