jQuery(document).ready(function($){
	   
    /*Sh*/$(".AAShwHdd-lnk").on("click",function(){var a=$(this).attr("data-shwhdd");$(this).toggleClass("on");$("#"+a).toggleClass("show")});    
    /*Mn*/$(".menu-item-has-children").prepend('<i class="fa-chevron-down"></i>');$(".menu-item-has-children>i").click(function(a){a.preventDefault();var b=$(this);if(b.next().next().hasClass("show")){b.next().next().removeClass("show");b.removeClass("On")}else{b.parent().parent().find("li .sub-menu").removeClass("show");b.parent().parent().find(".On").removeClass("On");b.next().next().toggleClass("show");b.addClass("On")}});
    /*Fx*/
    function hasScrolled(){var a=$(this).scrollTop();Math.abs(lastScrollTp-a)<=delta||(a>lastScrollTp&&a>navbarHeight?$(".Header").removeClass("HdOp1").addClass("HdOp0"):a+$(window).height()<$(document).height()&&$(".Header").removeClass("HdOp0").addClass("HdOp1"),lastScrollTp=a)}function addClass(a,t){a.classList?a.classList.add(t):hasClass(a,t)||(a.className+=" "+t)}$(window).scroll(function(){var a=$(this).scrollTop();a>=90&&!$(".Header").hasClass("Pfx")?$(".Header").addClass("Pfx"):90>=a&&$(".Header").hasClass("Pfx")&&$(".Header").removeClass("Pfx")});var TpScroll,lastScrollTp=0,delta=5,navbarHeight=$(".Header").outerHeight();$(window).scroll(function(a){TpScroll=!0}),setInterval(function(){TpScroll&&(hasScrolled(),TpScroll=!1)},250);var imgContainers,len;$(".no-flexbox.no-flexboxlegacy.no-flexboxtweener .Row").wrap('<div class="RowCn"></div>'),!function(a){a.fn.percircle=function(t){var e={animate:!0};t||(t={}),a.extend(t,e);var r=3.6;return this.each(function(){var e=a(this);e.hasClass("percircle")||e.addClass("percircle"),"undefined"!=typeof e.attr("data-animate")&&(t.animate="true"==e.attr("data-animate")),t.animate&&e.addClass("animate");var s=e.attr("data-percent")||t.percent||0,o=e.attr("data-perclock")||t.perclock||0;if(o){e.hasClass("perclock")||e.addClass("perclock");var d=function(a){return 10>a?"0"+a:a};setInterval(function(){var t=new Date,r=d(t.getHours())+":"+d(t.getMinutes())+":"+d(t.getSeconds());e.html("<span>"+r+"</span>"),a('<div class="slice"><div class="bar"></div><div class="fill"></div></div>').appendTo(e);var s=t.getSeconds();0===s&&e.removeClass("gt50"),s>30&&(e.addClass("gt50"),a(".bar",e).css({"-webkit-transform":"rotate(180deg)","-moz-transform":"rotate(180deg)","-ms-transform":"rotate(180deg)","-o-transform":"rotate(180deg)",transform:"rotate(180deg)"}));var o=6*s;a(".bar",e).css({"-webkit-transform":"rotate("+o+"deg)","-moz-transform":"rotate("+o+"deg)","-ms-transform":"rotate("+o+"deg)","-o-transform":"rotate("+o+"deg)",transform:"rotate("+o+"deg)"})},1e3)}else{s>50&&e.addClass("gt50");var l=e.attr("data-text")||t.text||s+"";a("<span>"+l+"</span>").appendTo(e),a('<div class="slice"><div class="bar"></div><div class="fill"></div></div>').appendTo(e),s>50&&a(".bar",e).css({"-webkit-transform":"rotate(180deg)","-moz-transform":"rotate(180deg)","-ms-transform":"rotate(180deg)","-o-transform":"rotate(180deg)",transform:"rotate(180deg)"});var n=r*s;setTimeout(function(){a(".bar",e).css({"-webkit-transform":"rotate("+n+"deg)","-moz-transform":"rotate("+n+"deg)","-ms-transform":"rotate("+n+"deg)","-o-transform":"rotate("+n+"deg)",transform:"rotate("+n+"deg)"})},0)}})}}(jQuery),$("#TPVotes").percircle();
    
    /*Sl*/$(".MovieListTop").owlCarousel({
        autoplay: $( '.MovieListTop' ).data( "autoplay" ),
        responsive : {
            0 : {
                items:2,
            },
            450 : {
                items:4,
            },
            768 : {
                items:6,
            },
            1000 : {
                items:8,
            }
        },
        nav:false
    });
    $(".MovieListSld").owlCarousel({
        items:1,
        autoHeight:true,
        nav:false,
        autoplay: $( '.MovieListSld' ).data( "autoplay" )
    });
    
    /*lg*/$(document).keyup(function(a){if(a.keyCode==27)$('.lgtbx-on').toggleClass('lgtbx-on');});	
    $('.lgtbx').click(function(event){event.preventDefault();$('body').toggleClass('lgtbx-on');});	
    $('.lghtsof').click(function(event){event.preventDefault();$('body').toggleClass('lgtbx-on');});
    
    /*tabs*/
    $('.MovieTabNav>div').click(function(){
        var tab_id = $(this).attr('data-Mvtab');
        $('.MovieTabNav>div').removeClass('on');
        $('.MvTbCn').removeClass('on');
        $(this).addClass('on');
        $("#"+tab_id).addClass('on');
    });
    $('.TPlayerNv>li').click(function() {

        var player_id = $(this).data('tplayernv');
        var shortcode = $(this).data('shortcode');
        var shortcode_current = $('.TPlayerNv .Current').data('shortcode');
        
        if( shortcode == 2 ) {
            if( shortcode_current == 2 ) { $('.TPlayer .Current').text($('.TPlayer .Current').html()); }
            var player_text = $('#'+player_id).text();
            if(player_text!=''){
                $('#'+player_id).html(player_text);
            }
        }
        
        var tab_id = $(this).attr('data-TPlayerNv');
        $('.TPlayerNv>li').removeClass('Current');
        $('.TPlayerTb').removeClass('Current');
        $(this).addClass('Current');
        $("#"+tab_id).addClass('Current');
        
    });
        
    /*AABox*/
    $('.AABox').find('.AA-link').click(function(){
        $(this).toggleClass('On');
        $(".AA-link").not($(this)).removeClass('On');
        var tab = $(this).data('tab');
        $('span.cnv'+tab).each(function(i, obj) {
            $(this).before('<span class="cn'+tab+'">'+$(this).text()+'</span>');
            $(this).remove();
        });
    });
    
    $('.AABox').find('.AA-Season').click(function(){
        var tab = $(this).data('tab');
        $('span.cnv'+tab).each(function(i, obj) {
            $(this).before('<span class="cn'+tab+'">'+$(this).text()+'</span>');
            $(this).remove();
        });
        $(this).toggleClass('On');
        $('html,body').animate({scrollTop: $(this).parent().offset().top},'slow');
    });
    
    /*Episodes*/
    $(".Season-Episodes").owlCarousel({
        responsive : {
            0 : {
                items:1,
            },
            450 : {
                items:2,
            },
            768 : {
                items:3,
            },
            1200 : {
                items:4,
            }
        },
        nav:true,
        startPosition: $('.episodeon').data('current'),
        navText: ["<span class='SeNvP fa-chevron-left'></span>","<span class='SeNvR fa-chevron-right'></span>"]
    });
    
    $('input[name="trtype"]').click(function () { window.location = $(this).attr('value'); });

    $('.wchtrlr').click(function () {
        var iframe = $(this).data('iframe');
        $('.Ttrailer .Modal-Content').prepend(iframe);
        $('.Ttrailer').addClass('on');
    });
    $('.Ttrailer .Modal-Close').click(function () {
        $(this).parent().parent().removeClass('on');
        $('.Ttrailer .Modal-Content iframe').remove();
    });
    
    // close ads player
    $('.tr-close-dvr').click(function () {
        $('.Dvr-Player').remove();
        $('.TPlayer').removeClass('on');
    });

});