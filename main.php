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
