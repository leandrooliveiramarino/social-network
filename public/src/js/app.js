var postId = 0;
var postBodyElement = null;

$('.post').find('.interaction').find('.edit').on('click', function(event){
	event.preventDefault();

	postBodyElement = event.target.parentNode.parentNode.childNodes[1];
	var postBody = event.target.parentNode.parentNode.childNodes[1].textContent;
	postId = event.target.parentNode.parentNode.dataset['postid'];
	$('#post-body').val(postBody);
	$('#edit-modal').modal();
});

$('#modal-save').on('click', function(){
	$.ajax({
		method: 'POST',
		url: url,
		data: {
			body: $('#post-body').val(),
			postId: postId,
			_token: token
		}
	}).done(function(msg) {
		$(postBodyElement).text(msg['new_body']);
		$("#edit-modal").modal('hide');
	});
});

$('.like').on('click', function(event){
	event.preventDefault();
	postId = event.target.parentNode.parentNode.dataset['postid'];
	var isLike = event.target.previousElementSibling == null ? true : false;
	$.ajax({
		method: 'POST',
		url: urlLike,
		data: {
			isLike: isLike,
			postId: postId,
			_token: token
		}
	}).done(function(){
		event.target.innerText = isLike 
			? event.target.innerText == 'Like' 
				? 'Você gostou desta postagem' 
				: 'Like' 
			: event.target.innerText == 'Dislike' 
				? 'Você não gostou desta postagem' 
				: 'Dislike';

		if(isLike) {
			event.target.nextElementSibling.innerText = 'Dislike';
		} else {
			event.target.previousElementSibling.innerText = 'Like';
		}
	}).error(function(){
		alert('error');
	});
});