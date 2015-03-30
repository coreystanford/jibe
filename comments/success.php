<h6>
    <?php echo $message_fail; ?>
    <?php echo $message_success; ?>
</h6>
    <div class="comment-wrap">
        <img src = "../images_upload/profiles/<?php echo $lastcomment->getUser()->getImgURL(); ?>" 
             alt = "<?php echo $lastcomment->getUser()->getFName(); ?> 
                    <?php echo $lastcomment->getUser()->getLName(); ?>" 
              class ="comment-profile-img"  />
        <h6><?php echo $lastcomment->getUser()->getFName(); ?> 
            <?php echo $lastcomment->getUser()->getLName(); ?> 
            <?php echo $lastcomment->getDate(); ?> 
        </h6>
        <p>
            <?php echo $lastcomment->getComment(); ?> 
        </p>
    </div>

</div>

