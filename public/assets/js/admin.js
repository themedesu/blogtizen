/*! For license information please see admin.js.LICENSE.txt */
(function($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function(e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function() {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
    
    // Toggle the side navigation when window is resized below 480px
    if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
      $("body").addClass("sidebar-toggled");
      $(".sidebar").addClass("toggled");
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function() {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function(e) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    e.preventDefault();
  });
    
  // Current Year
  document.getElementById("year").innerHTML = new Date().getFullYear()+' ';

  // Menu
  // load loading
  $(document).ajaxStart(function () {
    $("#ajax_loader").show();
  }).ajaxStop(function () {
    $("#ajax_loader").hide('slow');
  });

  // change label
  $(document).on('keyup', '.edit-menu-item-title', function () {
      var title = $(this).val();
      var index = $('.edit-menu-item-title').index($(this));
      $('.menu-item-title').eq(index).html(title);
  });

  // change url
  $(document).on('keyup', '.edit-menu-item-url', function () {
      var url = $(this).val();
      var index = $('.edit-menu-item-url').index($(this));
      // limit string
      var result = url.slice(0, 30) + (url.length > 30 ? "..." : "");
      $('.menu-item-link').eq(index).html(result);
  });

  jQuery(function() { 
      if ($('#nestable').length) {
          $('#nestable').nestable({
              expandBtnHTML: '',
              collapseBtnHTML: '',
              maxDepth: 3,
              callback: function (l, e) {
                  updateItem();
                  actualizar(l.nestable('toArray'));
              }
          });
      }
  });

})(jQuery); // End of use strict

// Item menu
function createItem(e) {
    let data = [];
    let form = $(e).parents('form');

    if (!form.find('input[name="label"]').val() || !form.find('input[name="url"]').val()) {
        menuResponse("Please enter label or url", 'error');
        return;
    }
    data.push({
        label: form.find('input[name="label"]').val(),
        url: form.find('input[name="url"]').val(),
        icon: form.find('input[name="icon"]').val(),
        id: $('#idmenu').val()
    });

    $.ajax({
        data: {
            data: data
        },
        url: URL_MENU_CREATE,
        type: 'POST',
        success: function(response) {
            menuResponse(response.text, response.type);
            setTimeout(function() {
                window.location.reload();
            }, 2000);
        },
        complete: function() { },
        error: function(request, status, error) {
            menuResponse(request.responseText, 'error');
        }
    });
}

function updateItem(id = 0) {
    if (id) {
        var label = $('#label-menu-' + id).val();
        var clases = $('#clases-menu-' + id).val();
        var url = $('#url-menu-' + id).val();
        var icon = $('#icon-menu-' + id).val();
        var target = $('#target-menu-' + id).val();
        if (!label || !url) {
            menuResponse("Please enter label or url", 'error');
            return;
        }
        var data = {
            label: label,
            clases: clases,
            url: url,
            icon: icon,
            target: target,
            id: id
        };
    } else {
        var menuArray = [];
        let flag = false;
        $('.menu-item-settings').each(function (k, v) {
            var id = $(this)
                .find('.edit-menu-item-id')
                .val();
            var label = $(this)
                .find('.edit-menu-item-title')
                .val();
            var clases = $(this)
                .find('.edit-menu-item-classes')
                .val();
            var url = $(this)
                .find('.edit-menu-item-url')
                .val();
            var icon = $(this)
                .find('.edit-menu-item-icon')
                .val();
            var target = $(this)
                .find('select.edit-menu-item-target option:selected')
                .val();
            if (!label || !url) {
                flag = true;
            }
            menuArray.push({
                id: id,
                label: label,
                class: clases,
                link: url,
                icon: icon,
                target: target,
            });
        });
        if (flag) {
            menuResponse("Please enter label or url", 'error');
            return;
        }
        var data = {
            dataItem: menuArray
        };
    }
    $.ajax({
        data: data,
        url: URL_MENU_UPDATE,
        type: 'POST',
        beforeSend: function (xhr) {
            if (id) { }
        },
        success: function(response) { 
            menuResponse(response.text, response.type);
        },
        complete: function () {
            if (id) { }
        },
        error: function(request, status, error) {
            menuResponse(request.responseText, 'error');
        }
    });
}

function actualizar(serialize) {
    $.ajax({
        dataType: 'json',
        data: {
            data: serialize
        },
        url: URL_MENU_ACTUALIZAR,
        type: 'POST',
        success: function (response) {
            menuResponse(response.text, response.type);
        },
        error: function(request, status, error) {
            menuResponse(request.responseText, 'error');
        }
    });


}

function deleteItem(id) {
    if (confirm("Are you sure?")) {
        $.ajax({
            dataType: 'json',
            data: {
                id: id
            },
            url: URL_MENU_DELETE,
            type: 'POST',
            success: function(response) {
                menuResponse(response.text, response.type);
                setTimeout(function() {
                    window.location.reload();
                }, 2000);
            },
            error: function(request, status, error) {
                menuResponse(request.responseText, 'error');
            }
        });
    }
}

function menuResponse(messageText, messageType) {
    new Noty({
        text: messageText,
        type: messageType,
        theme: "sunset",
        timeout: 2500,
    }).show();
}