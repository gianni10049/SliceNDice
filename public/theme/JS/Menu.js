$(function(){

    $('.primary-menu .list-group-item.sub-menu-open').hover(function(){
        $(this).find('.submenu').toggle();
    }, function(){
        $(this).find('.submenu').toggle();
    });


});