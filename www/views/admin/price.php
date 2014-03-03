<?php if (isset($GLOBALS['price'])) : ?>
<table style="width: 600px;">
	<tr><th>НАИМЕНОВАНИЕ</th><th>СТОИМОСТЬ</th><th>ДЕЙСТВИЯ</th></tr>
	<?php foreach ($GLOBALS['price'] as $index => $item) : ?>
	<tr data-index="<?php echo $index ?>">
		<td><?php echo $item['name'] ?></td>
		<td><?php echo $item['price'] ?> руб.</td>
		<td class="small">
			<i class="icon-pencil" title="Редактировать" data-form='{"id": "<?php echo $item['id'] ?>"}'></i>
			<i class="icon-cancel-circled" title="Удалить" data-delete='{"id": "<?php echo $item['id'] ?>", "table": "price-list"}'></i>
		</td>
	</tr>
	<?php endforeach; ?>
	<tr><td colspan="3" style="text-align: center;"><span class="btn" data-form='{}'>ДОБАВИТЬ</span></td></tr>
</table>
<?php endif; ?>