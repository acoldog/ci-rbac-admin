;
$(function(){
	$('.accordion-toggle').on('click', function(){
		if($(this).find('.glyphicon-chevron-down').length > 0) {
			$(this).find('.glyphicon-chevron-down').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-right');
		}else{
			$(this).find('.glyphicon-chevron-right').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-down');
		}
	});
})


/**
 * [showModalImage description]
 * @param  {[type]} obj [description]
 * @return {[type]}     [description]
 */
function showModalImage(obj) {
	var _src = $(obj).attr('src'),
		_class = $(obj).attr('class'),
		_id = _class.split('-')[2];

	$('#modal_body').html('<img id="modalpic-'+ _id +'" src="'+ _src +'">');
	$('#acolModal').modal('show');
}

/**
 * [modalNext description]
 * @param  {[type]} action [description]
 * @return {[type]}        [description]
 */
function modalNext(action) {
	var _imgObj = $('#modal_body').find('img').first();
		_class = _imgObj.attr('id'),
		_id = _class.split('-')[1];

	if (action == '-') {
		if (_id - 1 >= 0) {
			_prev_class = 'modal-pic-'+ (_id - 1);
			_prev_imgObj = $('.'+ _prev_class);
			if (_prev_imgObj.length == 0) {
				return false;
			}
			_src = _prev_imgObj.attr('src');

			$('#modal_body').html('<img id="modalpic-'+ (_id - 1) +'" src="'+ _src +'">');
		}
	}else{

		_prev_class = 'modal-pic-'+ (+_id + 1);
		_prev_imgObj = $('.'+ _prev_class);
		if (_prev_imgObj.length == 0) {
			return false;
		}
		_src = _prev_imgObj.attr('src');

		$('#modal_body').html('<img id="modalpic-'+ (+_id + 1) +'" src="'+ _src +'">');

	}
}
