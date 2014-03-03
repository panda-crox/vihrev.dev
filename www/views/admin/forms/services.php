<?php $item = $_POST['id'] ? $GLOBALS['services'][0] : array(); ?>
<form action="" method="POST">
	<table>
		<tr><th>ИЗОБРАЖЕНИЕ</th><th>ТЕКСТ</th><th>РАЗДЕЛ</th></tr>
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
			<td style="width: 300px;"><textarea name="data[text]"><?php echo $item['text'] ?></textarea></td>
			<td style="width: 150px;">
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
		<tr><td colspan="3" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="action" value="<?php echo $item['id'] ? 'update' : 'insert' ?>">
	<input type="hidden" name="table" value="services">
</form>