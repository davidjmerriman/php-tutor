var editor = ace.edit("editor");
editor.setTheme("ace/theme/twilight");
editor.getSession().setMode("ace/mode/php");

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