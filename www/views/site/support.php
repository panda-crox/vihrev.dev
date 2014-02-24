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
				<span class="btn"><span>ДОБАВИТЬ ФАЙЛЫ</span><input type="file" data-name="files[]"></span>
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
				<p>Развивающаяся компания в сфере Интернет-рекламы, которая специализируется на создании флеш-баннеров. Главная цель - создание привлекательного и стильного рекламного продукта, отвечающего всем требованиям современной рекламной индустрии.</p>
				<p><b>Интересные факты</b><br>В современном мире, где многое зависит от финансов, для проведения рекламной кампании флеш баннер является одним из самых недорогих, но достаточно продуктивных способов раскрутки.</p>
				<p>Стоимость флеш баннера может варьироваться и вы всегда можете выбрать именно то, что нужно вам. Ну а мы, в свою очередь, с удовольствием возьмемся за исполнение ваших самых креативных идей и замыслов! Так как мы стремимся к качеству и совершенству каждого рекламного продукта, выпускаемого студией. Заказать флеш баннер</p>
			</div>
			<div class="b-support__about__right">
				<h3>СТРАТЕГИЯ</h3>
				<p><b>Цель</b><br>Наша основная задача достижение максимального результата, никогда не останавливаться на достигнутом и постоянно совершенствоваться в сфере интернет рекламы и дизайна.</p>
				<p><b>Методы</b><br>Основой лучшей реализации рекламы является ясное донесение информации рекламного продукта. От креатива к реализации.</p>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="b-support__clients">
			<h3>КЛИЕНТЫ И БРЕНДЫ</h3>
			<div class="b-support__clients__facia">
				<div>Мы работаем вместе с этими брендами и выработали стратегию наряду с уникальным подходом. Мы процветаем и сотрудничаем с клиентами, которые хотят расширить границы и мыслить нестандартно.</div>
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