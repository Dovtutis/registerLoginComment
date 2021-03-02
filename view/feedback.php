
<main>
    <div class="container800" id="feedback-container">
        <div id="feedback-comments-container">
            <div class="col-12">
                <h4 class="my-2">Comments</h4>
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
                        <tr>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
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
                        <form action="" method="post" id="add-comment-form">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Your Name"
                                       id="username" value="<?php echo $_SESSION['user_name']?>">
                                <span class="invalid-feedback" id="username-area-feedback"></span>
                            </div>
                            <div class="form-group mt-2">
                                <textarea name="commentBody" id="comment-body" class="form-control" placeholder="Add comment. Maximum 500 chars."></textarea>
                                <span class="invalid-feedback" id="text-area-feedback"></span>
                            </div>
                            <button type="submit" class="btn btn-success mt-2 float-end" id="addCommentButton">Add comment</button>
                        </form>
                    </div>
                </div>
            <?php else:?>
                Want to comment? <a href="/register">Register</a>
            <?php endif;?>
        </div>
    </div>
</main>

<script>
    const commentsTable = document.getElementById('comments-table');

    fetchComments();

    function fetchComments(){
        fetch('/feedback/getComments')
            .then(resp => resp.json())
            .then(data => {
                console.log(data);
                generateComments(data)
            })
    }

    function generateComments(commentsArray){
        commentsTable.innerHTML = '';
        commentsArray.forEach(comment => {
            commentsTable.innerHTML +=
                `
                 <tr>
                    <td>${comment.name}</td>
                    <td>${comment.body}</td>
                    <td>${comment.created_at}</td>
                 </tr>
                `
        });
    }
</script>