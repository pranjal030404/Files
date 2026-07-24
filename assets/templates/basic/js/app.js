(function ($) {
  "use strict";

  $(document).ready(function () {
    // Show Hide Password Js
    let hidePassword = $(".toggle-password");
    if (hidePassword) {
      hidePassword.click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("id"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    }

    // ============== Header Hide Click On Body Js Start ========
    $(".navbar-toggler.header-button").on("click", function () {
      if ($(".body-overlay").hasClass("show")) {
        $(".body-overlay").removeClass("show");
        $('body').removeClass('scroll-hide');
      } else {
        $(".body-overlay").addClass("show");
        $('body').addClass('scroll-hide');
      }
    });
    $(".body-overlay").on("click", function () {
      $(".header-button").trigger("click");
    });

    // =============== Header Hide Click On Body Js End =========

    //  Banner Slider
    let heroSlider = $(".hero-slider");
    if (heroSlider) {
      heroSlider.slick({
        dots: true,
        infinite: true,
        autoplay: true,
        speed: 2500,
        autoplaySpeed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: "false",
        dots: "false",
        fade: true,
        cssEase: "linear",
      });
    }

    //  Latest Bride Slider
    let brideSlider = $(".latest-bride__slider");
    if (brideSlider) {
      brideSlider.slick({
        dots: true,
        infinite: true,
        autoplay: true,
        speed: 2000,
        autoplaySpeed: 3000,
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: true,
        dots: "false",
        prevArrow:
          '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow:
          '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        responsive: [
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 1,
            },
          },
          {
            breakpoint: 991,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 1399,
            settings: {
              slidesToShow: 3,
            },
          },
        ],
      });
    }

    // Search Sidbar
    $(".filter-icon").click(function () {
      $(".search__left").toggleClass("show-siderbar");
      $(".toggle-overlay").addClass("show-overlay");
    });
    $(".search__left-btn, .toggle-overlay").click(function () {
      $(".search__left").removeClass("show-siderbar");
      $(".toggle-overlay").removeClass("show-overlay");
    });

    // Show Dashboard Sidebar in Mobile Device
    $(".dashboard-sidebar-show").on("click", function () {
      $(".dashboard-sidenav").addClass("show-sidebar");
      $(".sidebar-overlay").addClass("show");
      $('body').addClass('scroll-hide');
    });

    // Show Dashboard Sidebar in Mobile Device
    $(".dashboard-sidenav__close-icon, .sidebar-overlay").on("click", function () {
      $(".dashboard-sidenav").removeClass("show-sidebar");
      $(".sidebar-overlay").removeClass("show");
      $('body').removeClass('scroll-hide');
    });

    // ChatBox Toggle Profile
    $(".chatbox-header__icon-profile").click(function () {
      $(this).toggleClass("change-icon");
      $(".chatbox-header__profile").toggleClass("show-profile");
      $(".chatbox-header__overlay").toggleClass("show-overlay");
    });

    $(".chatbox-header__overlay").on("click", function () {
      $(".chatbox-header__profile").removeClass("show-profile");
      $(".chatbox-header__overlay").removeClass("show-overlay");
      $(".chatbox-header__icon-profile").removeClass("change-icon");
    });

    // ChatBox Left User
    $(".chatbox-header__icon-chatbox-left").click(function () {
      $(".chatbox-left").addClass("show-chatbox-left");
      $(".toggle-overlay").addClass("show-overlay");
    });
    $(".chatbox-left__close").click(function () {
      $(".chatbox-left").removeClass("show-chatbox-left");
      $(".toggle-overlay").removeClass("show-overlay");
    });

    // Header Responsive Menu
    $(".nav--toggle").click(function () {
      $(this).toggleClass("nav-close-icon");
      $(".responisve-mobile-menu").slideToggle("slow");
    });

    // Public Profile Magnific Popup
    let magnific = $(".magnific-gallery");
    if (magnific) {
      magnific.magnificPopup({
        type: "image",
        gallery: {
          enabled: true,
        },
      });
    }

    // video
    let magnificVideo = $(".about-img__btn");
    if (magnificVideo) {
      magnificVideo.magnificPopup({
        type: "iframe",
      });
    }

    // Login Slider
    let loginSlider = $(".login__slider");
    if (loginSlider) {
      loginSlider.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        infinite: true,
        autoplay: true,
        speed: 2000,
        autoplaySpeed: 3000,
      });
    }
    // Login Slider End

    // Gird Layout Filteriar Js
    let girdLayout = $(".filter-container");
    if (girdLayout.length) {
      girdLayout.filterizr({
        layout: "sameWidth",
        gridItemsSelector: ".grid-item",
        gutterPixels: 10,
      });
    }

    // Mobile Submenu
    $(".primary-menu__list.has-sub .primary-menu__link").on(
      "click",
      function (e) {
        e.preventDefault();
        body.classList.add("primary-submenu-toggler");
      }
    );
    $(".primary-menu__list.has-sub.active .primary-menu__link").on(
      "click",
      function (e) {
        e.preventDefault();
        body.classList.remove("primary-submenu-toggler");
      }
    );
    $(".primary-menu__list.has-sub").on("click", function () {
      $(this).toggleClass("active").siblings().removeClass("active");
    });
    // Mobile Submenu End

    // Search Popup
    var bodyOvrelay = $("#body-overlay");
    var searchPopup = $("#search-popup");

    $(document).on("click", "#body-overlay", function (e) {
      e.preventDefault();
      bodyOvrelay.removeClass("active");
      searchPopup.removeClass("active");
    });
    $(document).on("click", ".search--toggler", function (e) {
      e.preventDefault();
      searchPopup.addClass("active");
      bodyOvrelay.addClass("active");
    });
    // Search Popup End

    // Testimonial Slider
    let testimonialSlider = $(".testimonial-slider");
    if (testimonialSlider) {
      testimonialSlider.slick({
        mobileFirst: true,
        arrows: false,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplaySpeed: 0,
        dots: true,
        speed: 1500,
        autoplaySpeed: 2000,
        responsive: [
          {
            breakpoint: 767,
            settings: {
              slidesToShow: 2,
            },
          },
          {
            breakpoint: 1199,
            settings: {
              slidesToShow: 3,
            },
          },
        ],
      });
    }
    // Testimonial Slider End

    // Counter Up by Odometer
    let counterUp = $(".counter-card");
    if (counterUp) {
      counterUp.each(function () {
        $(this).isInViewport(function (status) {
          if (status === "entered") {
            for (
              var i = 0;
              i < document.querySelectorAll(".odometer").length;
              i++
            ) {
              var el = document.querySelectorAll(".odometer")[i];
              el.innerHTML = el.getAttribute("data-odometer-final");
            }
          }
        });
      });
    }
    // Counter Up by Odometer End

    // Password Show Hide Toggle
    let passTypeToggle = $(".pass-toggle");
    if (passTypeToggle) {
      passTypeToggle.each(function () {
        $(this).on("click", function () {
          $(this)
            .children()
            .toggleClass("fas fa-eye-slash")
            .toggleClass("fas fa-eye");
          var input = $(this).parent().find("input");
          if (input.attr("type") == "password") {
            input.attr("type", "text");
          } else {
            input.attr("type", "password");
          }
        });
      });
    }
    // Password Show Hide Toggle End

    // Multi Step Form
    const goLocation = $("#goLocation");
    const goInformation = $("#goAccountInformation");

    const loginMenu = $(".login__menu");
    const loginLink = $(".login__link");

    const loginInfo = $(".login__link-info");
    const loginLocation = $(".login__link-location");
    const loginInformation = $(".login__link-information");

    if (goLocation) {
      goLocation.on("click", () => {
        loginMenu.find(loginLink).removeClass("active");
        loginLocation.addClass("active");
      });
    }

    if (goInformation) {
      goInformation.on("click", () => {
        loginMenu.find(loginLink).removeClass("active");
        loginInformation.addClass("active");
      });
    }

    if (loginLocation) {
      loginLocation.on("click", () => {
        goInformation.removeClass("active");
      });
    }
    if (loginInfo) {
      loginInfo.on("click", () => {
        goLocation.removeClass("active");
      });
    }
    // Multi Step Form End

    // Animate the scroll to top
    $(".back-to-top").on("click", function (event) {
      event.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, 300);
    });
  });
})(jQuery);

