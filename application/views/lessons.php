<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/php-tutor.css">
	</head>
	<body class="lessons">
		<article class="lessons">
			<header>
				<h1>PHP Tutor</h1>
			</header>
			<nav>
				<ul>
					<?php foreach($lessons as $lesson) { ?>
						<li>
							<a href="index.php/view/<?=$lesson['name']?>">
								<span class="term"><?=$lesson['title']?></span>
								<p class="definition"><?=$lesson['desc']?></p>
							</a>
						</li>
					<?php } ?>
				</ul>
			</nav>
		</article>
	</body>
</html>