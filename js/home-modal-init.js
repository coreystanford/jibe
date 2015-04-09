$(document).ready(function () {

    $('.home-project').each(function () {

    	var id = $(this).find('a').attr('rel');

        $(this).on('click', 'a', function (e) {

        	e.preventDefault();

        	modal.open(id);

        });

    });
    //open register mmodal once registerBtn clicked in anonymous header
//    console.log($('header'));
//    
//    $('#header #registerBtn').on('click', function (e) {
//        
//        e.preventDefault();
//        
//        modal.openRegister();
//    });
//    
//    //open login modal once loginBtn clicked in anonymous header
//    console.log($('header'));
//    
//    $('#header #loginBtn').on('click', function (e) {
//       
//        e.preventDefault();
//        
//        modal.openLogin();
//
//    });
//    
//    //open register modal once registerBtn clicked in login modal
//    console.log($('#login'));
//    
//    $('#login #registerBtn').on('click', function (e) {
//        
//        e.preventDefault();
//        
//        modal.openRegister();
//    
//    });   
//     
//    //open login modal once loginBtn clicked in register modal. 
//    console.log($('#register'));
//    
//    $('#register #loginBtn').on('click', function (e) {
//        
//       e.preventDefault();
//       
//       modal.openLogin();
//        
//    });
    


}());


