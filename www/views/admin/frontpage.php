<?php if (isset($GLOBALS['top-banner'])) : ?>
<form action="" method="POST" class="b-admin-banners">
	<table>
		<tr>
			<td class="small">ВЫБРАТЬ ФАЙЛ</td>
			<td colspan="4">
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="i-data[file]"></span>
					<ol class="selected-files"></ol>
				</div>
				<span class="b-format">(jpg, png, swf)</span>
				<input type="text" name="i-data[url]" style="width: 250px; margin: 0 10px;" placeholder="URL">
			</td>
			<td rowspan="2"><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
		<tr>
			<td class="small">ЦВЕТ ФОНА</td>
			<td colspan="4"><input type="text" name="i-data[background]" style="width: 70px;" required></td>
		</tr>
		<tr>
			<th></th><th>&#8470;</th><th></th><th>ПРЕВЬЮ</th><th>URL</th><th>УДАЛИТЬ</th>
		</tr>
		<?php foreach ($GLOBALS['top-banner'] as $index => $item) : ?>
		<tr>
			<?php if (!$index) : ?>
			<td rowspan="<?php echo count($GLOBALS['top-banner']) ?>" class="small">УДАЛИТЬ, ПЕРЕМЕСТИТЬ БАННЕР</td>
			<?php endif; ?>
			<td class="small"><?php echo $index + 1 ?></td>
			<td class="small"><span class="sort">
				<?php if ($index) : ?>
				<span class="ctrl-up" data-change-queue='{"type": "up", "index": "<?php echo $item['index'] ?>", "table": "top-banner"}'></span>
				<?php endif; ?>
				<?php if ($index != count($GLOBALS['top-banner']) - 1) : ?>
				<span class="ctrl-down" data-change-queue='{"type": "down", "index": "<?php echo $item['index'] ?>", "table": "top-banner"}'></span>
				<?php endif; ?>
			</span></td>
			<td style="width: 0; text-align: center;">
				<?php if (preg_match('/(\.(jpg|jpeg|png|gif))$/', $item['file'])) : ?>
				<img src="/files/<?php echo $item['file'] ?>">
				<?php elseif (preg_match('/(\.swf)$/', $item['file'])) : ?>
				<object type="application/x-shockwave-flash" data="/files/<?php echo $item['file'] ?>" width="100%" height="100%">
				  <param name="movie" value="/files/<?php echo $item['file'] ?>">
				  <param name="quality" value="high">
					<param name="wmode" value="transparent" />
				</object>
				<?php endif; ?>
			</td>
			<td><?php echo $item['url'] ?></td>
			<td class="small"><i class="icon-cancel-circled" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "top-banner"}'></i></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<input type="hidden" name="i-data[index]" value="<?php echo $GLOBALS['top-banner'][count($GLOBALS['top-banner']) - 1]['index'] + 1; ?>">
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="top-banner">
</form>
<?php elseif (isset($GLOBALS['clients'])) : ?>
<form action="" method="POST" class="b-admin-clients">
	<table>
		<tr>
			<th>&#8470;</th><th></th><th>ПРЕВЬЮ</th><th>ИМЯ</th><th>НА ГЛАВНУЮ</th><th>УДАЛИТЬ</th>
		</tr>
		<?php foreach ($GLOBALS['clients'] as $index => $item) : ?>
		<tr data-index="<?php echo $index ?>">
			<td class="small"><?php echo $index + 1 ?></td>
			<td class="small"><span class="sort">
				<?php if ($index) : ?>
				<span class="ctrl-up" data-change-queue='{"type": "up", "index": "<?php echo $item['index'] ?>", "table": "clients"}'></span>
				<?php endif; ?>
				<?php if ($index != count($GLOBALS['clients']) - 1) : ?>
				<span class="ctrl-down" data-change-queue='{"type": "down", "index": "<?php echo $item['index'] ?>", "table": "clients"}'></span>
				<?php endif; ?>
			</span></td>
			<td style="text-align: center;"><img src="/files/<?php echo $item['file'] ?>"></td>
			<td><?php echo $item['name'] ?></td>
			<td style="text-align: center;">
				<input type="hidden" name="u-data[on_frontpage]" value="0">
				<input type="checkbox" name="u-data[on_frontpage]" value="1" <?php echo $item['on_frontpage'] ? 'checked' : '' ?> data-update='{"index": "<?php echo $index ?>", "id": "<?php echo $item['id'] ?>", "table": "clients"}'>
			</td>
			<td class="small"><i class="icon-cancel-circled" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "clients"}'></i></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td></td><td></td>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="i-data[file]"></span>
					<ol class="selected-files"></ol>
				</div>
				<span class="b-format">jpg/png</span>
			</td>
			<td><input type="text" name="i-data[name]" placeholder="ИМЯ"></td>
			<td style="text-align: center;"><input type="checkbox" name="i-data[on_frontpage]" value="1"></td>
			<td><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
	</table>
	<input type="hidden" name="i-data[index]" value="<?php echo $GLOBALS['clients'][count($GLOBALS['clients']) - 1]['index'] + 1; ?>">
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="clients">
</form>
<?php elseif (isset($GLOBALS['settings'])) : ?>
<form action="" method="POST" class="b-admin-settings">
	<table>
		<tr><td>ЛОГИН</td><td><input type="text" name="u-data[login]" value="<?php echo $GLOBALS['settings']['login'] ?>" required></td></tr>
		<tr><td>ПАРОЛЬ</td><td><input type="password" name="u-data[password]" value="<?php echo $GLOBALS['settings']['password'] ?>" required></td></tr>
		<tr><td colspan="2" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="table" value="settings">
	<input type="hidden" name="id" value="<?php echo $GLOBALS['settings']['id'] ?>">
</form>
<?php endif; ?>