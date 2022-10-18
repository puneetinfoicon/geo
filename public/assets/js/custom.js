// ============MENU BG ACTIVE CODE END================

"use strict"; // Start of use strict
(function ($) {
    function bootstrapAnimatedLayer() {
        function doAnimations(elems) {
            //Cache the animationend event in a variable
            var animEndEv = "webkitAnimationEnd animationend";
            elems.each(function () {
                var $this = $(this),
                    $animationType = $this.data("animation");
                $this.addClass($animationType).one(animEndEv, function () {
                    $this.removeClass($animationType);
                });
            });
        }

        //Variables on page load
        var $myCarousel = $("#minimal-bootstrap-carousel"),
            $firstAnimatingElems = $myCarousel
                .find(".carousel-item:first")
                .find("[data-animation ^= 'animated']");

        //Initialize carousel
        $myCarousel.carousel({
                interval: 5000,
                cycle: true
            }
        );

        //Animate captions in first slide on page load
        doAnimations($firstAnimatingElems);

        //Other slides to be animated on carousel slide event
        $myCarousel.on("slide.bs.carousel", function (e) {
            var $animatingElems = $(e.relatedTarget).find(
                "[data-animation ^= 'animated']"
            );
            doAnimations($animatingElems);
        });
    }

    bootstrapAnimatedLayer();


})(jQuery);


// ==========IMAGES ZOOM CODE Start===============

$(document).ready(function () {
    if ($('.ex3').length) {
        // $('.ex3').zoom();
        $('.ex3').zoom({on: 'click', magnify: 2});
    }
});


// ==========IMAGES ZOOM CODE End===============

// ========================== Product-Slider-with-zoom Code Start=========================


$(document).ready(function () {
    if ($(".big").length) {
        var bigimage = $(".big");
        var thumbs = $("#thumbs");
        // var bigPopup = $("#big-popup");
        //var totalslides = 10;
        var syncedSecondary = true;

        bigimage
            .owlCarousel({
                items: 1,
                slideSpeed: 5000,
                nav: true,
                autoplay: false,
                dots: true,
                loop: true,
                responsiveRefreshRate: 100,
                navText: [
                    '<img src="../../../public/assets/img/l-arrow.png" alt="Left" class="left-img">',
                    '<img src="../../../public/assets/img/r-arrow.png" alt="Right" class="right-img">'
                ]
            })
            .on("changed.owl.carousel", syncPosition);

        thumbs
            .on("initialized.owl.carousel", function () {
                thumbs
                    .find(".owl-item")
                    .eq(0)
                    .addClass("current");
            })
            .owlCarousel({
                items: 3,
                dots: false,
                nav: true,
                navText: [
                    '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
                    '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
                ],
                smartSpeed: 100,
                slideSpeed: 500,
                slideBy: 3,
                responsiveRefreshRate: 100
            })
            .on("changed.owl.carousel", syncPosition2);

        function syncPosition(el) {
            //if loop is set to false, then you have to uncomment the next line
            //var current = el.item.index;

            //to disable loop, comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            //to this
            thumbs
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = thumbs.find(".owl-item.active").length - 1;
            var start = thumbs
                .find(".owl-item.active")
                .first()
                .index();
            var end = thumbs
                .find(".owl-item.active")
                .last()
                .index();

            if (current > end) {
                thumbs.data("owl.carousel").to(current, 100, true);
            }
            if (current < start) {
                thumbs.data("owl.carousel").to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                bigimage.data("owl.carousel").to(number, 100, true);
            }
        }

        thumbs.on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            bigimage.data("owl.carousel").to(number, 300, true);
        });
    }
});
// ========================== Product-Slider-with-zoom Code End=========================


// ==============Sticky HEADER CODE START==================

$(window).scroll(function () {
    if ($(this).scrollTop() > 1) {
        $('header').addClass("sticky");
        $('body').addClass("menuSticky");
    } else {
        $('header').removeClass("sticky");
        $('body').removeClass("menuSticky");
    }
});

// ==============Search Model CODE START==================

$(document).ready(function () {
    $('#close-btn').click(function () {
        $('#search-overlay').fadeOut();
        $('#search-btn').show();
    });
    $('#search-btn').click(function () {
        $(this).hide();
        $('#search-overlay').fadeIn();
    });
});

// ==============Search Model CODE End==================


//   ===========ICON UP DOWN CODE START================
$('.toggle-btn').on('click', function () {
    $(this).toggleClass('active')
});
//   ===========ICON UP DOWN CODE START================


