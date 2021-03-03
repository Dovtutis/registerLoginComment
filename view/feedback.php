
<main>
    <div class="container800" id="feedback-container">
        <div id="feedback-comments-container">
            <div class="col-12">
                <h4 class="my-2">Feedback from our customers</h4>
                <div id="comments" class="comment-container">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 15%;">Name</th>
                            <th scope="col" style="width: 60%;">Comment</th>
                            <th scope="col" style="width: 25%;">Date</th>
                        </tr>
                        </thead>
                        <tbody id="comments-table">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="comments-input-container">
            <?php if (\app\core\Session::isUserLoggedIn()):?>
                <div class="row mb-5">
                    <h4>Add Comment</h4>
                    <div class="col-12">
                        <form action="" method="post" id="add-comment-form" autocomplete="off">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Your Name"
                                       id="name" value="<?php echo $_SESSION['user_name']?>">
                                <span class="invalid-feedback" id="username-area-feedback"></span>
                            </div>
                            <div class="form-group mt-2">
                                <textarea name="body" id="body" class="form-control" placeholder="Add comment. Maximum 500 chars."></textarea>
                                <span class="invalid-feedback" id="text-area-feedback"></span>
                            </div>
                            <button type="submit" class="btn btn-success mt-2 float-end" id="addCommentButton">Add comment</button>
                        </form>
                    </div>
                </div>
            <?php else:?>
                <p id="feedback-log-in-message">
                    Want to comment? <a href="/register">Register</a> or <a href="/login">Login</a>
                </p>
                <div class="form-group mt-2">
                    <textarea name="body" id="body" class="form-control" disabled placeholder="Add comment. Maximum 500 chars."></textarea>
                </div>
            <?php endif;?>
        </div>
    </div>
</main>
<footer>
    <div id="feedback-footer-container">
        © 2021. Dovydas Tutinas, all rights reserved.
    </div>
</footer>

<script>
    const commentsTable = document.getElementById('comments-table');
    const nameEl = document.getElementById('name');
    const bodyEl = document.getElementById('body');
    let addCommentFormEl;
    const sessionTrigger = "<?php echo $_SESSION['user_name'] ?? '';?>"
    let errorsAndElements = {
        nameError: nameEl,
        bodyError: bodyEl,
    };

    if (sessionTrigger !== ""){
        addCommentFormEl = document.getElementById('add-comment-form');
        addCommentFormEl.addEventListener('submit', addCommentAsync);
    }

    fetchComments();

    function fetchComments(){
        fetch('/feedback/getComments', {
            method: 'post',
    }).then(resp => resp.json())
            .then(data => {
                generateComments(data)
            })
    }

    function generateComments(commentsArray){
        commentsTable.innerHTML = '';
        commentsArray.forEach((comment, index) => {
            printCommentHTML(comment)
            // setTimeout(printCommentHTML, (index * 300), comment)
        });
    }

    function printCommentHTML(comment){
        commentsTable.innerHTML +=
                `
                 <tr class="comment-row">
                    <td>${comment.name}</td>
                    <td>${comment.body}</td>
                    <td>${comment.created_at}</td>
                 </tr>
                `
    }

    function addCommentAsync(event){
        event.preventDefault();
        resetErrors();
        const addCommentFormData = new FormData(addCommentFormEl);

        fetch('/feedback/addComment', {
            method: 'post',
            body: addCommentFormData
        }).then(resp => resp.json())
            .then(data => {
                if (data === "commentAddedSuccessfully"){
                    fetchComments();
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
        const errorEl = addCommentFormEl.querySelectorAll('.is-invalid');
        errorEl.forEach((element) => {
            element.classList.remove('is-invalid');
        });
    }

    const currentPage = "<?php echo $currentPage?>";
    const navBarActiveEl = document.getElementById('nav-feedback');
    checkCurrentPage();

    function checkCurrentPage() {
        if (currentPage === "feedback"){
            navBarActiveEl.classList.add('active');
        }
    }
</script>