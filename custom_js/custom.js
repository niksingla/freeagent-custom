(function( $ ) {
	'use strict';
    
    $(document).on('change' , '#submit-hiring [name="job_old"]' , function(e) { 
                        
        var $this = $(this),
        $value = $this.val();
        if($value){
            var formData = new FormData();
            formData.append('action','fetch_budget');
            formData.append('job_id',$value);
            $.ajax({
                url: jws_script.ajax_url,
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response.success) {
                        if(response.data){
                            $('[name="cost"]').val(response.data.budget).trigger('change')
                            // $('[name="cost"]').attr('disabled','disabled')
                            
                        }
                    } else {            
                        $('[name="cost"]').val(0)
                        $('[name="cost"]').removeAttr('disabled')
                    }
                },
                error: function() {
                    console.log('error');
                },
                complete: function() {},
            });
        } else {
            $('[name="cost"]').val(0)
            $('[name="cost"]').removeAttr('disabled')
        }
        
    });
})( jQuery );