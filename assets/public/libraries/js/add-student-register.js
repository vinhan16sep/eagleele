$(function() {
	"use strict";
    
    $('button#addStudent').click(function() {
        $('<span>  add thêm vào đây </span>').appendTo('#addHere');
        
    });
    $('a#xoa').click(function() {
        $('#themxoa li:last').remove();
        
    });
});