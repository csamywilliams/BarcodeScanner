jQuery(function($){
  $( document ).ready(function(){

      $('#scanbox').keypress(function (e) {
        var key = e.which;
        if(e.which == 13) {
          console.log($('#scanbox').val());
        }
      });


//jQuery & document end braces
  });
});
