<div class="b-support">
	<div class="b-support__map" id="map-canvas"></div>
	<div class="container">
		<form action="" method="POST" class="b-support__form">
			<fieldset>
				<div class="b-support__form__left">
					<div class="b-support__form__input"><span class="star">*</span><input type="text" name="fio" placeholder="ФИО" required></div>
					<div class="b-support__form__input"><span class="star">*</span><input type="text" name="org" placeholder="Организация" required></div>
					<div class="b-support__form__input"><span class="star">*</span><input type="text" name="email" placeholder="E-mail" required></div>
				</div>
				<div class="b-support__form__right">
					<div class="b-support__form__input"><span class="star">*</span><textarea placeholder="Сообщение"></textarea></div>
				</div>
				<div class="clearfix"></div>
			</fieldset>
			<div class="note">* Звездочкой обозначены поля для обязательного заполнения</div>
			<div class="btn-wrapper"><button type="submit" class="btn">ОТПРАВИТЬ</button></div>
			<div class="clearfix"></div>
		</form>
		<div class="b-support__files">
			<span class="b-support__files__title">Файлы</span><br>
			<a href="#" class="b-support__files__item">Бриф на изготовление интернет  баннера</a><br>
			<a href="#" class="b-support__files__item">Бриф на изготовление полиграфической продукции</a><br>
			<a href="#" class="b-support__files__item">Бриф на изготовлние наружной рекламы</a><br>
			<a href="#" class="b-support__files__item">Бриф на изготовлние логотипа</a>
		</div>
		<div class="b-support__contacts">
			<b class="red">Контакты</b>
			<p>skype: wvihrev</p>
			<p>icq: 355-133-868</p>
			<p>tel: +7931 337 48 37</p>
			<p>mail: wvihr@mail.ru, wvihrev@gmail.com</p>
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
				<p><b>Цель</b><br>Наша основная задача достижение максимального результата, никогда не останавливаться на достигнутом и постоянно совершенствоваться  в сфере интернет рекламы и дизайна.</p>
				<p><b>Методы</b><br>Основой лучшей реализации рекламы является ясное донесение информации рекламного продукта. От  креатива к реализации.</p>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="b-support__clients">
			<h3>КЛИЕНТЫ И БРЕНДЫ</h3>
			<div class="b-support__clients__facia">
				<div>Мы работаем вместе с этими брендами и  выработали стратегию наряду с уникальным подходом. Мы процветаем и сотрудничаем с клиентами, которые хотят расширить границы и мыслить нестандартно.</div>
			</div>
			<div class="b-support__clients__logos">
				<div>
					<?php if ($GLOBALS['clients']) : foreach ($GLOBALS['clients'] as $key => $item) : ?>
					<span class="b-support__clients__logos__item"><img src="/files/<?php echo $item['file'] ?>" alt=""></span>
					<?php if (($key + 1) % 5 == 0) : ?>
					</div><div>
					<?php endif; ?>
					<?php endforeach; endif; ?>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>