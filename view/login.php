<?php
?>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card card-body bd-light mt-5" id="login-container">
            <h2>Login</h2>
            <form action="" method="post" autocomplete="off">
                <div class="form-group mt-1">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="text" class="form-control form-control-lg mt-1"
                           name="email" id="email" value="">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="form-group mt-1">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" class="form-control form-control-lg mt-1"
                           name="password" id="password" value="">
                    <span class="invalid-feedback"></span>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-primary btn-block">
                    </div>
                    <div class="col">
                        <a href="/register" class="btn btn-light btn-block float-right">No account? Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

