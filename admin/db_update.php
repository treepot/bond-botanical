<?php

include '../inc/site.php';

//更新時刻
$now = date('Y/m/d H:i:s');

//デバッグフラグ
$debug = 0;
if(isset($_GET['mode'])){
  if($_GET['mode'] == 'debug'){
    $debug = 1;
  }
}
//PHPエラー表示設定
if($debug == 1){
  error_reporting(E_ALL);
}else{
  error_reporting(0);
}

//パラメータ
$param = array();
if($debug == 1){
  $param = array_merge($param, array('mode' => 'debug'));
}
if(!empty($db_table)){
  $param = array_merge($param, array('page' => $_GET['page']));
}
$get = http_build_query($param);

//sqliteテーブル
if(isset($_GET['page'])){
  $db_table = $_GET['page'];
}else{
  header('Location: ./admin/setting/'.$get);
  exit();
}

// Initialize
$db = null;
$sql = null;
$res = null;

// データベースへ接続
$db = new SQLite3("./bond.sqlite");

// 変更前データの取得
$sql = 'SELECT * FROM '.$db_table;
$res = $db->query($sql);
$data = array();
while( $row = $res->fetchArray() ) {
  array_push($data, $row);
}

if($debug == 1){
  echo '【before】<br><pre>';
  var_dump($data);
  echo '</pre>';
}

$cnt = 0;
foreach ($data[1] as $key => $value) {//データ行を参照
  if($key == 'id' || $key == 'uptime'){ continue; }
  if(preg_match('/[^0-9]/', $key) && $value != $_POST[$key]){//変更のあるデータを参照
    // if(empty($_POST[$key])){//変更後NULLの場合
    //   if($debug == 1){ echo '[NULL]';}
    //   $_POST[$key] = '設定なし';
    // };
    //　データの更新
    $sql = 'UPDATE '.$db_table.' SET '.$key.'= "'.$_POST[$key].'" WHERE id = 2';
    $res = $db->query($sql);
    $cnt++;
    if($debug == 1){
      echo $cnt.'【'.$key.'】'.$value.'→'.$_POST[$key].'<br>';
    }
  }
}

//　更新時刻の変更
if($cnt > 0){//変更項目がある場合
  $key = 'uptime';
  $value = $data[1][$key];
  $sql = 'UPDATE '.$db_table.' SET '.$key.'= "'.$now.'" WHERE id = 2';
  $res = $db->query($sql);
  if($debug == 1){
    echo '【'.$key.'】'.$value.'→'.$now.'<br>';
  }
}

//パラメータ
if($cnt > 0){
  $param = array_merge($param, array('update' => 'true'));
}else{
  $param = array_merge($param, array('update' => 'false'));
}
$get = http_build_query($param);

if($debug == 0){
  header('Location: '.ROOT.'admin/setting/?'.$get);
  exit();
}

// データの取得
if($debug == 1){
  $sql = 'SELECT * FROM '.$db_table;
  $res = $db->query($sql);
  $data = array();
  while( $row = $res->fetchArray() ) {
    array_push($data, $row);
  }

  echo '<br>【after】<br><pre>';
  var_dump($data);
  echo '</pre>';
  echo ROOT;
  echo '<a href="'.ROOT.'admin/setting/?'.$get.'">Return</a>';
}
