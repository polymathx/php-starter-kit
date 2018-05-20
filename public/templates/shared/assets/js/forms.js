var POLYMATH_FORM = function() {

  var submitForm = function(el, callback) {
    var data = el.serializeArray();
    el.find(".notification").removeClass("active");
    $.ajax({
      method: "POST",
      url: "/api/form",
      data: data
    }).done(function(msg) {
      callback(msg);
    });
  };

  return {
    submit: submitForm,
  };

}();

$(document).ready(function() {
  // Submit Contact Form
  $('.contact-form').on('submit', function(e) {
    //Form Submission through polymath forms
    var serialized_data = $(this).serializeArray();
    console.log(serialized_data);
    $(this).find(".spinner").addClass("active");
    POLYMATH_FORM.submit($(this), function(data) {
      $(e.target).find(".spinner").removeClass("active");
      if ('error' in data) {
        //Fail
        $(e.target).find(".notification.danger").addClass("active").html(data['error']);
      } else {
        //Success
        $(e.target).trigger("reset");
        $(e.target).find(".notification.success").addClass("active").html(data["success"]);
        // TODO - Event tracking?
        //track_events(data);
      }
    });
    return false;
  });

  $('.contact-form a.submit').on('click', function(e) {
    $(this).parents('.contact-form').submit();
  });

});
