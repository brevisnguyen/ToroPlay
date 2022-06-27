jQuery(document).ready(function($){
    
    // menu icons
    
    $('#menu-management > form').attr('autocomplete', 'off');
    
    $('.additional-menu-field-tricon').append('<div style="display:none" class="tr-icons-menu"><p class="tr_select_font"><button type="button" data-id="1" class="triconscurrent">Material</button><button data-id="2" type="button">FontWeasome</button></p><ul><li class="trloading">'+tradmin.loading+'</li></ul></div>');
    
    $('.tr_select_font button').on('click', function(e){
        $('.triconscurrent').removeClass('triconscurrent');
        $(this).addClass('triconscurrent');
    });
    
    $(document).on('click', function(e){
        if ($(e.target).closest('.tr-icons-menu,.edit-menu-item-tricon').length === 0) {
            $('.tr-icons-menu').hide();
            $('.trcurrentul').removeClass('trcurrentul');
        }
    });
    
    $('body').on('click', '.edit-menu-item-tricon', function() {

        $('.tr-icons-menu').hide();
        $(this).closest('label').next();
        if ( !$( this ).hasClass( "trcurrentul" ) ) {
            var type = $('.triconscurrent').data('id');
            var $this = $(this);
            
            $.post( tradmin.url, { nonce: tradmin.nonce, action: tradmin.action, type: type, value: '' })
              .done(function( data ) {
                $($this).addClass('trcurrentul');
                $('.tr-icons-menu ul').html(data);                
            });

            $(this).closest('label').next().show();
        }
        
    });
    
    $('body').on('click', '.tr_select_font button', function() {

        var type = $('.triconscurrent').data('id');
        
        $.post( tradmin.url, { nonce: tradmin.nonce, action: tradmin.action, type: type, value: '' })
          .done(function( data ) {
            $('.tr-icons-menu ul').html(data);
        });
        
        $(this).parent().parent().show();
        
    });
    
    $(".edit-menu-item-tricon").keyup(function(){
 
        $('.tr-icons-menu ul').html('<li class="trloading">'+tradmin.loading+'</li>');
        
        var value = $(this).val();
        var type = $('.triconscurrent').data('id');

        $.post( tradmin.url, { nonce: tradmin.nonce, action: tradmin.action, type: type, value: value })
          .done(function( data ) {
            $('.tr-icons-menu ul').html(data);
        });
        
    });
    
    $(document.body).on('click', '.tr-icons-menu li' ,function(){

        var trclass = $(this).attr("class");
        
        $(this).parent().parent().parent().parent().find('.edit-menu-item-tricon').val(trclass);
        $('.tr-icons-menu').hide();
        $('.trcurrentul').removeClass('trcurrentul');
        
    });
    
    // ads desktop / mobile tab
    
    $(document.body).on('click', '.trads_type_a' ,function(){

        var id = $(this).data('id');
        
        $(this).addClass('current');
        $(this).closest('button').next().removeClass('current');
        
        $('.'+id+'_d').show();
        $('.'+id+'_m').hide();  
        
    });
    
    $(document.body).on('click', '.trads_type_b' ,function(){
        
        var id = $(this).data('id');
        $(this).addClass('current');
        $(this).closest('button').prev().removeClass('current');

        $('.'+id+'_d').hide();
        $('.'+id+'_m').show();
        
    });
    
    // optimization
    
    $(document.body).on('click', '.troptimization_add_js' ,function(){
        var thisRow = $( this ).closest( 'button' ).parent().prev().find('tbody tr:last');
        $( thisRow ).clone().insertAfter( thisRow ).find( 'input:text' ).val( '' );
        
        $('.table_tr_optimization_js tbody tr:last a').attr("href", '');
        $('.table_tr_optimization_js tbody tr:last input').attr('checked', false);
    });
    
    $(document.body).on('click', '.troptimization_del_js,.troptimization_del_css' ,function(event){
        event.preventDefault();
        var thisRow = $( this ).closest( 'tr' )[0];
        $( thisRow ).remove();
    });

    $(document.body).on('click', '.optimization_up,.optimization_down' ,function(event){
        event.preventDefault();
        var row = $(this).parents("tr:first");
        if ($(this).is(".optimization_up")) {
            row.insertBefore(row.prev());
        } else if ($(this).is(".optimization_down")) {
            row.insertAfter(row.next());
        }
    });
    
    $(document.body).on('click', '.troptimization_add_css' ,function(){
        var thisRow = $( this ).closest( 'button' ).parent().prev().find('tbody tr:last');
        $( thisRow ).clone().insertAfter( thisRow ).find( 'input:text' ).val( '' );
        
        $('.table_tr_optimization_css tbody tr:last a').attr("href", '');
        $('.table_tr_optimization_css tbody tr:last input').attr('checked', false);
    });
});