<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link href="<?= base_url() ?>resources/css/style.css" rel="stylesheet">
</head>
<body>
<form class="form-login" action="<?= base_url('User/Userlogin') ?>" method="post">



<div class="container">
<div class="col-12">
    <?php $errors = session()->getFlashdata('error_msg') ?>
    <?php if (!empty($errors)) :  ?>
        <?php if (!is_array($errors)) : ?>
            <div class="alert alert-danger mb-1">
                <?= $errors ?>
            </div>
        <?php else : ?>
            <?php foreach ($errors as $error) : ?>
                <div class="alert alert-danger mb-1">
                    <?= $error ?>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    <?php endif ?>
</div>
    <div>
    <label for="username"><b style="font-size:20px;">Username</b></label>
    <input style="width: 500px;height: 30px;" type="text" placeholder="Enter Username" name="username" >
    <br>
    <label for="passsword"><b style="font-size:20px;">Password</b></label>
    <input style="width: 500px;height: 30px;" type="password" placeholder="Enter Password" name="password" >
    <br>
    <button type="submit">Login</button>
    </div>
</div>
</form>

</body>
</html>