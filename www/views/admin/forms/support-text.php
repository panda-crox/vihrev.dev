<?php $item = $_POST['id'] ? $GLOBALS['text'][0] : array(); ?>
<form action="" method="POST">
	<table>
		<tr><th>CSS-класс</th><th>ТЕКСТ</th</tr>
		<tr>
			<td><input type="text" name="data[name]" value="<?php echo $item['name'] ?>" required></td>
			<td><textarea name="data[value]" class="editor"><?php echo $item['value'] ?></textarea></td>
		</tr>
		<tr><td colspan="2" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="data[type]" value="text">
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="action" value="<?php echo $item['id'] ? 'update' : 'insert' ?>">
	<input type="hidden" name="table" value="support">
</form>