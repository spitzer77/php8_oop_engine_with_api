<!doctype html>
<html lang="en">
<head>
    <title>Test task</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="/js/validate.js"></script>
</head>
<body>
<div class="container">
    <div class="mx-auto p-4 border border-1 border-gray rounded" style="width:1200px;">
        <div class="d-flex justify-content-between">
            <div class="pb-4">
                <a class="me-2" href="/">Home</a>
                <?php
                if ($this->e($timeToExpired)) { ?>
                    <a class="me-2" href="/user/personal">Cabinet</a>
                    <a class="me-2" href="/votes">Votes</a>
                    <a class="me-2" href="/user/logout">Logout</a>
                <?php
                } else { ?>
                    <a class="me-2" href="/user/registration">Registration</a>
                    <a class="me-2" href="/user/login">Login</a>
                <?php
                } ?>
                <a class="me-2" target="_blank" href="/api/votes">GET API</a>
            </div>
            <?php if ($this->e($timeToExpired)) { ?>
            <div class="ml-auto">
                Logged as: <span class="fw-bold"><?=$this->e($USER_AUTH['email']);?></span>
            </div>
            <?php }?>
        </div>
        <div>
            <?= $this->section('page_content') ?>
        </div>
    </div>
</div>
</body>
</html>