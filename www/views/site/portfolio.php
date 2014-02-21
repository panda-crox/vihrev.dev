<div class="b-portfolio">
	<?php if ($GLOBALS['portfolio']) : foreach ($GLOBALS['portfolio'] as $item) : ?>
	<div class="b-portfolio__item">
		<a href="/<?php echo $item['url'] ?>">
			<img src="/files/<?php echo $item['preview'] ?>" alt="">
			<div class="b-portfolio__item__popup">
				<span class="b-portfolio__item_type"><?php echo $item['category_name'] ?></span>
				<div class="b-portfolio__item_name"><?php echo $item['name'] ?></div>
				<div class="b-portfolio__item_desc"><?php echo $item['introtext'] ?></div>
			</div>
		</a>
	</div>
	<?php endforeach; endif; ?>
	<div class="clearfix"></div>
</div>