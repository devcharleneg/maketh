$(document).ready(function(){
      
      $('a[href="' + this.location + '"]').parent().addClass('active');
      var daten = new Date().toJSON().slice(0,10);
      $('input.datepicker').Zebra_DatePicker({
        direction: daten

      });

      var menTopSubCategories = ['T-Shirts','Polo','Longsleeves'];
      var menBottomSubCategories = ['Short','Pants'];
      var menBagsSubCategories = ['Backpack','Sling Bag','Shoulder Bag','Wallet'];
      var womenBagsSubCategories = ['Backpack','Sling Bag','Shoulder Bag','Wallet'];
      $('#category').change(function(){
          
          sub_category = "";
          if($(this).val() == 'Top')
          {
              
              for(var i = 0; i < 3; i++)
              {
                  sub_category += "<option value=" + menTopSubCategories[i] +">" + menTopSubCategories[i] + "</option>";
              }
              
          }

          else if($(this).val() == 'Bottom')
          {
          
              for(var i = 0; i < 2; i++)
              {
                  sub_category += "<option value=" + menBottomSubCategories[i] +">" + menBottomSubCategories[i] + "</option>";
              }
         
          }

          else if($(this).val() == 'Bag')
          {
              if($('#sex').val() == 'Men')
              {
                    for(var i = 0; i < 2; i++)
                    {
                        sub_category += "<option value=" + menBagsSubCategories[i] +">" + menBagsSubCategories[i] + "</option>";
                    }
              }

              else if($('#sex').val() == 'Women')
              {
                  for(var i = 0; i < 4; i++)
                    {
                        sub_category += "<option value=" + womenBagsSubCategories[i] +">" + womenBagsSubCategories[i] + "</option>";
                    }
              }
              
         
          }

          $('#sub-category').html(
                  sub_category
          );
      });



          $("#addProductBtn").click(function(){
              $("#addProductFormModal").modal();
          });

 
          if(meronUpdate)
          {
              $('#updateProductForm').attr('action','list.php?update=' + update_id + '&old_price=' + old_price)
              $('#updateProductFormModal').modal();
          }



          if(meronDelete)
          {
            $('#item').text(meronDelete); 
            // $('#confirm_delete').attr('href','list.php?delete=' + delete_id);
            $('#deleteForm').attr('action','list.php?delete=' + delete_id)
            $('#deleteProductModal').modal();
          }


          if(meronImgDelete)
          {
            // $('#deleteImageForm').attr('action','index.php?delete=' + delete_image_id)
            $('#deleteImageModal').modal();
          }

          



});