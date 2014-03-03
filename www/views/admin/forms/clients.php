<?php $item = $_POST['id'] ? $GLOBALS['clients'][0] : array(); ?>
<form action="" method="POST">
	<table>
		<tr><th>ИЗОБРАЖЕНИЕ</th><th>ИМЯ</th><th>НА ГЛАВНУЮ</th></tr>
		<tr>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[file]"></span>
					<span class="format">(jpg, png)</span>
					<ol class="selected-files"></ol>
				</div>
				<?php if ($item['file']) : ?>
				<p data-item="0" class="preview">					
					<a href="/files/<?php echo $item['file'] ?>" target="_blank"><img src="/files/<?php echo $item['file'] ?>" height="50"></a>
					<i class="icon-cancel" data-remove="0"></i>
					<input type="hidden" name="data[file]" value="<?php echo $item['file'] ?>">
				</p>
				<?php endif; ?>
			</td>
			<td><input type="text" name="data[name]" value="<?php echo $item['name'] ?>" required></td>
			<td class="small"><input type="checkbox" name="data[on_frontpage]" value="1"></td>
		</tr>
		<tr><td colspan="3" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="action" value="<?php echo $item['id'] ? 'update' : 'insert' ?>">
	<input type="hidden" name="table" value="clients">
</form>