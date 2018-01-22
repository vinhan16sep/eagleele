$(document).ready(function () {
	'use strict';
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $(window).scroll(function () {
      //if you hard code, then use console
      //.log to determine when you want the 
      //nav bar to stick.  
    if ($(window).scrollTop() > 100) {
      $('.header').addClass('header-fixed');
    }
    if ($(window).scrollTop() < 100) {
      $('.header').removeClass('header-fixed');
    }
    });


    var i = 0;


    $('i.chatbox').click(function(){
        if (i == 0) {
            $('.fixed i.chatbox').removeClass('fa-comment-o').addClass('fa-close');
            i = 1;
            $('.fixed iframe').addClass('active');
        } else {
            $('.fixed i.chatbox').removeClass('fa-close').addClass('fa-comment-o');
            i = 0;
            $('.fixed iframe').removeClass('active');
        }
    });

});