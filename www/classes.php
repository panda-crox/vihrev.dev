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
			if ($_GET && (count($_GET) > 1 || !isset($_GET['id']))) {
				$this->get404();
			}
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
					$navItem = $this->getNavItem($this->nav, 'id', $item['prev']['category']);
					$item['prev']['url'] = $navItem['url'] . '/?id=' . $item['prev']['id'];
				}

				$query = mysql_query("SELECT * FROM `portfolio` WHERE `id`>{$item['id']} ORDER BY `id` ASC LIMIT 1");
				if (mysql_num_rows($query)) {
					$item['next'] = mysql_fetch_assoc($query);
					$navItem = $this->getNavItem($this->nav, 'id', $item['next']['category']);
					$item['next']['url'] = $navItem['url'] . '/?id=' . $item['next']['id'];
				}

				$data['portfolio-item'] = $item;
				$this->render('portfolio-item.php', $data);
			}
			else {
				$data['portfolio'] = array();
				while ($item = mysql_fetch_assoc($query)) {
					$navItem = $this->getNavItem($this->nav, 'id', $item['category']);
					$item['url'] = $navItem['url'] . '/?id=' . $item['id'];
					$data['portfolio'][] = $item;
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
			if (mysql_num_rows($query)) {
				while ($item = mysql_fetch_assoc($query)) {
					foreach ($item as $key => $value) {
						$item[$key] = ($v = unserialize($value)) ? $v : $value;
					}
					$data[] = $item;
				}
			}
			return $data;
		}


		public function insert($table, $data)
		{
			$keys = ''; $values = '';
			$files = $data['files'] ? $data['files'] : $data['file'] ? array($data['file']) : false;
			if ($files) {
				foreach ($files as $file) {
					@rename($_SERVER['DOCUMENT_ROOT'] . '/uploaded/' . $file, $_SERVER['DOCUMENT_ROOT'] . '/files/' . $file);
				}
			}
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
			$files = $data['files'] ? $data['files'] : ($data['file'] ? array($data['file']) : false);
			if ($files) {
				foreach ($files as $file) {
					if (is_array($file)) $file = $file['file'];
					@rename($_SERVER['DOCUMENT_ROOT'] . '/uploaded/' . $file, $_SERVER['DOCUMENT_ROOT'] . '/files/' . $file);
				}
			}
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