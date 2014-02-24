<?php if (isset($GLOBALS['top-banner'])) : ?>
<form action="" method="POST" class="b-admin-banners">
	<table>
		<tr>
			<td class="small">ВЫБРАТЬ ФАЙЛ</td>
			<td colspan="4">
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[file]"></span>
					<ol class="selected-files"></ol>
				</div>
				<input type="text" name="data[url]" style="width: 250px; margin: 0 10px;" placeholder="URL"> <span class="b-admin-banners__format">(jpg, png, swf, html5)</span>
			</td>
			<td rowspan="2"><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
		<tr>
			<td class="small">ЦВЕТ ФОНА</td>
			<td colspan="4"><input type="text" name="data[background]" style="width: 70px;" required></td>
		</tr>
		<tr>
			<th></th><th>&#8470;</th><th></th><th>ПРЕВЬЮ</th><th>URL</th><th>УДАЛИТЬ</th>
		</tr>
		<?php foreach ($GLOBALS['top-banner'] as $key => $item) : ?>
		<tr>
			<?php if (!$key) : ?>
			<td rowspan="<?php echo count($GLOBALS['top-banner']) ?>" class="small">УДАЛИТЬ, ПЕРЕМЕСТИТЬ БАННЕР</td>
			<?php endif; ?>
			<td class="small"><?php echo $key + 1 ?></td>
			<td class="small"><span class="sort">
				<?php if ($key) : ?>
				<span class="ctrl-up"></span>
				<?php endif; ?>
				<?php if ($key != count($GLOBALS['top-banner']) - 1) : ?>
				<span class="ctrl-down"></span>
				<?php endif; ?>
			</span></td>
			<td style="width: 0; text-align: center;"><img src="/files/<?php echo $item['file'] ?>"></td>
			<td><?php echo $item['url'] ?></td>
			<td class="small"><i class="icon-cancel-circled" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "top-banner"}'></i></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="top-banner">
</form>
<?php elseif (isset($GLOBALS['clients'])) : ?>
<form action="" method="POST" class="b-admin-clients">
	<table>
		<tr>
			<th>&#8470;</th><th></th><th>ПРЕВЬЮ</th><th>ИМЯ</th><th>НА ГЛАВНУЮ</th><th>УДАЛИТЬ</th>
		</tr>
		<?php foreach ($GLOBALS['clients'] as $key => $item) : ?>
		<tr>
			<td class="small"><?php echo $key + 1 ?></td>
			<td class="small"><span class="sort">
				<?php if ($key) : ?>
				<span class="ctrl-up"></span>
				<?php endif; ?>
				<?php if ($key != count($GLOBALS['clients']) - 1) : ?>
				<span class="ctrl-down"></span>
				<?php endif; ?>
			</span></td>
			<td><img src="/files/<?php echo $item['file'] ?>"></td>
			<td><?php echo $item['name'] ?></td>
			<td><?php echo $item['on_frontpage'] ?></td>
			<td class="small"><i class="icon-cancel-circled" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "clients"}'></i></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<div style="margin-left: 20px;">
		<p><input type="text" name="data[name]" style="width: 250px;" placeholder="ИМЯ"></p>
		<div class="uploader">
			<div>ПРЕВЬЮ: jpg/png</div>
			<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[file]"></span>
			<ol class="selected-files"></ol>
		</div>
		<p><button type="submit" class="btn">ДОБАВИТЬ</button></p>
	</div>
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="clients">
</form>
<?php elseif (isset($GLOBALS['settings'])) : ?>
<form action="" method="POST" class="b-admin-settings">
	<table>
		<tr><td>ЛОГИН</td><td><input type="text" name="data[login]" value="<?php echo $GLOBALS['settings'][0]['login'] ?>" required></td></tr>
		<tr><td>ПАРОЛЬ</td><td><input type="password" name="data[password]" value="<?php echo $GLOBALS['settings'][0]['password'] ?>" required></td></tr>
		<tr><td colspan="2" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="table" value="settings">
	<input type="hidden" name="id" value="<?php echo $GLOBALS['settings'][0]['id'] ?>">
</form>
<?php endif; ?>