
$(document).ready(function(){
    cat();
    brand();
    product();
    
function cat(){
    $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {category:1},
       success: function(data){  
           $("#get_category").html(data);
        }
            });
            
    }
    function brand(){
    $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {brand:1},
       success: function(data){  
           $("#get_brand").html(data);
        }
            });
            
    }
    function product(){
    $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {getproduct:1},
       success: function(data){  
           $("#get_product").html(data);
        }
            });
              }
              $("body").delegate(".category", "click", function(event){
                  event.preventDefault();
                  var cid=$(this).attr("cid"); //attribute cid(cat_id of category table) contains primary key id of category table  field cat_id attr stand attribute and this "cid" copy from index file php
                 $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {get_selected_category:1, cat_id: cid},
       success: function(data){  
           $("#get_product").html(data);
        }
            });
              })
              $("body").delegate(".selectBrand", "click", function(event){
                  event.preventDefault();
                  var bid=$(this).attr("bid"); //attr stand attribute and this "cid" copy from index file php
                 $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {selectBrand:1, brand_id: bid},
       
       success: function(data){  
           $("#get_product").html(data);
        }
       
            });
              })
              
      $("#search_btn").click(function()   {
          var keyword= $("#search").val();
        if(keyword!="")  {
          $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {search:1, keyword: keyword},
       
       success: function(data){  
           $("#get_product").html(data);
        }
       
            });  
        }
      })
      $("#signup").click(function(event) //#signup is the id of button notice id and name of button must be different
      {
         // alert(0);
         event.preventDefault();
          $.ajax({
            
       url: 'register.php',
       method:'POST',
       data: $('form').serialize(),
       
       success: function(data){  
        //alert(data);// means register.php pe jo recive hua hai vo alert hoga
        $("#signup_msg").html(data); //#signup_msg is the location to view field field data
        }
       
            });  
      })
          $("#login").click(function(event) 
      {
         // alert(0);
         event.preventDefault();
         var email= $("#email").val(); //get value of email of loinin form in index.php
         var pass= $("#pass").val();
          $.ajax({  
       url: 'login.php',
       method:'POST',
       data: {userLogin: 1, userEmail: email, userPassword: pass}, // userEmail use for to recive the value of email field and userLogin is a like a field value of name attribute it use in isset funtion of action.php page
       
       success: function(data){  
       // alert(data);// means action.php pe jo recive hua hai vo alert hoga
        if(data){
          window.location.href="profile.php";
         
        }
        }
       
            });  
      })
      cart_count();
      $("body").delegate("#product", "click", function(event){
          event.preventDefault();
          var p_id= $(this).attr('pid'); // pid represent product_id of button tag of add to cart and it contaon intiger id from database
          //alert(p_id);
            $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {addToproduct:1, proId: p_id},
       
       success: function(data){  
      // alert(data);
      $("#product_msg").html(data);
      cart_count();
        }
       
            });  
      })
      cart_container();
      function cart_container(){
          $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {get_cart_product:1},
       
       success: function(data){  
      // alert(data);
      $("#cart_product").html(data); //cart_product is id of panel body of profile page
        }
       
            });   
          // cart_count();
      }
     function cart_count(){
       $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {cart_count:1},
       
       success: function(data){  
      // alert(data);
      $("#c_item").html(data);
        }
       
            });    
     }
      cart_checkout(); // function calling
      function cart_checkout(){
          $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {cart_checkout:1},
       
       success: function(data){  
      // alert(data);
      $("#cart_checkout").html(data); //cart_product is id of panel body of profile page
        }
       
            });  
      }
      $("body").delegate(".remove", "click", function(event){
          event.preventDefault();
          var pid= $(this).attr("remove_id");
          $.ajax({
            
       url: 'action.php',
       method:'POST',
       data: {removeFromCart:1, removeId: pid},
       
       success: function(data){  
      // alert(data);
      $("#cart_msg").html(data);
      cart_checkout();// call because no need to refresh after delete
       }
       
            });  
          
      })
      $("body").delegate(".delete", "click", function(event){
          event.preventDefault();
          var pid= $(this).attr("delete_id"); // delete_id is the attribute(i.e use define) of anchor glybhicon of action.php page
          alert(pid);
      })
});


