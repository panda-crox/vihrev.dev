<?php if (isset($_GET['branches'])) : $item = array();
foreach ($GLOBALS['nav'] as $item_) {
	if($item_['module'] != 'portfolio') continue;
	$portfolioId = $item_['id'];
	foreach ($item_['childs'] as $child) {
		if ($child['id'] == $_POST['id']) $item = $child;
	}
}
?>
<form action="" method="POST" style="width: 600px;">
	<table>
		<tr><th>НАИМЕНОВАНИЕ</th><th>URL</th></tr>
		<tr>
			<td><input type="text" name="data[caption]" value="<?php echo $item['caption'] ?>" required></td>
			<td><input type="text" name="data[url]" value="<?php echo $item['url_'] ?>" required></td>
		</tr>
		<tr><td colspan="2" class="small"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="data[parent]" value="<?php echo $portfolioId ?>">
	<input type="hidden" name="data[module]" value="portfolio">
	<input type="hidden" name="action" value="<?php echo $item['id'] ? 'update' : 'insert' ?>">
	<input type="hidden" name="table" value="navigation">
</form>
<?php else : $item = $_POST['id'] ? $GLOBALS['portfolio'][0] : array(); ?>
<form action="" method="POST" class="portfolio-form">
	<table>
		<tr>
			<td colspan="7">
				<input type="text" name="data[name]" placeholder="ИМЯ" value="<?php echo $item['name'] ?>" required style="margin-bottom: 10px;">
				<textarea name="data[introtext]" placeholder="ВВОДНЫЙ ТЕКСТ" style="margin-bottom: 10px;"><?php echo $item['introtext'] ?></textarea>
				<div style="height: 230px;"><textarea name="data[text]" class="editor" placeholder="ОПИСАНИЕ"><?php echo $item['text'] ?></textarea></div>
			</td>
		</tr>
		<tr><th>ПРЕВЬЮ</th><th>FLASH</th><th>GIF</th><th>JPG/PNG</th><th>HTML</th><th>НА ГЛАВНУЮ</th><th>РАЗДЕЛ</th></tr>
		<tr>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[preview]"></span>
					<ol class="selected-files"></ol>
				</div>
				<?php if ($item['preview']) : ?>
				<p class="preview" data-item="0">
					<a href="/files/<?php echo $item['preview'] ?>" class="fancybox" target="_blank"><img src="/files/<?php echo $item['preview'] ?>" width="50"></a>
					<i class="icon-cancel" data-remove="0"></i>
					<input type="hidden" name="data[preview]" value="<?php echo $item['preview'] ?>">
				</p>
				<?php endif; ?>
			</td>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[flash]"></span>
					<ol class="selected-files"></ol>
				</div>
				<?php if ($item['flash']) : ?>
				<p class="preview" data-item="0">
					<a href="/files/<?php echo $item['flash'] ?>" class="fancybox" target="_blank">
						<object type="application/x-shockwave-flash" data="/files/<?php echo $item['flash'] ?>" width="50" height="50">
						  <param name="movie" value="/files/<?php echo $item['flash'] ?>">
						  <param name="quality" value="high">
							<param name="wmode" value="transparent" />
						</object>
					</a>
					<i class="icon-cancel" data-remove="0"></i>
					<input type="hidden" name="data[flash]" value="<?php echo $item['flash'] ?>">
				</p>
				<?php endif; ?>				
			</td>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[gif]"></span>
					<ol class="selected-files"></ol>
				</div>
				<?php if ($item['gif']) : ?>
				<p class="preview" data-item="0">
					<a href="/files/<?php echo $item['gif'] ?>" class="fancybox" target="_blank"><img src="/files/<?php echo $item['gif'] ?>" width="50"></a>
					<i class="icon-cancel" data-remove="0"></i>
					<input type="hidden" name="data[gif]" value="<?php echo $item['gif'] ?>">
				</p>
				<?php endif; ?>				
			</td>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" multiple data-name="data[jpg_png][]"></span>
					<ol class="selected-files"></ol>
				</div>
				<?php if ($item['jpg_png']) : foreach ($item['jpg_png'] as $key => $file) : ?>
				<p class="preview" data-item="<?php echo $key ?>">
					<a href="/files/<?php echo $file ?>" class="fancybox" rel="jpg_png" target="_blank"><img src="/files/<?php echo $file ?>" width="50"></a>
					<i class="icon-cancel" data-remove="<?php echo $key ?>"></i>
					<input type="hidden" name="data[jpg_png][]" value="<?php echo $file ?>">
				</p>
				<?php endforeach; endif; ?>
			</td>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[html]"></span>
					<ol class="selected-files"></ol>
				</div>
				<?php if ($item['html']) : ?>
				<p class="preview" data-item="0">
					<a href="/files/<?php echo $item['html'] ?>" target="_blank"><?php echo $item['html'] ?></a>
					<i class="icon-cancel" data-remove="0"></i>
					<input type="hidden" name="data[html]" value="<?php echo $item['html'] ?>">
				</p>
				<?php endif; ?>
			</td>
			<td class="small"><input type="checkbox" name="data[on_frontpage]" value="1" <?php if ($item['on_frontpage']) echo 'checked' ?>></td>
			<td style="width: 175px;">
				<select name="data[category]" required>
					<option value="" default selected class="default">Выберите раздел</option>
					<?php foreach ($GLOBALS['nav'] as $item_) : if($item_['module'] != 'portfolio') continue;
					foreach ($item_['childs'] as $child) :
					?>
					<option value="<?php echo $child['id'] ?>" <?php if ($item['category'] == $child['id']) echo 'selected' ?>><?php echo $child['caption'] ?></option>
					<?php endforeach; endforeach; ?>
				</select>
			</td>
		</tr>
		<tr><td colspan="7" class="small"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="action" value="<?php echo $item['id'] ? 'update' : 'insert' ?>">
	<input type="hidden" name="table" value="portfolio">
</form>
<?php endif; ?>