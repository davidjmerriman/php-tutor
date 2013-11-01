$(document).ready( function() {
	if( 0 < $('#editor').size() ) {
		var editor = ace.edit("editor");
		editor.setTheme("ace/theme/twilight");
		editor.getSession().setMode("ace/mode/php");

		$('#test').click( function(e) {
			$('.loading').show();
			showOverlay( false );
			$.ajax({
				url: '../test/hello',
				method: 'post',
				data: 'code=' + encodeURI( editor.getValue() ) + '&' + $('#inputForm').serialize(),
				dataType: 'json',
				success: function( data ) {
					hideOverlay();
					$('#outputContainer').html(data.output);
					$('#executionTime').html(Math.round(data.time * 1000000)/1000000 + ' s');
				}
			});
		});

		$('#grade').click( function(e) {
			// TODO: show overlay
			$('.loading').show();
			showOverlay( true );
			$.ajax({
				url: '../grade/hello',
				method: 'post',
				data: 'code=' + encodeURI( editor.getValue() ),
				dataType: 'json',
				success: function( data ) {
					$('.score').html(data.grade);
					$('.breakdown').empty();
					for( i in data.datasets ) {
						var dataset = data.datasets[i];
						$('.breakdown').append('<li>' + dataset.name + ': ' + ( dataset.pass ? '<span class="pass">pass</span>' : '<span class="fail">fail</span>' ) + ' in ' + ( Math.round(dataset.time * 1000000)/1000000 ) + 's <p>output: <pre>' + dataset['output'] + '</pre></p></li>')
					}
					$('.loading').fadeOut(250);
					$('.grades').delay(300).fadeIn(250);
				}
			});
		});

		$('#addVariable').click( function(e) {
			$('#inputVariables').append('<fieldset><input name="input[names][]" type="text"><input name="input[values][]" type="text"><button class="deleteVariable" type="button">x</button></fieldset>');
		});

		$('.close-overlay').click( function(e) {
			hideOverlay();
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

	function showOverlay( showClose ) {
		if( showClose ) {
			$('.close-overlay').show();
		} else {
			$('.close-overlay').hide();
		}
		$('.overlay').fadeIn(250);
	}

	function hideOverlay() {
		$('.overlay').fadeOut(250);
		$('.overlay').children().hide();
	}
});