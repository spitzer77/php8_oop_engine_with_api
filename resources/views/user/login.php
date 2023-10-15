<?php $this->layout('layouts/main') ?>

<?php $this->start('page_content') ?>
<style>

</style>
<div>
    <h3>Login page</h3>
    <div class="mt-4">
        <form method="post" id="loginForm">
            <div class="form-group mb-3 d-block">
                <label for="inputEmail">Email address</label>
                <input name="form[email]" type="email" class="form-control mt-2" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="errorLogin" class="d-block form-text text-danger"></small>
            </div>
            <div class="form-group d-block">
                <label for="inputPassword">Password</label>
                <input name="form[password]" type="password" class="form-control mt-2" id="inputPassword" placeholder="Password">
                <small id="errorPassword" class="form-text text-danger"></small>
            </div>
            <div class="d-block mt-4">
                <button type="submit" class="btn btn-primary" id="login_button">Login</button>
            </div>
        </form>
    </div>
</div>
<?php $this->stop() ?>