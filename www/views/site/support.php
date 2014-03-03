<div class="b-support">
	<div class="b-support__map" id="map-canvas"></div>
	<div class="container">
		<form action="" method="POST" name="message" class="b-support__form">
			<fieldset>
				<div class="b-support__form__left">
					<div class="b-support__form__input"><span class="star">*</span><input type="text" name="fio" placeholder="ФИО" required></div>
					<div class="b-support__form__input"><span class="star">*</span><input type="text" name="org" placeholder="Организация" required></div>
					<div class="b-support__form__input"><span class="star">*</span><input type="text" name="email" placeholder="E-mail" required></div>
				</div>
				<div class="b-support__form__right">
					<div class="b-support__form__input"><span class="star">*</span><textarea name="text" placeholder="Сообщение"></textarea></div>
				</div>
				<div class="clearfix"></div>
			</fieldset>
			<div class="note">* Звездочкой обозначены поля для обязательного заполнения</div>
			<div class="btn-wrapper"><button type="submit" class="btn">ОТПРАВИТЬ</button></div>
			<div class="uploader">
				<span class="btn"><span>ДОБАВИТЬ ФАЙЛЫ</span><input type="file" multiple data-name="files[]"></span>
				<ol class="selected-files"></ol>
			</div>
			<div class="clearfix"></div>
			<input type="hidden" name="action" value="message">
		</form>
		<div class="b-support__files">
			<span class="b-support__files__title">Файлы</span><br>
			<?php foreach ($GLOBALS['support'] as $item) : if ($item['type'] != 'files') continue; ?>
			<div><a href="/files/<?php echo $item['value'] ?>" target="_blank" class="b-support__files__item"><?php echo $item['name'] ?></a></div>
			<?php endforeach; ?>
		</div>
		<div class="b-support__contacts">
			<b class="red">Контакты</b>
			<?php foreach ($GLOBALS['support'] as $item) : if ($item['type'] != 'contacts') continue; ?>
			<p><?php echo $item['name'] ?>: <?php echo $item['value'] ?></p>
			<?php endforeach; ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="b-support__line"></div>
	<div class="container">
		<?php foreach ($GLOBALS['support'] as $item) : if ($item['type'] != 'text') continue; ?>
		<div class="b-support__text-<?php echo $item['name'] ?>"><?php echo $item['value'] ?></div>
		<?php endforeach; ?>
		<div class="b-support__clients">
			<div>
				<?php foreach ($GLOBALS['clients'] as $key => $item) : ?>
				<span class="b-support__clients__logos__item"><img src="/files/<?php echo $item['file'] ?>" alt=""></span>
				<?php if (($key + 1) % 5 == 0) : ?>
				</div><div>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>