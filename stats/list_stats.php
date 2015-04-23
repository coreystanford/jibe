<?php //include '../view/header.php'; ?>

<!--<section role=main>

    <div class="slim clearfix">-->

<?php if(count($stats_projects)> 0) : ?>
    <ul class="stats-list">
    <?php foreach( $stats_projects as $stats_proj ): ?>
        <li class="stats-container">
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
            <div id="comments">
            <h4>Comments: <?php echo count($stats_comments); ?></h4>
            <?php if(isset($proj_id_sel) && $stats_proj_id == $proj_id_sel): ?>
            <span class="job-success"><?php echo $message_success;?></span>
            <span class="job-failure"><?php echo $message_fail;?></span>
            <?php endif; ?>
            <ul>
            <?php foreach($stats_comments as $stats_comment) : ?>
                <li>
                    <form name="delete_comment" class="delete_comment"  onsubmit="return submitForm(this);">
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
            </div>
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

<?php if(count(ProjectDB::getProjectsByUserID($user_id)) > 0): ?>
<a href="#" onclick='window.open("../stats/graph.php?id=<?php echo $user_id; ?>","Graph","directories=0,titlebar=0,toolbar=0,location=0,status=0,menubar=0,scrollbars=no,resizable=no,width=950,height=400,top=120");'>
    <h3>View graph and compare your projects</h3></a>
<?php endif; ?>
<!--    </div>
</section>-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script type="text/javascript">
    function equalize() {
            
            if ($(window).width() > 525) {
                $(".stats-container").css('height', 'auto');
                var list_array = $(".stats-container");
                var maxHeight = 0;
                $.each(list_array, function(){
                    if($(this).height() > maxHeight){
                        maxHeight = $(this).height();
                    }
                });
                
                $(".stats-container").css('height', maxHeight);
                
            }
            else {
                 $(".stats-container").css('height', 'auto');
           }
        }
    
    
    function submitForm(deleteForm) {
    $.ajax({
        type:'POST',            
        url: "../stats/delete_comment.php",
        data: $(deleteForm).serialize(), 
        success: function(response) {
        $('.stats').html(response);
        },
        error: function () {
                alert("failure");
            }
    });

    return false;
    }


$(document).ready(function(){
           
            equalize();
            $(window).resize(function(){
                // calling the function on resize
                
                equalize();
            });
});// end of document. ready

 

</script>


<?php// include '../view/footer.php'; ?>    

   