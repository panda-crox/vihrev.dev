<form action="" method="POST">
<?php if (isset($GLOBALS['files'])) : ?>
	<table style="width: 600px;">
		<tr><th>ФАЙЛЫ ДЛЯ СКАЧИВАНИЯ</th><th>ДЕЙСТВИЯ</th></tr>
		<?php foreach ($GLOBALS['files'] as $index => $item) : ?>
		<tr data-index="<?php echo $index ?>">
			<td>
				<a href="/files/<?php echo $item['value'] ?>" target="_blank"><?php echo $item['name'] ?></a>
			</td>
			<td class="small">
				<i class="icon-pencil" title="Редактировать" data-form='{"id": "<?php echo $item['id'] ?>"}'></i>
			<i class="icon-cancel-circled" title="Удалить" data-delete='{"id": "<?php echo $item['id'] ?>", "table": "support"}'></i>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr><td colspan="2" style="text-align: center;"><span class="btn" data-form='{}'>ДОБАВИТЬ</span></td></tr>
	</table>
	<input type="hidden" name="i-data[type]" value="files">
<?php elseif (isset($GLOBALS['contacts'])) : ?>
<table style="width: 300px;">
	<tr><th>КОНТАКТЫ</th><th class="small">ДЕЙСТВИЯ</th></tr>
	<?php foreach ($GLOBALS['contacts'] as $index => $item) : ?>
	<tr data-index="<?php echo $index ?>">
		<td>
			<?php echo $item['name'] . ': ' . $item['value'] ?>
		</td>
		<td class="small">
			<i class="icon-pencil" title="Редактировать" data-form='{"id": "<?php echo $item['id'] ?>"}'></i>
			<i class="icon-cancel-circled" title="Удалить" data-delete='{"id": "<?php echo $item['id'] ?>", "table": "support"}'></i>
		</td>
	</tr>
	<?php endforeach; ?>
	<tr><td colspan="2" style="text-align: center;"><span class="btn" data-form='{}'>ДОБАВИТЬ</span></td></tr>
</table>
<?php elseif (isset($GLOBALS['text'])) : ?>
<table style="width: 600px;">
	<tr><th>ТЕКСТ</th><th>ДЕЙСТВИЯ</th></tr>
	<?php foreach ($GLOBALS['text'] as $index => $item) : ?>
	<tr data-index="<?php echo $index ?>">
		<td>
			<div class="vis">
				<p>CSS-класс: <b><?php echo $item['name'] ?></b></p><hr>
				<p><?php echo $item['value'] ?></p>
			</div>			
		</td>
		<td class="small">
			<i class="icon-pencil" title="Редактировать" data-form='{"id": "<?php echo $item['id'] ?>"}'></i>
			<i class="icon-cancel-circled" title="Удалить" data-delete='{"id": "<?php echo $item['id'] ?>", "table": "support"}'></i>
		</td>
	</tr>
	<?php endforeach; ?>
	<tr><td colspan="2" style="text-align: center;"><span class="btn" data-form='{}'>ДОБАВИТЬ</span></td></tr>
</table>
<?php endif; ?>