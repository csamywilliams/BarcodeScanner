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

      $('#results').on('click', '#deleteItem', function(){
        $(this).closest ('tr').remove ();
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
        dataType:"json",
        data: {form_key: window.FORM_KEY, input: code, action: action, identifier: identifier},
        success: function(data) {
            console.log(data);
            $("#loading-mask").hide();

            drawTable(data);

            $("#results-table").show();
        },
        error: function (req, status, err) {
          console.log('Something went wrong', status, err);
        }
    });
  }

  function drawTable(data)
  {
    var id = data['id'];
    var sku = data['sku'];
    var qty = data['qty'];
    var stock_required = data['stock_required'];
    var product_name = data['name'];


    var row = "<tr id='"+id+"'><td>"+sku+"</td><td>"+product_name+"</td><td>"+qty+"</td><td>"+stock_required+"</td><td><input id='item' value='"+'1'+"'></input></td><td><button id='deleteItem'>X</></td></tr>";


    $('#results tr:last').after(row);
  }

  function deleteRow(id)
  {
    $("#results #".id).remove();
  }


});
