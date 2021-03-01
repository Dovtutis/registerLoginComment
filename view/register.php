<?php ?>

    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card card-body bd-light mt-5" id="registration-container">
                <h2>Create an account</h2>
                <p>Please fill in the form to register with us</p>
                <form action="" method="post" autocomplete="off" id="registration-form">
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
                        <label for="password-confirm">Password Confirm: <sup>*</sup></label>
                        <input type="password" class="form-control form-control-lg"
                               name="passwordConfirm" id="passwordConfirm" value="">
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
                            <input type="submit" class="btn btn-primary btn-block" value="Register" id="register-button">
                        </div>
                        <div class="col">
                            <a href="/login" class="btn btn-light btn-block float-right">Have an account? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>
    const registrationFormEl = document.getElementById('registration-form');
    const nameEl = document.getElementById('name');
    const surNameEl = document.getElementById('surname');
    const emailEl = document.getElementById('email');
    const passwordEl = document.getElementById('password');
    const passwordConfirmEl = document.getElementById('passwordConfirm');
    const phoneEl = document.getElementById('phone');
    const addressEl = document.getElementById('address');
    const registerButton = document.getElementById('register-button');
    registrationFormEl.addEventListener('submit', registerFetch);

    function registerFetch(e) {
        e.preventDefault();
        resetErrors();
        const formData = new FormData(registrationFormEl);

        fetch('/register', {
            method: 'post',
            body: formData
        }).then(resp => resp.json())
            .then(data => {
                console.log(data)
                if (data === "registrationSuccessful"){
                    window.location.replace("/");
                }
                if (data.errors){
                    handleErrors(data.errors);
                }
            }).catch(error => console.error())
    }

    function handleErrors(errors){

        if (errors.nameError){
            nameEl.classList.add('is-invalid');
            nameEl.nextElementSibling.innerHTML = errors.nameError;
        }
        if (errors.surnameError){
            surNameEl.classList.add('is-invalid');
            surNameEl.nextElementSibling.innerHTML = errors.surnameError;
        }
        if (errors.emailError){
            emailEl.classList.add('is-invalid');
            emailEl.nextElementSibling.innerHTML = errors.emailError;
        }
        if (errors.passwordError){
            passwordEl.classList.add('is-invalid');
            passwordEl.nextElementSibling.innerHTML = errors.passwordError;
        }
        if (errors.passwordConfirmError){
            passwordConfirmEl.classList.add('is-invalid');
            passwordConfirmEl.nextElementSibling.innerHTML = errors.passwordConfirmError;
        }
        if (errors.phoneError){
            phoneEl.classList.add('is-invalid');
            phoneEl.nextElementSibling.innerHTML = errors.phoneError;
        }
        if (errors.addressError){
            addressEl.classList.add('is-invalid');
            addressEl.nextElementSibling.innerHTML = errors.addressError;
        }
    }

    function resetErrors(){
        const errorEl = registrationFormEl.querySelectorAll('.is-invalid');
        errorEl.forEach((element) => {
            element.classList.remove('is-invalid');
        });
    }
</script>