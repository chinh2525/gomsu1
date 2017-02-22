/*
 * isMobile
 * responsiveMenu
 * blogSlider
 * removePreloader
 * detechChildMenu
 * detechParallax
 * blogFitVibs
 * retinaLogos
 * loadmorePortfolio
 * topCarShop
 * widgetSearch
 * widgetMailChimp
 * detechMenuAndButtonSilder
 * owlSomePortfolio
 * sliderScrollText
 * goTop
 * stickyHeader
 * topMobile
 * removePreloader
*/

;(function($) {

    'use strict'

    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    var ResponsiveMenu = {

        menuType: 'desktop',

        initial: function(winWidth) {
            ResponsiveMenu.menuWidthDetect(winWidth);
            ResponsiveMenu.menuBtnClick();
            ResponsiveMenu.parentMenuClick();
        },

        menuWidthDetect: function(winWidth) {
            var currMenuType = 'desktop';

            if (matchMedia('only screen and (max-width: 1199px)').matches) {
                currMenuType = 'mobile';
            } // change menu type

            if (currMenuType !== ResponsiveMenu.menuType) {
                ResponsiveMenu.menuType = currMenuType;

                if (currMenuType === 'mobile') {
                    var $mobileMenu = $('#mainnav').attr('id', 'mainnav-mobi').hide();
                    $('#header').find('.header-wrap').after($mobileMenu);
                    var hasChildMenu = $('#mainnav-mobi').find('li:has(ul)');
                    hasChildMenu.children('ul').hide();
                    hasChildMenu.children('a').after('<span class="btn-submenu"></span>');
                    $('.btn-menu').removeClass('active');
                } else {
                    var $desktopMenu = $('#mainnav-mobi').attr('id', 'mainnav').removeAttr('style');
                    $desktopMenu.find('.sub-menu').removeAttr('style');
                    $('#header').find('.col-md-10').after($desktopMenu);
                    $('.btn-submenu').remove();
                }
            } // clone and insert menu
        },

        menuBtnClick: function() {
            $('.btn-menu').on('click', function() {
                console.log('asd');
                $('#mainnav-mobi').slideToggle(300);
                $(this).toggleClass('active');
                return false;
            });
        }, // click on moblie button

        parentMenuClick: function() {
                $(document).on('click', '#mainnav-mobi li .btn-submenu', function(e) {
                    if ($(this).has('ul')) {
                        e.stopImmediatePropagation()
                        $(this).next('ul').slideToggle(300);
                        $(this).toggleClass('active');
                    }
                    return false;
                });
            } // click on sub-menu button
    }

    var blogFitVibs = function() {
        if ( $().fitVids )
            $('.container').fitVids();
    }

    var news = function () {
        if ( $().owlCarousel )
            $(".ewm-news .ewm-news-wrap").owlCarousel({
                navigation:false,
                autoplay:true,
                autoplayTimeout:4000,
                loop: false,
                slideSpeed: 4000,
                responsive:{ 
                    1200:{items:4, margin : 30},
                    960:{items:3, margin : 30},
                    678:{items:2, margin : 30},
                    0:{items:1, margin: 0}
                },
                nav:true,
                navText: [
                  "<i class='fa fa-angle-left'></i>",
                  "<i class='fa fa-angle-right'></i>"
                  ],
            });
    }

    var scholarship = function () {
        if ( $().owlCarousel )
            $(".ewm-scholarship .ewm-scholarship-wrap").owlCarousel({
                navigation:false,
                autoplay:false,
                autoplayTimeout:4000,
                loop: false,
                slideSpeed: 4000,
                items:1, 
                nav:true,
                navText: [
                  "<i class='fa fa-angle-left'></i>",
                  "<i class='fa fa-angle-right'></i>"
                  ],
            });
    }

    var testimonial = function () {
        if ( $().owlCarousel )
            $(".ewm-testimonial").owlCarousel({
                navigation:false,
                autoplay:false,
                autoplayTimeout:4000,
                loop: false,
                slideSpeed: 4000,
                items:1, 
                margin : 0,
                nav:false,
                navText: [
                  "<i class='fa fa-angle-left'></i>",
                  "<i class='fa fa-angle-right'></i>"
                  ],
            });
    }

    var customer = function () {
        if ( $().owlCarousel )
            $(".ewm-customer .wpb_wrapper").owlCarousel({
                navigation:false,
                autoplay: true,
                autoplayTimeout:4000,
                loop: true,
                slideSpeed: 4000,
                responsive:{ 
                    1200:{items:5, margin : 60},
                    960:{items:3, margin : 30},
                    678:{items:2, margin : 30},
                    0:{items:1, margin: 0}
                },
                nav:true,
                navText: [
                  "<i class='fa fa-angle-left'></i>",
                  "<i class='fa fa-angle-right'></i>"
                  ],
            });
    }

    function changeSelectCss(id ) {
        $(id).change(function(){
            $( id ).parent().find('.result').remove();
            $( id ).parent().append('<span class="result">'+$( id + ' option:selected' ).text()+'</span>')
        })
    }

    var contactForm = function () {
        changeSelectCss('.wpcf7-form .ngaysinh select.ngay' );
        changeSelectCss('.wpcf7-form .ngaysinh select.thang' );
        changeSelectCss('.wpcf7-form .ngaysinh select.nam' );
    }

    var detailsPost = function() {
        var ctRMore = '';
        $('.ewm-partner-item a').on('click', function() {
            var $this = $(this);
            $this.parents('.ewm-partner-item').addClass('loading');
            ctRMore = $this.text();
            $.ajax({
                type: "POST",
                url:  $this.attr('href'),
                success: function(html) {
                    $('.ewm-partner-item').removeClass('loading').hide();
                    $('.ewm-popa-content').empty().append('<span><i class="fa fa-times-circle"></i></span>' + $(html).find('.main-content')[0].innerHTML).show(300);

                    $('.ewm-popa-content span i').on('click', function() {
                        $('.ewm-popa-content').hide(300).empty();
                        $('.ewm-partner-item').show();
                    })
                }
            });
            return false;
        })

        $('.vc_tta-tab').on('click', function() {
            $('.ewm-popa-content').hide(300).empty();
            $('.ewm-partner-item').show();
        });
    }

    var widgetSearch = function() {
        if( $('.widget_search .search-form').length == 0 )
            return;
        $('.widget_search .search-form .search-submit').val('');
        $('.widget_search .search-form .search-field').attr('placeholder', 'Tìm kiếm bài viết');
    }

    var blogFitVibs = function() {
        if ( $().fitVids )
            $('.container').fitVids();
    }

    var customeSearch = function() {
        if( !$('.ewm-custome-search').length ) return;
        
        var search = function(id, victim, phpValue, index) {
            $(id).change(function(){
                removeValue(index);
                var value = $( id + ' option:selected' ).val(), datas = phpValue + '=' + value, $this = $(this);
                if( index < 2 ) {
                    $('.specific').hide();
                    $('.result-check').hide();
                    $('.search-contact').hide();
                    $this.parents('.ewm-custome-search').addClass('loading');
                    $.ajax({
                        type: "POST",
                        url:  $this.parent().attr('action'),
                        data: datas,
                        success: function(out) {
                            if( value == 'all' ) return;
                            $(victim).empty().append($(out).find(victim)[0].innerHTML).parents('.ewm-custome-search').removeClass('loading');
                        }
                    });
                    return;
                }

                $this.parents('.ewm-custome-search').addClass('loading');
                $.ajax({
                    type: "POST",
                    url:  $this.parent().attr('action'),
                    data: datas,
                    success: function(out) {
                        if( value == 'all' ) return;
                        $('.specific').show(300);
                        $(victim).empty().append($(out).find(victim)[0].innerHTML).parents('.ewm-custome-search').removeClass('loading');
                        allCheckbox(".ewm-result .specific th .checkbox", ".ewm-result .checkbox");
                        getValCheckbox();
                    }
                });
            })
        }

        var removeValue = function (index) {
            var length =$('.ewm-custome-search select').length;
            for( var i = index+1; i<length; i++ ) {
                $('.ewm-custome-search select').eq(i).find('option:not(:first)').remove();
            }
        }

        var allCheckbox = function (id, idCheck) {
            //check all
            $(id).change(function () {
                $(idCheck).prop('checked', $(this).prop("checked"));
            });
        }

        var getValCheckbox = function() {
            $('.ewm-result .specific .read-more').on( 'click', function () {
                var ids = '',$this = $(this), flat = 0;
                $(".ewm-result .specific .checkbox:not(:first):checked").each(function() {
                    ids += '_' + $(this).attr('id').split('_')[1];
                    flat = 1;
                })

                if(flat) {
                    ids = ids.substring(1, ids.length);
                    var datas = 'ids=' + ids;
                    $this.parents('.ewm-custome-search').addClass('loading');
                    $.ajax({
                        type: "POST",
                        url:  $this.parent().attr('action'),
                        data: datas,
                        success: function(out) {
                            $this.parents('.specific').hide();
                            $('.result-check').show(300);
                            $('.ewm-result .result-check table').empty().append($(out).find('.ewm-result .result-check table')[0].innerHTML).parents('.ewm-custome-search').removeClass('loading');
                            resultCheck();
                            allCheckbox(".result-check th .checkbox", ".result-check .checkbox");
                        }
                    });
                }
                return false;
            })
        }

        var resultCheck = function () {
            $('.ewm-result .result-check .read-more').on( 'click', function () {
                var $this = $(this);
                if( $this.hasClass('next') ) {
                    var flat = 0, value = '';
                    $(".ewm-result .result-check .checkbox:not(:first):checked").each(function() {
                        flat = 1;
                        value += ' -- ' + $(this).parents('tr').find('.name')[0].innerHTML;
                    })
                    if(flat) {
                        value = value.substring(4, value.length);
                        $('.result-check').hide();
                        $('.search-contact').show(300).find('.choose').find('span').empty().append(value);
                        $('.search-contact #course_hidden').val(value);
                    }
                }
                else {
                    $('.result-check').hide();
                    $('.search-contact').hide();
                    $('.ewm-result .specific').show(300);
                    $('.search-contact #course_hidden').val('');
                }
                return false;
            })   
        }

        var main = function() {
            $('.ewm-custome-search select:not(:first)').each(function() {
                $(this).find('option:not(:first)').remove();
            })

            search('.ewm-custome-search #country', '.ewm-custome-search #state', 'country', 0 );
            search('.ewm-custome-search #state', '.ewm-custome-search #broad', 'state', 1 );
            search('.ewm-custome-search #broad', '.ewm-result .specific table', 'broad', 2 );
        }

        main();
    }

    var goTop = function() {
        $(window).scroll(function() {
            if ( $(this).scrollTop() > 800 ) {
                $('.go-top').addClass('show');
            } else {
                $('.go-top').removeClass('show');
            }
        }); 

        $('.go-top').on('click', function () {
            $("html, body").animate({ scrollTop: 0 }, 1000 , 'easeInOutExpo');
            return false;
        });
    };

    // Dom Ready
    $(function() {
        blogFitVibs();
        ResponsiveMenu.initial($(window).width());
        $(window).resize(function() {
            ResponsiveMenu.menuWidthDetect($(this).width());
        });
        news();
        scholarship();
        testimonial();
        customer();
        contactForm();
        detailsPost();
        widgetSearch();
        blogFitVibs();
        customeSearch();
        goTop();
    });

})(jQuery);