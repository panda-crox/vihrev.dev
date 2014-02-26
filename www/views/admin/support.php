<form action="" method="POST" class="b-admin-support">
<?php if (isset($GLOBALS['settings']['files'])) : $files = $GLOBALS['settings']['files']; ?>
	<table>
		<tr><th>ФАЙЛЫ ДЛЯ СКАЧИВАНИЯ</th><th>УДАЛИТЬ</th></tr>
		<?php if ($files) : foreach ($files as $index => $item) : if (!$item['name'] || !$item['file']) { unset($files[$index]); continue; } ?>
		<tr data-index="<?php echo $index ?>">
			<td>
				<a href="/files/<?php echo $item['file'] ?>" target="_blank"><?php echo $item['name'] ?></a>
				<input type="hidden" name="u-data[files][<?php echo $index ?>][name]" value="<?php echo $item['name'] ?>">
				<input type="hidden" name="u-data[files][<?php echo $index ?>][file]" value="<?php echo $item['file'] ?>">
			</td>
			<td style="text-align: center;"><i class="icon-cancel-circled" onclick="removeItem(<?php echo $index ?>)"></i></td>
		</tr>
		<?php endforeach; endif; ?>
		<tr>
			<td><input type="text" name="u-data[files][<?php echo count($files) ?>][name]" placeholder="НАИМЕНОВАНИЕ"></td>
			<td>
				<div class="uploader">
					<span class="btn"><span>ВЫБРАТЬ</span><input type="file" data-name="u-data[files][<?php echo count($files) ?>][file]"></span>
					<ol class="selected-files"></ol>
				</div>
			</td>
		</tr>
		<tr><td colspan="2" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
<?php elseif (isset($GLOBALS['settings']['contacts'])) : $contacts = $GLOBALS['settings']['contacts']; ?>
	<table>
		<tr><th>КОНТАКТЫ</th><th>УДАЛИТЬ</th></tr>
		<?php if ($contacts) : foreach ($contacts as $index => $item) : 
		if (!$item['caption'] || !$item['value']) { unset($contacts[$index]); continue; } ?>
		<tr data-index="<?php echo $index ?>">
			<td>
				<?php echo $item['caption'] . ': ' . $item['value'] ?>
				<input type="hidden" name="u-data[contacts][<?php echo $index ?>][caption]" value="<?php echo $item['caption'] ?>">
				<input type="hidden" name="u-data[contacts][<?php echo $index ?>][value]" value="<?php echo $item['value'] ?>">
			</td>
			<td style="text-align: center;"><i class="icon-cancel-circled" onclick="removeItem(<?php echo $index ?>)"></i></td>
		</tr>
		<?php endforeach; endif; ?>
		<tr>
			<td><select name="u-data[contacts][<?php echo count($contacts) ?>][caption]">
				<option value="">Тип</option>
				<option value="mail">mail</option>
				<option value="skype">skype</option>
				<option value="tel">tel</option>
				<option value="icq">icq</option>
			</select></td>
			<td><input type="text" name="u-data[contacts][<?php echo count($contacts) ?>][value]" placeholder="КОНТАКТ"></td>
		</tr>
		<tr><td colspan="2" style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></td></tr>
	</table>
<?php elseif (isset($GLOBALS['settings']['about'])) : ?>
	<div style="max-width: 600px; margin-left: 20px;">
		<h3>О НАС</h3>
		<textarea name="u-data[about]" class="editor"><?php echo $GLOBALS['settings']['about'] ?></textarea>
		<h3>СТРАТЕГИЯ</h3>
		<textarea name="u-data[strategy]" class="editor"><?php echo $GLOBALS['settings']['strategy'] ?></textarea>
		<h3>КЛИЕНТЫ И БРЕНДЫ</h3>
		<textarea name="u-data[clients]" class="editor"><?php echo $GLOBALS['settings']['clients'] ?></textarea>
		<p style="text-align: center;"><button type="submit" class="btn">СОХРАНИТЬ</button></p>
	</div>
<?php endif; ?>
	<input type="hidden" name="action" value="update">
	<input type="hidden" name="table" value="settings">
	<input type="hidden" name="id" value="<?php echo $GLOBALS['settings']['id'] ?>">
</form>