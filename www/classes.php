<?php
	class Vihrev
	{
		private $viewsPath;
		private $_template;
		private $_var = array();
		public $requestPath;
		public $isAdmin;

		public function __construct()
		{
			$this->requestPath = trim(str_replace('?' . $_SERVER['QUERY_STRING'], '', $_SERVER['REQUEST_URI']), '/');
			$this->nav = $this->getNav();
			$this->viewsPath = $_SERVER['DOCUMENT_ROOT'] . '/views/';
			$this->isAdmin = preg_match('/(^admin)/', $_SERVER['HTTP_HOST']);
		}


		public function checkUrl($items)
		{
			foreach ($items as $item) {
				if ( ($item['url'] == $this->requestPath) || ($item['childs'] && $this->checkUrl($item['childs'])) ) {
					return true;
				}
			}
			return false;
		}


		public function getModule($items)
		{
			foreach ($items as $item) {
				if ($item['url'] == $this->requestPath) {
					return $item['module'];
				}
				else if ($item['childs'] && $module = $this->getModule($item['childs'])) {
					return $module;
				}
			}
		}


		public function getNav()
		{
			$nav = array();
			function appendTo(&$items, $child) {
				foreach ($items as &$item) {
					if ($item['id'] == $child['parent']) {
						if (!$item['childs']) {
							$item['childs'] = array();
						}
						$child['url_'] = $child['url'];
						$child['url'] = $item['url'] .'/'. $child['url'];
						$item['childs'][] = $child;
						return;
					}
					else if ($item['childs']) {
						appendTo($item['childs'], $child);
					}
				}
			}

			$query = mysql_query("SELECT * FROM `navigation`");
			while ($item = mysql_fetch_assoc($query)) {
				if (!$item['parent']) {
					$nav[] = $item;
				} else {
					appendTo($nav, $item);
				}
			}
			return $nav;
		}


		public function getUrl($items, $id)
		{
			foreach ($items as $item) {
				if ($item['id'] == $id) {
					return $item['url'];
				}
				else if ($item['childs'] && $url = $this->getUrl($item['childs'], $id)) {
					return $url;
				}
			}
		}


		public function render($template, $data = array())
		{
			
			if ($template != '404.php') {
				$template = $this->isAdmin ? 'admin/'.$template : 'site/'.$template;
			}
			foreach ($data as $key => $value) {
				$this->set($key, $value);
			}
			$this->set('nav', $this->nav);
			if ($_REQUEST['ajax']) {
				$this->display($template);
			} else {
				$this->set('content', $this->fetch($template));
				$this->display('layout.php');
			}
		}


		public function set($name, $value)
		{
			$GLOBALS[$name] = $value;
		}


		public function __get($name)
		{
			if (isset($this->_var[$name])) return $this->_var[$name];
			return '';
		}


		public function fetch($template, $strip = true)
		{
			$this->_template = $this->viewsPath . $template;
			if ($template && !file_exists($this->_template)) die('Шаблона ' . $this->_template . ' не существует!');

			ob_start();
			include($this->_template);
			return ($strip) ? $this->_strip(ob_get_clean()) : ob_get_clean();
		}


		public function display($template, $strip = true)
		{
			echo $this->fetch($template, $strip);
		}


		private function _strip($data)
		{
			$lit = array("\\t", "\\n", "\\n\\r", "\\r\\n", "  ");
			$sp = array('', '', '', '', '');
			return str_replace($lit, $sp, $data);
		}


		public function xss($data)
		{
			if (is_array($data)) {
				$escaped = array();
				foreach ($data as $key => $value) {
					$escaped[$key] = $this->xss($value);
				}
				return $escaped;
			}
			return htmlspecialchars($data, ENT_QUOTES);
		}




		/* Modules */

		public function frontpage()
		{
			$data = array();
			$query = mysql_query("SELECT `top-banner`.`file`, `top-banner`.`background`, `portfolio`.`id`, `portfolio`.`category` FROM `top-banner`
														LEFT JOIN `portfolio` ON `portfolio`.`id`=`top-banner`.`portfolio`");
			$query2 = mysql_query("SELECT `portfolio`.*, `navigation`.`caption` AS `category_name` FROM `portfolio`
														LEFT JOIN `navigation` ON `navigation`.`id`=`portfolio`.`category` WHERE `on_frontpage`=1");
			$query3 = mysql_query("SELECT * FROM `clients` WHERE `on_frontpage`=1");
			$data['top-banner'] = array();
			$data['previews'] = array();
			$data['clients'] = array();

			while ($item = mysql_fetch_assoc($query)) {
				$item['url'] = $this->getUrl($this->nav, $item['category']) . '/?id=' . $item['id'];
				$data['top-banner'][] = $item;
			}
			while ($item = mysql_fetch_assoc($query2)) {
				$item['url'] = $this->getUrl($this->nav, $item['category']) . '/?id=' . $item['id'];
				$data['previews'][] = $item;
			}
			while ($item = mysql_fetch_assoc($query3)) {
				$data['clients'][] = $item;
			}

			$this->render('frontpage.php', $data);
		}


		public function portfolio()
		{
			$requestPath = explode('/', $this->requestPath);
			$data = array();
			$condition = "";
			if (count($requestPath) > 1) {
				$condition .= "WHERE `portfolio`.`category`=(SELECT `id` FROM `navigation` WHERE `url`='{$requestPath[1]}') ";

			}
			if ($_GET['id']) {
				$condition .= "AND `portfolio`.`id`={$_GET['id']}";
			}

			$query = mysql_query("SELECT `portfolio`.*, `navigation`.`caption` AS `category_name` FROM `portfolio`
														LEFT JOIN `navigation` ON `navigation`.`id`=`portfolio`.`category` $condition");

			if ($_GET['id']) {
				if (!mysql_num_rows($query)) {
					$this->get404();
				}
				$item = mysql_fetch_assoc($query);

				$query = mysql_query("SELECT * FROM `portfolio` WHERE `id`<{$item['id']} ORDER BY `id` DESC LIMIT 1");
				if (mysql_num_rows($query)) {
					$item['prev'] = mysql_fetch_assoc($query);
					$item['prev']['url'] = $this->getUrl($this->nav, $item['prev']['category']) . '/?id=' . $item['prev']['id'];
				}

				$query = mysql_query("SELECT * FROM `portfolio` WHERE `id`>{$item['id']} ORDER BY `id` ASC LIMIT 1");
				if (mysql_num_rows($query)) {
					$item['next'] = mysql_fetch_assoc($query);
					$item['next']['url'] = $this->getUrl($this->nav, $item['next']['category']) . '/?id=' . $item['next']['id'];
				}

				$data['portfolio-item'] = $item;
				$this->render('portfolio-item.php', $data);
			}
			else {
				$data['portfolio'] = array();
				while ($item = mysql_fetch_assoc($query)) {
					$item['url'] = $this->getUrl($this->nav, $item['category']) . '/?id=' . $item['id'];
					$data['portfolio'][] = $item;
				}
				$this->render('portfolio.php', $data);
			}
		}


		public function price()
		{
			$data = array();
			if ($_GET['category']) {
				$condition = "WHERE `category`=(SELECT `id` FROM `navigation` WHERE `url`='{$_GET['category']}')";
			}
			else {
				$condition = "WHERE `category`=(SELECT `id` FROM `navigation` WHERE `module`='portfolio' AND `parent`!=0 LIMIT 1)";
			}

			$query = mysql_query("SELECT * FROM `price-list` $condition");

			$data['price'] = array();
			while ($item = mysql_fetch_assoc($query)) {
				$data['price'][] = $item;
			}

			$this->render('price.php', $data);
		}


		public function support()
		{
			$data = array();
			$query = mysql_query("SELECT * FROM `clients`");
			$data['clients'] = array();

			while ($item = mysql_fetch_assoc($query)) {
				$data['clients'][] = $item;
			}

			$this->render('support.php', $data);
		}


		public function get404()
		{
			header("HTTP/1.0 404 Not Found");
			$this->render('404.php');
			die();
		}
	}
?>