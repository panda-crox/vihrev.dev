<?php if ($GLOBALS['portfolio-item']['html']) : require_once('files/' . $GLOBALS['portfolio-item']['html']); else : ?>
<div class="b-canon">
	<div class="b-canon__title">Баннер к новой линейке проекторов<br><b>Canon</b></div>
	<div class="b-canon__banner"><img src="/files/canon.jpg"></div>
	<div class="b-canon__aim">
		<div class="container">
			<h4>Цели и задачи</h4>
			<i>Главная задача – показать конкурентные особенности проекторов canon:высокое качество изображения и стильный дизайн.<br>
			А интерактивный баннер лучше всего позволяет доказать превосходство проектора canon по отношению к его конкурентам, стоит лишь навести стрелку курсора.</i>
			<div class="b-canon__aim__author"><i>Идея и реализация: Владимир Вихрев.</i></div>
		</div>
	</div>
	<div class="b-canon__stages">
		<div class="container">
			<div class="left">
				<h4><span class="number">1</span> Креатив и идеи для будушего баннера</h4>
				<i>Баннер  к новой линейке проекторов Canon.<br>Главная задача – показать конкурентные особенности проекторов canon:высокое качество изображения и стильный дизайн. А интерактивный баннер лучше всего позволяет доказать превосходство проектора canon по отношению к его конкурентам, стоит лишь навести стрелку курсора.<br>Идея и реализация: Владимир Вихрев. </i>
			</div>
			<div class="right"><img src="/files/canon-stage-1.png"></div>
			<div class="clearfix"></div>
			<div class="left"><img src="/files/canon-stage-2.png"></div>
			<div class="right">
				<h4><span class="number">2</span> Материал и подготовка</h4>
				<i>Каждый раз приходя к разработке идеи для баннера наталкиваешься на сложность совместимости креатива-сценария и реализации твоей идеи.<br>Единственный способ работают ли эти две вместе, это метод проб и ошибок</i>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="b-canon__realization">
		<div class="container">
			<h4>Реализация</h4><br>
			<img src="/files/canon-realization.png" alt="">
			<h3>Это самый сложный и ответственный этап</h3>
			<i>Здесь можно представить себя культиватором который замешивает все части<br>и получает один “большой и вкусный пирог”, множественных эксперементов в анимации<br>подбираем оптимальный вариант моушена таким образом получаем отличный флеш баннер.</i>
		</div>
	</div>
</div>
<?php endif; ?>

<div class="b-pager">
	<div class="container">
		<?php if ($GLOBALS['portfolio-item']['prev']) : ?>
		<a href="/<?php echo $GLOBALS['portfolio-item']['prev']['url'] ?>" class="b-pager__prev">&lt;&lt; <i><?php echo $GLOBALS['portfolio-item']['prev']['name'] ?></i></a>
		<?php endif; ?>
		<?php if ($GLOBALS['portfolio-item']['next']) : ?>
		<a href="/<?php echo $GLOBALS['portfolio-item']['next']['url'] ?>" class="b-pager__next"><i><?php echo $GLOBALS['portfolio-item']['next']['name'] ?></i> &gt;&gt;</a>
		<?php endif; ?>
	</div>
	<div class="clearfix"></div>
</div>