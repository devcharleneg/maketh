$(document).ready(function(){


    $('#ageError').hide();
    $('#usernameError').hide();
    $('#emailError').hide();
    $('#passwordMatchError').hide();
    $('#captchaError').hide();

    $('.cart').hide();
    usernameValid = false;
    emailValid = false;
    captchaMatch = false;
    passwordMatch = false;
    var no1 = Math.floor((Math.random() * 100) + 1);
    var no2 = Math.floor((Math.random() * 100) + 1)
    $('#no1').text(no1);
    $('#no2').text(no2);
    var correct_answer = no1 + no2; 



    
    $('#password').change(function(){
        if($(this).val() != '' && $('#confirm_password').val() != '')
        {
                if($('#password').val() != $('#confirm_password').val())
                {
                    $('#passwordMatchError').show();
                }
                else
                {
                    $('#passwordMatchError').hide();
                }
        }
    });




    $('#confirm_password').change(function(){
         if($(this).val() != '' && $('#confirm_password').val() != '')
         {
            if($('#password').val() != $('#confirm_password').val())
            {
                $('#passwordMatchError').show();
                passwordMatch = false;
            }
            else
            {
                $('#passwordMatchError').hide();
                passwordMatch = true;
            }
         }
    });


    $('#answer').change(function(){
        if($(this).val() != correct_answer)
        {
            $('#captchaError').show();
            captchaMatch = false;
        }
        else
        {
            $('#captchaError').hide();
            captchaMatch = true;
        }
    });





    $('#registerForm').submit(function(e){
                $.get('api/checkUsername.php',{username: $('#username').val()},function(usernameExists){
                    if(usernameExists > 0)
                    {
                        $('#usernameError').show();
                        $('#usernameMsg').text($('#username').val() + ' already exists. Please try another username');
                        usernameValid = false;
                    }
                    else
                    {
                        $('#usernameError').hide();
                        usernameValid = true;
                    }
                });

                $.get('api/checkEmail.php',{email: $('#email').val()},function(emailExists){
                    if(emailExists > 0)
                    {
                        $('#emailError').show();
                        $('#emailMsg').text($('#email').val() + ' not available.');
                        emailValid = false;
                    }
                    else
                    {
                        $('#emailError').hide();
                        emailValid = true;
                    }
                });


                age = calculateAge($('#month').val(),$('#day').val(),$('#year').val());
                bday = $('#year').val() + '-' + $('#month').val() + '-' +  $('#day').val();
                if(age < 15)
                {
                    $('#ageError').show();
                }
                else
                {
                    $('#ageError').hide();
                }






                e.preventDefault();
                var customerData = $('#registerForm').serializeArray();
                customerData.push({name: 'bday', value: bday});


                
                console.log('age ' + age);
                console.log('usernamevalid ' + usernameValid);
                console.log('emailValid ' + emailValid);
                console.log('captchaMatch ' + captchaMatch);
                if(age >= 15 && usernameValid == true && emailValid == true && captchaMatch == true && passwordMatch == true)
                {
                    $('#ageError').hide();
                    $.post('api/register.php',customerData,function(data,status){
                        if(data == 'inserted')
                        {
                            alert('Successfully registered account. You can now login.');
                            window.location = 'login.php';
                        }
                    });
                }

        
    });














    function calculateAge(birthMonth, birthDay, birthYear)
    {
           var currentDate = new Date();
           var currentYear = currentDate.getFullYear();
           var currentMonth = currentDate.getMonth();
           var currentDay = currentDate.getDate();  
           age = currentYear - birthYear;

           if (currentMonth < birthMonth - 1) {
              age--;
           }
           if (birthMonth - 1 == currentMonth && currentDay < birthDay) {
              age--;
           }
           return age;
    }
    
 	$('[id^=detail-]').hide();
    $('.toggle').click(function() {
        $input = $( this );
        $target = $('#'+$input.attr('data-toggle'));
        $target.slideToggle();
    
    });


    $('[data-slide-number]').click(function() {
        var id = parseInt($(this).attr("data-slide-number"));
        $('#casualCarousel').carousel(id);
    });
   // for(i = 1; i <=6; i++)
   //      {
   //      	$('#dropdown-detail-' + i).click(function(){

   //      			if($('#arrow-' + i).hasClass('fa-chevron-down'))
			//         {	
			//         	$('#arrow-' + i).removeClass('fa-chevron-down');
			//         	$('#arrow-' + i).addClass('fa-chevron-up');
			//         }
			//         else if($('#arrow-' + i).hasClass('fa-chevron-up'))
			//         {
			//         	$('#arrow-' + i).removeClass('fa-chevron-up');
			//         	$('#arrow-' + i).addClass('fa-chevron-down');
			//         }
   //      	});
   //      }


});