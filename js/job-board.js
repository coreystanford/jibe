$().ready(function(){

	$('a.job-delete').click(function() {
        $('div.confirm-delete').hide();
        $(this).parent('div').parent('div').next('div.confirm-delete').show();
    
        });
        
        $('.job-delete-cancel').click(function() {
        $('div.confirm-delete').hide();
        
        });
        
        $('body').mouseup(function(trigger)
        {
            var delete_form = $('div.confirm-delete');

            if (!delete_form.is(trigger.target) && delete_form.has(trigger.target).length == 0)
            {
                delete_form.hide();
            }
        });
});


