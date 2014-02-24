<?php if (isset($GLOBALS['price'])) : ?>
<form action="" method="POST" class="b-admin-price">
	<table>
		<tr><th>НАИМЕНОВАНИЕ</th><th>СТОИМОСТЬ</th><th>УДАЛИТЬ</th></tr>
		<?php foreach ($GLOBALS['price'] as $item) : ?>
		<tr>
			<td><?php echo $item['name'] ?></td>
			<td><?php echo $item['price'] ?> руб.</td>
			<td style="text-align: center;"><i class="icon-cancel-circled" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "price-list"}'></i></td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td><input type="text" name="data[name]" placeholder="НАИМЕНОВАНИЕ" required></td>
			<td><input type="text" name="data[price]" placeholder="СТОИМОСТЬ" required></td>
			<td><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
	</table>
	<input type="hidden" name="data[category]" value="<?php echo $GLOBALS['category'] ?>">
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="price-list">
</form>
<?php endif; ?>