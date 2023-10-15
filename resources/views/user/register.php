<?php $this->layout('layouts/main') ?>

<?php $this->start('page_content') ?>
<div>
<h3>Register page</h3>
    <div class="mt-4">
    <form method="post" action="/user/store" id="registerForm">
            <div class="form-group mb-3">
                <label for="inputEmail">Email address</label>
                <input name="form[email]" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="errorEmail" class="form-text text-danger"></small>
            </div>
            <div class="form-group mb-3">
                <label for="inputPassword">Password</label>
                <input name="form[password]" type="password" class="form-control" id="inputPassword" placeholder="Password">
                <small id="errorPassword" class="form-text text-danger"></small>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
    </form>
    </div>
</div>
<?php $this->stop() ?>