$( document ).ready(function() {
  $(".needs-validation").submit(function(ev){
    ev.preventDefault();
    var $form = $(this);
    var form = $form[0];
    var data = new FormData(form);
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: $form.attr("action"),
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function(data,statusTest,xhr){
        if(xhr.status == 206) {
          document.location.href = data.url;
        } else {
          $('body').html(data);
        }
      },
      error: function(xhr){
        var $self = $(this);
        if(xhr.status === 400){
          $(".error-message").html('');
          var data = JSON.parse(xhr.responseText);
          _.each(data, function(value, key, obj) {
            $("#" + key).closest(".form-group").find(".error-message").html(value);
          });
        }
      },
    });
  });
  $(".needs-validation-password").submit(function(ev){
    ev.preventDefault();
    if(!passwordValido()) {
      return;
    }
    var $form = $(this);
    var form = $form[0];
    var data = new FormData(form);
    $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: $form.attr("action"),
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function(data,statusTest,xhr){
        if(xhr.status == 206) {
          document.location.href = data.url;
        } else {
          $('body').html(data);
        }
      },
      error: function(xhr){
        var $self = $(this);
        if(xhr.status === 400){
          var data = JSON.parse(xhr.responseText);
          _.each(data, function(value, key, obj) {
            $("#" + key).closest(".form-group").find(".error-message").html(value);
          });
        }
      },
    });
  });
  _.each($(".load-image"), function(item) {
    var $item = $(item);
    $.ajax({
      url: $item.attr("src"),
      type:'GET',
      data: {},
      success: function(data,statusTest,xhr){
        var $image = $(data);
        var _with = $item.attr("width");
        var _height = $item.attr("height")
        if(_.isString(_with)) {
          $image.attr('width', _with);
        }
        if(_.isString(_height)) {
          $image.attr('height', _height);
        }
        $item.replaceWith($image);
      }
    });
  });
});

function passwordValido() {
  var $el = $("input[name=confirm-password]");
  var confirm = $el.val();
  var password = $("input[id=password]").val();
  if(confirm.length == 0 || confirm !== password) {
    if(password.length > 0) {
      $el.closest(".form-group").find(".error-message").html("Sus contraseñas no coinciden");
      return false;
    } else {
      return true;
    }
  } else {
    $el.closest(".form-group").find(".error-message").html("");
    return true;
  }
}