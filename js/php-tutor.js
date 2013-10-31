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
				data: 'code=' + encodeURI( editor.getValue() ) + '&' + $('#inputForm').serialize(),
				dataType: 'json',
				success: function( data ) {
					// TODO: hide overlay
					$('#outputContainer').html(data.output);
					$('#executionTime').html(Math.round(data.time * 1000000)/1000000 + ' s');
				}
			});
		});

		$('#addVariable').click( function(e) {
			$('#inputVariables').append('<fieldset><input name="input[names][]" type="text"><input name="input[values][]" type="text"><button class="deleteVariable" type="button">x</button></fieldset>');
		});
	}

	$(document).on( 'click', '.deleteVariable', function(e) {
		$(this).parent().remove();
	});

	$('nav li').mouseenter( function(e) {
		$('nav li').removeClass('selected');
		$(this).addClass('selected');
		$('.desc').fadeOut(100);
		$('.desc.' + $(this).attr('id')).delay(100).fadeIn(100);
	});
});