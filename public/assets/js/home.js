$(document).on('ready', function () {
  // window.addEventListener('scroll', function () {
  //   var nav = document.getElementById('header-container');
  //   var logo = document.querySelector('.header-container img');
  //   if (window.pageYOffset > 450) {
  //     nav.classList.add('position-fixed');
  //     nav.style.maxWidth = '100%';
  //     nav.style.background = 'black';
  //     logo.style.height = '50px';
  //   } else {
  //     nav.classList.remove('position-fixed');
  //     nav.style.background = '';
  //     logo.style.height = '';
  //   }
  // });


  let a = 0;
  window.addEventListener('scroll', function () {
    // alert("aaa")

    let oTop = $('#counter').offset().top - window.innerHeight;
    // Md.Asaduzzaman Muhid
    if (a == 0 && $(window).scrollTop() > oTop) {
      $('.counter').each(function () {
        let $this = $(this);
        console.log($this.text())
        jQuery({
          Counter: 0
        }).animate({
          Counter: $this.text()
        }, {
          duration: 10000,
          easing: 'swing',
          step: function () {
            $this.text(Math.ceil(this.Counter));
          }
        });
      });
      a = 1; // Md.Asaduzzaman Muhid
    }
  });
  $('.regular').slick({
    dots: false,
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    rtl: false,
    prevArrow:
      "<button type='button' class='slick-prev pull-left'><svg width='40' height='40' viewBox='0 0 49 50' fill='none' xmlns='http://www.w3.org/2000/svg'><ellipse cx='24.2935' cy='25' rx='24.2935' ry='25' fill='white'/><path d='M19.4348 32.65L26.442 25L19.4348 17.35L21.592 15L30.7718 25L21.592 35L19.4348 32.65Z' fill='#3E3E3E'/></svg></button>",
    nextArrow:
      "<button type='button' class='slick-next pull-right'><svg width='40' height='40' viewBox='0 0 49 50' fill='none' xmlns='http://www.w3.org/2000/svg'><ellipse cx='24.2935' cy='25' rx='24.2935' ry='25' transform='matrix(-1 0 0 1 48.5869 0)' fill='white'/><path d='M29.1521 32.65L22.1449 25L29.1521 17.35L26.9949 15L17.8151 25L26.9949 35L29.1521 32.65Z' fill='#3E3E3E'/></svg></button>",
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1008,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 420,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
  $('.about-section-box').slick({
    dots: false,
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    rtl: false,
    prevArrow:
      "<button type='button' class='slick-prev pull-left'><svg width='40' height='40' viewBox='0 0 49 50' fill='none' xmlns='http://www.w3.org/2000/svg'><ellipse cx='24.2935' cy='25' rx='24.2935' ry='25' fill='white'/><path d='M19.4348 32.65L26.442 25L19.4348 17.35L21.592 15L30.7718 25L21.592 35L19.4348 32.65Z' fill='#3E3E3E'/></svg></button>",
    nextArrow:
      "<button type='button' class='slick-next pull-right'><svg width='40' height='40' viewBox='0 0 49 50' fill='none' xmlns='http://www.w3.org/2000/svg'><ellipse cx='24.2935' cy='25' rx='24.2935' ry='25' transform='matrix(-1 0 0 1 48.5869 0)' fill='white'/><path d='M29.1521 32.65L22.1449 25L29.1521 17.35L26.9949 15L17.8151 25L26.9949 35L29.1521 32.65Z' fill='#3E3E3E'/></svg></button>",
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1008,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 420,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $('.techer').slick({
    dots: false,
    infinite: true,
    slidesToShow: 5,
    slidesToScroll: 5,
    autoplay: true,
    autoplaySpeed: 5000,
    rtl: true,
    prevArrow:
      "<button type='button' class='slick-prev pull-left'><svg width='40' height='40' viewBox='0 0 49 50' fill='none' xmlns='http://www.w3.org/2000/svg'><ellipse cx='24.2935' cy='25' rx='24.2935' ry='25' fill='white'/><path d='M19.4348 32.65L26.442 25L19.4348 17.35L21.592 15L30.7718 25L21.592 35L19.4348 32.65Z' fill='#3E3E3E'/></svg></button>",
    nextArrow:
      "<button type='button' class='slick-next pull-right'><svg width='40' height='40' viewBox='0 0 49 50' fill='none' xmlns='http://www.w3.org/2000/svg'><ellipse cx='24.2935' cy='25' rx='24.2935' ry='25' transform='matrix(-1 0 0 1 48.5869 0)' fill='white'/><path d='M29.1521 32.65L22.1449 25L29.1521 17.35L26.9949 15L17.8151 25L26.9949 35L29.1521 32.65Z' fill='#3E3E3E'/></svg></button>",
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1008,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 420,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  $('.slider-teacher-courses').slick({
    dots: false,
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 2,
    autoplay: true,
    autoplaySpeed: 5000,
    rtl: true,
    prevArrow:
      "<button type='button' class='slick-prev pull-left'><svg width='40' height='40' viewBox='0 0 49 50' fill='none' xmlns='http://www.w3.org/2000/svg'><ellipse cx='24.2935' cy='25' rx='24.2935' ry='25' fill='white'/><path d='M19.4348 32.65L26.442 25L19.4348 17.35L21.592 15L30.7718 25L21.592 35L19.4348 32.65Z' fill='#3E3E3E'/></svg></button>",
    nextArrow:
      "<button type='button' class='slick-next pull-right'><svg width='40' height='40' viewBox='0 0 49 50' fill='none' xmlns='http://www.w3.org/2000/svg'><ellipse cx='24.2935' cy='25' rx='24.2935' ry='25' transform='matrix(-1 0 0 1 48.5869 0)' fill='white'/><path d='M29.1521 32.65L22.1449 25L29.1521 17.35L26.9949 15L17.8151 25L26.9949 35L29.1521 32.65Z' fill='#3E3E3E'/></svg></button>",
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 1008,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 420,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });
});
