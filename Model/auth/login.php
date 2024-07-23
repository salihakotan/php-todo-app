<?php

if ($process == 'login') {

    if (!$data['email']){
        return [
            'success' => false,
            'type'=>'danger',
            'message' => 'Email is required'
        ];
    }
    if (!$data['password']){
        return [
            'success' => false,
            'type'=>'danger',
            'message' => 'Please enter your password'
        ];
    }

    $email = $data['email'];
    $password = md5($data['password']);

    $q = $db->prepare("SELECT *,CONCAT(name,' ',surname) as fullname FROM users WHERE email=? && password=?");
    $q->execute([$email, $password]);

    if ($q->rowCount()) {
        $user = $q->fetch(PDO::FETCH_ASSOC);


        add_session('id', $user['id']);
        add_session('name', $user['name']);
        add_session('surname', $user['surname']);
        add_session('password', $user['password']);
        add_session('fullname', $user['fullname']);
        add_session('email', $user['email']);
        add_session('login',true);

        return [
            'data' => $user,
            'type'=>'success',
            'message' => 'Logged in successfully',
            'success' => true,
            'redirect'=>'home'
        ];


    } else {
        return [
            'success' => false,
            'type'=>'danger',
            'message' => 'Email or password is incorrect'
        ];
    }
}