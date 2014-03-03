<?php $item = $_POST['id'] ? $GLOBALS['contacts'][0] : array(); ?>
<form action="" method="POST">
	<table>
		<tr><th>ТИП</th><th>КОНТАКТ</th</tr>
		<tr>
			<td>
				<select name="data[name]">
					<option value="" default selected class="default">Выберите тип</option>
					<?php foreach (array('mail', 'skype', 'tel', 'icq') as $type) : ?>
					<option value="<?php echo $type ?>" <?php if ($item['name'] == $type) echo 'selected' ?>><?php echo $type ?></option>
					<?php endforeach; ?>
				</select>
			</td>
			<td><input type="text" name="data[value]" value="<?php echo $item['value'] ?>"></td>
		</tr>
		<tr><td colspan="2" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="data[type]" value="contacts">
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="action" value="<?php echo $item['id'] ? 'update' : 'insert' ?>">
	<input type="hidden" name="table" value="support">
</form>