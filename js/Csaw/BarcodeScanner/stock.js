jQuery(function($){
  $( document ).ready(function(){

      $('#scanbox').keypress(function (e) {
        var key = e.which;
        if(e.which == 13) {

          var input = $('#scanbox').val();
          if(input != null || input != '')
          {
              var rowId = replaceString(input);
              if ($(rowId).length == 0){
                //if row does not exist, send the request
                sendRequest(input);
              } else {
                //if row does exist add one to
                increaseQuantity(rowId);
              }
          }
        }
      });

      //remove product from table if delete button is pressed
      $('#results').on('click', '#deleteItem', function(){
        $(this).closest ('tr').remove ();
      });

  //jQuery & document end braces
  });

  function replaceString(code)
  {
    return '#'+code.replace(/\s/g, '');
  }

  /**
  * If product doesn't already exist, send an ajax request to find the product
  */
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
        dataType:"json",
        data: {form_key: window.FORM_KEY, input: code, action: action, identifier: identifier},
        success: function(data) {
            console.log(data);
            $("#loading-mask").hide();

            drawTable(data, code);

            $("#results-table").show();
        },
        error: function (req, status, err) {
          console.log('Something went wrong', status, err);
        }
    });

  }

  /**
  * Check if product exists in table before sending an unnecessary ajax request
  */
  function doesProductExist(code)
  {

    var identifier = code;
    var rowId = '#'+identifier.replace(/\s/g, '');
    if($('#results tr '+rowId).length == 0){
      //what you should do when the row doesn't exist
      sendRequest(code);

    }
    else{
       //Horray you have the row you specified.
        alert("row exists");
    }
  }

  function drawTable(data, code)
  {
    var id = data['id'];
    var sku = data['sku'];
    var qty = data['qty'];
    var stock_required = data['stock_required'];
    var product_name = data['name'];

    //remove whitespace from code
    var rowId = code.replace(/\s/g, '');

    var row = "<tr id='"+rowId+"'><td>"+sku+"</td><td>"+product_name+"</td><td>"+qty+"</td><td>"+stock_required+"</td><td><input id='item' value='"+'1'+"'></input></td><td><button id='deleteItem'>X</></td></tr>";


    $('#results tr:last').after(row);
  }

  function deleteRow(id)
  {
    $("#results #".id).remove();
  }

  function increaseQuantity(rowId)
  {
    var tableRow = $(rowId).find('td').eq(4).find("input:text");

    var quantity = parseInt($(tableRow).val()) + 1;

    $(tableRow).val(quantity);

    console.log($(tableRow).val());
  }


});
