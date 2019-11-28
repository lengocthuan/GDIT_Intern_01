function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + ' animated');
};
$('#myModal').on('show.bs.modal', function (e) {
	var anim = 'flipInX';
	testAnim(anim);
})
$('#myModal').on('hide.bs.modal', function (e) {
	var anim = 'flipOutX';
	testAnim(anim);
	// let delayres = await delay(3000);
	// delay(1);
})