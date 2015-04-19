<div id="like">
<form method="post" name="submit-like" id="submit_like" class="submit_like">
    <input type="hidden" name="user_id" class="user_id" value="<?php echo $id; ?>" />
    <input type="hidden" name="proj_id" class="proj_id" value="<?php echo $proj_id; ?>" />
    <?php $like_id = LikeDB::checkUserLikesProject($id, $proj_id);
    if(is_null($like_id)){
        $action = "Like";
    }
    else {
        $action = "Unlike";
    }
        ?>
    <input type="hidden" name="action" class="action" id="action" value="<?php echo $action; ?>" />

    <button type="submit" name="btn_submit_like" id="btn_submit_like" class="btn submit" style="display: inline" ><?php echo $action; ?></button>
</form>
    <span id="result"></span>
<script type="text/javascript">
jQuery(document).ready(function () {
//    if($('input#cmt_msg').empty()){
//        $('#btn_submit_comment').disabled = true;
//        $('#btn_submit_comment').css("opacity", "0.5");
//    }
//    if(!$('input#cmt_msg').empty()){
//        $('#btn_submit_comment').css("opacity", "1");
//    }
        $("#submit_like").submit(function () {
        $.ajax({
            type: "POST",
            url: "../likes/submit_like.php",
            data: $('form.submit_like').serialize(),
            success: function (result) {
                $('#result').html(result);
                console.log(result);
                var hiddenField = $('input[name="action"]');
                var submitButton = $('#btn_submit_like');
                val = hiddenField.val();
                hiddenField.val(val === "Like" ? "Unlike" : "Like");            
                submitButton.html(val === "Like" ? "Unlike" : "Like"); 
          
            },
            error: function () {
                alert("failure");
            }
        });
        
        
        return false;
    });
});               
</script>
</div>



