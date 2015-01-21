/**
 * Created by dhamez on 1/21/15.
 */
$(function(){
    $('body').on('mouseenter','.file-preview',function(){
        var image = $(this);
        var thumb = image.data('thumb');

        var options = new Object();
        options.html = true;
        options.content = '<img src="'+thumb+'"/>';
        options.placement = 'bottom';
        options.container = 'body';

        $(this).popover(options);
        $(this).popover('show');
    });

    $('body').on('mouseleave','.file-preview',function(){
        $(this).popover('destroy');
    });
});