$(document).ready(function(){
    $(".brand_wrap .top_area .tit_area").delay(300).animate({"opacity":1},300);
    $( window ).scroll( function() {
        var thisScroll = $(this).scrollTop();
        var topArea = $(".brand_wrap .top_area").offset().top - 300;
        var $box01 = $(".brand_wrap .box01").offset().top - 300;
        var $box02 = $(".brand_wrap .box02").offset().top - 650;
        var $box03 = $(".brand_wrap .box03").offset().top - 650;
        var $box04 = $(".brand_wrap .box04").offset().top - 650;
        
        if ( thisScroll > topArea ){
            $(".brand_wrap .top_area .cont").animate({"bottom":180,"opacity":1},800);
        }
        if ( thisScroll > $box01 ) {
            $(".brand_wrap .box01 .left_img").animate({"margin-left":0, "opacity":1},500);
            $(".brand_wrap .box01 .left_txt").delay( 200 ).animate({"left":680, "opacity":1},800);
            $(".brand_wrap .box01 .left_txt h4").delay( 400 ).animate({"opacity":1},800);
            $(".brand_wrap .box01 .left_txt p").delay( 400 ).animate({ "opacity":1},800);
           // $(".brand_wrap .box01 .left_txt p").delay( 400 ).animate({"margin-left":30, "opacity":1},800);
        }
        if ( thisScroll > $box02 ) {
            $(".brand_wrap .box02 .right_img").animate({"margin-right":0, "opacity":1},500);
            $(".brand_wrap .box02 .right_txt").delay( 800 ).animate({"right":680, "opacity":1},800);
            $(".brand_wrap .box02 .right_txt p").delay( 900 ).animate({"opacity":1},1000);
        }
        if ( thisScroll > $box03 ) {
            $(".brand_wrap .box03 .left_img").animate({"margin-left":0, "opacity":1},500);
            $(".brand_wrap .box03 .left_txt").delay( 200 ).animate({"left":680, "opacity":1},800);
            $(".brand_wrap .box03 .left_txt h4").delay( 400 ).animate({"opacity":1},800);
            $(".brand_wrap .box03 .left_txt p").delay( 400 ).animate({ "opacity":1},800);
           // $(".brand_wrap .box01 .left_txt p").delay( 400 ).animate({"margin-left":30, "opacity":1},800);
        }
        if ( thisScroll > $box04 ){
            $(".brand_wrap .box04").animate({"bottom":180,"opacity":1},800);
        }
        /*if ( thisScroll > $box04 ) {
            $(".brand_wrap .box04 .left_txt").delay( 200 ).animate({"left":680, "opacity":1},800);
            $(".brand_wrap .box04 .left_txt h4").delay( 400 ).animate({"opacity":1},800);
            $(".brand_wrap .box04 .left_txt p").delay( 400 ).animate({ "opacity":1},800);
           // $(".brand_wrap .box01 .left_txt p").delay( 400 ).animate({"margin-left":30, "opacity":1},800);
        }*/
    });
});
/**
 * ???????????? ????????? ?????? ?????????
 * ???????????? ?????? ?????? ??????
 */

