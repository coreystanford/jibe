<?php include '../view/header.php'; ?>

<section role=main>

    <div class="slim clearfix">
<h2>USER ID: <?php echo $user_id; ?>
</h2>
<?php if(count($stats_projects)> 0) : ?>
    <ul>
    <?php foreach( $stats_projects as $stats_proj ): ?>
        <li>
            <h3><?php echo $stats_proj->getProjTitle();?></h3>
            
            <!---- display views for this project ----->

            <?php $stats_proj_id = $stats_proj->getID(); ?>
            <?php $stats_views = ViewDB::getViewByProjId($stats_proj_id); ?>
            <h4>Views <?php echo $stats_views["num_views"]; ?></h4>
            
            <!---- list all comments for this project  ----->
            
            <?php 
            $stats_comments = CommentDB::getComments($user_id, $stats_proj_id); 
            if(count($stats_comments)> 0) :?>
            <h4>Comments</h4>
            <ul>
            <?php foreach($stats_comments as $stats_comment) : ?>
                <li>
                    <form name="delete_comment" method="post" action="?action=delete_comment">
                    <input type="hidden" name="comment_id" value="25">

                                <button type="submit" name="deletecomment" class="fa fa-trash-o fa-lg  job-button-clear" 
                                        title="Remove comment" style="display: inline; float: left; width: 50px;">
                                </button>
                    </form>
                   
                    <?php echo $stats_comment->getComment(); ?>
                    <br/> - <em>by <?php echo $stats_comment->getUser()->getLName(); ?></em>
                    
                    
                </li>
            
            <?php endforeach;?>
            </ul>
            <?php endif;?>

            <!------ List likes for this project ------------>
            
            <?php $stats_likes = LikeDB::getLikesByProjId($stats_proj_id); ?>
            <?php if(count($stats_likes)> 0) :?>
            <h4>Likes</h4>
            <ul>
            <?php foreach($stats_likes as $stats_like) : ?>
                <li>
                    <img src="../images_upload/thumbs/<?php echo $stats_like->getUser()->getImgURL(); ?>" />
                </li>
                
            <?php endforeach;?>
            </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif;?>
        
    </div>
</section>
<script type="text/javascript" src='//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
<script type="text/javascript">
$("#remove").submit( function() {
    //var form = $("#filter-jobs");
    //$("#submitfilter").click();
});
</script>
<?php include '../view/footer.php'; ?>      
   