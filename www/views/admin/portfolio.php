<?php if (isset($_GET['add'])) : ?>
<form action="" method="POST" style="max-width: 750px; margin-left: 20px;">
	<p><input type="text" name="i-data[name]" placeholder="ИМЯ" required></p>
	<p><textarea name="i-data[introtext]" class="editor">Вводный текст</textarea></p>
	<p><textarea name="i-data[description]" class="editor">Описание</textarea></p>
	<table>
		<tr><th>ПРЕВЬЮ</th><th>FLASH</th><th>GIF</th><th>JPG/PNG</th><th>HTML</th><th>НА ГЛАВНУЮ</th><th>РАЗДЕЛ</th></tr>
		<tr>
			<td style="width: 13%;">
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="i-data[preview]"></span>
					<ol class="selected-files"></ol>
				</div>
			</td>
			<td style="width: 13%;">
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="i-data[flash]"></span>
					<ol class="selected-files"></ol>
				</div>
			</td>
			<td style="width: 13%;">
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="i-data[gif]"></span>
					<ol class="selected-files"></ol>
				</div>
			</td>
			<td style="width: 13%;">
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" multiple data-name="i-data[jpg_png]"></span>
					<ol class="selected-files"></ol>
				</div>
			</td>
			<td style="width: 13%;">
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="i-data[html]"></span>
					<ol class="selected-files"></ol>
				</div>
			</td>
			<td style="text-align: center;"><input type="checkbox" name="i-data[on_frontpage]" value="1"></td>
			<td>
				<select name="i-data[category]">
					<?php foreach ($GLOBALS['nav'] as $item) : if($item['module'] != 'portfolio') continue;
					foreach ($item['childs'] as $index => $child) :
					?>
					<option value="<?php echo $child['id'] ?>"><?php echo $child['caption'] ?></option>
					<?php endforeach; endforeach; ?>
				</select>
			</td>
		</tr>
	</table>
	<p style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></p>
	<input type="hidden" name="i-data[index]" value="<?php echo $GLOBALS['portfolio'][count($GLOBALS['portfolio']) - 1]['index'] + 1; ?>">
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="portfolio">
</form>
<?php elseif (isset($_GET['branches'])) : ?>
<form action="" method="POST" class="b-admin-price">
	<table>
		<tr><th>НАИМЕНОВАНИЕ</th><th>URL</th><th class="small">УДАЛИТЬ</th></tr>
		<?php foreach ($GLOBALS['nav'] as $item) : if($item['module'] != 'portfolio') continue;
		$portfolioId = $item['id'];
		foreach ($item['childs'] as $index => $child) :
		?>
		<tr data-index="<?php echo $index ?>">
			<td><span class="vis"><?php echo $child['caption'] ?></span><input type="text" name="u-data[caption]" value="<?php echo $child['caption'] ?>" required class="hidden"></td>
			<td><span class="vis"><?php echo $child['url_'] ?></span><input type="text" name="u-data[url]" value="<?php echo $child['url_'] ?>" required class="hidden"></td>
			<td style="text-align: center;">
				<i class="icon-pencil vis" data-edit="<?php echo $index ?>"></i>
				<i class="icon-cancel-circled vis" data-remove='{"id": "<?php echo $child['id'] ?>", "table": "navigation"}'></i>
				<i class="icon-floppy hidden" data-update='{"index": "<?php echo $index ?>", "id": "<?php echo $child['id'] ?>", "table": "navigation"}'></i>
			</td>
		</tr>
		<?php endforeach; endforeach; ?>
		<tr>
			<td><input type="text" name="i-data[caption]" placeholder="НАИМЕНОВАНИЕ" required></td>
			<td><input type="text" name="i-data[url]" placeholder="URL" required></td>
			<td><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
	</table>
	<input type="hidden" name="i-data[parent]" value="<?php echo $portfolioId ?>">
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="navigation">
</form>
<?php elseif (isset($GLOBALS['portfolio'])) : ?>
<table>
	<tr>
		<th>&#8470;</th><th></th><th>ПРЕВЬЮ</th><th>ИМЯ</th><th>Вводный текст</th><th>НА ГЛАВНУЮ</th><th>УДАЛИТЬ</th>
	</tr>
	<?php foreach ($GLOBALS['portfolio'] as $index => $item) : ?>
	<tr data-index="<?php echo $index ?>">
		<td class="small"><?php echo $index + 1 ?></td>
		<td class="small"><span class="sort">
			<?php if ($index) : ?>
			<span class="ctrl-up" data-change-queue='{"type": "up", "index": "<?php echo $item['index'] ?>", "table": "portfolio"}'></span>
			<?php endif; ?>
			<?php if ($index != count($GLOBALS['portfolio']) - 1) : ?>
			<span class="ctrl-down" data-change-queue='{"type": "down", "index": "<?php echo $item['index'] ?>", "table": "portfolio"}'></span>
			<?php endif; ?>
		</span></td>
		<td style="text-align: center;"><img src="/files/<?php echo $item['preview'] ?>" style="min-height: 100px;"></td>
		<td><?php echo $item['name'] ?></td>
		<td valign="top"><?php echo $item['introtext'] ?></td>
		<td style="text-align: center;">
			<input type="hidden" name="u-data[on_frontpage]" value="0">
			<input type="checkbox" name="u-data[on_frontpage]" value="1" <?php echo $item['on_frontpage'] ? 'checked' : '' ?> data-update='{"index": "<?php echo $index ?>", "id": "<?php echo $item['id'] ?>", "table": "portfolio"}'>
		</td>
		<td class="small"><i class="icon-cancel-circled" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "portfolio"}'></i></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>