$(document).ready(function(){

    var methods = {
        aCategory    : [],
        aSubCategory : {},

        get: function()
        {
             $.ajax({
                url : '/exec/front/Product/SubCategory',
                dataType: 'json',
                success: function(aData) {

                    if (aData == null || aData == 'undefined') return;
                    for (var i=0; i<aData.length; i++)
                    {
                        var sParentCateNo = aData[i].parent_cate_no;

                        if (!methods.aSubCategory[sParentCateNo]) {
                            methods.aSubCategory[sParentCateNo] = [];
                        }

                        methods.aSubCategory[sParentCateNo].push( aData[i] );
                    }
                }
            });
        },

        getParam: function(sUrl, sKey) {

            var aUrl         = sUrl.split('?');
            var sQueryString = aUrl[1];
            var aParam       = {};

            if (sQueryString) {
                var aFields = sQueryString.split("&");
                var aField  = [];
                for (var i=0; i<aFields.length; i++) {
                    aField = aFields[i].split('=');
                    aParam[aField[0]] = aField[1];
                }
            }
            return sKey ? aParam[sKey] : aParam;
        },

        getParamSeo: function(sUrl) {
            var aUrl         = sUrl.split('/');
            return aUrl[3] ? aUrl[3] : null;
        },

        show: function(overNode, iCateNo) {

            if (methods.aSubCategory[iCateNo].length == 0) {
                return;
            }

            var aHtml = [];
            aHtml.push('<ul>');
            $(methods.aSubCategory[iCateNo]).each(function() {
                aHtml.push('<li><a href="'+this.link_product_list+'">'+this.name+'</a></li>');
            });
            aHtml.push('</ul>');


            var offset = $(overNode).offset();
            $('<div class="sub-category"></div>')
                .appendTo(overNode)
                .html(aHtml.join(''))
                .find('li').mouseover(function(e) {
                    $(this).addClass('over');
                }).mouseout(function(e) {
                    $(this).removeClass('over');
                });
        },

        close: function() {
            $('.sub-category').remove();
        }
    };

    methods.get();


        /*$('.xans-layout-category li').mouseenter(function(e) {
        var $this = $(this).addClass('on'),
        iCateNo = Number(methods.getParam($this.find('a').attr('href'), 'cate_no'));

        if (!iCateNo) {
            iCateNo = Number(methods.getParamSeo($this.find('a').attr('href')));
        }

        if (!iCateNo) {
           return;
        }

        methods.show($this, iCateNo);
     }).mouseleave(function(e) {
        $(this).removeClass('on');

          methods.close();
     });*/
    
    (function($) {
        $(function() {
            $('.xans-layout-category li.cate1').each(function(e) {

                var $this = $(this).addClass('on'),
                    iCateNo = Number(methods.getParam($this.find('a').attr('href'), 'cate_no'));
                if (!iCateNo) {
                    iCateNo = Number(methods.getParamSeo($this.find('a').attr('href')));
                }
                if (!iCateNo) {
                    return;
                }

                $(this).children('a').addClass('cateList').prepend('<span class="icon"></span>');

                setTimeout(function () {
                    methods.show($this, iCateNo);
                },200);

                //asdf

                setTimeout(function () {
                    $(".leftCategory > .category > .position > li > .sub-category").each(function() {
                        var sublen = $(this).find("li").length;
                        if (sublen > 0)
                        {
                            /*
							var st = $(this).parent().find(".st");				
							st.prependTo(this);
					     	var cc1 = - ($(this).width() / 2);
                            var cc2 = $(this).parent().width() / 2;
                            $(this).css("left",cc1 + cc2);*/
                        } else {
                            $(this).remove();
                        }

                    });
                },210);	

            },function(){		
                $(this).removeClass('on');
                methods.close();
            });
        }); 		
        $(".btn-allcate").click(function(){
            $(".allCate_con ul").remove();
            var cateClone = $(".category > ul").clone();
            cateClone.prependTo(".allCate_con");
            //$(".allCate_con > .position > li").eq(0).remove();  /* ????????? ??????*/
        });
        $("#allCate .sub-category > ul > li").click(function(){
            window.location = $(this).find("a").attr("href");
        });
    })(jQuery);
});

setTimeout(function () {
    $(".category > .position > li > .sub-category").each(function(){
        var st = $(this).find(".st")
        var stlen = st.length;
        if (stlen > 0)
        {			
            var thisW = $(this).width();
            var thisH = $(this).height();
            var stW = st.width() + thisW;
            var stW2 = stW + 80;		
            $(this).css("width",stW2);
            var stH = st.height();
            var stH2 = stH + 0;
            if (stH > thisH)
            {	
                $(this).css("height",stH2);
            }
        }
    });
},300);	

$('.leftCategory .category > ul > li.etc').each(function(){
    var etcDisplay = $(this).css('display');
    if (etcDisplay=='none')
    {
        $(this).remove();
    }
});
/**
 * ???????????? ?????? Jquery Plug-in
 * @author  cafe24
 */

