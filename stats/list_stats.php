<?php include '../view/header.php'; ?>

<section role=main>

    <div class="slim clearfix">
<h2>USER : <?php echo $user->getFName(); ?> <?php echo $user->getLName(); ?> (<?php echo $user_id; ?>)
</h2>
<?php if(count($stats_projects)> 0) : ?>
    <ul>
    <?php foreach( $stats_projects as $stats_proj ): ?>
        <li>
            <div class="stats-project-container">
            <h3><?php echo $stats_proj->getProjTitle();?> (<?php echo $stats_proj->getID();?>)</h3>
            
            <!---- display views for this project ----->

            <?php $stats_proj_id = $stats_proj->getID(); ?>
            <?php $stats_views = ViewDB::getViewByProjId($stats_proj_id); ?>
            <h4>Views <?php echo $stats_views["num_views"]; ?></h4>
            
            <!---- list all comments for this project  ----->
            
            <?php 
            $stats_comments = CommentDB::getComments($stats_proj_id); 
            if(count($stats_comments)> 0) :?>
            <h4>Comments: <?php echo count($stats_comments); ?></h4>
            <?php if($stats_proj_id == $proj_id_sel): ?>
            <span class="job-success"><?php echo $message_success;?></span>
            <span class="job-failure"><?php echo $message_fail;?></span>
            <?php endif; ?>
            <ul>
            <?php foreach($stats_comments as $stats_comment) : ?>
                <li>
                    <form name="delete_comment" method="post" action="?action=delete_comment">
                    <input type="hidden" name="comment_id" value="<?php echo $stats_comment->getID(); ?>" />
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                    <input type="hidden" name="proj_id" value="<?php echo $stats_proj_id; ?>" />
                    

                                <button type="submit" name="deletecomment" class="fa fa-trash-o fa-lg  job-button-clear" 
                                        title="Remove comment" style="display: inline; float: left; width: 50px;">
                                </button>
                    </form>
                   
                    <?php echo $stats_comment->getComment(); ?>
                     - <em>by <?php echo $stats_comment->getUser()->getFName(); ?> <?php echo $stats_comment->getUser()->getLName(); ?></em>
                    
                    
                </li>
            
            <?php endforeach;?>
            </ul>
            <?php endif;?>

            <!------ List likes for this project ------------>
            
            <?php $stats_likes = LikeDB::getLikesByProjId($stats_proj_id); ?>
            <?php if(count($stats_likes)> 0) :?>
            <h4>Liked by: <?php echo count($stats_likes); ?> member(s)</h4>
            <ul class="likes-list">
            <?php foreach($stats_likes as $stats_like) : ?>
                <li>
                    <img src="../images_upload/thumbs/<?php echo $stats_like->getUser()->getImgURL(); ?>" />
                    <br />
                    <?php echo $stats_like->getUser()->getFName(); ?> <?php echo $stats_like->getUser()->getLName(); ?>
                </li>
                
            <?php endforeach;?>
            </ul>
            <?php endif; ?>
            </div> <!--project container--->
        </li>
    <?php endforeach; ?>
    </ul>
<?php endif;?>
<!--    <a href="#modal" class="open-modal" rel="modal" title="">View graph</a>-->
<a href="#" onclick='window.open("graph.php","Graph","directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no,width=950,height=400,top=120");'>
    <h3>View graph and compare your stats with others</h3></a>

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

   