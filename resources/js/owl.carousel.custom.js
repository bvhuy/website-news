
// Lazy load
$(function() {
    $("img.lazyload").lazyload({
        effect : "fadeIn"
    });
  });
  // End lazy load
  
  // slider
  $(".slider").owlCarousel({
      loop: true,
      autoplay: true,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      margin: 15,
      dots: false,
      responsive: {
          0: {
              items: 1
          },
          480: {
              items: 2
          },
          768: {
              items: 2
          },
          992: {
              items: 3
          }
      }
  });
  // End slider 
  
  // slider-right-second
  $('.slider-right-second').owlCarousel({
      loop:true,
      autoplay: true,
      margin: 10,
      items: 1,
      autoplayTimeout: 5000,
      autoplayHoverPause:true,
      dots: false
    });
  // End slider-right-second