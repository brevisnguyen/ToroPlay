jQuery(document).ready(function($) {
    
    // menu
    
    if($("#tr-grabber-menu").length) {

        $('.wrap h1').after('<nav class="wp-filter" id="tr-grabber-menunav"></nav>');
        $("#tr-grabber-menu").appendTo("#tr-grabber-menunav");
        $("#tr-grabber-menunav").next().remove();

        if($(".subsubsub").length) {

            var wpmenugrabber = $('.subsubsub').html().split("\n");
            var content = '';
            var type = $('input[name="tr_post_type"]').val();
            $.each(wpmenugrabber, function(i) {
                if( wpmenugrabber[i]!='' ) {
                    content+= wpmenugrabber[i].replace('post_type=post', 'post_type=post&amp;tr_post_type='+type).replace('<span', '<span style="display:none"');
                }
            });
            $('.subsubsub').html(content);

        }
        
    }
    
    // API Click
    $(document.body).on('click', '.tr_grabber_go' , function(event) {
        if( $('#trgrabber_id').val().length === 0 ) {
            event.preventDefault();
            alert(TrGrabber.empty);
        }else{
            var value = $('#trgrabber_id').val();
            $('#title').prev().text('');
            $('#title').val(TrGrabber.loading);
            $('#publish').click();
        }
    });
    
    // API Enter
    $(document).on('keydown', 'input#trgrabber_id', function(ev) {
        if(ev.which === 13) {
            $('.tr_grabber_go').click();
            return false;
        }
    });
    
    // Backdrop Featured
    
    $(document.body).on('click', '.trgrabber-add-media' , function(event) {
        
        event.preventDefault();
        
        var $this = $(this);
        var id = $(this).data('id');
        var postid = $(this).data('postid');
        var title = $(this).data('title');
        var button = $(this).data('button');
        var nonce = $(this).data('nonce');

        var file_frame = wp.media.frames.file_frame = wp.media({
            title: title,
            button: {
                text: button
            },
            multiple: false
        });

        file_frame.on( 'select', function() {
            attachment = file_frame.state().get('selection').first().toJSON();
            $('#trgrabber_backdrop_id').val(attachment.id);
            $($this).html('<img src="'+attachment.sizes.full.url+'" alt="backdrop">');
            $('.trgrabber-media-delete').parent().show();
        });

        file_frame.open();
        
    });
    
    $(document.body).on('click', '.trgrabber-media-delete' , function(event) {
        
        event.preventDefault();
        
        var title = $(this).data('title');
        $('.trgrabber-add-media').html(title);
        $('#trgrabber_backdrop_id').val('');
        $(this).parent().hide();
        
    });
    
    // links
    
    // move
    
    $('#tr-grabber-content-links').sortable({
        items: '.tr-grabber-row',
        cursor: 'move',
    });
        
    // add
    
    $("body").on("click", "#trgrabber_addlink", function(e){
        e.preventDefault();
        
        var clone = $( ".tr-grabber-row:first" ).clone().insertBefore( ".tr-grabber-row:first" );
        $( ".tr-grabber-row:first select option" ).prop("selected", false);
        $( ".tr-grabber-row:first input[type='text'],.tr-grabber-row:first input[type='date']" ).val('');
    });
    
    // remove
    
    $("body").on("click", ".trgrabber_removelink", function(e){
        e.preventDefault();
        
        var num = $('.tr-grabber-row').length;
                
        if(num>1){
            $(this).parent().parent().remove();
        }else{
            $( ".tr-grabber-row:first select option" ).prop("selected", false);
            $( ".tr-grabber-row:first input" ).val('');
        }
        
    });
    
    // quick movies
    
    // open
    
    $("body").on("click", "#trgrabber_quiclinks", function(e){

        $('#tr_quick_links_content').show();
        
    });
    
    // submit
    
    $("body").on("click", ".tr_quick_links_submit_movies", function(e){

        $('#tr_quick_links_content').hide();
        
        var links = $('textarea[name="tr_quick_links_links"]').val().split("\n");
        var type = $('select[name="tr_quick_links_type"] option:selected').val();
        var lang = $('select[name="tr_quick_links_lang"] option:selected').val();
        var quality = $('select[name="tr_quick_links_quality"] option:selected').val();
        $.each(links, function(i) {
            if(links[i]!='') {
                $('#trgrabber_addlink').click();
                $('#tr-grabber-content-links tr:first input[name="trgrabber_type[]"]').val(type);
                $('#tr-grabber-content-links tr:first button').removeClass('current');
                if( type == 1 ) {
                    $('#tr-grabber-content-links tr:first button.trgrabberbt_a').addClass('current'); 
                }else{
                    $('#tr-grabber-content-links tr:first button.trgrabberbt_b').addClass('current');
                }
                $('#tr-grabber-content-links tr:first input[name="trgrabber_link[]"]').val(links[i]);
                $('#tr-grabber-content-links tr:first select[name="trgrabber_lang[]"] option[value='+lang+']').attr('selected','selected');
                $('#tr-grabber-content-links tr:first select[name="trgrabber_quality[]"] option[value='+quality+']').attr('selected','selected');
            }
        });
        $('textarea[name="tr_quick_links_links"]').val('');
    });
    
    // close
    
    $("body").on("click", "#quicklinks_close", function(e){

        $('#tr_quick_links_content').hide();
        
    });
    
    // type link
    
    $("body").on("click", ".trgrabberbt_t", function(e){

        var id = $(this).data('id');
        $(this).parent().parent().find('button').removeClass('current');
        $(this).addClass('current');
        $(this).parent().parent().next().val(id);
        
    });
    
    /*Dropdown*/
    $('.AADrpd').each(function() {
        var $AADrpdwn = $(this);
        $('.AALink', $AADrpdwn).click(function(e){
          e.preventDefault();
          $AADrpdDv = $('.AACont', $AADrpdwn);
          $AADrpdDv.parent('.AADrpd').toggleClass('on');
          $('.AACont').not($AADrpdDv).parent('.AADrpd').removeClass('on');
          return false;
        });
    });
    $(document).on('click', function(e){
        if ($(e.target).closest('.AACont').length === 0) {
            $('.AACont').parent('.AADrpd').removeClass('on');
        }
    });

    // add / update seasons
    
    $("body").on("click", "#updtseason", function(event) {
        
        event.preventDefault();

        var href = $(this).data('href');

        $('#trgrabber_seasons_lg').show();
        
        $('#grabber_iframe').append('<iframe src="'+href+'" width="100%" height="100%"></iframe>');
                
    });
    
    // add / update episodes
    
    $("body").on("click", ".updtepsd", function(event) {

        event.preventDefault();
        
        var href = $(this).data('href');

        $('#trgrabber_seasons_lg').show();
        
        $('#grabber_iframe').append('<iframe src="'+href+'" width="100%" height="100%"></iframe>');
                
    });
    
    $("body").on("click", ".grabberadvanced", function(event) {

        $('.term-slug-wrap,.term-description-wrap').show();
        $(this).hide();
        
    });
    
    // image taxonomys
    
    $(document.body).on('click', '.tr-grabber-media-tax' , function(event) {
        
        event.preventDefault();
        
        var $this = $(this);
        var id = $(this).data('id');
        var postid = $(this).data('postid');
        var title = $(this).data('title');
        var button = $(this).data('button');
        var nonce = $(this).data('nonce');

        var file_frame = wp.media.frames.file_frame = wp.media({
            title: title,
            button: {
                text: button
            },
            multiple: false
        });

        file_frame.on( 'select', function() {
            attachment = file_frame.state().get('selection').first().toJSON();
            $('#tr-grabber-media-content').val(attachment.id);
            $('#image').html('<img src="'+attachment.sizes.full.url+'" alt="backdrop">');
            $('.trgrabber-media-tax-delete').show();
        });

        file_frame.open();
        
    });
    
    $(document.body).on('click', '.trgrabber-media-tax-delete' , function(event) {
        
        event.preventDefault();
                
        $('#tr-grabber-media-content').val('');
        $('#image').html('');
        $('.trgrabber-media-tax-delete').hide();
        
    });
    
    // config
    
    // reorder homecontrol
    
    $('#tr-homecontrol').sortable({
        items: '.tr-homecontrol-row',
        cursor: 'move',
    });
    
    $(document.body).on('click', '.trgrabberselect' , function(event) {

        if ( $( this ).hasClass( "checked" ) ) {
            var value = $(this).next().val().split('|');
            $(this).next().val(value[0]+'|'+value[1]+'|2');
            $(this).removeClass('checked dashicons dashicons-yes').addClass('unchecked');
        }else{
            var value = $(this).next().val().split('|');
            $(this).next().val(value[0]+'|'+value[1]+'|1');
            $(this).addClass('checked dashicons dashicons-yes').removeClass('unchecked');
        }
                
    });
    
    // edit widget text
    
    $(document.body).on('click', '.trhomecontrol_widgetext' , function(event) {
        $('#tr-grabber-addtext').show();
        $(window).scrollTop($('#tr-grabber-addtext').offset().top);
    });
    
    // list posts
    
    // view
    $(document.body).on('click', '.trgrabber_viewlink' , function(event) {
        event.preventDefault();
        var id = $( this ).data( "id" );
        var href = $('#post-'+id+' .edit a').attr('href');
        location.href = href;
    });
    
    // edit
    $(document.body).on('click', '.trgrabber_editlink' , function(event) {
        event.preventDefault();
        var id = $( this ).data( "id" );
        var href = $('#post-'+id+' .edit a').attr('href');
        location.href = href;
    });
    
    // delete
    $(document.body).on('click', '.trgrabber_deletelink' , function(event) {
        event.preventDefault();
        var id = $( this ).data( "id" );
        var href = $('#post-'+id+' .trash a').attr('href');
        location.href = href;
    });
    
    // tabs config
    $(document.body).on('click', '.tr-config-tab-ul button' , function(event) {
        var tab = $(this).data('tab');
        $('.tr-config-tab-ul li').removeClass('Current');
        $(this).parent().addClass('Current');
        $('.tr-config-tab').hide();
        $('#tr-config-tab-'+tab).show();
    });
    
    // tabs config prefix posts
    $("#grabber-prefixpost").change(function() {
        if(this.checked) {
            $('.prefix_slugs_grabber').show();
        }else{
            $('.prefix_slugs_grabber').hide();            
        }
    });
    
    // msj update
    $(document.body).on('click', '#tr-grabber-warning-upt' , function(event) {
        $(this).hide();
        $('.tr_grabber_continue').show();
    });
    
    // iframe update
    
    $("body").on("click", "#update_db_trgrabber", function(event) {
        
        event.preventDefault();
        
        $('body').append('<div class="lgtbx qcklnkbx" style="display:none;" id="trgrabber_update_lg"><div class="lgtbxcn" style="max-width:180px"><div class="lgtbxbd"><div id="grabber_update_iframe"></div></div></div><span class="lgtblyr"></span></div>');

        var href = $(this).data('href');

        $('#trgrabber_update_lg').show();
        
        $('#grabber_update_iframe').append('<iframe src="'+href+'" width="100%" height="100%"></iframe>');
                
    });
    
    // color hide frame
    
    $(function() {
        $('.trcolor').wpColorPicker();
    });
    
    // image hide frame
    
    $(document.body).on('click', '.tr-grabber-hideframe' , function(event) {
        
        event.preventDefault();
                
        var $this = $(this);
        var id = $(this).data('id');
        var title = $(this).data('title');
        var button = $(this).data('button');

        var file_frame = wp.media.frames.file_frame = wp.media({
            title: title,
            button: {
                text: button
            },
            multiple: false
        });

        file_frame.on( 'select', function() {
            attachment = file_frame.state().get('selection').first().toJSON();
            $('#tr-grabber-media-content').val(attachment.url);
            $('.tr-config-tab-ul li:last').addClass('Current');
            $('.tr-config-tab').hide();
            $('#tr-config-tab-5').show();
        });

        file_frame.open();
        
    });
});