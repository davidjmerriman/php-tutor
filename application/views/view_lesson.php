<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../../css/php-tutor.css">
		<script src="../../lib/ace-builds/src-min-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
		<script src="../../lib/jquery/jquery.min.js"></script>
	</head>
	<body>
		<article class="lesson">
			<header>
				<h1>Hello, World!</h1>
			</header>
			<main>
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
							<button type="button" id="test">Test</button>
							<button type="button" id="grade">Grade</button>
						</form>
					</div>
				</div>
				<section class="right col">
					<section class="input">
						<header>
							<h1>Input</h1>
						</header>
						<form id="inputForm">
							<section id="inputVariables">
								<fieldset>
									<input name="input[method]" type="radio" value="GET" checked>
									<label>GET</label>
									<input name="input[method]" type="radio" value="POST">
									<label>POST</label>
									<button type="button" id="addVariable">Add Input</button>
								</fieldset>
							</section>
						</form>
					</section>
					<section class="output">
						<header>
							<h1>Output</h1>
						</header>
						<section id="outputContainer">
						</section>
						<footer>
							Execution time: <span id="executionTime">N/A</span>
						</footer>
					</section>
				</section>
			</main>
		</article>
		<script src="../../js/php-tutor.js"></script>
	</body>
</html>