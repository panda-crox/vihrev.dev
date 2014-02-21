<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Vihrev</title>
	<link href="/assets/css/styles.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhLxDE78q5-SKIg1jMghOMVyZeHTT7HWg&sensor=true"></script>
	<script src="/assets/js/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="/assets/js/jquery.bxslider.min.js" type="text/javascript"></script>
	<script src="/assets/js/jquery.scrollTo.min.js" type="text/javascript"></script>
	<script src="/assets/js/history.min.js" type="text/javascript"></script>
	<script src="/assets/js/scripts.js" type="text/javascript"></script>
</head>

<body class="<?php echo $this->isAdmin ? 'admin' : 'site' ?>">
	<header class="b-header">
		<?php if (!$this->isAdmin) : ?>
		<div class="b-logo"><a href="/"><img src="/assets/images/logo.png"></a></div>

		<div class="b-social">
			<a href="#" target="_blank"><i class="icon-vkontakte"></i></a>
			<a href="#" target="_blank"><i class="icon-facebook"></i></a>
			<a href="#" target="_blank"><i class="icon-twitter"></i></a>
		</div>

		<div class="b-order-btn"><a href="#">ЗАКАЗАТЬ</a></div>
		<?php endif; ?>

		<nav class="b-nav">
			<?php foreach ($GLOBALS['nav'] as $item) :
			if ($item['side'] == 'both' || ($item['side'] == 'admin' && $this->isAdmin) || ($item['side'] == 'site' && !$this->isAdmin)) : ?>
			<div class="b-nav__item <?php if (@strpos($this->requestPath, $item['url']) !== false || $this->requestPath == $item['url']) echo 'active' ?>">
				<a href="/<?php echo $item['url'] ?>" class="<?php if (@strpos($this->requestPath, $item['url']) !== false || $this->requestPath == $item['url']) echo 'current' ?>"><?php echo $item['caption'] ?><?php if ($item['childs'] && !$this->isAdmin) : ?> <i class="icon-menu"></i><?php endif; ?></a>
				<?php if ($item['childs']) : ?>
				<nav class="b-nav__item__popup">
					<?php foreach ($item['childs'] as $child) :
					if ($child['side'] == 'both' || ($child['side'] == 'admin' && $this->isAdmin) || ($child['side'] == 'site' && !$this->isAdmin)) : ?>
					<a href="/<?php echo $child['url'] ?>" class="<?php if (@strpos($this->requestPath, $child['url']) !== false) echo 'current' ?>"><?php echo $child['caption'] ?></a>
				<?php endif; endforeach; ?>
				</nav>
				<?php endif; ?>
			</div>
			<?php endif; endforeach; ?>
			<?php if (!$this->isAdmin) : ?>
			<div class="b-nav__item spec"><a href="#">СДЕЛАЙ САМ</a></div>
			<?php endif; ?>
		</nav>
	</header>


	<section class="b-section">
		<div class="b-content">
			<?php if ($GLOBALS['content']) : echo $GLOBALS['content']; endif; ?>
		</div>
		<div class="clearfix"></div>
	</section>


	<footer class="b-footer">
		<div class="b-logo"><img src="/assets/images/logo-2.png"></div>
		<div class="b-contacts">
			<span class="b-contacts__item"><i class="icon-mail"></i>wvihrev@gmail.com</span>
			<span class="b-contacts__item"><i class="icon-skype"></i>wvihrev</span>
			<span class="b-contacts__item"><i class="icon-mobile"></i>+7(931) 3374837</span>
		</div>
		<div class="b-name">ДИЗАЙН-СТУДИЯ ВЛАДИМИРА ВИХРЕВА</div>
	</footer>
</body>
</html>