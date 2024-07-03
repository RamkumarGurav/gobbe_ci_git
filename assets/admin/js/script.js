$(".ico-help").hover(function () {
  $(this).find(".ques-popup").toggleClass("qp-b");
});


$(".nav-item-drop .nid-li").click(function () {
  $(this).siblings(".nid-con").toggleClass("nid-con-b");
});

$(".nid-li").on('click', function () {
  $(this).find(".menu").toggleClass('menu-active');
});
$(document).ready(function(){
  // Custom event handler for links inside tab panes
  $('.tab-redirect').on('click', function (e) {
      e.preventDefault(); // Prevent default anchor behavior

      // Get the target tab pane ID from the href attribute of the clicked link
      var targetTabPaneId = $(this).attr('href');

      // Activate the tab pane
      $('.nav a[href="' + targetTabPaneId + '"]').tab('show');
  });
});
$(document).ready(function () {
  $(".dsm-user-box").click(function () {
    $(".dsm-ub-con").toggleClass("dsm-ub-con-b");
  });

  $(document).on('click', function (event) {
    var $target = $(event.target);
    if (!$target.closest('.dsm-user-box').length && !$target.closest('.dsm-ub-con').length) {
      $('.dsm-ub-con').removeClass('dsm-ub-con-b');
    }
  });
});

$(document).ready(function () {
  $(".dsm-notification").click(function () {
    $(".dhm-hn-con").toggleClass("dhm-hn-con-b");
  });

  $(document).on('click', function (event) {
    var $target = $(event.target);
    if (!$target.closest('.dsm-notification').length && !$target.closest('.dhm-hn-con').length) {
      $('.dhm-hn-con').removeClass('dhm-hn-con-b');
    }
  });
});

// $(function () {
//   $("span.toggle-btn").on("click", function () {
//       $(".dsm-navigation").toggleClass("dsm-navigation-hide");
//   });
//   $(document).on("click", function (e) {
//       if ($(e.target).is(".dsm-navigation") === false) {
//           $(".dsm-navigation").removeClass("dsm-navigation-hide");
//       }
//   });
// });
$(document).ready(function () {
  $("span.toggle-btn").click(function () {
    $(".dsm-navigation").toggleClass("dsm-navigation-hide");
  });

  $(document).on('click', function (event) {
    var $target = $(event.target);
    if (!$target.closest('span.toggle-btn').length && !$target.closest('.dsm-navigation').length) {
      $('.dsm-navigation').removeClass('dsm-navigation-hide');
    }
  });
});
// $(".dsm-content-100").click(function () {
//   $(".dsm-content").removeClass("dsm-content-100");
// });

// $("span.toggle-btn").click(function () {
//   $(".dsm-navigation").toggleClass("dsm-navigation-hide");
// });

$("span.toggle-btn").click(function () {
  $(".dsm-content").toggleClass("dsm-content-100");
});



$(document).ready(function () {
   $(".export-btn").click(function () {
    $(".exp-dd").toggleClass("exp-dd-b");
  });

  $(document).on('click', function (event) {
    var $target = $(event.target);
    if (!$target.closest('.export-btn').length && !$target.closest('.exp-dd').length) {
      $('.exp-dd').removeClass('exp-dd-b');
    }
  });
});

$(document).ready(function () {
  $(".import-btn").click(function () {
    $(".impt-con").toggleClass("impt-con-b");
  });

  $(document).on('click', function (event) {
    var $target = $(event.target);
    if (!$target.closest('.import-btn').length && !$target.closest('.impt-con').length) {
      $('.impt-con').removeClass('impt-con-b');
    }
  });
});

jQuery(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

  $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
      if (imgArray[i].name === file) {
        imgArray.splice(i, 1);
        break;
      }
    }
    $(this).parent().parent().remove();
  });
}
(function ($) {
  var CheckboxDropdown = function (el) {
    var _this = this;
    this.isOpen = false;
    this.areAllChecked = false;
    this.$el = $(el);
    this.$label = this.$el.find('.dropdown-label');
    this.$checkAll = this.$el.find('[data-toggle="check-all"]').first();
    this.$inputs = this.$el.find('[type="checkbox"]');

    this.onCheckBox();

    this.$label.on('click', function (e) {
      e.preventDefault();
      _this.toggleOpen();
    });

    this.$checkAll.on('click', function (e) {
      e.preventDefault();
      _this.onCheckAll();
    });

    this.$inputs.on('change', function (e) {
      _this.onCheckBox();
    });
  };

  CheckboxDropdown.prototype.onCheckBox = function () {
    this.updateStatus();
  };

  CheckboxDropdown.prototype.updateStatus = function () {
    var checked = this.$el.find(':checked');

    this.areAllChecked = false;
    this.$checkAll.html('Check All');

    if (checked.length <= 0) {
      this.$label.html('Select Category');
    }
    else if (checked.length === 1) {
      this.$label.html(checked.parent('label').text());
    }
    else if (checked.length === this.$inputs.length) {
      this.$label.html('All Selected');
      this.areAllChecked = true;
      this.$checkAll.html('Uncheck All');
    }
    else {
      this.$label.html(checked.length + ' Selected');
    }
  };

  CheckboxDropdown.prototype.onCheckAll = function (checkAll) {
    if (!this.areAllChecked || checkAll) {
      this.areAllChecked = true;
      this.$checkAll.html('Uncheck All');
      this.$inputs.prop('checked', true);
    }
    else {
      this.areAllChecked = false;
      this.$checkAll.html('Check All');
      this.$inputs.prop('checked', false);
    }

    this.updateStatus();
  };

  CheckboxDropdown.prototype.toggleOpen = function (forceOpen) {
    var _this = this;

    if (!this.isOpen || forceOpen) {
      this.isOpen = true;
      this.$el.addClass('on');
      $(document).on('click', function (e) {
        if (!$(e.target).closest('[data-control]').length) {
          _this.toggleOpen();
        }
      });
    }
    else {
      this.isOpen = false;
      this.$el.removeClass('on');
      $(document).off('click');
    }
  };

  var checkboxesDropdowns = document.querySelectorAll('[data-control="checkbox-dropdown"]');
  for (var i = 0, length = checkboxesDropdowns.length; i < length; i++) {
    new CheckboxDropdown(checkboxesDropdowns[i]);
  }
})(jQuery);

