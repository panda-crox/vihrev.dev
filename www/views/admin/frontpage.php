<div class="b-admin-banners">
	<table>
		<tr>
			<td>ВЫБРАТЬ ФАЙЛ</td>
			<td colspan="5"><span class="btn">ВЫБРАТЬ</span> <input type="text" class="input-url" value="/admin/add-banner.php?id=38"> <span class="b-admin-banners__format">(jpg, png, swf, html5)</span></td>
			<td rowspan="2" colspan="2"><span class="btn">ДОБАВИТЬ</span></td>
		</tr>
		<tr>
			<td>ЦВЕТ ФОНА</td>
			<td colspan="5"><input type="text" class="input-bg" value="#000000"></td>
		</tr>
		<?php if ($GLOBALS['top-banner']) : foreach ($GLOBALS['top-banner'] as $key => $item) : ?>
		<tr>
			<?php if (!$key) : ?>
			<td rowspan="<?php echo count($GLOBALS['top-banner']) ?>">УДАЛИТЬ, ПЕРЕМЕСТИТЬ БАННЕР</td>
			<?php endif; ?>
			<td style="padding: 0; text-align: center; width: 45px;"><?php echo $key + 1 ?></td>
			<td style="padding: 0; text-align: center; width: 45px;"><span class="sort"><span class="ctrl-up"></span><span class="ctrl-down"></span></span></td>
			<td><?php echo $item['file'] ?></td>
			<td><?php echo $item['file'] ?></td>
			<td><?php echo $item['url'] ?></td>
			<td style="padding: 0; text-align: center; width: 45px;">x</td>
			<td></td>
		</tr>
		<?php endforeach; endif; ?>
	</table>
</div>