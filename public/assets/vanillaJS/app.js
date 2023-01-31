$(document).ready(function(){
    // Upload Image Preview
        $('.image').change(function(){
            // console.log('Changed');  
            let file = $("input[type=file].image").get(0).files[0]; 
            if(file){
                let reader = new FileReader(); 
                reader.onload = function(){
                    $(".image-preview").attr("src", reader.result);
                } 
                reader.readAsDataURL(file);
            }
        });   
        // post selection problem 
        $('div.dropdown-menu.open').css('margin-left', '0px'); 

 
 
});


$('#pwdVal').validate({
    rules: {
        old_password: {
          required: true
        },
        password: {
          required: true
        },
        password_confirmation: {
          required: true, 
          equalTo: '#password'
        }
    },
    message: {

    }

});  