<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="<?= base_url() ?>resources/css/style.css" rel="stylesheet">
    <style></style>
</head>

<body>

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
        <form class="form-register" action="<?= base_url('User/Save') ?>" method="post">
            <input type="hidden" name="id" value="">
            <div>
                <label for="first_name"><b>FirstName :</b></label><br>
                <input type="text" style="width: 500px;" name="first_name" placeholder="FirstName...." required />
            </div>

            <div>
                <label for="last_name"> <b>Lastname :</b> </label><br>
                <input type="text" style="width: 500px;" name="last_name" placeholder="LastName...." required />
            </div>
            <div>
                <label for="username"> <b>UserName :</b></label><br>
                <input type="text" style="width: 500px;" name="username" placeholder="UserName...." required />
            </div>
            <div>
                <label for="password"><b>Password :</b> </label><br>
                <input type="password" style="width: 500px;" name="password" placeholder="Password...." required />
            </div>
            <div>
                <label for="email"><b>Email :</b></label><br>
                <input type="email" style="width: 500px;" name="email" placeholder="Email...." required />
            </div>

            <button type="submit" class="registerbtn">Register</button>
        </form>
    </div>
</body>

</html>