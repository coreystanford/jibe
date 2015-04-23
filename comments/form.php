<!-- function to display a list of comments for the project and a form to submit new comment -->

<div id="result">
<div id="orig_list" >
   <?php
    if(!empty($comments)){
        //  --if comments exist, load comments
            include 'list.php';
    }
    ?>
</div>
</div>

<!-- form to submit new comment  --->

<form method="post" name="submit-comment" id="submit_comment" class="submit_comment">
    <input type="hidden" name="user_id" class="user_id" value="<?php echo $user_id; ?>" />
    <input type="hidden" name="proj_id" class="proj_id" value="<?php echo $proj_id; ?>" />
    <input type="hidden" name="id" class="proj_id" value="<?php echo $proj_id; ?>" />
    <input type="hidden" name="cmt_date" class="cmt_date" value="<?php echo $cmt_date; ?>" />
    <input type="text" name="cmt_msg" id="cmt_msg" class="text-input cmt_msg" placeholder="Type your comment" value=""  />
    <?php echo $newcommentfields->getField('cmt_msg')->getHTML(); ?>
    <button type="submit" name="btn_submit_comment" id="btn_submit_comment" class="btn submit" >Submit</button>
</form>

<!--- ajax call to process new comment --->

<script type="text/javascript">
jQuery(document).ready(function () {
        var comment = $.trim($('#cmt_msg').val());
        
    if(comment.length <= 0 )
        {
        $('#btn_submit_comment').disabled = true;
        $('#btn_submit_comment').css("opacity", "0.5");
        }
    if(!comment.length > 0){
        $('#btn_submit_comment').css("opacity", "1");
    }
    $("#submit_comment").submit(function () {
        $.ajax({
            type: "POST",
            url: "../comments/submit_comment.php",
            data: $('form.submit_comment').serialize(),
            success: function (result) {
                $("#orig_list").html('');

                $("#comments").html(result);
                $('form#submit_comment')[0].reset();
                //$('form.cmt_msg').empty();
            },
            error: function () {
                alert("failure");
            }
        });
       
        return false;
    });
});               
</script>
