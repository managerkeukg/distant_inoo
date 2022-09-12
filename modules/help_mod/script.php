<script type="text/javascript">
$(function(){
    
    var current_index = null;    
    
    $('#help-button').live('click', function(){        
        $('#help-panel').toggle(300);
    });
    
        
    $('a.title').live('click', function(){        
        
        if(current_index != $('a.title').index(this)){
            $('.collapse:visible').slideUp(500);
            $('a.title').removeClass('selected');
        }        
        
        if($(this).parent().next().attr('class') == 'collapse'){
            
            if($(this).parent().next().is(":hidden")){
                $(this).addClass('selected');
            } else if($(this).parent().next().is(":visible")) {
                $(this).removeClass('selected');
            }
            $(this).parent().next().slideToggle(500);
        }
        
        current_index = $('a.title').index(this);        
    });
    
    if(!$('#price_block').length){
        if($('#main_price_block').length){
            $('#main_price_block').remove();
        }       
    }
    
    if(!$('#faq_block').length){
        if($('#main_faq_block').length){
            $('#main_faq_block').remove();
        }       
    }   
});
</script>