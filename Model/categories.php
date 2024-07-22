<?php

if ($process == 'add') {

    if (!$data['title']){
        return [
            'success' => false,
            'type'=>'danger',
            'message' => 'Category title is required'
        ];
    }


    $title = $data['title'];

    $q = $db->prepare("INSERT INTO categories SET title=?,user_id=?");
    $q->execute([$title, get_session('id')]);

    if ($q->rowCount()) {
        return [
            'type'=>'success',
            'message' => 'Category added successfully',
            'success' => true,
            'redirect'=>'categories/list'
        ];


    } else {
        return [
            'success' => false,
            'type'=>'danger',
            'message' => 'An error occured'
        ];
    }
}
elseif ($process == 'list') {



    $q = $db->prepare("SELECT * FROM categories WHERE user_id=?");
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
elseif ($process == 'remove') {

    $id = $data['id'];

    $q = $db->prepare("DELETE FROM categories WHERE categories.id=? && categories.user_id=?");
    $q->execute([$id,get_session('id')]);

    if ($q->rowCount()) {


        return [
            'type'=>'success',
            'success' => true,
            'message' => 'Category removed successfully',
        ];


    } else {

        return [
            'type'=>'danger',
            'success' => false,
            'message' => 'An error occured while removing category'
        ];
    }
}

elseif ($process == 'getsingle') {

    $id = $data['id'];
    $q = $db->prepare("SELECT * FROM categories WHERE categories.id=? && user_id=?");
    $q->execute([$id,get_session('id')]);

    if ($q->rowCount()) {
        return [
            'type'=>'success',
            'success' => true,
            'data' => $q->fetch(PDO::FETCH_ASSOC),
        ];


    } else {
        return [
            'type'=>'success',
            'success' => true,
            'data' => [],
        ];
    }
}


elseif ($process == 'edit') {

    $id = $data['id'];
    $title = $data['title'];

    if (!$data['title']){
        return [
            'success' => false,
            'type'=>'danger',
            'message' => 'Category title is required'
        ];
    }


    $q = $db->prepare("UPDATE categories SET categories.title=? WHERE categories.id=? && user_id=?");
    $edit = $q->execute([$title,$id,get_session('id')]);

    if ($edit) {
        return [
            'type'=>'success',
            'success' => true,
            'message' => 'Category edited successfully',
        ];


    } else {
        return [
            'type'=>'danger',
            'message' => 'An error occured while updating category',
            'success' => true,
        ];
    }
}