
jQuery(document).ready(function () {
    "use strict";


    /*========sticker end========*/
    $.scrollUp({
        animation: 'slide', // Fade, slide, none
    });
    /*======scroll up======*/
    

    // dropdown
        function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

     $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
            $(this).prev(".card-header").find(".fa").addClass("fa-caret-down").removeClass("fa-caret-up");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
            $(this).prev(".card-header").find(".fa").removeClass("fa-caret-up").addClass("fa-caret-down");
        }).on('hide.bs.collapse', function(){
            $(this).prev(".card-header").find(".fa").removeClass("fa-caret-down").addClass("fa-caret-up");
        });
    });

     // slide top
   

  // When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("myHeader");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}


// mobile menu
    var menu = new MmenuLight(
        document.querySelector( '#menu' ),
        'all'
      );
      var navigator = menu.navigation({
        // selectedClass: 'Selected',
        // slidingSubmenus: true,
        // theme: 'dark',
        title: 'Ecommerce'
      });
      var drawer = menu.offcanvas({
        // position: 'left'
      });
      //  Open the menu.
      document.querySelector( 'a[href="#menu"]' )
        .addEventListener( 'click', evnt => {
          evnt.preventDefault();
          drawer.open();
      });
      // mobile menu end
  
      
});

    $('.open-login').click(function(event) {
      $('.filtersidebar').addClass('active');
      $('.overlay').addClass('active');
    });

    $('.remove_filter').click(function(event) {
      $('.filtersidebar').removeClass('active');
      $('.overlay').removeClass('active');
    });

 

$(document).ready(function(){
          $('.codform').hide();
          $('.bkashform').hide();
          $('.nagadform').hide();
          $('.roketform').hide();

        $('.paymentoption').on('click', function() {
          var id = $(this).val();
          var area = $('.area').val();
          // alert(area);
            if(id,area){
                $.ajax({
                   type:"GET",
                   url:"http://www.sparklefashionbd.com/payment-charge/"+id+"/"+area,
                   dataType: "html",
                    success: function(response){
                        $('.paymentCharge').html(response);
                    }
                });
            }
            if(id=="cash"){
              $('.codform').show();
              $('.bkashform').hide();
              $('.nagadform').hide();
              $('.roketform').hide();
            }
            else if(id=='bkash'){
              $('.codform').hide();
              $('.roketform').hide();
              $('.nagadform').hide();
              $('.bkashform').show();
            }
            else if(id=='roket'){
              $('.codform').hide();
              $('.bkashform').hide();
              $('.nagadform').hide();
              $('.roketform').show();
            }
            else if(id=='nagad'){
              $('.codform').hide();
              $('.bkashform').hide();
              $('.roketform').hide();
              $('.nagadform').show();
            }
            else if(id==''){
              $('.codform').show();
              $('.bkashform').hide();
              $('.nagadform').hide();
              $('.roketform').hide();
            }
        });
        $('.cbutton').on('click', function() {
           $(this).addClass('active');
           $('.bbutton').removeClass('active');
           $('.rbutton').removeClass('active');
           $('.nbutton').removeClass('active');
           
        });
        $('.bbutton').on('click', function() {
           $(this).addClass('active');
           $('.cbutton').removeClass('active');
           $('.rbutton').removeClass('active');
           $('.nbutton').removeClass('active');
        });
        $('.rbutton').on('click', function() {
           $(this).addClass('active');
           $('.cbutton').removeClass('active');
           $('.bbutton').removeClass('active');
           $('.nbutton').removeClass('active');
        });
        $('.nbutton').on('click', function() {
           $(this).addClass('active');
           $('.cbutton').removeClass('active');
           $('.bbutton').removeClass('active');
           $('.rbutton').removeClass('active');
        });
         
    });

function myFunction() {
     document.getElementById("myDropdown").classList.toggle("acshow");
    }
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('acshow')) {
            openDropdown.classList.remove('acshow');
          }
        }
      }
    }

