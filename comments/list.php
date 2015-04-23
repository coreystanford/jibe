<h4>Comments</h4>

<!--displaying a list of comments  ---->

 <?php foreach ($comments as $comment) : ?>
    <div class="comment-wrap">
        <img src = "../images_upload/thumbs/<?php echo $comment->getUser()->getImgURL(); ?>" 
             alt = "<?php echo $comment->getUser()->getFName(); ?> 
                    <?php echo $comment->getUser()->getLName(); ?>"
              class ="comment-profile-img"      />
        <h6><?php echo $comment->getUser()->getFName(); ?> 
            <?php echo $comment->getUser()->getLName(); ?> 
            <?php echo $comment->getDate(); ?> 
        </h6>
        <p>
            <?php echo $comment->getComment(); ?> 
        </p>
    </div>
 <?php endforeach; ?>
