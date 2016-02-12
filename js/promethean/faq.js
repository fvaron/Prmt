$j(document).ready(function(){
    var hash = window.location.hash.substring(1);
    if(hash) {
        var target = $j('#faq .list-item > li[data-item-id="' + hash + '"]');
        target.find('.question').toggleClass('active');
        $j('html, body').animate({
            scrollTop: target.offset().top
        }, 2000);
        target.find('.question').next().stop().slideToggle();
    }
    $j('#faq .question').on('click', function(){
        $j(this).toggleClass('active');
        $j(this).next().stop().slideToggle();
    });
});