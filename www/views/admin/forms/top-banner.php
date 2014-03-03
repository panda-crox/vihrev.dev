<?php $item = $_POST['id'] ? $GLOBALS['top-banner'][0] : array(); ?>
<form action="" method="POST">
	<table>
		<tr><th>ФАЙЛ</th><th>ЦВЕТ ФОНА</th><th>РАБОТА</th></tr>
		<tr>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[file]"></span>
					<span class="format">(jpg, png, swf)</span>
					<ol class="selected-files"></ol>
				</div>
				<?php if ($item['file']) : ?>
				<p data-item="0" class="preview">					
					<a href="/files/<?php echo $item['file'] ?>" target="_blank">
						<?php if (preg_match('/(\.(jpg|jpeg|png|gif))$/', $item['file'])) : ?>
						<img src="/files/<?php echo $item['file'] ?>" height="50">
						<?php elseif (preg_match('/(\.swf)$/', $item['file'])) : ?>
						<object type="application/x-shockwave-flash" data="/files/<?php echo $item['file'] ?>" width="100" height="50">
						  <param name="movie" value="/files/<?php echo $item['file'] ?>">
						  <param name="quality" value="high">
							<param name="wmode" value="transparent" />
						</object>
						<?php endif; ?>
					</a>
					<i class="icon-cancel" data-remove="0"></i>
					<input type="hidden" name="data[file]" value="<?php echo $item['file'] ?>">
				</p>
				<?php endif; ?>
			</td>
			<td><input type="text" name="data[background]" value="<?php echo $item['background'] ?>" required></td>
			<td style="width: 150px;">
				<select name="data[portfolio]">
					<option value="" default selected class="default">Выберите работу</option>
					<?php foreach ($GLOBALS['portfolio'] as $portfolio) : ?>
					<option value="<?php echo $portfolio['id'] ?>" <?php if ($item['portfolio'] == $portfolio['id']) echo 'selected' ?>><?php echo $portfolio['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<tr><td colspan="3" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="action" value="<?php echo $item['id'] ? 'update' : 'insert' ?>">
	<input type="hidden" name="table" value="top-banner">
</form>