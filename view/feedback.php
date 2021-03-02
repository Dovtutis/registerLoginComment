
<main>
    <div class="container800" id="feedback-container">
        <div id="feedback-comments-container">
            <div class="col-12">
                <h4 class="my-2">Comments</h4>
                <div id="comments" class="comment-container">

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
                                <textarea name="commentBody" id="comment-body" class="form-control" placeholder="Add comment"></textarea>
                                <span class="invalid-feedback" id="text-area-feedback"></span>
                            </div>
                            <button type="submit" class="btn btn-success mt-2" id="addCommentButton">Add comment</button>
                        </form>
                    </div>
                </div>
            <?php else:?>
                Want to comment? <a href="/register">Register</a>
            <?php endif;?>
        </div>
    </div>
</main>