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
			<?php if ($files = $GLOBALS['settings'][0]['files']) :
			foreach ($files as $index => $item) : if (!$item['name'] || !$item['file']) { unset($files[$index]); continue; } ?>
			<div><a href="/files/<?php echo $item['file'] ?>" target="_blank" class="b-support__files__item"><?php echo $item['name'] ?></a></div>
			<?php endforeach; endif; ?>
		</div>
		<div class="b-support__contacts">
			<b class="red">Контакты</b>
			<?php if ($contacts = $GLOBALS['settings'][0]['contacts']) :
			foreach ($contacts as $index => $item) : if (!$item['caption'] || !$item['value']) { unset($contacts[$index]); continue; } ?>
			<p><?php echo $item['caption'] ?>: <?php echo $item['value'] ?></p>
			<?php endforeach; endif; ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="b-support__line"></div>
	<div class="container">
		<div class="b-support__about">
			<div class="b-support__about__left">
				<h3>О НАС</h3>
				<?php echo $GLOBALS['settings'][0]['about'] ?>
			</div>
			<div class="b-support__about__right">
				<h3>СТРАТЕГИЯ</h3>
				<?php echo $GLOBALS['settings'][0]['strategy'] ?>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="b-support__clients">
			<h3>КЛИЕНТЫ И БРЕНДЫ</h3>
			<div class="b-support__clients__facia">
				<div class="inner"><?php echo $GLOBALS['settings'][0]['clients'] ?></div>
			</div>
			<div class="b-support__clients__logos">
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
</div>