$(".basket-icon").click(function () {
    $('.basket-box').toggleClass('d-none');
    $('header').toggleClass('open');

    $("body").click(function () {
        $('.basket-box').addClass('d-none');
        $('header').removeClass('open');
    });

    $(".basket-box, .basket-icon").click(function (e) {
        e.stopPropagation();
    });
});

$(".acuser-icon").click(function () {
    $('.userBox-section').toggleClass('d-none');

    $(".userBox-section, .acuser-icon").click(function (e) {
        e.stopPropagation();
    });

    $("body").click(function () {
        $('.userBox-section').addClass('d-none');
    });
});



// $(document).ready(function () {
//     var parents_li = $('.search').parents('li').siblings();
//
//     $('.search').focus(function () {
//         $('.search-overlay').removeClass('d-none');
//         parents_li.addClass('disable');
//         $('header').addClass('open');
//
//     });
//     $('.search').blur(function () {
//         $('.search-overlay').hide;
//          $('.search-overlay').addClass('d-none');
//         parents_li.removeClass('disable');
//         $('header').removeClass('open');
//     });
//
// });

$(".search").click(function () {
    $('.search-overlay').toggleClass('d-none');
    //parents_li.addClass('disable');
    $('header').addClass('open');

    $("body").click(function () {
        $('.search-overlay').addClass('d-none');
        $('header').removeClass('open');
    });

    $(".search-overlay, .search-icon").click(function (e) {
        e.stopPropagation();
    });
});


$(document).ready(function () {
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });


    $('.show_ul').click(function () {
        $('.map-location').removeClass('show');
        $(this).parents('.map-location').toggleClass('show');
        $('#map').addClass('active');
    });

    $(".mobile-menu-trigger").click(function () {
        $(this).find('i').toggleClass('fa-bars fa-times');
        $('body').toggleClass('overlay_before');
        $('.menu-bar').toggleClass('show');
    });


    ma5menu({
        menu: '.site-menu',
        activeClass: 'active',
        footer: '#ma5menu-tools',
        position: 'left',
        closeOnBodyClick: true
    });
});


$('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
    if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");

    }
    var $subMenu = $(this).next(".dropdown-menu");
    $subMenu.toggleClass('show');


    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function (e) {
        $('.dropdown-submenu .show').removeClass("show");
        console.log('asdfsf');
    });

    return false;
});


$('.navbar-custom .dropdown').on('show.bs.dropdown', function () {
    $('.overlay_menubg').addClass('show');
    $('body').addClass('overlayOff');
});

$('.navbar-custom .dropdown').on('hide.bs.dropdown', function (e) {
    $('.overlay_menubg').removeClass('show');
    $('body').removeClass('overlayOff');
});

$(".navbar-custom .dropdown-menu li .dropdown-toggle").on('click', function () {
    $(".dropdown-menu li").removeClass('active-color');
    $(this).parent().addClass('active-color');

});


if ($('.closeAll').length > 0) {
    $('.closeAll').click(function () {
        $(this).toggleClass('closeSec');
        $(this).parents(".custom-checkbox").toggleClass("closeSec");
    });
}

$(document).ready(function(){
    $('.add_to_cart').click(function (){
        //var data = $(this).Attr('id');
        $(this).addClass('wwww');
    })


    $(".navbar-menu li.li_list").hover(
        function () {
            $('.dropdown').removeClass("show").children('.dropdown-menu').removeClass("show");
            $('.overlay_menubg').removeClass("show");
            $('body').removeClass("overlayOff");
        }
    );

    $(".navbar-menu li.li_list.dropdown").hover(
        function () {
            $('.dropdown').removeClass("show").children('.dropdown-menu').removeClass("show");
            $(this).addClass("show").children('.dropdown-menu').addClass("show");
            $('.overlay_menubg').addClass("show");
            $('body').addClass("overlayOff");
        }
    );

    $(".menuClose").click(
        function () {
            $('.dropdown').removeClass("show").children('.dropdown-menu').removeClass("show");
            $('.overlay_menubg').removeClass("show");
            $('body').removeClass("overlayOff");
        }
    );
})

// scrolling-jquery start

$(document).keydown(function (event) {
    if (event.ctrlKey == true && (event.which == '61' || event.which == '107' || event.which == '173' || event.which == '109' || event.which == '187' || event.which == '189')) {
        event.preventDefault();
    }
});

const handleWheel = function (e) {
    if (e.ctrlKey || e.metaKey)
        e.preventDefault();
};
window.addEventListener("wheel", handleWheel, { passive: false });

// scrolling-jquery end


