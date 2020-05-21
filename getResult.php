<?php

if(!empty($_GET)){

  // Content-TypeをJSONに指定
  header('Content-Type: application/json');

  // クロスドメイン対策
  header('Access-Control-Allow-Origin: *');

  $dsn = 'mysql:dbname=water_rank;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $options = array(
    // SQL実行失敗時に例外をスロー
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // デフォルトフェッチモードを連想配列形式に設定
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
    // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
  );

  // PDOオブジェクト生成（DBへ接続）
  $dbh = new PDO($dsn, $user, $password, $options);

  //SQL文（事業体情報取得）
  $stmt1 = $dbh->prepare('SELECT * FROM `rank` WHERE `id` = :townId ');

  $stmt1->execute(array(':townId' => $_GET['townId']));

  $result1 = array();

  $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);
  // $result = $stmt->fetchAll();

  // var_dump($result1['pref_id']);

  //SQL文（都道府県内の事業体数取得）
  $stmt2 = $dbh->prepare('SELECT `group_count` FROM `pref` WHERE `id` = :prefId ');

  $stmt2->execute(array(':prefId' => $result1['pref_id']));

  $result2 = array();

  $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  
  // var_dump($result2);

  // ２つの結果を結合

  $result = array_merge($result1, $result2);

  // var_dump($result);

  //結果が空の場合
  if(empty($result)){
    echo json_encode(array(
        'errorFlg' => true,
        'msg' => '空です'
    ));
  }else{
    echo json_encode($result);
  }
  exit();

}