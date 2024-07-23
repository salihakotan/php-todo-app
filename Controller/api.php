<?php


if (route(1) == 'addtodo') {

    $post = filter($_POST);

    $start_date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s');

    if (!$post['title']) {

        $status = 'error';
        $title = 'Ops!';
        $msg = 'Please enter a title';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

    if (!$post['description']) {

        $status = 'error';
        $title = 'Ops!';
        $msg = 'Please enter a description';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

    if ($post['start_date_time'] && $post['start_date']) {
        $start_date = $post['start_date'] . ' ' . $post['start_date_time'];
    }

    if ($post['end_date_time'] && $post['end_date']) {
        $end_date = $post['end_date'] . ' ' . $post['end_date_time'];
    }


    if ($post['category_id']) {
        $user_id = get_session('id');
        $c_id = $post['category_id'];
        $q = $db->query("SELECT id FROM categories WHERE user_id='$user_id' && categories.id ='$c_id'");
        $c = $q->fetch(PDO::FETCH_ASSOC);

        if (!$c) {
            $status = 'error';
            $title = 'Ops!';
            $msg = 'Sadece oluşturduğunuz kategorilere ekeleme yapabilirsiniz!';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }


    $q = $db->prepare("INSERT INTO todos SET
                   todos.title =?, 
                   todos.description =?,
                   todos.color=?,
                   todos.status=?,
                   todos.progress=?,
                   todos.start_date =?,
                   todos.end_date =?,
                   todos.category_id =?,
                   todos.user_id =?
                   ");

    $insert = $q->execute([
        $post['title'],
        $post['description'],
        $post['color'] ?? '#007bff',
        $post['status'] ?? 'a',
        intval($post['progress']) ?? 1,
        $start_date,
        $end_date,
        $post['category_id'] ?? 0,
        get_session('id')

    ]);

    if ($insert) {
        $status = 'success';
        $title = 'Success';
        $msg = 'Added a new todo';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => url('todo/list')]);
        exit();
    } else {
        $status = 'error';
        $title = 'Ops!';
        $msg = 'Something went wrong';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

}
elseif (route(1) == 'edittodo') {

    $post = filter($_POST);

    $start_date = date('Y-m-d H:i:s');
    $end_date = date('Y-m-d H:i:s');

    if (!$post['title']) {

        $status = 'error';
        $title = 'Ops!';
        $msg = 'Please enter a title';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

    if (!$post['description']) {

        $status = 'error';
        $title = 'Ops!';
        $msg = 'Please enter a description';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

    if ($post['start_date_time'] && $post['start_date']) {
        $start_date = $post['start_date'] . ' ' . $post['start_date_time'];
    }

    if ($post['end_date_time'] && $post['end_date']) {
        $end_date = $post['end_date'] . ' ' . $post['end_date_time'];
    }


    if ($post['category_id']) {
        $user_id = get_session('id');
        $c_id = $post['category_id'];
        $q = $db->query("SELECT id FROM categories WHERE user_id='$user_id' && categories.id ='$c_id'");
        $c = $q->fetch(PDO::FETCH_ASSOC);

        if (!$c) {
            $status = 'error';
            $title = 'Ops!';
            $msg = 'Sadece oluşturduğunuz kategorilere ekeleme yapabilirsiniz!';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();
        }
    }


    $q = $db->prepare("UPDATE todos SET
                   todos.title=?, 
                   todos.description=?,
                   todos.color=?,
                   todos.status=?,
                   todos.progress=?,
                   todos.start_date=?,
                   todos.end_date=?,
                   todos.category_id=?
                   WHERE todos.id=? && todos.user_id=? ");

    $update = $q->execute([
        $post['title'],
        $post['description'],
        $post['color'] ?? '#007bff',
        $post['status'] ?? 'a',
        intval($post['progress']) ?? 1,
        $start_date,
        $end_date,
        $post['category_id'] ?? 0,
        $post['id'],
        get_session('id'),

    ]);

    if ($update) {
        $status = 'success';
        $title = 'Success';
        $msg = 'Todo updated successfully';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg, 'redirect' => url('todo/list')]);
        exit();
    } else {
        $status = 'error';
        $title = 'Ops!';
        $msg = 'Something went wrong';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

}
elseif (route(1) == 'removetodo') {


//    $status = 'error';
//    $title = 'Ops!';
//    $msg = 'Please enter a title';
//    echo json_encode(['status'=>$status,'title'=>$title,'msg'=>$msg]);
//    exit();

    $post = filter($_POST);

    if (!$post['id']) {
        $status = 'error';
        $title = 'Ops!';
        $msg = 'ID not found';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

    $id = $post['id'];
    $user = get_session('id');
    $q = $db->query("DELETE FROM todos WHERE todos.id = '$id' && todos.user_id = '$user'");

    if ($q){
        $status = 'success';
        $title = 'Successfull';
        $msg = 'Successfully removed todo';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg,'id'=>$id]);
        exit();
    }else {
        $status = 'error';
        $title = 'Ops!';
        $msg = 'Something went wrong';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

}
elseif(route(1)=='calendar'){

    $end = get('end');
    $start = get('start');


    $sql = "SELECT id,title,color, start_date as start, end_date as end, CONCAT('/todoapp/todo/edit/',todos.id) as url FROM todos
         WHERE todos.user_id=?";

    if ($start && $end){
        $sql.= " && (end_date BETWEEN '$end' AND '$start' OR start_date BETWEEN '$start' AND '$end')";
    }

    $q = $db->prepare($sql);
    $q->execute([get_session('id')]);
    $array = $q->fetchAll(PDO::FETCH_ASSOC);


    echo json_encode($array);
}