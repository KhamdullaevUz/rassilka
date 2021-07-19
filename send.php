<?php

$mysqli = new Mysqli($_POST['host'], $_POST['user'], $_POST['password'], $_POST['dbname']);
if($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

$mysqli->set_charset("utf8mb4");
$id = [];
$result= $mysqli->query("SELECT user_id FROM ".$_POST['tablename']);
$ids = 0;
$j = 0;
while($row = $result->fetch_assoc()){
$j++;
 $ids++;
 if($ids == 20){ sleep(1); $ids = 0; }
 $url = "https://api.telegram.org/bot".$_POST['api_key']."/sendMessage";
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,[
            'chat_id'=>$row['user_id'],
            'text'=>$_POST['matn'],
            'parse_mode'=>"HTML"
            ]);
            $res = curl_exec($ch);  
            if(curl_error($ch)){
            var_dump(curl_error($ch));
            }
}

echo $j." ta userga yetkazildi";