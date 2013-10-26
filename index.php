<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Editor</title>
	<link rel="stylesheet" type="text/css" href="css/php-tutor.css">
</head>
<body>
<div class="title">
	<h1>Hello, World!</h1>
</div>
<div class="main">
	<div class="left col">
		<h2>Lesson Contents</h2>
		<p>Contents, yay!</p>
	</div>
	<div class="middle col">
		<div id="editor">&lt;?php
	foreach( $_GET as $key => $value ) {
		echo "$key, $value!";
	}
?&gt;</div>
		<div class="submitter">
			<form id="submitter" method="POST" action="grader.php">
				<input type="submit">
			</form>
		</div>
	</div>
	<div class="right col">
		<div class="input">Input</div>
		<div class="output">Output</div>
	</div>
</div>

<script src="lib/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="lib/jquery/jquery.min.js"></script>
<script src="js/php-tutor.js"></script>

</body>
</html>