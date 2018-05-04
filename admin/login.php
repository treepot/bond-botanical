<?php

//デバッグ
$debug = 0;
if(isset($_GET['mode'])){
  if($_GET['mode'] == 'debug'){
    $debug = 1;
    echo '<!-- debug mode -->';
  }
}
//PHPエラー表示設定
if($debug == 1){
  error_reporting(E_ALL);
  echo '<!-- php error : ON -->';
}else{
  error_reporting(0);
}

//パラメータ
$param = array();
if($debug == 1){
  $param = array_merge($param, array('mode' => 'debug'));
}
$get = http_build_query($param);

//id & pass 照合
$enter_id = '';
$enter_password = '';
$check_fail = '';
if(isset($_POST['id']) && isset($_POST['password'])){
  $enter_id = $_POST['id'];
  $enter_password = $_POST['password'];

  //sqLite
  $data = array();
  // Initialize
  $db = null;
  $sql = null;
  $res = null;

  // データベースへ接続
  $db = new SQLite3("./lp.sqlite");

  // データの取得
  $sql = 'SELECT * FROM settings';
  $res = $db->query($sql);
  while( $row = $res->fetchArray() ) {
    array_push($data, $row);
  }
  if($debug == 1){
    echo '<!--<pre>';
    var_dump($data);
    echo '</pre>-->';
  }
  if($data[1]['login_id'] == $enter_id && $data[1]['password'] == $enter_password){
    if($debug == 1){
      echo '<!-- id & pass OK -->';
    };
    $login = 1;
    $cookie = $data[1]['cookie'];
    setcookie('login', $login, time() + 60 * strval($cookie));
    header('Location: ./?'.$get);
    exit();
  }else{
    if($debug == 1){
      echo '<!-- id or pass NG -->';
    };
    $btn_class = ' btn-error';
    $check_fail = 1;
  }
}

$login = 1;

if(isset($_GET['login']) && $_GET['login'] == 0){//ログアウト処理
  setcookie('login', $login, time()-1);
  if($_COOKIE['login'] == 1){//ログアウトの確認
    echo '<!-- login -->';
  }else{
    echo '<!-- logout -->';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <title>CMS</title>
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- button -->
  <link rel="stylesheet" type="text/css" href="../lib/CreativeButtons/css/default.css" />
  <link rel="stylesheet" type="text/css" href="../lib/CreativeButtons/css/component.css" />
  <script src="../lib/CreativeButtons/js/modernizr.custom.js"></script>

  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="./system.css">
  <?php if($debug == 1){ ?>
  <style>
    html,body{
      background-color: #555;
    }
  </style>
  <?php } ?>
  <script>
  $(function(){
    $('a, button')
      .on('touchstart', function(){
        $(this).addClass('hover');
    }).on('touchend', function(){
        $(this).removeClass('hover');
    });
  });
  $(window).on("load",function(){
    setTimeout(function(){
      $('.btn-success,.btn-error').removeClass('btn-success btn-error');
    },1500);
  });
  </script>
</head>

<body>
  <form action="./login.php?<?php echo $get ?>" method="post" id="login">
    <div>
      <span><i class="fas fa-user-circle"></i></span>
      <input type="text" name="id" placeholder="ID" value="<?php echo $enter_id ?>">
    </div>
    <div>
      <span><i class="fas fa-lock"></i></span>
      <input type="text" name="password" placeholder="Password" value="<?php echo $enter_password ?>">
    </div>
    <?php if($check_fail == 1){ ?>
      <p>IDまたはパスワードが正しくありません。</p>
    <?php } ?>
    <button type="submit" class="btn btn-7 btn-7h icon-cog<?php echo $btn_class ?>">LOGIN</button>
  </form>
</body>
</html>
