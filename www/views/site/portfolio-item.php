<?php if ($GLOBALS['portfolio-item']['html']) : ?>
<iframe src="/files/<?php echo $GLOBALS['portfolio-item']['html'] ?>" frameborder="0" scrolling="no" onload='javascript:resizeIframe(this);'></iframe>
<?php else : ?>
шаблон работы
<?php endif; ?>

<div class="b-pager">
	<div class="container">
		<?php if ($GLOBALS['portfolio-item']['prev_id']) : ?>
		<a href="/<?php echo $GLOBALS['portfolio-item']['prev_url'] ?>" class="b-pager__prev">&lt;&lt; <i><?php echo $GLOBALS['portfolio-item']['prev_name'] ?></i></a>
		<?php endif; ?>
		<?php if ($GLOBALS['portfolio-item']['next_id']) : ?>
		<a href="/<?php echo $GLOBALS['portfolio-item']['next_url'] ?>" class="b-pager__next"><i><?php echo $GLOBALS['portfolio-item']['next_name'] ?></i> &gt;&gt;</a>
		<?php endif; ?>
	</div>
	<div class="clearfix"></div>
</div>