(function($){

    $.fn.floatBanner = function(options) {
        options = $.extend({}, $.fn.floatBanner.defaults , options);

        return this.each(function() {
            var aPosition = $(this).position();
            var jbOffset = $(this).offset();
            var node = this;

            $(window).scroll(function() {
                var _top = $(document).scrollTop();
                _top = (aPosition.top < _top) ? _top : aPosition.top;

                setTimeout(function () {
                    var newinit = $(document).scrollTop();

                    if ( newinit > jbOffset.top ) {
                        _top -= jbOffset.top;
                        var container_height = $("#wrap").height();
                        var quick_height = $(node).height();
                        var cul = container_height - quick_height;
                        if(_top > cul){
                            _top = cul;
                        }
                    }else {
                        _top = 0;
                    }

                    $(node).stop().animate({top: _top}, options.animate);
                }, options.delay);
            });
        });
    };

    $.fn.floatBanner.defaults = {
        'animate'  : 500,
        'delay'    : 500
    };

})(jQuery);

/**
 * ?????? ????????? ??????
 */
$(document).ready(function(){
    $('#banner:visible, #quick:visible').floatBanner();

    //placeholder
    $(".ePlaceholder input, .ePlaceholder textarea").each(function(i){
        var placeholderName = $(this).parents().attr('title');
        $(this).attr("placeholder", placeholderName);
    });
    /* placeholder ie8, ie9 */
    $.fn.extend({
        placeholder : function() {
            //IE 8 ???????????? hasPlaceholderSupport() ?????? false??? ??????
           if (hasPlaceholderSupport() === true) {
                return this;
            }
            //hasPlaceholderSupport() ?????? false ??? ?????? ?????? ????????? ??????
            return this.each(function(){
                var findThis = $(this);
                var sPlaceholder = findThis.attr('placeholder');
                if ( ! sPlaceholder) {
                   return;
                }
                findThis.wrap('<label class="ePlaceholder" />');
                var sDisplayPlaceHolder = $(this).val() ? ' style="display:none;"' : '';
                findThis.before('<span' + sDisplayPlaceHolder + '>' + sPlaceholder + '</span>');
                this.onpropertychange = function(e){
                    e = event || e;
                    if (e.propertyName == 'value') {
                        $(this).trigger('focusout');
                    }
                };
                //?????? class
                var agent = navigator.userAgent.toLowerCase();
                if (agent.indexOf("msie") != -1) {
                    $(".ePlaceholder").css({"position":"relative"});
                    $(".ePlaceholder span").css({"position":"absolute", "padding":"0 4px", "color":"#878787"});
                    $(".ePlaceholder label").css({"padding":"0"});
                }
            });
        }
    });

    $(':input[placeholder]').placeholder(); //placeholder() ????????? ??????

    //???????????? placeholder ??????
    $('body').delegate('.ePlaceholder span', 'click', function(){
        $(this).hide();
    });

    //input??? ????????? ??? ?????? placeholder ??????
    $('body').delegate('.ePlaceholder :input', 'focusin', function(){
        $(this).prev('span').hide();
    });

    //input??? ????????? ?????? ?????? value ??? true ?????? ??????, false ?????? ?????????
    $('body').delegate('.ePlaceholder :input', 'focusout', function(){
        if (this.value) {
            $(this).prev('span').hide();
        } else {
            $(this).prev('span').show();
        }
    });

    //input??? placeholder??? ????????? ?????? true??? ????????? false??? ??????????????? ?????????
    function hasPlaceholderSupport() {
        if ('placeholder' in document.createElement('input')) {
            return true;
        } else {
            return false;
        }
    }
});

/**
 *  ????????? ????????? ??????????????? ????????? ??????
 */
$(window).load(function() {
    $("img.thumb,img.ThumbImage,img.BigImage").each(function($i,$item){
        var $img = new Image();
        $img.onerror = function () {
                $item.src="//img.echosting.cafe24.com/thumb/img_product_big.gif";
        }
        $img.src = this.src;
    });
});

/**
 *  tooltip
 */
$('.eTooltip').each(function(i){
    $(this).find('.btnClose').attr('tabIndex','-1');
});
//tooltip input focus
$('.eTooltip').find('input').focus(function() {
    var targetName = returnTagetName(this);
    targetName.siblings('.ec-base-tooltip').show();
});
$('.eTooltip').find('input').focusout(function() {
    var targetName = returnTagetName(this);
    targetName.siblings('.ec-base-tooltip').hide();
});
function returnTagetName(_this){
    var ePlacename = $(_this).parent().attr("class");
    var targetName;
    if(ePlacename == "ePlaceholder"){ //ePlaceholder ??????
        targetName = $(_this).parents();
    }else{
        targetName = $(_this);
    }
    return targetName;
}

