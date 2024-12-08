<?php
    require_once '../src/controllers/CommentController.php';

    $commentController = new CommentController();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'addComment') {
        // AuthMiddleware::checkRole('admin')
        $commentController->addComment([
            'bookid' => $_POST['bookid'],
            'memberid' => $_POST['memberid'],
            'content' => $_POST['content']
        ]);
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'getComment'){
        $commentController->getComment($_GET['page'],$_GET['perPage'],$_GET['bookid'], $_GET['memberid'], $_GET['time']);   
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_GET['action'] === 'updateComment') {
        // AuthMiddleware::checkRole('admin')
        $commentController->updateComment([
            'bookid' => $_POST['bookID'],
            'memberid' => $_POST['memberID'],
            'content' => $_POST['content'],
            'time'=> $_POST['time']
        ]);
    }
    elseif ($_SERVER['REQUEST_METHOD'] === 'POST'&& $_GET['action'] ==='deleteComment'){
        // AuthMiddleware::checkRole('admin')
        $commentController->deleteComment($_POST['bookID'], $_POST['memberID'], $_POST['time']);
    }