'use strict';

$( document ).ready(function() {
    //preloader
    $(".preloader").delay(300).animate({
      "opacity" : "0"
      }, 300, function() {
      $(".preloader").css("display","none");
    });
  });

 // function to set a given theme/color-scheme
 function setTheme(themeName) {
    localStorage.setItem('theme', themeName);
    document.documentElement.className = themeName;
}

// function to toggle between light and dark theme
function toggleTheme() {
    if (localStorage.getItem('theme') === 'theme-dark') {
        setTheme('theme-light');
    } else {
        setTheme('theme-dark');
    }
}

// Immediately invoked function to set the theme on initial load
(function () {
    if (localStorage.getItem('theme') === 'theme-dark') {
        setTheme('theme-dark');
        document.getElementById('slider').checked = false;
    } else {
        setTheme('theme-light');
      document.getElementById('slider').checked = true;
    }
})();

$('.sidebar-collapse-btn').on('click', function(){
    $('.s7__main').toggleClass('collaped');
    $('.s7__sidebar').toggleClass('collaped');
    $('.s7__nav').toggleClass('collaped');
})

 $(".s7__sidebar-nav .has-child ul").hide();
 $(".s7__sidebar-nav .has-child.open ul").show();
 $(".s7__sidebar-nav .has-child >a").on("click", function(e) {
     e.preventDefault();
     $(this)
         .parent()
         .next("has-child")
         .slideUp();
     $(this)
         .parent()
         .parent()
         .children(".has-child")
         .children("ul")
         .slideUp();
     $(this)
         .parent()
         .parent()
         .children(".has-child")
         .removeClass("open");
     if (
         $(this)
             .next()
             .is(":visible")
     ) {
         $(this)
             .parent()
             .removeClass("open");
     } else {
         $(this)
             .parent()
             .addClass("open");
         $(this)
             .next()
             .slideDown();
     }
 });

 //to keep the current page active
 $(function () {
    for (var nk = window.location,
        o = $("ul#s7__sidebar-nav a").filter(function () {
            return this.href == nk;
        })
            .addClass("active") // anchor
            .parent()
            .addClass("active"); ;) { // li
        if (!o.is("li")) break;
        o = o.parent()
            .addClass("show")
            .parent()
            .addClass("open");
    }
});

 /* Replace all SVG images with inline SVG */
 $("img.svg").each(function() {
  var $img = $(this);
  var imgID = $img.attr("id");
  var imgClass = $img.attr("class");
  var imgURL = $img.attr("src");
  $.get(
      imgURL,
      function(data) {
          var $svg = jQuery(data).find("svg");
          if (typeof imgID !== "undefined") {
              $svg = $svg.attr("id", imgID);
          }
          if (typeof imgClass !== "undefined") {
              $svg = $svg.attr("class", imgClass + " replaced-svg");
          }
          $svg = $svg.removeAttr("xmlns:a");
          $img.replaceWith($svg);
      },
      "xml"
  );
});

/* feather icon */
feather.replace();

$('.sidebar-open-btn').on('click', function(){
    $('.s7__sidebar').addClass('active');
    $('body').addClass('dark-overlay');
});
$('.sidebar-close-btn').on('click', function(){
    $('.s7__sidebar').removeClass('active');
    $('body').removeClass('dark-overlay');
});

$('.nav-search-btn').on('click', function(){
    $(this).toggleClass('active');
    $('.s7__nav-search-form').toggleClass('active');
});