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
				<h1><?=$lesson['title']?></h1>
			</header>
			<main>
				<section class="left col">
					<button id="slideLeft">&lt;</button>
					<button id="slideRight">&gt;</button>
					<div class="clear"></div>
				</section>
				<section class="middle col">
					<div id="editor"><?=htmlentities($lesson['code'])?></div>
					<section class="submitter">
						<form id="submitter" method="POST" action="grader.php">
							<button type="button" id="test">Test</button>
							<button type="button" id="grade">Grade</button>
						</form>
					</section>
				</section>
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
		<section class="overlay hide">
			<button class="close-overlay">x</button>
			<section class="loading hide">Executing your code....Please wait...</section>
			<section class="grades hide">
				<header>
					<h1>Grades</h1>
				</header>
				<ul class="report-card">
					<li>Overall Score: <span class="score"></span></li>
					<li>Breakdown:
						<ul class="breakdown">
						</ul>
					</li>
				</ul>
			</section>
		</section>
		<script>
			window.lessonName = '<?=$lesson['name']?>';
			window.slides = ['<?=implode("','", $lesson['content'])?>'];
		</script>
		<script src="../../js/php-tutor.js"></script>
	</body>
</html>