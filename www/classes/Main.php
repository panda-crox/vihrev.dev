<?php
	class Main
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
			$this->filesPath = $_SERVER['DOCUMENT_ROOT'] . '/files/';
			$this->isAdmin = preg_match('/(^admin)/', $_SERVER['HTTP_HOST']);
			$this->host = preg_replace('/(^admin\.)/', '', $_SERVER['HTTP_HOST']);
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

			$query = mysql_query("SELECT * FROM `navigation` WHERE `side`='' OR `side`='$side' ORDER BY `index` ASC");
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
			$this->set('isAdmin', $this->isAdmin);
			$this->set('host', $this->host);
			if ($this->isAJAX) {
				$this->display($template);
			} else {
				$this->set('content', $this->fetch($template));
				$this->display('layout.php');
			}
			die();
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
			$condition = "";

			if (!$this->isAdmin) {
				$data['top-banner'] = $this->select("SELECT `top-banner`.*, `portfolio`.`category`, `portfolio`.`id` AS `portfolio_id` FROM `top-banner`
																						LEFT JOIN `portfolio` ON `portfolio`.`id`=`top-banner`.`portfolio`
																						ORDER BY `top-banner`.`index` ASC");
				$data['previews'] = $this->select("SELECT `portfolio`.*, `navigation`.`caption` AS `category_name` FROM `portfolio`
																					LEFT JOIN `navigation` ON `navigation`.`id`=`portfolio`.`category`
																					WHERE `on_frontpage`=1 ORDER BY `portfolio`.`index` ASC");
				$data['clients'] = $this->select("SELECT * FROM `clients` WHERE `on_frontpage`=1 ORDER BY `index` ASC");

				$data['services'] = $this->select("SELECT * FROM `services` ORDER BY `index` ASC");

				foreach ($data['top-banner'] as $key => $item) {
					$navItem = $this->getNavItem($this->nav, 'id', $item['category']);
					$data['top-banner'][$key]['url'] = $navItem['url'] . '/?id=' . $item['portfolio_id'];
				}
				foreach ($data['previews'] as $key => $item) {
					$navItem = $this->getNavItem($this->nav, 'id', $item['category']);
					$data['previews'][$key]['url'] = $navItem['url'] . '/?id=' . $item['id'];
				}
				foreach ($data['services'] as $key => $item) {
					$navItem = $this->getNavItem($this->nav, 'id', $item['category']);
					$data['services'][$key]['url'] = $navItem['url'];
				}
			}
			else {
				$navItem = $this->getNavItem($this->nav, 'url', $this->requestPath);
				if (!$navItem['section']) {
					$this->redirect($navItem['childs'][0]['url']);
				}				
				if ($_POST['action'] == 'getForm' && $_POST['id']) {
					$condition = "WHERE `id`=".$_POST['id'];
				}
				$table = $navItem['section'];				
				$data[$table] = $this->select("SELECT * FROM `$table` $condition ORDER BY `index` ASC");
				if ($table == 'top-banner') {
					$data['portfolio'] = $this->select("SELECT * FROM `portfolio`");
					foreach ($data['portfolio'] as $key => $item) {
						$navItem = $this->getNavItem($this->nav, 'id', $item['category']);
						$data['portfolio'][$key]['url'] = $navItem['url'] . '/?id=' . $item['id'];
					}
				}
				if ($_POST['action'] == 'getForm') {
					$this->render("forms/$table.php", $data);
				}
			}

			$this->render('frontpage.php', $data);
		}


		public function portfolio()
		{
			if ($_GET && ( count($_GET) > 1 || (!isset($_GET['id']) && !isset($_GET['branches'])) )) {
				$this->get404();
			}
			$requestPath = explode('/', $this->requestPath);
			$data = array();
			$condition = "";
			if (count($requestPath) > 1) {
				$condition .= "WHERE `t1`.`category`=(SELECT `id` FROM `navigation` WHERE `url`='{$requestPath[1]}') ";
			}

			if ($_GET['id'] && !isset($_GET['action'])) {
				$condition .= "AND `t1`.`id`={$_GET['id']}";
				$item = $this->select("SELECT `t1`.*, `prev`.`id` AS `prev_id`, `prev`.`name` AS `prev_name`, `prev`.`category` AS `prev_category`,
															`next`.`id` AS `next_id`, `next`.`name` AS `next_name`, `next`.`category` AS `next_category` FROM `portfolio` AS `t1`
															LEFT JOIN `portfolio` AS `prev` ON `prev`.`id`=(SELECT `id` FROM `portfolio` WHERE `index`<`t1`.`index` ORDER BY `index` DESC LIMIT 1)
															LEFT JOIN `portfolio` AS `next` ON `next`.`id`=(SELECT `id` FROM `portfolio` WHERE `index`>`t1`.`index` ORDER BY `index` ASC LIMIT 1)
															$condition GROUP BY 1 LIMIT 1");
				if (!$item) {
					$this->get404();
				}
				$item = $item[0];

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
				if (isset($_GET['branches']) && $_POST && $_POST['action'] != 'getForm') {
					echo json_encode(array('json' => true, 'updatePage' => true));
					die();
				}
				if ($_POST['action'] == 'getForm' && $_POST['id']) {
					$condition = "WHERE `t1`.`id`=".$_POST['id'];
				}
				$data['portfolio'] = $this->select("SELECT `t1`.*, `t2`.`caption` AS `category_name` FROM `portfolio` AS `t1`
																					LEFT JOIN `navigation` AS `t2` ON `t2`.`id`=`t1`.`category` $condition ORDER BY `index` ASC");
				foreach ($data['portfolio'] as $key => $item) {
					$navItem = $this->getNavItem($this->nav, 'id', $item['category']);
					$data['portfolio'][$key]['url'] = $navItem['url'] . '/?id=' . $item['id'];
				}

				if ($_POST['action'] == 'getForm') {
					$this->render("forms/portfolio.php", $data);
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
			$condition = "";
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

			if ($_POST['action'] == 'getForm' && $_POST['id']) {
				$condition = "AND `id`=".$_POST['id'];
			}

			$data['price'] = $this->select("SELECT * FROM `price-list` WHERE `category`={$navItem['id']} $condition");
			$data['category'] = $navItem['id'];

			if ($_POST['action'] == 'getForm') {
				$this->render("forms/price.php", $data);
			}

			$this->render('price.php', $data);
		}


		public function support()
		{
			if ($_GET) {
				$this->get404();
			}
			$data = array();
			$condition = "";
			if (!$this->isAdmin) {
				$data['clients'] = $this->select("SELECT * FROM `clients`");
				$data['support'] = $this->select("SELECT * FROM `support`");
			} else {
				$navItem = $this->getNavItem($this->nav, 'url', $this->requestPath);
				if (!$navItem['section']) {
					$this->redirect($navItem['childs'][0]['url']);
				}
				if ($_POST['action'] == 'getForm' && $_POST['id']) {
					$condition = "AND `id`=".$_POST['id'];
				}
				$section = $navItem['section'];
				$data[$section] = $this->select("SELECT * FROM `support` WHERE `type`='$section' $condition");

				if ($_POST['action'] == 'getForm') {
					$this->render("forms/support-$section.php", $data);
				}
			}

			$this->render('support.php', $data);
		}


		public function get404()
		{
			header("HTTP/1.0 404 Not Found");
			$this->render('404.php');
			die();
		}


		public function auth($data)
		{
			$user = $this->select("SELECT * FROM `settings` WHERE `login`='{$data['login']}' && `password`='{$data['password']}'");
			if ($user) {
				$_SESSION['error'] = false;
				$_SESSION['user'] = $user[0];
				$this->redirect('/');
			} else {
				$_SESSION['error'] = true;
			}
		}


		public function redirect($url)
		{
			if ($this->isAJAX) echo json_encode(array('json' => true, 'redirect' => $url));
			else header('Location: ' . $url);
			die();
		}


		public function sendMail()
		{
			require_once('classes/phpmailer/class.phpmailer.php');
			$mailer = new PHPMailer();
			$contacts = $this->select("SELECT * FROM `support` WHERE `type`='contacts' AND `name`='mail'");
			$to = $contacts[0]['value'];
			$subject = 'Новая заявка с сайта';
			$message = nl2br($_POST['text']);

			$mailer->FromName = $_POST['fio'] . ($_POST['org'] ? " (" . $_POST['org'] . ")" : "");
			$mailer->From = $_POST['email'];
			$mailer->Subject = $subject;
			$mailer->Body = $message;
			$mailer->isHTML(true);
			$mailer->IsSMTP();
			$mailer->AddAddress($to);
			$mailer->CharSet = 'utf-8';

			if($_POST['files']) {
				foreach ($_POST['files'] as $file) { 
					$mailer->AddAttachment($_SERVER['DOCUMENT_ROOT'] . '/uploaded/' . $file, $file);
				}
			}
			
			if(@$mailer->Send()){
				$mailer->ClearAddresses();
				$mailer->ClearAttachments();
				echo json_encode(array('json' => true, 'type' => 'message'));
			}
			die();
		}


		public function removeDirectory($dir)
		{
			if ($objs = glob($dir."/*")) {
				foreach($objs as $obj) {
					is_dir($obj) ? $this->removeDirectory($obj) : unlink($obj);
				}
	    }
	    rmdir($dir);
	  }


		public function select($query)
		{
			$data = array();
			$query = mysql_query($query);
			while ($item = mysql_fetch_assoc($query)) {
				foreach ($item as $key => $value) {
					$item[$key] = ($v = unserialize($value)) ? $v : $value;
				}
				$data[] = $item;
			}
			return $data;
		}


		public function insert($table, $data)
		{
			$keys = ''; $values = '';
			$query = mysql_query("SELECT `index` FROM `$table` ORDER BY `index` DESC LIMIT 1");
			$last = mysql_num_rows($query) ? mysql_fetch_assoc($query) : array('index' => 0);
			foreach ($data as $key => $value) {
				if (is_array($value)) $value = serialize($value);
				$keys .= $keys ? ",`$key`" : "`$key`";
				$values .= $values ? ",'$value'" : "'$value'";
			}
			$query = mysql_query("INSERT INTO `$table` ($keys) VALUES ($values)");
			$query = mysql_query("UPDATE `$table` SET `index`=".($last['index'] + 1)." WHERE `id`=".mysql_insert_id());
		}


		public function update($table, $data, $id)
		{
			$keysValues = '';
			$query = mysql_query("SELECT * FROM `$table` WHERE `id`=$id");
			$item = mysql_fetch_assoc($query);
			foreach ($item as $key => $value) {
				if (!$value || $value == $data[$key]) continue;
				if ($v = unserialize($value)) {
					foreach ($v as $key2 => $value2) {
						if (!$value2 || in_array($value2, $data[$key])) continue;
						$filepath = $this->filesPath . $value2;
						@is_dir($filepath) ? @$this->removeDirectory($filepath) : @unlink($filepath);
					}
				}
				else {
					$filepath = $this->filesPath . $value;
					@is_dir($filepath) ? @$this->removeDirectory($filepath) : @unlink($filepath);
				}
								
			}
			foreach ($data as $key => $value) {
				if (is_array($value)) $value = serialize($value);
				$keysValues .= $keysValues ? ",`$key`='$value'" : "`$key`='$value'";
			}
			$query = mysql_query("UPDATE `$table` SET $keysValues WHERE `id`=$id");
		}


		public function delete($table, $id)
		{
			$query = mysql_query("SELECT * FROM `$table` WHERE `id`=$id");
			$item = mysql_fetch_assoc($query);
			$query = mysql_query("DELETE FROM `$table` WHERE `id`=$id");

			foreach ($item as $key => $value) {
				if (!$value) continue;
				$filepath = $this->filesPath . $value;
				@is_dir($filepath) ? @$this->removeDirectory($filepath) : @unlink($filepath);				
			}
		}


		public function queue($table, $index, $type)
		{
			$symbol = $type == 'up' ? "<" : ">";
			$order = $type == 'up' ? "DESC" : "ASC";
			$query = mysql_query("SELECT * FROM `$table` WHERE `index` $symbol $index ORDER BY `index` $order LIMIT 1");
			$item = mysql_fetch_assoc($query);
			$query = mysql_query("UPDATE `$table` SET `index`={$item['index']} WHERE `index`=$index");
			$query = mysql_query("UPDATE `$table` SET `index`=$index WHERE `id`={$item['id']}");
		}


		public function onFrontpage($table, $id, $val)
		{
			$query = mysql_query("UPDATE `$table` SET `on_frontpage`=$val WHERE `id`=$id");
		}
	}
?>