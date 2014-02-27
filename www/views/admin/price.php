<?php if (isset($GLOBALS['price'])) : ?>
<form action="" method="POST" style="width: 600px;">
	<table>
		<tr><th>НАИМЕНОВАНИЕ</th><th>СТОИМОСТЬ</th><th class="small">УДАЛИТЬ</th></tr>
		<?php foreach ($GLOBALS['price'] as $index => $item) : ?>
		<tr data-index="<?php echo $index ?>">
			<td><span class="vis"><?php echo $item['name'] ?></span><input type="text" name="u-data[name]" value="<?php echo $item['name'] ?>" required class="hidden"></td>
			<td><span class="vis"><?php echo $item['price'] ?> руб.</span><input type="text" name="u-data[price]" value="<?php echo $item['price'] ?>" required class="hidden"></td>
			<td style="text-align: center;">
				<i class="icon-pencil vis" data-edit="<?php echo $index ?>"></i>
				<i class="icon-cancel-circled vis" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "price-list"}'></i>
				<i class="icon-floppy hidden" data-update='{"index": "<?php echo $index ?>", "id": "<?php echo $item['id'] ?>", "table": "price-list"}'></i>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td><input type="text" name="i-data[name]" placeholder="НАИМЕНОВАНИЕ" required></td>
			<td><input type="text" name="i-data[price]" placeholder="СТОИМОСТЬ" required></td>
			<td><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
	</table>
	<input type="hidden" name="i-data[category]" value="<?php echo $GLOBALS['category'] ?>">
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="price-list">
</form>
<?php endif; ?>