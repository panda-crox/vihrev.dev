<?php
	session_start();
	mysql_connect('localhost', 'root', '') or die('No connect');
	mysql_select_db('vihrev');
	mysql_query("SET CHARSET utf8");
	//chmod($_SERVER['DOCUMENT_ROOT'] . '/uploaded/', 0777);
	
	require_once('classes/Main.php');
	$main = new Main();


	if (!$main->checkUrl($main->nav) && $main->requestPath != 'uploadFiles') {
		$main->get404();
	}
	else if ($main->requestPath == 'uploadFiles') {
		require_once('classes/Uploader.php');

		$uploader = new FileUpload('file');
		$fileName = time() . rand(100, 999);
		$fileExt = strtolower($uploader->getExtension());
		$uploader->newFileName = $fileName . '.' . $fileExt;
		$result = $uploader->handleUpload($_SERVER['DOCUMENT_ROOT'] . ($main->isAdmin ? '/files/' : '/uploaded/'));

		if (!$result) {
			echo json_encode(array('success' => false, 'msg' => $uploader->getErrorMsg()));
		} else {
			if ($fileExt == 'zip' && $main->isAdmin) {
				mkdir($_SERVER['DOCUMENT_ROOT'] . '/files/' . $fileName);
				$zip = new ZipArchive; 
				$zip->open($_SERVER['DOCUMENT_ROOT'] . '/files/' . $uploader->getFileName());
				$zip->extractTo($_SERVER['DOCUMENT_ROOT'] . '/files/' . $fileName); 
				$zip->close();
				@unlink($_SERVER['DOCUMENT_ROOT'] . '/files/' . $uploader->getFileName());
				echo json_encode(array('success' => true, 'file' => $fileName));
			} else {
				echo json_encode(array('success' => true, 'file' => $uploader->getFileName()));
			}
		}  
	}
	else {
		if ($_POST) {
			if ($_POST['action'] == 'insert') {
				$main->insert($_POST['table'], $_POST['data']);
			}
			elseif ($_POST['action'] == 'update') {
				$main->update($_POST['table'], $_POST['data'], $_POST['id']);
			}
			elseif ($_POST['action'] == 'delete') {
				$main->delete($_POST['table'], $_POST['id']);
			}
			elseif ($_POST['action'] == 'queue') {
				$main->queue($_POST['table'], $_POST['index'], $_POST['type']);
			}
			elseif ($_POST['action'] == 'on-frontpage') {
				$main->onFrontpage($_POST['table'], $_POST['id'], $_POST['val']);
			}
			elseif ($_POST['action'] == 'message') {
				$main->sendMail();
			}
			elseif ($_POST['action'] == 'auth') {
				$main->auth($_POST['data']);
			}
		}

		if ($main->isAdmin && !$_SESSION['user']) {
			echo $main->fetch('admin/auth.php');
			die();
		}

		$func =$main->getModule($main->nav);
		$main->$func();
	}
?>