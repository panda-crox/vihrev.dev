<?php if (isset($GLOBALS['top-banner'])) : ?>
<table style="width: 600px;">
	<tr><th></th><th>ПРЕВЬЮ</th><th>ЦВЕТ ФОНА</th><th>РАБОТА</th><th>ДЕЙСТВИЯ</th></tr>
	<?php foreach ($GLOBALS['top-banner'] as $index => $item) : ?>
	<tr data-index="<?php echo $index ?>">
		<td class="small"><span class="sort">
			<?php if ($index) : ?>
			<span class="ctrl-up" data-queue='{"type": "up", "index": "<?php echo $item['index'] ?>", "table": "top-banner"}'></span>
			<?php endif; ?>
			<?php if ($index != count($GLOBALS['top-banner']) - 1) : ?>
			<span class="ctrl-down" data-queue='{"type": "down", "index": "<?php echo $item['index'] ?>", "table": "top-banner"}'></span>
			<?php endif; ?>
		</span></td>
		<td class="small">
			<a href="/files/<?php echo $item['file'] ?>" class="fancybox" target="_blank">
			<?php if (preg_match('/(\.(jpg|jpeg|png|gif))$/', $item['file'])) : ?>
				<img src="/files/<?php echo $item['file'] ?>" height="27">
				<?php elseif (preg_match('/(\.swf)$/', $item['file'])) : ?>
				<object type="application/x-shockwave-flash" data="/files/<?php echo $item['file'] ?>" width="100" height="27">
				  <param name="movie" value="/files/<?php echo $item['file'] ?>">
				  <param name="quality" value="high">
					<param name="wmode" value="transparent" />
				</object>
			<?php endif; ?>
			</a>
		</td>
		<td><?php echo $item['background'] ?></td>
		<td>
			<?php foreach ($GLOBALS['portfolio'] as $portfolio) : if ($item['portfolio'] == $portfolio['id']) : ?>
			<a href="http://<?php echo $GLOBALS['host'] ?>/<?php echo $portfolio['url'] ?>" class="vis" target="_blank"><?php echo $portfolio['name'] ?></a>
			<?php endif; endforeach; ?>
		</td>
		<td class="small">
			<i class="icon-pencil" title="Редактировать" data-form='{"id": "<?php echo $item['id'] ?>"}'></i>
			<i class="icon-cancel-circled" title="Удалить" data-delete='{"id": "<?php echo $item['id'] ?>", "table": "top-banner"}'></i>
		</td>
	</tr>
	<?php endforeach; ?>
	<tr><td colspan="5" style="text-align: center;"><span class="btn" data-form='{}'>ДОБАВИТЬ</span></td></tr>
</table>
<?php elseif (isset($GLOBALS['clients'])) : ?>
<table style="width: 600px;">
	<tr><th></th><th>ПРЕВЬЮ</th><th>ИМЯ</th><th>НА ГЛАВНУЮ</th><th>ДЕЙСТВИЯ</th></tr>
	<?php foreach ($GLOBALS['clients'] as $index => $item) : ?>
	<tr data-index="<?php echo $index ?>">
		<td class="small"><span class="sort">
			<?php if ($index) : ?>
			<span class="ctrl-up" data-queue='{"type": "up", "index": "<?php echo $item['index'] ?>", "table": "clients"}'></span>
			<?php endif; ?>
			<?php if ($index != count($GLOBALS['clients']) - 1) : ?>
			<span class="ctrl-down" data-queue='{"type": "down", "index": "<?php echo $item['index'] ?>", "table": "clients"}'></span>
			<?php endif; ?>
		</span></td>
		<td style="text-align: center;"><img src="/files/<?php echo $item['file'] ?>" height="27"></td>
		<td><?php echo $item['name'] ?></td>
		<td class="small">
			<input type="checkbox" <?php echo $item['on_frontpage'] ? 'checked' : '' ?> data-on-frontpage='{"id": "<?php echo $item['id'] ?>", "table": "clients"}'>
		</td>
		<td class="small">
			<i class="icon-pencil" title="Редактировать" data-form='{"id": "<?php echo $item['id'] ?>"}'></i>
			<i class="icon-cancel-circled" title="Удалить" data-delete='{"id": "<?php echo $item['id'] ?>", "table": "clients"}'></i>
		</td>
	</tr>
	<?php endforeach; ?>
	<tr><td colspan="5" style="text-align: center;"><span class="btn" data-form='{}'>ДОБАВИТЬ</span></td></tr>
</table>
<?php elseif (isset($GLOBALS['settings'])) : ?>
<form action="" method="POST">
	<table style="width: 300px;">
		<tr><td>ЛОГИН</td><td><input type="text" name="data[login]" value="<?php echo $GLOBALS['settings'][0]['login'] ?>" required></td></tr>
		<tr><td>ПАРОЛЬ</td><td><input type="password" name="data[password]" value="<?php echo $GLOBALS['settings'][0]['password'] ?>" required></td></tr>
		<tr><td colspan="2" class="small"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="table" value="settings">
	<input type="hidden" name="id" value="<?php echo $GLOBALS['settings'][0]['id'] ?>">
</form>
<?php elseif (isset($GLOBALS['services'])) : ?>
<table style="width: 600px;">
	<tr><th></th><th>ИЗОБРАЖЕНИЕ</th><th>ТЕКСТ</th><th>РАЗДЕЛ</th><th>ДЕЙСТВИЯ</th></tr>
	<?php foreach ($GLOBALS['services'] as $index => $item) : ?>
	<tr data-index="<?php echo $index ?>">
		<td class="small"><span class="sort">
			<?php if ($index) : ?>
			<span class="ctrl-up" data-queue='{"type": "up", "index": "<?php echo $item['index'] ?>", "table": "services"}'></span>
			<?php endif; ?>
			<?php if ($index != count($GLOBALS['services']) - 1) : ?>
			<span class="ctrl-down" data-queue='{"type": "down", "index": "<?php echo $item['index'] ?>", "table": "services"}'></span>
			<?php endif; ?>
		</span></td>
		<td class="small"><img src="/files/<?php echo $item['file'] ?>" class="vis" height="50"></td>
		<td><?php echo nl2br($item['text']) ?></td>
		<td class="small">
			<?php foreach ($GLOBALS['nav'] as $item_) : if($item_['module'] != 'portfolio') continue;
			foreach ($item_['childs'] as $child) : if ($item['category'] == $child['id']) :
			?>
			<a href="http://<?php echo $GLOBALS['host'] ?>/<?php echo $child['url'] ?>" class="vis" target="_blank"><?php echo $child['caption'] ?></a>
			<?php endif; endforeach; endforeach; ?>
		</td>
		<td class="small">
			<i class="icon-pencil" title="Редактировать" data-form='{"id": "<?php echo $item['id'] ?>"}'></i>
			<i class="icon-cancel-circled" title="Удалить" data-delete='{"id": "<?php echo $item['id'] ?>", "table": "services"}'></i>
		</td>
	</tr>
	<?php endforeach; ?>
	<tr><td colspan="5" style="text-align: center;"><span class="btn" data-form='{}'>ДОБАВИТЬ</span></td></tr>
</table>
<?php endif; ?>