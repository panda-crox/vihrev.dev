<form action="" method="POST">
<?php if (isset($GLOBALS['files'])) : ?>
	<table style="width: 600px;">
		<tr><th>ФАЙЛЫ ДЛЯ СКАЧИВАНИЯ</th><th class="small">УДАЛИТЬ</th></tr>
		<?php foreach ($GLOBALS['files'] as $index => $item) : ?>
		<tr data-index="<?php echo $index ?>">
			<td>
				<a href="/files/<?php echo $item['value'] ?>" target="_blank"><?php echo $item['name'] ?></a>
			</td>
			<td style="text-align: center;">
				<i class="icon-cancel-circled" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "support"}'></i>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td>
				<p><input type="text" name="i-data[name]" placeholder="НАИМЕНОВАНИЕ"></p>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="i-data[value]"></span>
					<ol class="selected-files"></ol>
				</div>
			</td>
			<td><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
	</table>
	<input type="hidden" name="i-data[type]" value="files">
<?php elseif (isset($GLOBALS['contacts'])) : ?>
	<table style="width: 300px;">
		<tr><th>КОНТАКТЫ</th><th class="small">УДАЛИТЬ</th></tr>
		<?php foreach ($GLOBALS['contacts'] as $index => $item) : ?>
		<tr data-index="<?php echo $index ?>">
			<td>
				<?php echo $item['name'] . ': ' . $item['value'] ?>
			</td>
			<td style="text-align: center;">
				<i class="icon-cancel-circled" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "support"}'></i>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td>
				<p><select name="i-data[name]">
					<option value="">Тип</option>
					<option value="mail">mail</option>
					<option value="skype">skype</option>
					<option value="tel">tel</option>
					<option value="icq">icq</option>
				</select></p>
				<p><input type="text" name="i-data[value]" placeholder="КОНТАКТ"></p>
			</td>
			<td><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
	</table>
	<input type="hidden" name="i-data[type]" value="contacts">
<?php elseif (isset($GLOBALS['text'])) : ?>
	<table>
		<tr><th>Текст</th><th class="small">УДАЛИТЬ</th></tr>
		<?php foreach ($GLOBALS['text'] as $index => $item) : ?>
		<tr data-index="<?php echo $index ?>">
			<td>
				<div class="vis">
					<p>CSS-класс: <b><?php echo $item['name'] ?></b></p><hr>
					<p><?php echo $item['value'] ?></p>
				</div>
				<div class="hidden">
					<p><input type="text" name="u-data[name]" placeholder="CSS-класс" value="<?php echo $item['name'] ?>"></p>
					<textarea name="u-data[value]" class="editor" id="editor-<?php echo $index ?>"><?php echo $item['value'] ?></textarea>
				</div>				
			</td>
			<td style="text-align: center;">
				<i class="icon-pencil vis" data-edit="<?php echo $index ?>"></i>
				<i class="icon-cancel-circled vis" data-remove='{"id": "<?php echo $item['id'] ?>", "table": "support"}'></i>
				<i class="icon-floppy hidden" data-update='{"index": "<?php echo $index ?>", "id": "<?php echo $item['id'] ?>", "table": "support"}'></i>
			</td>
		</tr>
		<?php endforeach; ?>
		<tr>
			<td><p><input type="text" name="i-data[name]" placeholder="CSS-класс"></p><textarea name="i-data[value]" class="editor"></textarea></td>
			<td><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
	</table>
	<input type="hidden" name="i-data[type]" value="text">
<?php endif; ?>
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="support">
</form>