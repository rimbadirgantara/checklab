const flashData = $('.flash-data').data('flashdata');
if (flashData) {
	Swal.fire({
		title: flashData,
		text: '',
		icon: 'success'
	});
}

const loginLoginFlashData = $('.login-flash-data'). data('flashdata');
if (loginLoginFlashData) {
	Swal.fire({
		title: loginLoginFlashData,
		text: '',
		icon: 'warning'
	});
}

const BerhasilLogin = $('.berhasillogin').data('flashdata');
if (BerhasilLogin) {
	Swal.fire({
		title: BerhasilLogin,
		text: '',
		icon: 'success'
	});
}

const Formatwaktutidakvalid = $('.formatwaktutidakvalid').data('flashdata');

if (Formatwaktutidakvalid) {
	Swal.fire({
		title: Formatwaktutidakvalid,
		text: '',
		icon: 'error'
	});
}

const Hapusbooking = $('.hapusbooking').data('flashdata');

if (Hapusbooking) {
	Swal.fire({
		title: Hapusbooking,
		text: '',
		icon: 'success'
	});
}

const Updateprofile = $('.updateprofile').data('flashdata');

if (Updateprofile) {
	Swal.fire({
	  title: Updateprofile,
	  text: '',
	  imageUrl: '/assets/dist/img/Website-Maintenance.gif',
	  imageWidth: 400,
	  imageHeight: 200,
	  imageAlt: '',
	});
}

const Hapususer = $('.flashdatauser').data('flashdata');

if (Hapususer) {
	Swal.fire({
		title: Hapususer,
		text: '',
		icon: 'success'
	});
}