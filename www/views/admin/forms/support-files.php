<?php $item = $_POST['id'] ? $GLOBALS['files'][0] : array(); ?>
<form action="" method="POST">
	<table>
		<tr><th>ФАЙЛ</th><th>ИМЯ</th></tr>
		<tr>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[value]"></span>
					<ol class="selected-files"></ol>
				</div>
				<?php if ($item['value']) : ?>
				<p data-item="0" class="preview">					
					<a href="/files/<?php echo $item['value'] ?>" target="_blank"><img src="/files/<?php echo $item['value'] ?>" height="50"></a>
					<i class="icon-cancel" data-remove="0"></i>
					<input type="hidden" name="data[value]" value="<?php echo $item['value'] ?>">
				</p>
				<?php endif; ?>
			</td>
			<td><input type="text" name="data[name]" value="<?php echo $item['name'] ?>" required></td>
		</tr>
		<tr><td colspan="3" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="data[type]" value="files">
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="action" value="<?php echo $item['id'] ? 'update' : 'insert' ?>">
	<input type="hidden" name="table" value="support">
</form>