/**
 *  eTab
 */
 $("body").delegate(".eTab a", "click", function(e){
    // ????????? li ??? selected ????????? ??????, ?????? li??? ?????? selected ???????????? ??????.
    var _li = $(this).parent("li").addClass("selected").siblings().removeClass("selected"),
    _target = $(this).attr("href"),
    _siblings = $(_target).attr("class"),
    _arr = _siblings.split(" "),
    _classSiblings = "."+_arr[0];

    //????????? ?????? ???????????? ????????? ?????????, ?????? ????????? ???????????? ???.
    $(_target).show().siblings(_classSiblings).hide();


    //preventDefault ??? a ?????? ?????? ?????? ????????? ?????? ????????? ???????????? ????????? ?????? ?????? ?????????.
    e.preventDefault();
});



$(document).ready(function(){
    $("#header .top_section .contents ul.right .search").click(function(){
        $(".searchWrap").slideToggle();
    });
});

/* ????????? ????????? (??????,????????????) */
<!-- 
function calculate_discount() {
	$('.discount').each(function() {

		var custom = $(this).attr('data-custom');
		var price = $(this).attr('data-price');

		custom = parseInt(custom.replace(/,/g, ''));
		price = parseInt(price.replace(/,/g, ''));

		var rate = 0;
		if (!isNaN(custom) && !isNaN(price) && 0 < custom) {
			rate = Math.round((custom - price) / custom * 100);
		}
		if(rate>0) {
			$(this).html(rate + '<span>%</span>')/*.css("box-shadow" , "2px 4px 9px 2px rgba(0,0,0,0.05)").css("background" , "#fff");*/
		}

		$(this).removeAttr('data-custom');
		$(this).removeAttr('data-price');
	});
}

$(document).ready(function() {
	calculate_discount();
});

/* ???????????? ???????????? */
$( document ).ready( function() {
    var jbOffset = $( '#header' ).offset();
    $( window ).scroll( function() {
      if ( $( document ).scrollTop() > jbOffset.top ) {
        $( '#header' ).addClass( 'fixed' );
      }
      else {
        $( '#header' ).removeClass( 'fixed' );
      }
    });
  });


/* prd tab */
$(document).ready(function(){
    $(".prd_tab .tab_menu li").click(function(){
        var thisNum = $(this).index();
        console.log(thisNum);
        $(".prd_tab .tab_menu li").removeClass("active");
        $(this).addClass("active");
        $(".prd_tab .prd").hide();
        $(".prd_tab .prd").eq(thisNum).show();
    });
});

/* ???????????? ???????????? TOP?????? */
$(document).ready(function(){
    $(window).scroll(function () {
        if ($(this).scrollTop() > 10) { 
            $('.sns_area').fadeIn();
        } else {
            $('.sns_area').fadeOut();
        }
    });
});

/* ft_banner */
$(document).ready(function(){
    $(".mainBanner01 .section ul li").mouseover(function(){
        $(this).find(".img").css({"top":"-10px"});
    }).mouseleave(function(){
        $(this).find(".img").css({"top":0});
    });

    /* ???????????? ???????????? TOP?????? */
    $(document).ready(function(){
        $(window).scroll(function () {
            if ($(this).scrollTop() > 10) { 
                $('.back-top').fadeIn();
            } else {
                $('.back-top').fadeOut();
            }
        });

        $('.back-top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 200);
            return false;
        });
    });

    /*** TOP,BOTTOM ?????? ***/
    $(document).ready(function(){
        var top_btn = $("#goBtn").offset().top;
        $(window).scroll(function(){
            if($(window).scrollTop() > top_btn+400) {
                $('#goBtn').addClass('btnFixed');
            }

        });

        $(".btn.up").click(function(){
            return $("html, body").animate({scrollTop:0},1200,"easeInOutExpo"),!1});

        $(".btn.down").click(function(){
            return $("html, body").animate({scrollTop:$(document).height()},1200,"easeInOutExpo"),!1});
    });    
});
    
/* ?????? ????????? ????????? ?????? ?????? */
$(document).ready(function() {
    $('.main_board .galleryList li').mouseover(function(e) {
       $(this).find(".imgLink").css({"top":"-10px"});
    }).mouseleave(function(){
        $(this).find(".imgLink").css({"top":0});       
    });
});    


jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,f,a,h,g){return jQuery.easing[jQuery.easing.def](e,f,a,h,g)},easeInQuad:function(e,f,a,h,g){return h*(f/=g)*f+a},easeOutQuad:function(e,f,a,h,g){return -h*(f/=g)*(f-2)+a},easeInOutQuad:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f+a}return -h/2*((--f)*(f-2)-1)+a},easeInCubic:function(e,f,a,h,g){return h*(f/=g)*f*f+a},easeOutCubic:function(e,f,a,h,g){return h*((f=f/g-1)*f*f+1)+a},easeInOutCubic:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f+a}return h/2*((f-=2)*f*f+2)+a},easeInQuart:function(e,f,a,h,g){return h*(f/=g)*f*f*f+a},easeOutQuart:function(e,f,a,h,g){return -h*((f=f/g-1)*f*f*f-1)+a},easeInOutQuart:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f+a}return -h/2*((f-=2)*f*f*f-2)+a},easeInQuint:function(e,f,a,h,g){return h*(f/=g)*f*f*f*f+a},easeOutQuint:function(e,f,a,h,g){return h*((f=f/g-1)*f*f*f*f+1)+a},easeInOutQuint:function(e,f,a,h,g){if((f/=g/2)<1){return h/2*f*f*f*f*f+a}return h/2*((f-=2)*f*f*f*f+2)+a},easeInSine:function(e,f,a,h,g){return -h*Math.cos(f/g*(Math.PI/2))+h+a},easeOutSine:function(e,f,a,h,g){return h*Math.sin(f/g*(Math.PI/2))+a},easeInOutSine:function(e,f,a,h,g){return -h/2*(Math.cos(Math.PI*f/g)-1)+a},easeInExpo:function(e,f,a,h,g){return(f==0)?a:h*Math.pow(2,10*(f/g-1))+a},easeOutExpo:function(e,f,a,h,g){return(f==g)?a+h:h*(-Math.pow(2,-10*f/g)+1)+a},easeInOutExpo:function(e,f,a,h,g){if(f==0){return a}if(f==g){return a+h}if((f/=g/2)<1){return h/2*Math.pow(2,10*(f-1))+a}return h/2*(-Math.pow(2,-10*--f)+2)+a},easeInCirc:function(e,f,a,h,g){return -h*(Math.sqrt(1-(f/=g)*f)-1)+a},easeOutCirc:function(e,f,a,h,g){return h*Math.sqrt(1-(f=f/g-1)*f)+a},easeInOutCirc:function(e,f,a,h,g){if((f/=g/2)<1){return -h/2*(Math.sqrt(1-f*f)-1)+a}return h/2*(Math.sqrt(1-(f-=2)*f)+1)+a},easeInElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return -(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e},easeOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k)==1){return e+l}if(!j){j=k*0.3}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}return g*Math.pow(2,-10*h)*Math.sin((h*k-i)*(2*Math.PI)/j)+l+e},easeInOutElastic:function(f,h,e,l,k){var i=1.70158;var j=0;var g=l;if(h==0){return e}if((h/=k/2)==2){return e+l}if(!j){j=k*(0.3*1.5)}if(g<Math.abs(l)){g=l;var i=j/4}else{var i=j/(2*Math.PI)*Math.asin(l/g)}if(h<1){return -0.5*(g*Math.pow(2,10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j))+e}return g*Math.pow(2,-10*(h-=1))*Math.sin((h*k-i)*(2*Math.PI)/j)*0.5+l+e},easeInBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*(f/=h)*f*((g+1)*f-g)+a},easeOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}return i*((f=f/h-1)*f*((g+1)*f+g)+1)+a},easeInOutBack:function(e,f,a,i,h,g){if(g==undefined){g=1.70158}if((f/=h/2)<1){return i/2*(f*f*(((g*=(1.525))+1)*f-g))+a}return i/2*((f-=2)*f*(((g*=(1.525))+1)*f+g)+2)+a},easeInBounce:function(e,f,a,h,g){return h-jQuery.easing.easeOutBounce(e,g-f,0,h,g)+a},easeOutBounce:function(e,f,a,h,g){if((f/=g)<(1/2.75)){return h*(7.5625*f*f)+a}else{if(f<(2/2.75)){return h*(7.5625*(f-=(1.5/2.75))*f+0.75)+a}else{if(f<(2.5/2.75)){return h*(7.5625*(f-=(2.25/2.75))*f+0.9375)+a}else{return h*(7.5625*(f-=(2.625/2.75))*f+0.984375)+a}}}},easeInOutBounce:function(e,f,a,h,g){if(f<g/2){return jQuery.easing.easeInBounce(e,f*2,0,h,g)*0.5+a}return jQuery.easing.easeOutBounce(e,f*2-g,0,h,g)*0.5+h*0.5+a}});
/*! Respond.js v1.4.2: min/max-width media query polyfill
 * Copyright 2014 Scott Jehl
 * Licensed under MIT
 * http://j.mp/respondjs */

