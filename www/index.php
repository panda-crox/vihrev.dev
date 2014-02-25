<?php
	mysql_connect('localhost', 'root', '') or die('No connect');
	mysql_select_db('vihrev');
	mysql_query("SET CHARSET utf8");
	//chmod($_SERVER['DOCUMENT_ROOT'] . '/uploaded/', 0777);
	
	require_once('classes.php');
	$vihrev = new Vihrev();


	if (!$vihrev->checkUrl($vihrev->nav) && $vihrev->requestPath != 'uploadFiles') {
		$vihrev->get404();
	}
	else if ($vihrev->requestPath == 'uploadFiles') {
		require_once('Uploader.php');

		$uploader = new FileUpload('file');
		$uploader->newFileName = time() . rand(100, 999) . '.' . strtolower($uploader->getExtension());
		$result = $uploader->handleUpload($_SERVER['DOCUMENT_ROOT'] . '/uploaded/');

		if (!$result) {
			echo json_encode(array('success' => false, 'msg' => $uploader->getErrorMsg()));
		} else {
			echo json_encode(array('success' => true, 'file' => $uploader->getFileName()));
		}  
	}
	else {
		if ($_POST) {
			if ($_POST['action'] == 'insert') {
				$vihrev->insert($_POST['table'], $_POST['i-data']);
			}
			elseif ($_POST['action'] == 'remove') {
				$vihrev->remove($_POST['table'], $_POST['id']);
			}
			elseif ($_POST['action'] == 'update') {
				$vihrev->update($_POST['table'], $_POST['u-data'], $_POST['id']);
			}
			elseif ($_POST['action'] == 'change-queue') {
				$vihrev->changeQueue($_POST['table'], $_POST['index'], $_POST['type']);
			}
			elseif ($_POST['action'] == 'message') {
				$vihrev->sendMail();
			}
		}

		$func =$vihrev->getModule($vihrev->nav);
		$vihrev->$func();
	}
?>