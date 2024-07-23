<?php

if ($process == 'list') {



    $q = $db->prepare("SELECT todos.*, c.title as category_title FROM todos
         LEFT JOIN categories c ON c.id = todos.category_id
         WHERE todos.user_id=?");
    $q->execute([get_session('id')]);

    if ($q->rowCount()) {
        return [
            'type'=>'success',
            'success' => true,
            'data' => $q->fetchAll(PDO::FETCH_ASSOC),
        ];


    } else {
        return [
            'type'=>'success',
            'success' => true,
            'data' => [],
        ];
    }
}


elseif ($process == 'getsingle') {

    $id = $data['id'];
    $user_id = get_session('id');

    $q = $db->query("SELECT * FROM categories WHERE user_id='$user_id'");
    $category = $q->fetchAll(PDO::FETCH_ASSOC);

    $q = $db->prepare("SELECT * FROM todos WHERE todos.id=? && todos.user_id=?");
    $q->execute([$id,$user_id]);

    if ($q->rowCount()) {
        return [
            'type'=>'success',
            'success' => true,
            'data' => array_merge($q->fetch(PDO::FETCH_ASSOC), ['categories'=>$category])
        ];


    } else {
        return [
            'type'=>'success',
            'success' => true,
            'data' => [],
        ];
    }
}

