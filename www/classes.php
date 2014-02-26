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
			$this->viewsPath = $_SERVER['DOCUMENT_ROOT'] . '/views/';
			$this->isAdmin = preg_match('/(^admin)/', $_SERVER['HTTP_HOST']);
			$this->isAJAX = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
			$this->nav = $this->getNav();
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
				elseif ($item['childs'] && $module = $this->getModule($item['childs'])) {
					return $module;
				}
			}
		}


		public function getNav()
		{
			$nav = array();
			$side = $this->isAdmin ? 'admin' : 'client';
			function appendTo(&$items, $child) {
				foreach ($items as &$item) {
					if ($item['id'] == $child['parent']) {
						if (!$item['childs']) {
							$item['childs'] = array();
						}
						$child['url_'] = $child['url'];
						if ($item['url']) {
							$child['url'] = $item['url'] .'/'. $child['url'];
						}
						$item['childs'][] = $child;
						return;
					}
					elseif ($item['childs']) {
						appendTo($item['childs'], $child);
					}
				}
			}

			$query = mysql_query("SELECT * FROM `navigation` WHERE `side`='' OR `side`='$side' ORDER BY `id` ASC");
			while ($item = mysql_fetch_assoc($query)) {
				if (!$item['parent']) {
					$nav[] = $item;
				} else {
					appendTo($nav, $item);
				}
			}
			return $nav;
		}


		public function getNavItem($items, $key, $value)
		{
			foreach ($items as $item) {
				if ($item[$key] == $value) {
					return $item;
				}
				elseif ($item['childs'] && $child = $this->getNavItem($item['childs'], $key, $value)) {
					return $child;
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
			if ($this->isAJAX) {
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
			if ($_GET) {
				$this->get404();
			}
			$data = array();

			if (!$this->isAdmin) {
				$data['top-banner'] = $this->select("SELECT * FROM `top-banner` ORDER BY `index` ASC");
				$data['previews'] = $this->select("SELECT `portfolio`.*, `navigation`.`caption` AS `category_name` FROM `portfolio`
																					LEFT JOIN `navigation` ON `navigation`.`id`=`portfolio`.`category` WHERE `on_frontpage`=1");
				$data['clients'] = $this->select("SELECT * FROM `clients` WHERE `on_frontpage`=1 ORDER BY `index` ASC");

				foreach ($data['previews'] as $key => $item) {
					$navItem = $this->getNavItem($this->nav, 'id', $item['category']);
					$data['previews'][$key]['url'] = $navItem['url'] . '/?id=' . $item['id'];
				}
			}
			else {
				$navItem = $this->getNavItem($this->nav, 'url', $this->requestPath);
				if (!$navItem['section']) {
					$this->redirect($navItem['childs'][0]['url']);
				}
				$table = $navItem['section'];
				$data[$table] = $this->select("SELECT * FROM `$table` ORDER BY `index` ASC");
			}

			$this->render('frontpage.php', $data);
		}


		public function portfolio()
		{
			if ($_GET && (count($_GET) > 1 || (!isset($_GET['id']) && !isset($_GET['add']) && !isset($_GET['branches'])))) {
				$this->get404();
			}
			$requestPath = explode('/', $this->requestPath);
			$data = array();
			$condition = "";
			if (count($requestPath) > 1) {
				$condition .= "WHERE `t1`.`category`=(SELECT `id` FROM `navigation` WHERE `url`='{$requestPath[1]}') ";

			}

			if ($_GET['id']) {
				$condition .= "AND `t1`.`id`={$_GET['id']}";
				$item = $this->select("SELECT `t1`.*, `prev`.`id` AS `prev_id`, `prev`.`name` AS `prev_name`, `prev`.`category` AS `prev_category`,
															`next`.`id` AS `next_id`, `next`.`name` AS `next_name`, `next`.`category` AS `next_category` FROM `portfolio` AS `t1`
															LEFT JOIN `portfolio` AS `prev` ON `prev`.`id`=(SELECT `id` FROM `portfolio` WHERE `id`<{$_GET['id']} ORDER BY `id` DESC LIMIT 1)
															LEFT JOIN `portfolio` AS `next` ON `next`.`id`=(SELECT `id` FROM `portfolio` WHERE `id`>{$_GET['id']} ORDER BY `id` ASC LIMIT 1)
															$condition GROUP BY 1 LIMIT 1");
				if (!$item) {
					$this->get404();
				}

				if ($item['prev_id']) {
					$navItem = $this->getNavItem($this->nav, 'id', $item['prev_category']);
					$item['prev_url'] = $navItem['url'] . '/?id=' . $item['prev_id'];
				}

				if ($item['next_id']) {
					$navItem = $this->getNavItem($this->nav, 'id', $item['next_category']);
					$item['next_url'] = $navItem['url'] . '/?id=' . $item['next_id'];
				}

				$data['portfolio-item'] = $item;
				$this->render('portfolio-item.php', $data);
			}
			else {
				if (isset($_GET['branches']) && $_POST) {
					echo json_encode(array('json' => true, 'updatePage' => true));
					die();
				}
				elseif (isset($_GET['add']) && $_POST) {
					$this->redirect($requestPath[0]);
				}
				else {
					$data['portfolio'] = $this->select("SELECT `t1`.*, `t2`.`caption` AS `category_name` FROM `portfolio` AS `t1`
																					LEFT JOIN `navigation` AS `t2` ON `t2`.`id`=`t1`.`category` $condition ORDER BY `index` ASC");
					foreach ($data['portfolio'] as $key => $item) {
						$navItem = $this->getNavItem($this->nav, 'id', $item['category']);
						$data['portfolio'][$key]['url'] = $navItem['url'] . '/?id=' . $item['id'];
					}
				}				
				
				$this->render('portfolio.php', $data);
			}
		}


		public function price()
		{
			if ($_GET && (count($_GET) > 1 || !isset($_GET['category']))) {
				$this->get404();
			}
			$data = array();
			if ($_GET['category']) {
				$navItem = $this->getNavItem($this->nav, 'url_', $_GET['category']);
				if (!$navItem) {
					$this->get404();
				}
			}
			else {
				$navItemParent = $this->getNavItem($this->nav, 'module', 'portfolio');
				$this->redirect('?category=' . $navItemParent['childs'][0]['url_']);
			}

			$data['price'] = $this->select("SELECT * FROM `price-list` WHERE `category`={$navItem['id']}");
			$data['category'] = $navItem['id'];

			$this->render('price.php', $data);
		}


		public function support()
		{
			if ($_GET) {
				$this->get404();
			}
			$data = array();
			if (!$this->isAdmin) {
				$data['clients'] = $this->select("SELECT * FROM `clients`");
				$data['settings'] = $this->select("SELECT * FROM `settings`");
			} else {
				$navItem = $this->getNavItem($this->nav, 'url', $this->requestPath);
				if (!$navItem['section']) {
					$this->redirect($navItem['childs'][0]['url']);
				}
				$section = $navItem['section'];
				$data['settings'] = $this->select($q = "SELECT `id`, $section FROM `settings`");
				if(!$data['settings'][0][$section]) $data['settings'][0][$section] = array();
			}

			$this->render('support.php', $data);
		}


		public function get404()
		{
			header("HTTP/1.0 404 Not Found");
			$this->render('404.php');
			die();
		}


		public function redirect($url)
		{
			if ($this->isAJAX) echo json_encode(array('json' => true, 'redirect' => $url));
			else header('Location: ' . $url);
			die();
		}


		public function sendMail()
		{
			$to = 'salavat-1@mail.ru';
			$subject = 'Новая заявка с сайта';
			$message = nl2br($_POST['text']);
			$sid = md5(uniqid(time()));

			$headers = "";
			$headers .= "From: " . $_POST['fio'];
			if ($_POST['org']) $headers .= " (" . $_POST['org'] . ")";
			$headers .= " <".$_POST['email'].">\nReply-To: ".$_POST['email']."\r\n";

			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: multipart/mixed; boundary=\"".$sid."\"\r\n";
			$headers .= "This is a multi-part message in MIME format.\n";

			$headers .= "--".$sid."\n";
			$headers .= "Content-type: text/html; charset=utf-8\n";
			$headers .= "Content-Transfer-Encoding: 7bit\n\n";
			$headers .= $message."\n\n";

			//*** Attachment ***//  
			if($_POST['files']) {
				foreach ($_POST['files'] as $file) { 
					$fileBase64 = chunk_split(base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/uploaded/' . $file)));  
					$headers .= "--".$sid."\n";  
					$headers .= "Content-Type: application/octet-stream; name=\"".$file."\"\n";  
					$headers .= "Content-Transfer-Encoding: base64\n";  
					$headers .= "Content-Disposition: attachment; filename=\"".$file."\"\n\n";  
					$headers .= $fileBase64."\n\n";
				}
			}  

			mail($to, $subject, null, $headers);
			echo json_encode(array('json' => true, 'type' => 'message'));
			die();
		}


		public function select($query)
		{
			$data = array();
			$query = mysql_query($query);
			if (mysql_num_rows($query) > 1) {
				while ($item = mysql_fetch_assoc($query)) {
					foreach ($item as $key => $value) {
						$item[$key] = ($v = unserialize($value)) ? $v : $value;
					}
					$data[] = $item;
				}
			}
			else if (mysql_num_rows($query) == 1) {
				$data = mysql_fetch_assoc($query);
				foreach ($data as $key => $value) {
					$data[$key] = ($v = unserialize($value)) ? $v : $value;
				}
			}
			return $data;
		}


		public function insert($table, $data)
		{
			$keys = ''; $values = '';
			foreach ($data as $key => $value) {
				if (is_array($value)) $value = serialize($value);
				$keys .= $keys ? ",`$key`" : "`$key`";
				$values .= $values ? ",'$value'" : "'$value'";
			}
			$query = mysql_query("INSERT INTO `$table` ($keys) VALUES ($values)");
		}


		public function update($table, $data, $id)
		{
			$keysValues = '';
			foreach ($data as $key => $value) {
				if (is_array($value)) $value = serialize($value);
				$keysValues .= $keysValues ? ",`$key`='$value'" : "`$key`='$value'";
			}
			$query = mysql_query("UPDATE `$table` SET $keysValues WHERE `id`=$id");
		}


		public function remove($table, $id)
		{
			$query = mysql_query("SELECT * FROM `$table` WHERE `id`=$id");
			$item = mysql_fetch_assoc($query);
			$query = mysql_query("DELETE FROM `$table` WHERE `id`=$id");

			$files = $item['files'] ? unserialize($item['files']) : $item['file'] ? array($item['file']) : false;
			if ($files) {
				foreach ($files as $file) {
					@unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $item['file']);
				}
			}
		}


		public function changeQueue($table, $index, $type)
		{
			$symbol = $type == 'up' ? "<" : ">";
			$order = $type == 'up' ? "DESC" : "ASC";
			$query = mysql_query("SELECT * FROM `$table` WHERE `index` $symbol $index ORDER BY `index` $order LIMIT 1");
			$item = mysql_fetch_assoc($query);
			$query = mysql_query("UPDATE `$table` SET `index`={$item['index']} WHERE `index`=$index");
			$query = mysql_query("UPDATE `$table` SET `index`=$index WHERE `id`={$item['id']}");
		}
	}
?>