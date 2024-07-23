<?php

if ($process == 'list') {

     $q= $db->prepare("SELECT todos.*,c.title as category_title FROM todos 
         LEFT JOIN categories c ON todos.category_id = c.id
         WHERE todos.user_id=? && status =? ORDER BY start_date ASC");
    $q->execute([get_session('id'),'s']);
    $todos = $q->fetchAll(PDO::FETCH_ASSOC);



    $q = $db->prepare("SELECT status,count(todos.id) as toplam,
       (count(todos.id) *100 / (SELECT count(id) FROM todos WHERE user_id=?)) as yuzde
FROM todos
         WHERE todos.user_id=? GROUP BY todos.status");
    $q->execute([get_session('id'),get_session('id')]);

    if ($q->rowCount()) {
        return [
            'type'=>'success',
            'success' => true,
            'data' => array_merge(['istatistik'=> $q->fetchAll(PDO::FETCH_ASSOC)],['surec' => $todos])
        ];


    } else {
        return [
            'type'=>'success',
            'success' => true,
            'data' => [],
        ];
    }
}

