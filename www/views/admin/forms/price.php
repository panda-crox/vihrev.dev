<?php $item = $_POST['id'] ? $GLOBALS['price'][0] : array(); ?>
<form action="" method="POST">
	<table>
		<tr><th>НАИМЕНОВАНИЕ</th><th>СТОИМОСТЬ</th></tr>
		<tr>
			<td><input type="text" name="data[name]" value="<?php echo $item['name'] ?>" required></td>
			<td><input type="text" name="data[price]" value="<?php echo $item['price'] ?>" required></td>
		</tr>
		<tr><td colspan="2" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="data[category]" value="<?php echo $GLOBALS['category'] ?>">
	<input type="hidden" name="id" value="<?php echo $item['id'] ?>">
	<input type="hidden" name="action" value="<?php echo $item['id'] ? 'update' : 'insert' ?>">
	<input type="hidden" name="table" value="price-list">
</form>