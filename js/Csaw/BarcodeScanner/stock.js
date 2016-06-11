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

  function sendRequest(identifier)
  {

    var urlLink = "<?php echo Mage::helper('adminhtml')->getUrl(''*/*/save') ?>";

    $.ajax({
        url: '/barcodescanner/index/save',
        type: "POST",
        data: {form_key: window.FORM_KEY},
        success: function(data) {
          console.log(data);
        }
    });
  }


});
