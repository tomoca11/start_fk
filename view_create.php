<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型todoリスト（入力画面）</title>
</head>

<body>
  <form action="process_create.php" method ="POST">
    <fieldset>
      <legend>受講者入力</legend>



      <div>
        <h3>受講者カード作成</h3> 
        <ol>
          <p> 受講者番号　: <input type="text" name="uid" required></p> 
          <p> 受講者名　　: <input type="text" name="name" required></p> 
          <p> 生年月日　　: <input type="date" name="birthDay" required></p> 
        </ol>
      </div>
      <div>
        <button>submit</button>
        
      </div>
    </fieldset>
    <a href="home.php">一覧に戻る</a>
  </form>

</body>

</html>