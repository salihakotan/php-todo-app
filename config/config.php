<?php

const BASEDIR = 'C:\xampp\htdocs\php-todo-app';
const URL ='http://localhost/php-todo-app/';
const DEV_MODE = true;

try {
$db= new PDO("mysql:host=localhost;dbname=todoapp", "root", "");
}catch (PDOException $e){
    echo $e->getMessage();
}