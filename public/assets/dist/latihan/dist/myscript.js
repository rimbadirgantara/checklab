const loginDulu = $('.login-dulu').data('flashdata');
if (loginDulu){
	Swal.fire({
		title: 'STOP!',
		text: loginDulu,
		icon: 'error'
	});
}

const BerhasilSimpanDataReservasi = $('.berhasilSimpanDataReservasi').data('flashdata');
if (BerhasilSimpanDataReservasi) {
	Swal.fire({
		position: 'top-end',
  		icon: 'success',
  		title: BerhasilSimpanDataReservasi,
  		showConfirmButton: false,
  		timer: 2500
	});
}

const Berhasiltambahkomting = $('.berhasiltambahkomting').data('flashdata');
if (Berhasiltambahkomting) {
	Swal.fire({
		position: 'top-end',
  		icon: 'success',
  		title: Berhasiltambahkomting,
  		showConfirmButton: false,
  		timer: 2500
	});
}

const Formatwaktutidakvalid = $('.format-waktu').data('flashdata');
if (Formatwaktutidakvalid){
	Swal.fire({
		title: Formatwaktutidakvalid,
		text: '',
		icon: 'error'
	});
}

const Updatedatareservasi = $('.update-data-reservasi').data('flashdata');
if (Updatedatareservasi){
	Swal.fire({
		title: Updatedatareservasi,
		text: '',
		icon: 'success'
	});
}

const Hapusreservasi = $('.hapusreservasi').data('flashdata');
if (Hapusreservasi) {
	Swal.fire({
		position: 'top-end',
  		icon: 'success',
  		title: Hapusreservasi,
  		showConfirmButton: false,
  		timer: 2500
	});
}

const Hapuskomting = $('.hapus_komting').data('flashdata');
if (Hapuskomting) {
	Swal.fire({
		position: 'top-end',
  		icon: 'success',
  		title: Hapuskomting,
  		showConfirmButton: false,
  		timer: 2500
	});
}

const Berhasileditprofile = $('.berhasileditprofile').data('flashdata');
if (Berhasileditprofile) {
	Swal.fire({
		position: 'top-end',
  		icon: 'success',
  		title: Berhasileditprofile,
  		showConfirmButton: false,
  		timer: 2500
	});
}

const Metainance = $('.metainance').data('flashdata');
if (Metainance) {
	Swal.fire({
	  title: Metainance,
	  text: '',
	  imageUrl: '/assets/dist/img/Website-Maintenance.gif',
	  imageWidth: 400,
	  imageHeight: 200,
	  imageAlt: '',
	});
}
