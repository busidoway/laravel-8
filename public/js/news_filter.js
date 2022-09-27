$(function(){
        var news = $('.news');
        var news_item = news.find('.news-item');
        var active_target = $('.news-target.active').data('filter');

        $('.news-target').on('click', function(e){
            e.preventDefault();
            var this_filter = $(this).data('filter');

            $('.news-target').removeClass('active');
            $(this).addClass('active');

            news_item.removeClass('show');
            news.find('.news-item.filter-' + this_filter).addClass('show');

        });
    });