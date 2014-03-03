<?php if (isset($_GET['branches'])) : ?>
<table style="width: 300px;">
	<tr><th>НАИМЕНОВАНИЕ</th><th>URL</th><th>УДАЛИТЬ</th></tr>
	<?php foreach ($GLOBALS['nav'] as $item) : if($item['module'] != 'portfolio') continue;
	foreach ($item['childs'] as $index => $child) :
	?>
	<tr data-index="<?php echo $index ?>">
		<td><?php echo $child['caption'] ?></td>
		<td><?php echo $child['url_'] ?></td>
		<td class="small">
			<i class="icon-pencil" title="Редактировать" data-form='{"id": "<?php echo $child['id'] ?>"}'></i>
			<i class="icon-cancel-circled" title="Удалить" data-delete='{"id": "<?php echo $child['id'] ?>", "table": "navigation"}'></i>
		</td>
	</tr>
	<?php endforeach; endforeach; ?>
	<tr><td colspan="3" style="text-align: center;"><span class="btn" data-form='{}'>ДОБАВИТЬ</span></td></tr>
</table>
<?php elseif (isset($GLOBALS['portfolio'])) : ?>
<table style="width: 600px;">
	<tr><th></th><th>ПРЕВЬЮ</th><th>ИМЯ</th><th>ВВОДНЫЙ ТЕКСТ</th><th>НА ГЛАВНУЮ</th><th>ДЕЙСТВИЯ</th></tr>
	<?php foreach ($GLOBALS['portfolio'] as $index => $item) : ?>
	<tr data-index="<?php echo $index ?>">
		<td class="small"><span class="sort">
			<?php if ($index) : ?>
			<span class="ctrl-up" data-queue='{"type": "up", "index": "<?php echo $item['index'] ?>", "table": "portfolio"}'></span>
			<?php endif; ?>
			<?php if ($index != count($GLOBALS['portfolio']) - 1) : ?>
			<span class="ctrl-down" data-queue='{"type": "down", "index": "<?php echo $item['index'] ?>", "table": "portfolio"}'></span>
			<?php endif; ?>
		</span></td>
		<td class="small"><img src="/files/<?php echo $item['preview'] ?>" height="73"></td>
		<td><a href="http://<?php echo $GLOBALS['host'] ?>/<?php echo $item['url'] ?>" target="_blank"><?php echo $item['name'] ?></a></td>
		<td valign="top"><?php echo $item['introtext'] ?></td>
		<td class="small">
			<input type="checkbox" <?php echo $item['on_frontpage'] ? 'checked' : '' ?> data-on-frontpage='{ "id": "<?php echo $item['id'] ?>", "table": "portfolio"}'>
		</td>
		<td class="small">
			<i class="icon-pencil" title="Редактировать" data-form='{"id": "<?php echo $item['id'] ?>"}'></i>
			<i class="icon-cancel-circled" title="Удалить" data-delete='{"id": "<?php echo $item['id'] ?>", "table": "portfolio"}'></i>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<?php endif; ?>