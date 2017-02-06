<?php
//import background bbs
require "main.php"
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>簡易掲示板</title>
    </head>
    <body>
<h1>掲示板っぽいもの</h1>
<section>
<h2>投稿フォーム</h2>
        <form method="post" action="">
            名前（10文字以内）<input type="text" name="name" value="" /maxlength="10" wrap="hard"><br>
            コメント<textarea name="comment" rows="4" cols="20" maxlength="100" wrap="hard" placeholder="100字以内で入力してください"></textarea><br>
           <input type="submit" name="send" value="書き込む" />
        </form>
        <!-- The following code is contribution list -->
<?php
if ( $msg     !== '' ) echo '<p>' . $msg . '</p>';
if ( $err_msg !== '' ) echo '<p style="color:#f00;">' . $err_msg . '</p>';
foreach( $data as $key => $val ){
    echo '<div>'.$val['name']."さんのコメント". ' ';
    $date = new DateTime($val['date']);
    echo $date->format("Y-m-d H:i:s"). "<br>";
    echo $val['comment'].'<br></div>';
}
?>
    </body>
</html>
