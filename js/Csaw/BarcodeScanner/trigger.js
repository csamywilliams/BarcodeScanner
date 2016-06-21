jQuery(function($){
  $( document ).ready(function(){
    $('#btn-start').click(function(){

      clearTable();

      var action = $('#action-choice').val();


      var identifier = $("input[name='identifier']:checked").val();

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

  /**
  * Ask user if they want to clear the table, if it already exists
  * If user confirms, clear and hide the table
  */
  function clearTable()
  {
    var rowCount = $('#results tr').length;
    var clear = true;

    if(rowCount >= 2) {
      var action = confirm("Are you sure you want to clear the table?");
      if(action == true) {
          clear = true;
      } else {
          clear = false;
      }
    } else {
      clear = false;
    }

    if(clear) {
      $("#results").find("tr:gt(0)").remove();
      $('#results-table').hide();
      $('#scan-barcode').hide();
      $('input#scanbox').val('');
    }
  }

  // function refreshTable()
  // {
  //   $("#results").empty();
  //   $('#results-table').hide();
  //   $('#scan-barcode').hide();
  //   $('#scanbarcode').val('');
  // }
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
