<?php

// 送信データのチェック
var_dump($_POST);
exit();

// 関数ファイルの読み込み
include('functions.php');

// 送信データ受け取り
$id = $_POST['id'];
$uid = $_POST['uid'];
$name=$_POST['name'];
$birthDay = $_POST['birthDay'];
$k1 = $_POST['k1'];
$k2 = $_POST['k2'];
$k3 = $_POST['k3'];
$k4 = $_POST['k4'];
$z1 = $_POST['z1'];
$z2 = $_POST['z2'];
$z3 = $_POST['z3'];
$z4 = $_POST['z4'];
$h1 = $_POST['h1'];
$h2 = $_POST['h2'];
$h3 = $_POST['h3'];
$h4 = $_POST['h4'];
$j1 = $_POST['j1'];
$j2 = $_POST['j2'];
$j3 = $_POST['j3'];
$j4 = $_POST['j4'];


// DB接続
$pdo = connect_to_db();


// UPDATE文を作成&実行
$sql = "UPDATE startup_support
         SET   k1=:k1, k2=:k2, k3=:k3, k4=:k4, z1=:z1, z2=:z2, z3=:z3, z4=:z4,
               h1=:h1, h2=:h2, h3=:h3, h4=:-4, j1=NULL, j2=:j2, j3=:j3, j4=:j4,
               stats=:stats, end_date=:end_date WHERE id=:id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':uid', $uid, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':birthDay', $birthDay, PDO::PARAM_STR);

        $stmt->bindValue(':k1', $k1, PDO::PARAM_STR);
        $stmt->bindValue(':k2', $k2, PDO::PARAM_STR);
        $stmt->bindValue(':k3', $k3, PDO::PARAM_STR);
        $stmt->bindValue(':k4', $k4, PDO::PARAM_STR);

        $stmt->bindValue(':z1', $z1, PDO::PARAM_STR);
        $stmt->bindValue(':z2', $z2, PDO::PARAM_STR);
        $stmt->bindValue(':z3', $z3, PDO::PARAM_STR);
        $stmt->bindValue(':z4', $z4, PDO::PARAM_STR);
        
        $stmt->bindValue(':h1', $h1, PDO::PARAM_STR);
        $stmt->bindValue(':h2', $h2, PDO::PARAM_STR);
        $stmt->bindValue(':h3', $h3, PDO::PARAM_STR);
        $stmt->bindValue(':h4', $h4, PDO::PARAM_STR);

        $stmt->bindValue(':j1', $j1, PDO::PARAM_STR);
        $stmt->bindValue(':j2', $j2, PDO::PARAM_STR);
        $stmt->bindValue(':j3', $j3, PDO::PARAM_STR);
        $stmt->bindValue(':j4', $j4, PDO::PARAM_STR);

        $stmt->bindValue(':stats', $stats, PDO::PARAM_STR);
        $stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        
        $status = $stmt->execute();






// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:home.php");
  exit();

}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（入力画面）</title>
</head>

<body>
  <form action="todo_create.php" method ="POST">
    <fieldset>
      <legend>受講状況更新</legend>
      <a href="home.php">受講中一覧へ戻る</a>

      <!-- 名前とIDを抽出して表示  -->
      <h4>{$record["受講者番号"]}</h4>
      <h4>{$record["名前"]}</h4>


      <div class="keiei">
        <h3>経営</h3> 
        <ol>
         <p>１ 福岡県　　　: <input type="date" name="k1"></p> 
         <p>２ 福岡商工　　: <input type="date" name="k2"></p> 
         <p>３ 日本政策金融: <input type="date" name="k3"></p> 
         <p>４ 福岡県　　　: <input type="date" name="k4"></p>        
        </ol>
      </div>

      <div class="zaimu">
        <h3>財務</h3>
        <ol>
          <p>１ 福岡県　　　: <input type="date" name="z1"></p> 
          <p>２ 福岡商工　　: <input type="date" name="z2"></p> 
          <p>３ 日本政策金融: <input type="date" name="z3"></p> 
          <p>４ 福岡県　　　: <input type="date" name="z4"></p> 
        </ol> 
      </div>

      <div class="hanro">
        <h3>販路</h3> 
        <ol>
          <p>１ 福岡県　　　: <input type="date" name="h1"></p> 
          <p>２ 福岡商工　　: <input type="date" name="h2"></p> 
          <p>３ 日本政策金融: <input type="date" name="h3"></p> 
          <p>４ 福岡県　　　: <input type="date" name="h4"></p> 
        </ol>
      </div>

      <div class="jinzai">
        <h3>人材育成</h3> 
        <ol>
          <p>１ 福岡県　　　: <select name="j1" selected></p> 
                            <option value="対象なし" selected>対象なし</option>
                            </select></p> 
                     
          <p>２ 福岡商工　　: <input type="date" name="j2"></p> 
          <p>３ 日本政策金融: <input type="date" name="j3"></p> 
          <p>４ 福岡県　　　: <input type="date" name="j4"></p> 
        </ol>
      </div>

      <div>
        <h3>完了確認</h3>
        <ol>
          <p>１ 受講状況　: <select name="stats"></p> 
                            <option value="ongoing" selected>受講中</option>
                            <option value="completed">完了</option>
                          </select></p> 

          <p>２ 完了日　　: <input type="date" name="end_date"></p> 
        </ol> 

      </div>
      <div>
        <button>登録する</button>
      </div>
    </fieldset>
  </form>

</body>

</html>