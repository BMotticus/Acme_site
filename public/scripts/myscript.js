

    var validInfo = {
        "fname": {
            "pattern": "^[a-zA-Z ]+$",
            "invalid": " First name must be characters only"
        },
        "lname": {
            "pattern": "^[a-zA-Z ]+$",
            "invalid": " *Last name must be characters only"
        },
        "phone": {
            "pattern": "^(?:\\([0-9]{3}\\)||[0-9]{3})(|-)[0-9]{3}(|-)[0-9]{4}$",
            "invalid": " *Phone number with area code"
        },
        "address": {
            "pattern": "^(?:[a-zA-Z\\. ]{1,15}|[0-9 ]{1,15}){3,10}$",
            "invalid": " *Invalid street address"
        },
        "city": {
            "pattern": "^[a-zA-Z ]+$",
            "invalid": " *Invalid city, must be characters only"
        },
        "state": {
            "pattern": "^[A-Z]{2}$",
            "invalid": " *Please choose a state"
        },
        "zip": {
            "pattern": "^[0-9]{5}([\-]?[0-9]{4})?$",
            "invalid": " *Invalid zip, must be ##### or #####-####"
        },
        "myusername": {
            "pattern": "^.{5,}$",
            "invalid": " *Invalid, username must be atleast 8 Chars"
        },
        "mypassword": {
            "pattern": "^.{5,}$",
            "invalid": " *Invalid, password must be atleast 8 Chars"
        }
    };

    var myFields = $("#theForm :input:not([type=submit])");
    var myButtons = $("#theForm :input[type=submit]");
    var clkBtn = "";
    

    $(document).ready(function() {
        /**
         * CATALOG PAGE FUNCTIONS
         */

        $("#products").change(function() {
            $("#quantity").css("box-shadow", "1px 16px 34px 9px yellow");
            $("span").remove();
            var str = "<span>  Price:$";
            var img = "<img src='/pics/";
            var title = "<span> Description: ";
            $("select option:selected").each(function() {
                str += $(this).attr("id") + "</span>";
                img += $(this).val() + ".jpg' alt='Picture'>";
                title += $(this).attr("title");
            });
            $("#products").after(str);
            $("#discritpion").html(img).append(title);
        });//selecting Items


        $("#remove").on('click', function() {
            if ($("#cart tbody tr:last") === $("#cart tbody tr:first")) {
                //do nothing
            } else {
                var newprice = parseFloat($("#cart tbody tr:last td #sub").text());
                var oldprice = parseFloat($("#footTotal").text());
                var total = oldprice - newprice;
                $("#cart tbody tr:last").remove();
                $("#footTotal").html(total.toFixed(2));
            }
        });//remove last element row
        /**
         * CONTACT PAGE FUNCTIONS
         */
        $("#theForm").attr("action","#");
     myFields.each(function(){        
        $(this).on('blur', myFunction);//blur event
        $(this).on('change', myFunction);//change event
     });//each inputs

myButtons.each(function(){
    $(this).on('click', function(event){
        clkBtn = event.target.id;
        });//click event    
    });//each button

$("#theForm").submit(function(event){
    nosubmit = true;
         $("span.errors").remove();
        if(clkBtn === 'search'){
                 if($("#fname").val() === ""){
                     $("#fname").before( '<span class="errors"> Required </span>' )
                                .css("box-shadow", "3px 3px 3px red"); 
                     nosubmit = false;
                 }
                 if($("#lname").val() === ""){
                     $("#lname").before( '<span class="errors"> Required </span>' )
                                .css("box-shadow", "3px 3px 3px red");  
                     nosubmit = false;
                 }
            } else {
                if($("#fname").val() === ""){
                     $("#fname").before( '<span class="errors"> Required </span>' )
                                .css("box-shadow", "3px 3px 3px red");  
                     nosubmit = false;
                 }
                 if($("#lname").val() === ""){
                     $("#lname").before( '<span class="errors"> Required </span>' )
                                .css("box-shadow", "3px 3px 3px red");  
                     nosubmit = false;
                 }
                 if($("#phone").val() === ""){
                     $("#phone").before( '<span class="errors"> Required </span>' )
                                .css("box-shadow", "3px 3px 3px red");  
                     nosubmit = false;
                 }
                 if($("#address").val() === ""){
                     $("#address").before( '<span class="errors"> Required </span>' )
                                .css("box-shadow", "3px 3px 3px red");  
                     nosubmit = false;
                 }
                 if($("#city").val() === ""){
                     $("#city").before( '<span class="errors"> Required </span>' )
                               .css("box-shadow", "3px 3px 3px red"); 
                     nosubmit = false;
                 }
                 if($("#state").val() === ""){
                     $("#state").before( '<span class="errors"> Required </span>' )
                                .css("box-shadow", "3px 3px 3px red");  
                     nosubmit = false;
                 }
                 if($("#zip").val() === ""){
                     $("#zip").before( '<span class="errors"> Required </span>' )
                              .css("box-shadow", "3px 3px 3px red");  
                     nosubmit = false;
                 }
                 if($("#myusername").val() === ""){
                     $("#myusername").before( '<span class="errors"> Required </span>' )
                                    .css("box-shadow", "3px 3px 3px red"); 
                     nosubmit = false;
                 }
                 if($("#mypassword").val() === ""){
                     $("#mypassword").before( '<span class="errors"> Required </span>' )
                                    .css("box-shadow", "3px 3px 3px red");  
                     nosubmit = false;
                 }
                
             }
         
               
                if(nosubmit){
                    
                    $("#theForm").attr("action","results.php");
                    return true;
                } else {
                    
                    $("div.errorMessage").text("Please complete form to continue..").show().fadeOut(2000);
                    event.preventDefault();
                    return false;
                }
                    
        });//submit form event


});//doc.ready   

 function myFunction(){
                    var myId = $(this).attr('id');
                    $("span#"+myId+"error").remove();
                    
                    var pattern = validInfo[myId]["pattern"];
                    var errorPat = validInfo[myId]["invalid"]; 
                    var myField = $(this).val();
                    var isValid = myField.search(pattern) >= 0;
                 if(!isValid){
                 $("div.content1").width(720);
                 $(this).css("box-shadow", "3px 3px 3px red");
                 $(this).after( '<span class="errors" id="' + myId + 'error' + '">' + errorPat + '</span>');
                 $("label").css("padding-left", "0px");
                 return false;
             } else {
                 $("label").css("padding-left", "75px");
                 $(this).css("box-shadow", "3px 3px 3px green");
                 return true;
             }
             
}//myFunction
 


