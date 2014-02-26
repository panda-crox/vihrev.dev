<?php if (isset($_GET['branches'])) : ?>
<form action="" method="POST" class="b-admin-price">
	<table>
		<tr><th>НАИМЕНОВАНИЕ</th><th>URL</th><th class="small">УДАЛИТЬ</th></tr>
		<?php foreach ($GLOBALS['nav'] as $item) : if($item['module'] != 'portfolio') continue;
		$portfolioId = $item['id'];
		foreach ($item['childs'] as $index => $child) :
		?>
		<tr data-index="<?php echo $index ?>">
			<td><span class="vis"><?php echo $child['caption'] ?></span><input type="text" name="u-data[caption]" value="<?php echo $child['caption'] ?>" required class="hidden"></td>
			<td><span class="vis"><?php echo $child['url_'] ?></span><input type="text" name="u-data[url]" value="<?php echo $child['url_'] ?>" required class="hidden"></td>
			<td style="text-align: center;">
				<i class="icon-pencil vis" data-edit="<?php echo $index ?>"></i>
				<i class="icon-cancel-circled vis" data-remove='{"id": "<?php echo $child['id'] ?>", "table": "navigation"}'></i>
				<i class="icon-floppy hidden" data-update='{"index": "<?php echo $index ?>", "id": "<?php echo $child['id'] ?>", "table": "navigation"}'></i>
			</td>
		</tr>
		<?php endforeach; endforeach; ?>
		<tr>
			<td><input type="text" name="i-data[caption]" placeholder="НАИМЕНОВАНИЕ" required></td>
			<td><input type="text" name="i-data[url]" placeholder="URL" required></td>
			<td><button type="submit" class="btn">ДОБАВИТЬ</button></td>
		</tr>
	</table>
	<input type="hidden" name="i-data[parent]" value="<?php echo $portfolioId ?>">
	<input type="hidden" name="action" value="insert">
	<input type="hidden" name="table" value="navigation">
</form>
<?php elseif (isset($GLOBALS['portfolio'])) : ?>
<div class="b-portfolio">
	<?php if ($GLOBALS['portfolio']) : foreach ($GLOBALS['portfolio'] as $item) : ?>
	<div class="b-portfolio__item">
		<div class="b-portfolio__item__inner">
			<img src="/files/<?php echo $item['preview'] ?>" alt="">
			<div class="b-portfolio__item__popup">
				<span class="b-portfolio__item_type"><?php echo $item['category_name'] ?></span>
				<div class="b-portfolio__item_name"><?php echo $item['name'] ?></div>
				<div class="b-portfolio__item_desc"><?php echo $item['introtext'] ?></div>
			</div>
		</div>
	</div>
	<?php endforeach; endif; ?>
	<div class="clearfix"></div>
</div>
<?php endif; ?>