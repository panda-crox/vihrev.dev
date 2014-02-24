<div class="b-price">
	<div class="container">
		<div class="b-price__title">Прайс лист</div>
		<nav class="b-price__tabs">
			<?php foreach ($GLOBALS['nav'] as $item) : if($item['module'] != 'portfolio') continue;
			foreach ($item['childs'] as $index => $child) : 
			?>
			<a href="?category=<?php echo $child['url_'] ?>" class="<?php if ($_GET['category'] == $child['url_'] || (!$_GET['category'] && !$index)) echo 'current' ?>"><?php echo $child['caption'] ?></a>
			<?php endforeach; endforeach; ?>
		</nav>
		<div class="b-price__table">
			<table>
				<tr><th>Наименование</th><th>Стоимость</th></tr>
				<?php foreach ($GLOBALS['price'] as $item) : ?>
				<tr><td><?php echo $item['name'] ?></td><td><?php echo $item['price'] ?> руб.</td></tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div class="b-price__desc">
			<span class="b-price__desc__title">Скидки, акции</span>
			<p>Получи скидку 5% заказав более двух баннеров</p>
			<p>Сделайте заказ через форму обратной связи и получите скидку 10%</p>
			<span class="b-price__desc__title">Способы оплаты:</span>
			<p>
				-Безналичный расчет<br>
				-На счет в Альфа банке<br>
				-Webmoney кошелек<br>
				- Яндекс деньги
			</p>
			<div class="b-price__desc__attention">
				<span class="red">ВАЖНО ЗНАТЬ!</span>
				<p>Все идеи и предложения по реализации проекта после предоплаты не менне 50%</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<form action="" method="POST" name="message" class="b-price__form">
			<fieldset>
				<div class="b-price__form__left">
					<div class="b-price__form__title">Есть вопросы по стоимости заказа? <span class="red">Пишите!</span></div>
					<input type="text" name="fio" placeholder="ФИО" required>
					<input type="text" name="email" placeholder="E-mail" required>
				</div>
				<div class="b-price__form__right"><textarea name="text" placeholder="Сообщение"></textarea></div>
				<div class="clearfix"></div>
			</fieldset>
			<div class="btn-wrapper"><button type="submit" class="btn">ЗАДАТЬ ВОПРОС</button></div>
			<input type="hidden" name="action" value="message">
		</form>
		<div class="b-price__attention"><span class="red">* Важно!</span><br>Цены, указанные в прайсе являются ориентировочными, тк каждый проект уникальный и требует индивидуального подхода!<br>Конечная стоимость работ обсуждается отдельно по каждому заданию после предоставления ТЗ</div>
		<div class="b-price__social">
			Рассаказать о нас<br>
			<a href="#"><i class="icon-vkontakte"></i></a>
			<a href="#"><i class="icon-facebook"></i></a>
			<a href="#"><i class="icon-twitter"></i></a>
		</div>
		<div class="clearfix"></div>
	</div>
</div>