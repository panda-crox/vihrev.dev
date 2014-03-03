<?php if ($GLOBALS['portfolio-item']['html']) : ?>
<iframe src="/files/<?php echo $GLOBALS['portfolio-item']['html'] ?>" frameborder="0" scrolling="no" onload='javascript:onloadIframe(this);'></iframe>
<?php else : ?>
<div class="b-portfolio-item">
	<div class="b-portfolio-item__title"><?php echo $GLOBALS['portfolio-item']['name'] ?></div>
	<?php if ($GLOBALS['portfolio-item']['flash']) : $size = getimagesize($_SERVER['DOCUMENT_ROOT'].'/files/'.$GLOBALS['portfolio-item']['flash']); ?>
	<div class="b-portfolio-item__file flash-yes">
		<object type="application/x-shockwave-flash" data="/files/<?php echo $GLOBALS['portfolio-item']['flash'] ?>" width="<?php echo $size[0] ?>" height="<?php echo $size[1] ?>">
		  <param name="movie" value="/files/<?php echo $GLOBALS['portfolio-item']['flash'] ?>">
		  <param name="quality" value="high">
			<param name="wmode" value="transparent" />
		</object>
	</div>
	<?php endif; if ($GLOBALS['portfolio-item']['gif']) : ?>
	<div class="b-portfolio-item__file flash-no"><img src="/files/<?php echo $GLOBALS['portfolio-item']['gif'] ?>"></div>
	<?php endif; if ($GLOBALS['portfolio-item']['text']) : ?>
	<div class="b-portfolio-item__text"><div class="container"><?php echo nl2br($GLOBALS['portfolio-item']['text']) ?></div></div>
	<?php endif; if ($files = $GLOBALS['portfolio-item']['jpg_png']) : foreach ($files as $file) : ?>
	<p class="b-portfolio-item__file"><img src="/files/<?php echo $file ?>"></p>
	<?php endforeach; endif; ?>
</div>
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