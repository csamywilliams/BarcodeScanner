jQuery(function($){
  $( document ).ready(function(){
    $('#btn-start').click(function(){
      var action = $('#action-choice').val();

      var identifier = [];
      $.each($("input[name='identifier[]']:checked"), function() {
        identifier.push($(this).val());
      });

      var validated = validateActions(action, identifier);

      if(validated)
      {
        //show input box for barcode, sku to be entered or scanned
        $('#scan-barcode').show();
      } else {
        //if scan barcode div is showing, we must remove it
        if($('#scan-barcode').is(":visible"))
        {
          $('#scan-barcode').hide();
        }

        // show a dialog to user to ensure action or identifier is selected
        alert("Please ensure an action and at least one identifier has been picked.");
      }
    });
  });
});

/**
* function validateActions, the action for stock movement cannot be blank nor
* can the identifiers it must be able to match on ID, SKU or barcode
* @param action must have an incoming or outgoing action
* @param identifiers must be able to match on ID, SKU or barcode chosen by user
* @return if validation is successful or not
*/
function validateActions(action,identifiers)
{
  var validated = false;
  if(action != "blank" && identifiers.length != 0)
  {
    validated = true;
  }
  return validated;
}
