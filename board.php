<?php
//info database
$db_host = 'localhost';
$db_name = 'bbs_db';
$db_user = 'user';
$db_pass = 'user';

//connect database
$dblink = mysqli_connect( $db_host, $db_user, $db_pass, $db_name);
if ($dblink !== false) {
    $msg     = "";
    $err_msg = "";

    if ( isset( $_POST['send'] ) === true ) {
        $name = $_POST['name']   ;
        $comment = $_POST['comment'];

        if ( $name !== '' && $comment !== '' ) {

            $query = " INSERT INTO board ( "
                . "    name , "
                . "    comment "
                . " ) VALUES ( "
                . "'" . mysqli_real_escape_string( $dblink, $name ) ."', "
                . "'" . mysqli_real_escape_string( $dblink, $comment ) . "'"
                ." ) ";

            $res   = mysqli_query( $dblink, $query);

            if ($res === true) {
                $msg = '書き込みに成功しました';
            }else{
                $err_msg = '書き込みに失敗しました';
            }
        }else{
            $err_msg = '名前とコメントを記入してください';
        }
    }

    $query  = "SELECT id, name, comment FROM board";
    $res    = mysqli_query($dblink, $query);
    $data = array();
    while($row = mysqli_fetch_assoc($res)) {
        array_push($data, $row);
    }
    arsort($data);

} else {
    die('接続失敗です。'.mysql_error());
}

//disconnect database
mysqli_close( $dblink );
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    </head>
    <body>
<h1>簡易掲示板</h1>
<section>
<h2>新規投稿</h2>
        <form method="post" action="">
            名前（10字以内）<input type="text" name="name" value="" maxlength = "10" /><br>
            コメント<textarea name="comment" rows="4" cols="20" maxlength = "100" wrap="hard" placeholder="100字以内で入力してください"></textarea>
           <input type="submit" name="send" value="書き込む" />
        </form>
        <!-- ここに、書き込まれたデータを表示する -->
</section>
<section>
<h2>投稿一覧</h2>
<?php
if ( $msg     !== '' ) echo '<p>' . $msg . '</p>';
if ( $err_msg !== '' ) echo '<p style="color:#f00;">' . $err_msg . '</p>';
foreach( $data as $key => $val ){
    echo $val['name']."さんのコメント" . '<br>';
    echo $val['comment'].'<br>';
}
?>
</section>
    </body>
</html>
