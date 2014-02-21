jQuery(function($) {
  viewportHeight = $('body').outerHeight() - $('header').outerHeight() - $('footer').outerHeight();
  subnavWidth = $('.b-header a:first').width();

  
  $(window).resize(function(e) {
   $('.b-portfolio').css({'min-height': $('body').height() - 150});
  });


  $(document)
  .on('click', 'a', function(e) {
    if ($(this).attr('target')) return;
    if ($(this).attr('href') == '/') $('.current').removeClass('current');
    $('.active').removeClass('active').find('.b-nav__item__popup').css({'width': 'auto'});
    $('.current', $(this).parents('nav')).removeClass('current');
    $(this).addClass('current').parents('.b-nav__item').addClass('active').find('>a').addClass('current').next('.b-nav__item__popup').css({'width': subnavWidth});
    var state = {
      title: $(this).text(),
      url: $(this).attr('href')
    }
    history.pushState(state, state.title, state.url);
    ajaxPage();
    e.preventDefault();
  })
  .on('submit', 'form', function(e) {
    $(this).append('<input')
    var data = $(this).serializeArray();
    data.push({name: "ajax", value: true});
    console.log(data);
    $.post(window.location, data, function(data) {
      $('.b-content').html(data);
      checkElements();
      $.scrollTo(0);
    });
    e.preventDefault();
  });;

  window.onpopstate = function( e ) {
    ajaxPage();
  }


  checkElements();
});


function mapInit() {
  var mapOptions = {
    center: new google.maps.LatLng(55.750061, 37.616169),
    zoom: 15,
    styles: [{stylers: [{saturation: -100}]}]
  };
  var map = new google.maps.Map(document.getElementById("map-canvas"),
      mapOptions);
  var marker = new google.maps.Marker({
      position: mapOptions.center,
      map: map,
      icon: '/assets/images/map-marker.png'
  });
}


function checkElements() {
  if($('#map-canvas').length) {
    mapInit();
  }


  $('.b-banners__slider').bxSlider({
    mode: 'fade'
    ,controls: false
    ,auto: true
  });


  $('.b-portfolio').css({'min-height': viewportHeight - 40});
  $('.active .b-nav__item__popup').css({'width': subnavWidth});
  $('.b-admin-banners').css({'margin-left': subnavWidth}).find('td:first').css({'width': subnavWidth});


  $('form').trigger('reset');
}


function ajaxPage() {
  $.get(window.location, {ajax:true}, function(data) {
    $('.b-content').html(data);
    checkElements();
    $.scrollTo(0);
  });
}