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
elseif (route(1)=='profile'){

    $post = filter($_POST);

    if (!$post['isim']){
        $status = 'error';
        $title = 'Ops!';
        $msg = 'Please enter your name';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

    if (!$post['soyisim']){
        $status = 'error';
        $title = 'Ops!';
        $msg = 'Please enter your surname';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }


    if (!$post['email']){
        $status = 'error';
        $title = 'Ops!';
        $msg = 'Please enter your email';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }

    $isim = $post['isim'];
    $soyisim = $post['soyisim'];
    $email = $post['email'];
    $id = get_session('id');

    $q = $db->query("UPDATE users SET name='$isim', email='$email',surname='$soyisim' WHERE id='$id'");

    if ($q){

        add_session('name',$isim);
        add_session('email',$email);
        add_session('surname',$soyisim);
        add_session('fullname',$isim.' '.$soyisim);

        $status = 'success';
        $title = 'Successfull';
        $msg = 'Profile updated successfully';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }else {
        $status = 'error';
        $title = 'Ops!';
        $msg = 'Something went wrong';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }


//    $q = $db->query('')

}
elseif (route(1)=="password_change"){

    $post = filter($_POST);

    if (!$post['old_password'] || (get_session('password') != md5($post['old_password']))) {

            $status = 'error';
            $title = 'Ops!';
            $msg = 'Please enter your current password';
            echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
            exit();

    }

    $kucuk = preg_match('#[a-z]#', $post['password']);
    $buyuk = preg_match('#[A-Z]#', $post['password']);
    $sayi = preg_match('#[0-9]#', $post['password']);

    if (!$post['password'] || !$kucuk || !$sayi || !$buyuk || strlen($post['password']) < 6) {
        $status = 'error';
        $title = 'Ops!';
        $msg = 'Password should be at least 6 characters and must contain at least one number, one uppercase and lowercase letter';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }


    if (!$post['password_again']  || ($post['password'] != $post['password_again'])) {

        $status = 'error';
        $title = 'Ops!';
        $msg = 'Passwords does not match';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();

    }

    $id = get_session('id');
    $p = md5($post['password']);

    $upd = $db->query("UPDATE users SET password='$p' WHERE users.id='$id'");

    if ($upd){

        add_session('password',$p);

        $status = 'success';
        $title = 'Successfull';
        $msg = 'Password updated successfully';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }else {
        $status = 'error';
        $title = 'Ops!';
        $msg = 'Something went wrong';
        echo json_encode(['status' => $status, 'title' => $title, 'msg' => $msg]);
        exit();
    }



}