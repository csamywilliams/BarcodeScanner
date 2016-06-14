jQuery(function($){
  $( document ).ready(function(){

      $('#scanbox').keypress(function (e) {
        var key = e.which;
        if(e.which == 13) {

          var input = $('#scanbox').val();
          if(input != null || input != '')
          {
            sendRequest(input);
          }
        }
      });


//jQuery & document end braces
  });

  function sendRequest(code)
  {

    //get the identifier and action, may need to change as duplicating in trigger.js
    var action = $('#action-choice').val();
    var identifier = [];
    $.each($("input[name='identifier[]']:checked"), function() {
      identifier.push($(this).val());
    });

    $("#loading-mask").show();
    $.ajax({
        url: '/barcodescanner/index/search',
        type: "POST",
        data: {form_key: window.FORM_KEY, input: code, action: action, identifier: identifier},
        success: function(data) {
          if (data === undefined)
          {
            console.log("data is undefined");
          } else {
            console.log(data);
          }

          $("#loading-mask").hide();
        }
    });
  }


});
