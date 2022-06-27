jQuery(document).ready(function($) {

    // Widget search
    
    // select text
    
    $( '.trselect_text_inp' ).keyup( function() {
        var type = $(this).data('type');
        $('.tr-select-none').remove();
        var matches = $( '#trfilter_'+type+' ul.trselect' ).find( 'li:contains('+ $( this ).val() +') ' );        
        $( 'li', '#trfilter_'+type+' ul.trselect' ).not( matches ).hide();
        matches.show();
        if( matches.length == 0 ) { $('#trfilter_'+type+' .trsrcbx').append('<p class="tr-select-none">'+trlive.none+'</p>');  }
    });
    
    $(document).on('click', function(e){
        if ($(e.target).closest('.trselect_text_inp,.trselect_search_inp').length === 0) {
            $('.trselectcnt').hide();
            $('.trselect li').show();
            $('.trselect_text_inp,.trselect_search_inp').val('');
            $('.tr-select-none').remove();
        }
    });
    
    $(document.body).on('click', '.trselect_text_inp' ,function(){
        var type = $(this).data('type');
        $('.trselectcnt').hide();
        $('#trfilter_'+type+' .trsrcbx').show();
    });
    
    $(document.body).on('click', '.trselect_search_inp' ,function(){
        $('.trselectcnt').hide();
        $('.trselect_text_inp,.trselect_search_inp').val('');
    });
    
    $(document.body).on('click', '.trselect_text li' ,function() {
        var type = $(this).parent().data('type');
        var name = $(this).parent().data('name');
        var value = $(this).data('value');
        var val = $(this).data('val');
        var text = $(this).text();
        $('.tr-term'+value).remove();
        $('#trfilter_'+type+' ul.trselect_results').append('<li class="tr-term'+value+'"><input type="hidden" name="'+name+'[]" value="'+value+'"><span>'+text+'</span> <span class="tr-delete trselect-delete"></span></li>');
        $('.trselectcnt').hide();
        $('.trselect li').show();
        $('#trfilter_'+type+' .trselect_text,#trfilter_'+type+' .trselect_search_inp').val('');
    });
    
    $(document.body).on('click', '.trselect-delete' ,function() {
        $(this).parent().remove();
    });
    
    // select ajax
    
    var typingTimer;
    var doneTypingInterval = 500;
    var $input = $('.trselect_search_inp');

    $input.on('keyup', function (e) {
        if(e.keyCode != 13) {
            var type = $(this).data('type');
            $('#trfilter_'+type+' i').removeClass('AAIco-search').addClass('fa-spinner fa-spin');
            clearTimeout(typingTimer);
            typingTimer = setTimeout(trdoneTyping(this), doneTypingInterval);
        }
    });

    $input.on('keydown', function (e) {
        if(e.keyCode != 13){
            clearTimeout(typingTimer);
        }
    });

    function trdoneTyping (var1) {
        
        var type = $(var1).data('type');
        var value = $('#trfilter_'+type+' .trselect_search_inp').val();
        var count = value.length;

        if(count<3) {
            $('#trfilter_'+type+' .trselectcnt').hide();
            $('#trfilter_'+type+' i').addClass('AAIco-search').removeClass('fa-spinner fa-spin');
        }

        if(count>=3) {
            
            $.ajax({
              method: "POST",
              url: trlive.url,
              data: { nonce: trlive.nonce, action: 'tr_live', type: type, value: value }
            }).done(function( html ) {
                $('#trfilter_'+type+' i').addClass('AAIco-search').removeClass('fa-spinner fa-spin');
                $('#trfilter_'+type+' .trselectcnt').show().html(html);
            });

        }

    }
    
    // search live
    
    if($("#tr_live_search_content").length) {
            
        var typingTimersearch;
        var doneTypingIntervalsearch = 500;
        var $inputsearch = $('#tr_live_search');

        $inputsearch.on('keyup', function (e) {
            if(e.keyCode != 13){
                $('#tr_live_search_content').html('<p class="trloading"><i class="fa-spinner fa-spin"></i>'+trlive.loading)+'</p>';
                $('#searchsubmit i').removeClass('fa-search').addClass('fa-spinner fa-spin');
                clearTimeout(typingTimersearch);
                typingTimersearch = setTimeout(trdoneTypingsearch, doneTypingIntervalsearch);
            }
        });

        $inputsearch.on('keydown', function (e) {
            if(e.keyCode != 13){
                clearTimeout(typingTimersearch);
                $('#searchsubmit i').addClass('fa-search').removeClass('fa-spinner fa-spin');
            }
        });

        function trdoneTypingsearch () {

            var value = $inputsearch.val();
            var count = value.length;

            if(count<3){
                $('#tr_live_search_content').removeClass('On');
                $('#tr_live_search_content').html('<p class="trloading"><i class="fa-spinner fa-spin"></i>'+trlive.loading)+'</p>';
                $('#searchsubmit i').addClass('fa-search').removeClass('fa-spinner fa-spin');
            }

            if(count>=3){


                $.post( trlive.url, { nonce: trlive.nonce, action: 'tr_live', trsearch: value, type: 10 })
                  .done(function( data ) {
                    $('#tr_live_search_content').html(data);
                    $('#tr_live_search_content').addClass('On');
                    $('#searchsubmit i').addClass('fa-search').removeClass('fa-spinner fa-spin');
                });

            }

        }

        function trcloselive(){
            $('#tr_live_search_content').html('<p class="trloading"><i class="fa-spinner fa-spin"></i>'+trlive.loading)+'</p>';
            $('#tr_live_search_content').removeClass('On');
            $('#tr_live_search').val('');
            $('#searchsubmit i').addClass('fa-search').removeClass('fa-spinner fa-spin');
        }

        $(document).on('click', function(e){
            if ($(e.target).closest('.Search').length === 0) {
                trcloselive();
            }
        });
        
    }
    
});