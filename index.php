<?php
/**
 * Created by PhpStorm.
 * User: leminhtoan
 * Date: 7/25/17
 * Time: 22:12
 */
// .htpasswordのファイルパス
$filePath = ".htpasswd";

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    $user = $_POST['user'];
    $password = $_POST['password'];
    $encryptPassword = crypt($password, base64_encode($password));

    //.htpasswordファイルにデータを書き込む
    $content = $user. ':' . $encryptPassword;
    try{
        file_put_contents($filePath, $content);
        $message = "パスワード変更しました";
    }catch (Exception $e){
        $message = "エラーが発生しました" . "\n" . $e->getMessage();
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="http://code.jquery.com/jquery-1.12.4.min.js"></script>
</head>
<body>
<div class="container">
    <h2>パスワード変更</h2>
    <span class="error message" style="color:red"><?php echo $message ?></span>
    <form class="form-horizontal" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">ユーザ:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="user" name="user" placeholder="ユーザ">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">パスワード:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" name="password" placeholder="パスワード">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">変更</button>
            </div>
        </div>
    </form>
</div>

<script>
    $('input:text').on('click', function () {
        $('.message').text('');
    })
</script>
</body>
</html>
