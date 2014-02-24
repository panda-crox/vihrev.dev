<?php if (isset($GLOBALS['settings'][0]['files'])) : $files = $GLOBALS['settings'][0]['files']; ?>
<form action="" method="POST" class="b-admin-files">
	<table>
		<tr><th>ФАЙЛЫ ДЛЯ СКАЧИВАНИЯ</th><th>УДАЛИТЬ</th></tr>
		<?php if ($files) : foreach ($files as $index => $item) : if (!$item['name'] || !$item['file']) { unset($files[$index]); continue; } ?>
		<tr data-id="<?php echo $index ?>">
			<td>
				<?php echo $item['name'] ?>
				<input type="hidden" name="data[files][<?php echo $index ?>][name]" value="<?php echo $item['name'] ?>">
				<input type="hidden" name="data[files][<?php echo $index ?>][file]" value="<?php echo $item['file'] ?>">
			</td>
			<td style="text-align: center;"><i class="icon-cancel-circled" onclick="removeItem(<?php echo $index ?>)"></i></td>
		</tr>
		<?php endforeach; endif; ?>
		<tr>
			<td><input type="text" name="data[files][<?php echo count($files) ?>][name]" placeholder="НАИМЕНОВАНИЕ"></td>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="data[files][<?php echo count($files) ?>][file]"></span>
					<ol class="selected-files"></ol>
				</div>
			</td>
		</tr>
		<tr><td colspan="2" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="table" value="settings">
	<input type="hidden" name="id" value="<?php echo $GLOBALS['settings'][0]['id'] ?>">
</form>
<?php elseif (isset($GLOBALS['settings'][0]['contacts'])) : $contacts = $GLOBALS['settings'][0]['contacts']; ?>
<form action="" method="POST" class="b-admin-files">
	<table>
		<tr><th>КОНТАКТЫ</th><th>УДАЛИТЬ</th></tr>
		<?php if ($contacts) : foreach ($contacts as $index => $item) : 
		if (!$item['caption'] || !$item['value']) { unset($contacts[$index]); continue; } ?>
		<tr data-id="<?php echo $index ?>">
			<td>
				<?php echo $item['caption'] . ': ' . $item['value'] ?>
				<input type="hidden" name="data[contacts][<?php echo $index ?>][caption]" value="<?php echo $item['caption'] ?>">
				<input type="hidden" name="data[contacts][<?php echo $index ?>][value]" value="<?php echo $item['value'] ?>">
			</td>
			<td style="text-align: center;"><i class="icon-cancel-circled" onclick="removeItem(<?php echo $index ?>)"></i></td>
		</tr>
		<?php endforeach; endif; ?>
		<tr>
			<td><select name="data[contacts][<?php echo count($contacts) ?>][caption]">
				<option value="">Тип</option>
				<option value="mail">mail</option>
				<option value="skype">skype</option>
				<option value="tel">tel</option>
				<option value="icq">icq</option>
			</select></td>
			<td><input type="text" name="data[contacts][<?php echo count($contacts) ?>][value]" placeholder="КОНТАКТ"></td>
		</tr>
		<tr><td colspan="2" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="table" value="settings">
	<input type="hidden" name="id" value="<?php echo $GLOBALS['settings'][0]['id'] ?>">
</form>
<?php endif; ?>