// Header Fixed On Scroll
var bodySelector = document.querySelector("body");
const header = document.querySelector(".header-fixed");

if (bodySelector.contains(header)) {
  const headerTop = header.offsetTop;
  function fixHeader() {
    if (window.scrollY > headerTop) {
      document.body.classList.add("fixed-header");
    } else if (window.scrollY <= headerTop) {
      document.body.classList.remove("fixed-header");
    } else {
      document.body.classList.remove("fixed-header");
    }
  }
  $(window).on("scroll", function () {
    fixHeader();
  });
}
// Header Fixed On Scroll End

$(window).on("scroll", function () {
  var ScrollTop = $(".back-to-top");
  if ($(window).scrollTop() > 1200) {
    ScrollTop.fadeIn(1000);
  } else {
    ScrollTop.fadeOut(1000);
  }
});

$(window).on("load", function () {
  // Preloader
  var preloader = $(".preloader");
  preloader.fadeOut(1000);
});

$("input").attr("autocomplete", "off");

if (!$(".datepicker-here").val()) {
  $(".datepicker-here").datepicker({
    autoClose: true,
  });
}

$("input").attr("placeholder", " ");
$("textarea").attr("placeholder", " ");

function proPicURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      var preview = $(input).parents(".thumb").find(".profilePicPreview");
      $(preview).css("background-image", "url(" + e.target.result + ")");
      $(preview).addClass("has-image");
      $(preview).hide();
      $(preview).fadeIn(650);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
$(".profilePicUpload").on("change", function () {
  proPicURL(this);
});

$(".remove-image").on("click", function () {
  $(this).parents(".profilePicPreview").css("background-image", "none");
  $(this).parents(".profilePicPreview").removeClass("has-image");
  $(this).parents(".thumb").find("input[type=file]").val("");
});

Array.from(document.querySelectorAll("table")).forEach((table) => {
  let heading = table.querySelectorAll("thead tr th");
  Array.from(table.querySelectorAll("tbody tr")).forEach((row) => {
    Array.from(row.querySelectorAll("td")).forEach((colum, i) => {
      colum.setAttribute("data-label", heading[i] ? heading[i].innerText : "");
    });
  });
});

$("#confirmationModal")
  .find(".btn--primary")
  .removeClass("btn--primary")
  .addClass("btn--base");

$(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();
});

$.each($("input, select, textarea"), function (i, element) {
  if (element.hasAttribute("required")) {
    $(element)
      .parents(".input--group")
      .find("label")
      .first()
      .addClass("required");
  }
});
