<?php
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
				$main->insert($_POST['table'], $_POST['i-data']);
			}
			elseif ($_POST['action'] == 'update') {
				$main->update($_POST['table'], $_POST['u-data'], $_POST['id']);
			}
			elseif ($_POST['action'] == 'remove') {
				$main->delete($_POST['table'], $_POST['id']);
			}
			elseif ($_POST['action'] == 'change-queue') {
				$main->changeQueue($_POST['table'], $_POST['index'], $_POST['type']);
			}
			elseif ($_POST['action'] == 'message') {
				$main->sendMail();
			}
		}

		$func =$main->getModule($main->nav);
		$main->$func();
	}
?>