//window popup script
function winPop(url) {
    window.open(url, "popup", "width=300,height=300,left=10,top=10,resizable=no,scrollbars=no");
}
/**
 * document.location.href split
 * return array Param
 */
function getQueryString(sKey)
{
    var sQueryString = document.location.search.substring(1);
    var aParam       = {};

    if (sQueryString) {
        var aFields = sQueryString.split("&");
        var aField  = [];
        for (var i=0; i<aFields.length; i++) {
            aField = aFields[i].split('=');
            aParam[aField[0]] = aField[1];
        }
    }

    aParam.page = aParam.page ? aParam.page : 1;
    return sKey ? aParam[sKey] : aParam;
};

$(document).ready(function(){
    // tab
    $.eTab = function(ul){
        $(ul).find('a').click(function(){
            var _li = $(this).parent('li').addClass('selected').siblings().removeClass('selected'),
                _target = $(this).attr('href'),
                _siblings = '.' + $(_target).attr('class');
            $(_target).show().siblings(_siblings).hide();
            return false
        });
    }
    if ( window.call_eTab ) {
        call_eTab();
    };
});
(function($){
$.fn.extend({
    center: function() {
        this.each(function() {
            var
                $this = $(this),
                $w = $(window);
            $this.css({
                position: "absolute",
                top: ~~(($w.height() - $this.outerHeight()) / 2) + $w.scrollTop() + "px",
                left: ~~(($w.width() - $this.outerWidth()) / 2) + $w.scrollLeft() + "px"
            });
        });
        return this;
    }
});
$(function() {
    var $container = function(){/*
<div id="modalContainer">
    <iframe id="modalContent" scroll="0" scrolling="no" frameBorder="0"></iframe>
</div>');
*/}.toString().slice(14,-3);
    $('body')
    .append($('<div id="modalBackpanel"></div>'))
    .append($($container));
    function closeModal () {
        $('#modalContainer').hide();
        $('#modalBackpanel').hide();
    }
    $('#modalBackpanel').click(closeModal);
    zoom = function ($piProductNo, $piCategoryNo, $piDisplayGroup) {
        var $url = '/product/image_zoom.html?product_no=' + $piProductNo + '&cate_no=' + $piCategoryNo + '&display_group=' + $piDisplayGroup;
        $('#modalContent').attr('src', $url);
        $('#modalContent').bind("load",function(){
            $(".header .close",this.contentWindow.document.body).bind("click", closeModal);
        });
        $('#modalBackpanel').css({width:$("body").width(),height:$("body").height(),opacity:.4}).show();
        $('#modalContainer').center().show();
    }
});
})(jQuery);
$(document).ready(function(){
    if (typeof(EC_SHOP_MULTISHOP_SHIPPING) != "undefined") {
        var sShippingCountryCode4Cookie = 'shippingCountryCode';
        var bShippingCountryProc = false;

        // ???????????? ?????? ????????? ?????????????????? ??????
        if (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShippingCountrySelection === false) {
            $('.xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist').hide();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioption .xans-layout-multishoplistmultioptioncountry').hide();
        } else {
            $('.thumb .xans-layout-multishoplistitem').hide();
            var aShippingCountryCode = document.cookie.match('(^|;) ?'+sShippingCountryCode4Cookie+'=([^;]*)(;|$)');
            if (typeof(aShippingCountryCode) != 'undefined' && aShippingCountryCode != null && aShippingCountryCode.length > 2) {
                var sShippingCountryValue = aShippingCountryCode[2];
            }

            // query string?????? ?????? ??? ???????????? ?????? ?????????, ??? ?????? ?????????
            var aHrefCountryValue = decodeURIComponent(location.href).split("/?country=");

            if (aHrefCountryValue.length == 2) {
                var sShippingCountryValue = aHrefCountryValue[1];
            }

            // ?????? ??????????????? ??????????????? ?????? ??????, ??? ?????? ??????????????? ????????? ?????? ??? ????????? ?????? ??????
            if (location.href.split("/").length != 4 && $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val()) {
                $(".xans-layout-multishoplist .xans-layout-multishoplistmultioption a .ship span").text(" : "+$(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist option:selected").text().split("SHIPPING TO : ").join(""));

                if ($("#f_country").length > 0 && location.href.indexOf("orderform.html") > -1) {
                    $("#f_country").val($(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val());
                }
            }
            if (typeof(sShippingCountryValue) != "undefined" && sShippingCountryValue != "" && sShippingCountryValue != null) {
                sShippingCountryValue = sShippingCountryValue.split("#")[0];
                var bShippingCountryProc = true;

                $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val(sShippingCountryValue);
                $(".xans-layout-multishoplist .xans-layout-multishoplistmultioption a .ship span").text(" : "+$(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist option:selected").text().split("SHIPPING TO : ").join(""));
                var expires = new Date();
                expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30?????? ?????? ??????
                document.cookie = sShippingCountryCode4Cookie+'=' + $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val() +';path=/'+ ';expires=' + expires.toUTCString();
                if ($("#f_country").length > 0 && location.href.indexOf("orderform.html") > -1) {
                    $("#f_country").val(sShippingCountryValue).change();;
                }
            }
        }
        // ???????????? ????????? ?????????????????? ??????
        if (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShippingLanguageSelection === false) {
            $('.xans-layout-multishopshipping .xans-layout-multishopshippinglanguagelist').hide();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioption .xans-layout-multishoplistmultioptionlanguage').hide();
        } else {
            $('.thumb .xans-layout-multishoplistitem').hide();
        }

        // ???????????? ??? ?????? ????????? ??? ??? ?????????????????? ??????
        if (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShipping === false) {
            $(".xans-layout-multishopshipping").hide();
            $('.xans-layout-multishoplist .xans-layout-multishoplistmultioption').hide();
        } else if (bShippingCountryProc === false && location.href.split("/").length == 4) { // ???????????? ?????? ????????? ?????? ??????, ??????????????? ?????? ?????? ???????????? ??????
            var sShippingCountryValue = $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val();
            $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val(sShippingCountryValue);
            $(".xans-layout-multishoplist .xans-layout-multishoplistmultioption a .ship span").text(" : "+$(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist option:selected").text().split("SHIPPING TO : ").join(""));
            // ???????????? ????????? ???????????? ???????????? ????????? ???
            if (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShippingCountrySelection === true) {
                $(".xans-layout-multishopshipping").show();
            }
        }

        $(".xans-layout-multishopshipping .close").bind("click", function() {
            $(".xans-layout-multishopshipping").hide();
        });

        $(".xans-layout-multishopshipping .ec-base-button a").bind("click", function() {
            var expires = new Date();
            expires.setTime(expires.getTime() + (30 * 24 * 60 * 60 * 1000)); // 30?????? ?????? ??????
            document.cookie = sShippingCountryCode4Cookie+'=' + $(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val() +';path=/'+ ';expires=' + expires.toUTCString();

            // ????????? ????????? ????????? ???????????? ????????? ??? ?????? ????????? ?????? query string?????? ???????????? ?????? ??????
            var sQuerySting = (EC_SHOP_MULTISHOP_SHIPPING.bMultishopShippingCountrySelection === false) ? "" : "/?country="+encodeURIComponent($(".xans-layout-multishopshipping .xans-layout-multishopshippingcountrylist").val());

            location.href = '//'+$(".xans-layout-multishopshipping .xans-layout-multishopshippinglanguagelist").val()+sQuerySting;
        });
        $(".xans-layout-multishoplist .xans-layout-multishoplistmultioption a").bind("click", function() {
            $(".xans-layout-multishopshipping").show();
        });
    }
});
