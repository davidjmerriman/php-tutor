

$('#submitter').submit( function(e) {
	e.preventDefault();
	$.ajax({
		url: 'http://davidmerriman.net/grader/grader.php',
		method: 'post',
		data: 'code=' + encodeURI( editor.getValue() ),
		dataType: 'json',
		success: function( data ) {
			alert(JSON.stringify(data));
		}
	});
} );

$(document).ready( function() {
	if( 0 < $('#editor').size() ) {
		var editor = ace.edit("editor");
		editor.setTheme("ace/theme/twilight");
		editor.getSession().setMode("ace/mode/php");
	}

	$('nav li').mouseenter( function(e) {
		$('nav li').removeClass('selected');
		$(this).addClass('selected');
		$('.desc').fadeOut(100);
		$('.desc.' + $(this).attr('id')).delay(100).fadeIn(100);
	});
});