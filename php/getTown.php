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

  //SQL文（クエリー作成）
  $stmt = $dbh->prepare('SELECT `id`, `org_name` FROM `rank` WHERE `pref_id` = :prefId ');

  $stmt->execute(array(':prefId' => $_GET['prefId']));

  $result = array();

  // $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $result = $stmt->fetchAll();

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
