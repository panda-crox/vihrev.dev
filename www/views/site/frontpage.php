<?php if ($GLOBALS['top-banner']) : ?>
<div class="b-banners">
	<div class="b-banners__slider">
		<?php foreach ($GLOBALS['top-banner'] as $item) : $fileParams = getimagesize($_SERVER['DOCUMENT_ROOT'] . '/files/' . $item['file']); ?>
		<div class="b-slide" style="background: <?php echo $item['background'] ?>">
			<div class="container">
				<a href="<?php echo $item['url'] ?>">
					<?php if (preg_match('/(\.(jpg|jpeg|png|gif))$/', $item['file'])) : ?>
					<img src="/files/<?php echo $item['file'] ?>">
					<?php elseif (preg_match('/(\.swf)$/', $item['file'])) : ?>
					<object type="application/x-shockwave-flash" data="/files/<?php echo $item['file'] ?>" width="100%" height="300">
					  <param name="movie" value="/files/<?php echo $item['file'] ?>">
					  <param name="quality" value="high">
						<param name="wmode" value="transparent" />
					</object>
					<?php endif; ?>
				</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>

<?php if ($GLOBALS['previews']) : ?>
<div class="b-previews">
	<?php foreach ($GLOBALS['previews'] as $item) : ?>
	<div class="b-previews__item">
		<a href="/<?php echo $item['url'] ?>">
			<img src="/files/<?php echo $item['preview'] ?>" alt="">
			<div class="b-previews__item__popup">
				<span class="b-previews__item_type"><?php echo $item['category_name'] ?></span>
				<div class="b-previews__item_name"><?php echo $item['name'] ?></div>
				<div class="b-previews__item_desc"><?php echo $item['introtext'] ?></div>
			</div>
		</a>
	</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<?php if ($GLOBALS['clients']) : ?>
<div class="b-clients">
	<?php foreach ($GLOBALS['clients'] as $item) : ?>
	<div class="b-clients__item"><img src="/files/<?php echo $item['file'] ?>" alt=""></div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<div class="b-services">
	<div class="b-services__item">
		<div class="b-services__item__image"><img src="assets/images/service-1.png" alt=""></div>
		<div class="b-services__item__text">
			<div>СОЗДАНИЕ HTML5 БАННЕРОВ</div>
			<div>Креативные идеи на всех устройствах.<br>Интересные анимации, адаптивность.<br>Отличный инструмент медийной рекламы!</div>
			<a href="#" class="b-services__item__more">ОБЗОР</a>
		</div>
	</div>
	<div class="b-services__item">
		<div class="b-services__item__image"><img src="assets/images/service-2.png" alt=""></div>
		<div class="b-services__item__text">
			<div>ЛОГОТИП И ФИРМЕННЫЙ СТИЛЬ</div>
			<div>Современнные и стильные логотипы, точно отражающие последние тенденции времени.<br>Вас заметят и будут узнавать!</div>
			<a href="#" class="b-services__item__more">ОБЗОР</a>
		</div>
	</div>
	<div class="b-services__item">
		<div class="b-services__item__image"><img src="assets/images/service-3.png" alt=""></div>
		<div class="b-services__item__text">
			<div>ПОЛИГРАФИЯ</div>
			<div>Буклеты, визитки, билборды и многое другое, сделаем красиво и качественно в удобные для Вас сроки!</div>
			<a href="#" class="b-services__item__more">ОБЗОР</a>
		</div>
	</div>
</div>