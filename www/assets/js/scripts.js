jQuery(function($) {
  viewportHeight = $('body').outerHeight() - $('header').outerHeight() - $('footer').outerHeight();
  subnavWidth = $('.b-header a:first').width();

  
  $(window).resize(function(e) {
   $('.b-portfolio').css({'min-height': $('body').height() - 150});
  });


  $(document)
  .on('click', function(event) {
    $('.visible').removeClass('visible');
  })
  .on('click', 'a', function(e) {
    if ($(this).attr('target')) return;
    $('.current').removeClass('current');
    history.pushState(null, null, $(this).attr('href'));
    ajaxPage();
    e.preventDefault();
  })
  .on('submit', 'form', function(e) {
    var form = $(this);
    if ($('.selected-files li', form).length) {
      onComplete = function(filename, response, uploadBtn) {
        form.append('<input type="hidden" name="'+ $(':file', uploadBtn).data('name') +'" value="'+ response.file +'">');
        $('.selected-files li:contains("'+ filename +'")', form).remove();
        if(!$('.selected-files li', form).length) form.submit();
      }
      $.each(uploader._queue, function(index, item) { uploader.submit(); });
    } else {
      var data = form.serializeArray();
      ajaxPage(data);
    }
    e.preventDefault();
  })
  .on('click', '[data-remove]', function(event) {
    var data = $(this).data('remove');
    data.action = 'remove';
    ajaxPage(data);
  })
  .on('click', '[data-update]', function(event) {
    var attr = $(this).data('update');
    var data = $('[data-index="'+attr.index+'"] input').serializeArray();
    data.push({"name": "action", "value": "update"});
    data.push({"name": "id", "value": attr.id});
    data.push({"name": "table", "value": attr.table});
    console.log(data);
    ajaxPage(data);
  })
  .on('click', '[data-edit]', function(event) {
    $('[data-index="'+$(this).data('edit')+'"]').addClass('edit');
  })
  .on('click', '[data-disedit]', function(event) {
    $('[data-index="'+$(this).data('disedit')+'"]').removeClass('edit');
  });

  window.onpopstate = function( e ) {
    ajaxPage();
  }


  init();
});


var selectedFiles
    , uploader
    , loadingTimeout
    , onComplete = function(filename, response, uploadBtn) {};


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


function init() {
  $('script[src*="maps.gstatic.com"]').remove();
  if($('#map-canvas').length) {
    $.getScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyBhLxDE78q5-SKIg1jMghOMVyZeHTT7HWg&sensor=true&callback=mapInit');
  }


  $('.b-banners__slider').bxSlider({
    mode: 'fade'
    ,controls: false
    ,auto: true
  });


  $('.active').removeClass('active').find('.b-nav__item__popup').css({'width': 'auto'});

  $('a').each(function(index, element) {
    if ($.inArray($(this).attr('href'), [window.location.pathname, window.location.search, window.location.pathname+window.location.search]) >= 0) {
      $(this).addClass('current').parents('.b-nav__item').addClass('active');
    }
  });


  $('.b-portfolio').css({'min-height': viewportHeight - 40});
  $('.active .b-nav__item__popup').css({'width': subnavWidth});
  $('.admin .b-content').css({'margin-left': subnavWidth})
  $('.b-admin-banners td:first').css({'width': subnavWidth});


  $('form').trigger('reset');


  selectedFiles = false;
  if (uploader) uploader.destroy();
  if ($('.uploader').length) {
    uploader = new ss.SimpleUpload({
      button: $('.uploader .btn').toArray(),
      url: '/uploadFiles',
      name: 'file',
      multiple: true,
      autoSubmit: false,
      maxUploads: 10,
      responseType: 'json',
      onChange: function(filename, extension, uploadBtn) {
        $('.selected-files', $(uploadBtn).parents('.uploader')).empty();
        setTimeout(function() {
          $.each(uploader._queue, function(index, item) {
            $('.selected-files', $(uploadBtn).parents('.uploader')).append('<li>'+item.file.name+'</li>');
          })
        }, 0);
      },
      onComplete: function(filename, response, uploadBtn) {
        onComplete(filename, response, uploadBtn);
      }
    });
  }
}


function ajaxPage(postData) {
  data = postData || {};
  loadingTimeout = setTimeout(function() {
    $('.b-loading').addClass('visible');
  }, 300);
  
  $.ajax({
    url: window.location,
    data: data,
    type: postData ? 'POST' : 'GET',
    success: function(response) {
      clearTimeout(loadingTimeout);
      $('.b-loading').removeClass('visible');
      if(/json/.test(response)) {
        response = $.parseJSON(response);
        if(response.type == 'message') {
          $('form').trigger('reset');
          $('.b-alert').addClass('visible');
          setTimeout(function() {
            $('.b-alert').removeClass('visible');
          }, 2000);
        }
        else if (response.redirect) {
          history.pushState(null, null, response.redirect);
          ajaxPage();
        }
      } else {
        $('.b-content').html(response);
        $(document).scrollTop(0);
        init();
      }
  }});
}


function removeItem (id) {
  $('[data-id="'+id+'"]').remove();
}