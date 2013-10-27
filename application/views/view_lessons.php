<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="css/php-tutor.css">
		<script src="lib/jquery/jquery.min.js"></script>
	</head>
	<body>
		<article class="lessons">
			<header>
				<h1>PHP Tutor</h1>
			</header>
			<main>
				<nav>
					<ul>
						<li class="selected" id="default">Introduction</li>
						<? foreach($lessons as $lesson) { ?>
							<li id="<?=$lesson['name']?>">
								<a href="index.php/view/<?=$lesson['name']?>"><?=$lesson['title']?></a>
							</li>
						<? } ?>
					</ul>
				</nav>
				<section class="description">
					<section class="desc default">
						<p>Welcome to PHP Tutor, an interactive learning tool to get you learning,
						understanding, and <em>writing</em> PHP as fast as humanly possible.</p>
						<p>Choose from a selection of lessons to the left, and you'll be learning
						and coding solutions on a variety of topics, from the obligatory "Hello, 
						World!" introduction through advanced object-oriented programming and on to
						performance, scalability, complexity analysis, and security.</p>
						</section>
					<? foreach($lessons as $lesson) { ?>
						<a href="index.php/view/<?=$lesson['name']?>">
							<section class="hide desc <?=$lesson['name']?>"><?=$lesson['desc']?></section>
						</a>
					<? } ?>
				</section>
			</main>
		</article>
		<script>
			$(document).ready( function() {
				$('nav li').mouseenter( function(e) {
					$('nav li').removeClass('selected');
					$(this).addClass('selected');
					$('.desc').fadeOut(100);
					$('.desc.' + $(this).attr('id')).delay(100).fadeIn(100);
				});
			});
		</script>
	</body>
</html>