
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Mobile nav toggle
   */
  on('click', '.mobile-nav-toggle', function(e) {
    select('#navbar').classList.toggle('navbar-mobile')
    this.classList.toggle('bi-list')
    this.classList.toggle('bi-x')
  })

  /**
   * Mobile nav dropdowns activate
   */
  on('click', '.navbar .dropdown > a', function(e) {
    if (select('#navbar').classList.contains('navbar-mobile')) {
      e.preventDefault()
      this.nextElementSibling.classList.toggle('dropdown-active')
    }
  }, true)

  /**
   * Preloader
   */
  let preloader = select('#preloader');
  if (preloader) {
    window.addEventListener('load', () => {
      preloader.remove()
    });
  }

  /**
   * Testimonials slider
   */
  new Swiper('.testimonials-slider', {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 20
      },

      1200: {
        slidesPerView: 2,
        spaceBetween: 20
      }
    }
  });

  /**
   * Animation on scroll
   */
  window.addEventListener('load', () => {
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    })
  });
//isotope filler
var $grid = $(".courses").isotope({
  itemSelector:'.course-item',
  layoutMode:'fitRows'
});

var mixer = mixitup('.control', {
  controls: {
   scope: 'local'
  }
});

$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut();
	$("#preloder").delay(400).fadeOut("slow");


	/*------------------
		Gallery item
	--------------------*/
	if($('.course-items-area').length > 0 ) {
		var containerEl = document.querySelector('.course-items-area');
		var mixer = mixitup(containerEl);
	}

});
$(function() {
  $('#filter').mixItUp({
     load: {
        filter: '.central-indiana'
     }
  });
});
//changes the top center text
$('.mixitup-control[data-filter=".doctorofeducation"]').trigger('click');
//bolds the filter link
$('.mixitup-control[data-filter=".doctorofeducation"]').addClass('mixitup-control-active');
$(document).ready(function(){

  // banner owl carousel
  $("#banner-area .owl-carousel").owlCarousel({
      dots: true,
      items: 1
  });

  // top sale owl carousel
  $("#top-sale .owl-carousel").owlCarousel({
      loop: true,
      nav: true,
      dots: false,
      responsive : {
          0: {
              items: 1
          },
          600: {
              items: 3
          },
          1000 : {
              items: 5
          }
      }
  });

  // isotope filter
  var $grid = $(".grid").isotope({
      itemSelector : '.grid-item',
      layoutMode : 'fitRows'
  });

  // filter items on button click
  $(".button-group").on("click", "button", function(){
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue});
  })


  // new phones owl carousel
  $("#new-phones .owl-carousel").owlCarousel({
      loop: true,
      nav: false,
      dots: true,
      responsive : {
          0: {
              items: 1
          },
          600: {
              items: 3
          },
          1000 : {
              items: 5
          }
      }
  });

  // blogs owl carousel
  $("#blogs .owl-carousel").owlCarousel({
      loop: true,
      nav: false,
      dots: true,
      responsive : {
          0: {
              items: 1
          },
          600: {
              items: 3
          }
      }
  })


  // product qty section
  let $qty_up = $(".qty .qty-up");
  let $qty_down = $(".qty .qty-down");
  // let $input = $(".qty .qty_input");

  // click on qty up button
  $qty_up.click(function(e){
      let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
      if($input.val() >= 1 && $input.val() <= 9){
          $input.val(function(i, oldval){
              return ++oldval;
          });
      }
  });

     // click on qty down button
     $qty_down.click(function(e){
      let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
      if($input.val() > 1 && $input.val() <= 10){
          $input.val(function(i, oldval){
              return --oldval;
          });
      }
  });


});
})()
