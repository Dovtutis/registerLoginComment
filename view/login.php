<?php
?>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card card-body bd-light mt-5 p-4 container800" id="login-container">
            <h2>Login</h2>
            <form action="" method="post" autocomplete="off" id="login-form">
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
                <div class="row mt-3">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-primary btn-block">
                    </div>
                    <div class="col">
                        <a href="/register" class="btn btn-light btn-block float-end">No account? Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const loginFormEl = document.getElementById('login-form');
    const emailEl = document.getElementById('email');
    const passwordEl = document.getElementById('password');
    let errorsAndElements = {
        emailError: emailEl,
        passwordError: passwordEl,
    };

    loginFormEl.addEventListener('submit', loginFetch);

    function loginFetch(e) {
        e.preventDefault();
        resetErrors();
        const formData = new FormData(loginFormEl);

        fetch('/login', {
            method: 'post',
            body: formData
        }).then(resp => resp.json())
            .then(data => {
                console.log(data)
                if (data === "loginSuccessful"){
                    window.location.replace("/");
                }
                if (data.errors){
                    handleErrors(data.errors);
                }
            }).catch(error => console.error())
    }

    function handleErrors(errors){
        let possibleErrors = Object.keys(errorsAndElements);
        for (let i = 0; i < possibleErrors.length; i++) {
            let errorName = possibleErrors[i];
            if (errors[errorName]) {
                let errorElement = errorsAndElements[errorName];
                errorElement.classList.add('is-invalid');
                errorElement.nextElementSibling.innerHTML = errors[errorName];
            }
        }
    }

    function resetErrors(){
        const errorEl = loginFormEl.querySelectorAll('.is-invalid');
        errorEl.forEach((element) => {
            element.classList.remove('is-invalid');
        });
    }

    const currentPage = "<?php echo $currentPage?>";
    const navBarActiveEl = document.getElementById('nav-login');
    checkCurrentPage();

    function checkCurrentPage() {
        if (currentPage === "login"){
            navBarActiveEl.classList.add('active');
        }
    }
</script>
