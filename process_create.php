<?php

// 送信確認
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if(
  !isset($_POST['uid']) || $_POST['uid']==''||
  !isset($_POST['birthDay']) || $_POST['birthDay']==''||
  !isset($_POST['name']) || $_POST['name']==''
){
 exit('ParamError');

};


// 受け取ったデータを変数に入れる
$uid = $_POST['uid'];
$name = $_POST['name'];
$birthDay = $_POST['birthDay'];




// DB接続の設定
// DB名は`gsacf_x00_00`にする
$dbn = 'mysql:dbname=gsacf_l03_01;
          charset=utf8;
          port=3306;
          host=localhost';

$user = 'root';
$pwd = '';

try {
  // ここでDB接続処理を実行する
  $pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
  // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
  // echo json_encode(["db error" => "{$e->getMessage()}"]);
  exit('dbError:' .$e -> getMessage());
}

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO startup_support(id, 受講者番号, 名前, 生年月日, 作成日)
        VALUES (NULL, :uid, :name, :birthDay, sysdate())';

  // var_dump($sql);

  $stmt = $pdo -> prepare($sql);
  var_dump($stmt);
  $stmt -> bindValue(':uid', $uid, PDO::PARAM_STR);
  $stmt -> bindValue(':name', $name, PDO::PARAM_STR);
  $stmt -> bindValue(':birthDay', $birthDay, PDO::PARAM_STR);
  $status = $stmt -> execute();

  // var_dump($stmt);
  // var_dump($status);

// SQL準備&実行




// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  exit('sqlError:' .$error[2]);


} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header('Location: home.php');

  };

  
