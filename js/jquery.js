// SETTINGS FOR THE ITEM CAROUSEL


$(function(){
    $('.owl-carousel').owlCarousel({
        loop:false,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:2
            },
            800:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });
});


// NOTE: SOME OF THE JQUERY VALIDATIONS ARE EMBEDDED IN THEIR HTML

// SETTINGS FOR THE LOGIN AND SIGN UP VALIDATION

// ======================================= LOG IN VALIDATION =======================================

$(function(){
    $('#inputEmail').on('focusout', function(){
        if ($('#inputEmail').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Email Address' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });

    $('#inputPassword').on('focusout', function(){
        if ($('#inputPassword').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Password' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });


    


    // ======================================= SIGN UP VALIDATION =======================================


    $('#signupinputEmail').on('focusout', function(){
        if ($('#signupinputEmail').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Email Address' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });

    $('#signupinputPassword').on('focusout', function(){
        if ($('#signupinputPassword').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Password' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });

    
    $('#signupinputFirstname').on('focusout', function(){
        if ($('#signupinputFirstname').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Firstname' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });

    $('#signupinputLastname').on('focusout', function(){
        if ($('#signupinputLastname').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Lastname' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });


    $('#signupinputContactNumber').on('focusout', function(){
        if ($('#signupinputContactNumber').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Contact Number' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }


        else if ($('#signupinputContactNumber').val().length < 10) {
            $(function() {
                $.notify({
                    message: 'Your Contact Number Has Some Missing Numbers, Recheck It' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });

    $('#signupinputHouseNumber').on('focusout', function(){
        if ($('#signupinputHouseNumber').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your House Number' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });

    $('#signupinputStreet').on('focusout', function(){
        if ($('#signupinputStreet').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Street Location' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });


    $('#signupinputBarangay').on('focusout', function(){
        if ($('#signupinputBarangay').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Barangay Location' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });
    
    $('#signupinputCity').on('focusout', function(){
        if ($('#signupinputCity').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your City Location' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });


    $('#signupinputProvince').on('focusout', function(){
        if ($('#signupinputProvince').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Enter Your Province Location' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });



    // ======================================= ACCOUNTS VALIDATION =======================================

    $('#accountsinputFirstname').on('focusout', function(){
        if ($('#accountsinputFirstname').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Specify The Firstname Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });


    $('#accountsinputLastname').on('focusout', function(){
        if ($('#accountsinputLastname').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Specify The Lastname Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });



    $('#accountsinputEmail').on('focusout', function(){
        if ($('#accountsinputEmail').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Specify The Email Address Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });


    $('#accountsinputPassword').on('focusout', function(){
        if ($('#accountsinputPassword').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Specify The Password Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });



    $('#accountsinputContactNumber').on('focusout', function(){
        if ($('#accountsinputContactNumber').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Include The Contact Number Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
        else if ($('#accountsinputContactNumber').val().length < 10) {
            $(function() {
                $.notify({
                    message: 'The Contact Number You Entered Is Incorrect' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });



    $('#accountsinputHouseNumber').on('focusout', function(){
        if ($('#accountsinputHouseNumber').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Include The House Number Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });


    $('#accountsinputStreet').on('focusout', function(){
        if ($('#accountsinputStreet').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Include The Street Location Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });



    $('#accountsinputBarangay').on('focusout', function(){
        if ($('#accountsinputBarangay').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Include The Barangay Location Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });
    
    


    $('#accountsinputCity').on('focusout', function(){
        if ($('#accountsinputCity').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Include The City Location Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });
    



    $('#accountsinputProvince').on('focusout', function(){
        if ($('#accountsinputProvince').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Include The Province Location Of The Account Holder' 
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });
    
    


    // ======================================= INVENTORY VALIDATION =======================================
    
    
    $('#productname').on('focusout', function(){
        if ($('#productname').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Product Name Should Not Be Empty'
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });
    

    $('#price').on('focusout', function(){
        if ($('#price').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Specify The Price Of The Product'
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });


    $('#quantity').on('focusout', function(){
        if ($('#quantity').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Specify The Quantity Of The Product'
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });


    $('#productdesc1').on('focusout', function(){
        if ($('#productdesc1').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Include Some Descriptions For The Product'
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });

    $('#productdesc2').on('focusout', function(){
        if ($('#productdesc2').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Include Some Descriptions For The Product'
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });

    $('#productdesc3').on('focusout', function(){
        if ($('#productdesc3').val().length == 0) {
            $(function() {
                $.notify({
                    message: 'Please Include Some Descriptions For The Product'
                },{
                    animate: {
                        enter: 'animate__animated animate__fadeInDown',
                        exit: 'animate__animated animate__fadeOutLeft'
                    },
                    delay: 2000,
                    placement: {
                        from: 'bottom',
                        align: 'left'
                    },
                    type: 'warning'
                });
            });
        }
    });

    
});
