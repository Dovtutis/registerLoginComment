<?php ?>

<form autocomplete="off" action="" method="post" id="registration-form">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card card-body bd-light mt-5" id="registration-container">
                <h2>Create an account</h2>
                <p>Please fill in the form to register with us</p>
                <form action="" method="post" autocomplete="off">
                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" class="form-control form-control-lg"
                               name="name" id="name" value="">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="surname">Surname: <sup>*</sup></label>
                        <input type="text" class="form-control form-control-lg"
                               name="surname" id="surname" value="">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="text" class="form-control form-control-lg"
                               name="email" id="email" value="">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" class="form-control form-control-lg"
                               name="password" id="password" value="">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="confirmPassword">Confirm password: <sup>*</sup></label>
                        <input type="password" class="form-control form-control-lg"
                               name="confirmPassword" id="confirmPassword" value="">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="phone">Phone number: </label>
                        <input type="text" class="form-control form-control-lg"
                               name="phone" id="phone" value="">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group mt-2">
                        <label for="address">Address: </label>
                        <input type="text" class="form-control form-control-lg"
                               name="address" id="address" value="">
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <input type="submit" class="btn btn-primary btn-block" value="Register">
                        </div>
                        <div class="col">
                            <a href="/login" class="btn btn-light btn-block float-right">Have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</form>