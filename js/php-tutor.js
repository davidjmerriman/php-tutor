$(document).ready( function() {
	if( 0 < $('#editor').size() ) {
		var editor = ace.edit("editor");
		editor.setTheme("ace/theme/twilight");
		editor.getSession().setMode("ace/mode/php");

		$('#test').click( function(e) {
			// TODO: show overlay
			$.ajax({
				url: '../test/hello',
				method: 'post',
				data: 'code=' + encodeURI( editor.getValue() ),
				dataType: 'json',
				success: function( data ) {
					// TODO: hide overlay
					$('#outputContainer').html(data.output);
					$('#executionTime').html(Math.round(data.time * 1000000)/1000000 + ' s');
				}
			});
		} );
	}

	$('nav li').mouseenter( function(e) {
		$('nav li').removeClass('selected');
		$(this).addClass('selected');
		$('.desc').fadeOut(100);
		$('.desc.' + $(this).attr('id')).delay(100).fadeIn(100);
	});
});