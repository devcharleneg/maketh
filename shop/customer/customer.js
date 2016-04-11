$(document).ready(function(){
	$('[id^=detail-]').hide();
  $('#creditCardForm').hide();
    $('.toggle').click(function() {
        $input = $( this );
        $target = $('#'+$input.attr('data-toggle'));
        $target.slideToggle();
    
    });


    $('[data-slide-number]').click(function() {
        var id = parseInt($(this).attr("data-slide-number"));
        $('#casualCarousel').carousel(id);
    });


    $('#signUpOrder').hide();


      if(meronUpdate)
      {
  
      }



      if(meronDelete && qty_in_cart)
      {
        $('#item').text(meronDelete); 
        // $('#confirm_delete').attr('href','list.php?delete=' + delete_id);
        $('#deleteForm').attr('action','cart.php?delete=' + delete_id + '&qty_in_cart=' + qty_in_cart);
        $('#deleteProductModal').modal();
      }


      $('#mode_of_payment').change(function(){
          if($('#mode_of_payment').val() == 'Credit Card')
          {
              $('#creditCardForm').show();
              $('#first_digit').attr('required',true);
              $('#second_digit').attr('required',true);
              $('#third_digit').attr('required',true);
              $('#fourth_digit').attr('required',true);
              $('#pin_no').attr('required',true);

          }
          else
          {
              $('#creditCardForm').hide();
              $('#first_digit').attr('required',false);
              $('#second_digit').attr('required',false);
              $('#third_digit').attr('required',false);
              $('#fourth_digit').attr('required',false);
              $('#pin_no').attr('required',false);
          }
      });


})