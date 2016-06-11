jQuery(function($){
  $( document ).ready(function(){
    $('#btn-start').click(function(){
      var action = $('#action-choice').val();

      var identifier = [];
      $.each($("input[name='identifier[]']:checked"), function() {
        identifier.push($(this).val());
      });

      var validated = validateActions(action, identifier);
      console.log(validated);

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
