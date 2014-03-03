<!doctype html>
<html class="site">
<head>
	<meta charset="UTF-8">
	<title>Vihrev</title>
	<link href="/assets/fancybox/jquery.fancybox.css?v=2.1.5" rel="stylesheet" type="text/css" media="screen" />
	<link href="/assets/css/styles.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
	<script src="/assets/js/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="/assets/js/jquery.bxslider.min.js" type="text/javascript"></script>
	<script src="/assets/js/SimpleAjaxUploader.min.js" type="text/javascript"></script>
	<script src="/assets/js/history.min.js" type="text/javascript"></script>
	<script src="/assets/fancybox/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript"></script>
	<?php if ($GLOBALS['isAdmin']) : ?>
	<script src="/assets/tinymce/tinymce.min.js" type="text/javascript"></script>
	<?php endif; ?>
	<script src="/assets/js/scripts.js" type="text/javascript"></script>
</head>

<body class="<?php echo $GLOBALS['isAdmin'] ? 'admin' : 'client' ?>">
	<header class="b-header">
		<?php if (!$GLOBALS['isAdmin']) : ?>
		<div class="b-logo"><a href="/"><img src="/assets/images/logo.png"></a></div>

		<div class="b-social">
			<a href="https://vk.com/" target="_blank"><i class="icon-vkontakte"></i></a>
			<a href="https://www.facebook.com/" target="_blank"><i class="icon-facebook"></i></a>
			<a href="https://twitter.com/" target="_blank"><i class="icon-twitter"></i></a>
		</div>

		<div class="b-order-btn"><a href="#">ЗАКАЗАТЬ</a></div>
		<?php endif; ?>

		<nav class="b-nav">
			<?php foreach ($GLOBALS['nav'] as $item) : ?>
			<div class="b-nav__item">
				<a href="/<?php echo $item['url'] ?>"><?php echo $item['caption'] ?><?php if ($item['childs'] && !$GLOBALS['isAdmin']) : ?> <i class="icon-menu"></i><?php endif; ?></a>
				<?php if ($item['childs']) : ?>
				<nav class="b-nav__item__popup">
					<?php foreach ($item['childs'] as $child) : ?>
					<a href="/<?php echo $child['url'] ?>"><?php echo $child['caption'] ?></a>
					<?php endforeach; ?>
					<?php if ($item['module'] == 'portfolio' && $GLOBALS['isAdmin']) : ?>
					<span data-form='{}'>Добавить работу</span>
					<a href="/<?php echo $item['url'] ?>?branches">Разделы</a>
					<?php endif; ?>
				</nav>
				<?php elseif ($item['module'] == 'price' && $GLOBALS['isAdmin']) : ?>
				<nav class="b-nav__item__popup">
					<?php foreach ($GLOBALS['nav'] as $item_) : if($item_['module'] != 'portfolio') continue;
					foreach ($item_['childs'] as $index => $child) :
					?>
					<a href="/<?php echo $item['url'] ?>?category=<?php echo $child['url_'] ?>"><?php echo $child['caption'] ?></a>
					<?php endforeach; endforeach; ?>
				</nav>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</nav>
	</header>


	<section class="b-section">
		<div class="b-content">
			<?php if ($GLOBALS['content']) : echo $GLOBALS['content']; endif; ?>
		</div>
		<div class="clearfix"></div>
	</section>

	<?php if (!$GLOBALS['isAdmin']) : ?>
	<footer class="b-footer">
		<div class="b-logo"><img src="/assets/images/logo-2.png"></div>
		<div class="b-contacts">
			<span class="b-contacts__item"><i class="icon-mail"></i>wvihrev@gmail.com</span>
			<span class="b-contacts__item"><i class="icon-skype"></i>wvihrev</span>
			<span class="b-contacts__item"><i class="icon-mobile"></i>+7(931) 3374837</span>
		</div>
		<div class="b-name">ДИЗАЙН-СТУДИЯ ВЛАДИМИРА ВИХРЕВА</div>
	</footer>
	<?php endif; ?>

	<div class="b-loading">
		<b class="b-loading__msg">Подождите. Идет загрузка</b>
	</div>
	<div class="b-alert">
		<div class="b-alert__msg">
			<h4 class="">Уведомление</h4>
			<div class="b-alert__msg__text">Уважаемый(-ая) клиент!<br>Ваша заявка принята. С вами свяжутся в ближайшее время для уточнения условий заказа.<br>С уважением, Дизайнт-Студия Владимира Вихрева.</div>
		</div>
	</div>
	<div class="b-overlay"></div>
	<div class="b-popup">
		<div class="b-popup__inner"></div>
	</div>
</body>
</html>