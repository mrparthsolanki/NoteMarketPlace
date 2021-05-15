$(function () {

    // show/hide nav on page load
    showHideNav();

    $(window).scroll(function () {

        // show/hide nav on window's scroll
        showHideNav();

    });

    function showHideNav() {

        if ($(window).scrollTop() > 50) {

            // show white nav
            $('#home-nav').removeClass('bg-dark-1');
            $('#home-nav').addClass('bg-white');

            // show dark logo
            $("#home-nav .navbar-brand img").attr("src", "images/Homepage/logo.png");

            // Show Back To Top button
            $('#home-login-btn-white').removeClass('btn-white');
            $('#home-login-btn-white').addClass('btn-purple');

        } else {

            // hide white nav
            $('#home-nav').removeClass('bg-white');
            $('#home-nav').addClass('bg-dark-1');

            // show dark logo
            $("#home-nav .navbar-brand img").attr("src", "images/Homepage/top-logo.png");

            // Show Back To Top button
            $('#home-login-btn-white').removeClass('btn-purple');
            $('#home-login-btn-white').addClass('btn-white');
        }
    }

});

function faq(q1) {
    var img = document.getElementById('faq-' + q1 + '-img-add').className;
    if (img == 'add-img') {
        $("." + q1 + "-img img").attr("src", "images/FAQ/minus.png");
        $("." + q1 + "-img img").removeClass("add-img");
        $("." + q1 + "-img img").addClass("minus-img");
        $("#faq-" + q1).addClass("accordion-flush");
    } else {
        $("." + q1 + "-img img").attr("src", "images/FAQ/add.png");
        $("." + q1 + "-img img").removeClass("minus-img");
        $("#faq-" + q1).removeClass("accordion-flush");
        $("." + q1 + "-img img").addClass("add-img");
    }
}
$(".toggle-password").click(function () {
    var input = $('#login-password').attr("type");
    if (input == "password") {
        $('#login-password').attr("type", "text");
    } else {
        $('#login-password').attr("type", "password");
    }
});

$(".toggle-password-old").click(function () {
    var input = $('#change-pass-old-password').attr("type");
    if (input == "password") {
        $('#change-pass-old-password').attr("type", "text");
    } else {
        $('#change-pass-old-password').attr("type", "password");
    }
});
$(".toggle-password-new").click(function () {
    var input = $('#change-pass-new-password').attr("type");
    if (input == "password") {
        $('#change-pass-new-password').attr("type", "text");
    } else {
        $('#change-pass-new-password').attr("type", "password");
    }
});
$(".toggle-password-confirm").click(function () {
    var input = $('#change-pass-confirm-password').attr("type");
    if (input == "password") {
        $('#change-pass-confirm-password').attr("type", "text");
    } else {
        $('#change-pass-confirm-password').attr("type", "password");
    }
});
$(".toggle-signup-password").click(function () {
    var input = $('#signup-password').attr("type");
    if (input == "password") {
        $('#signup-password').attr("type", "text");
    } else {
        $('#signup-password').attr("type", "password");
    }
});
$(".toggle-signup-password-confirm").click(function () {
    var input = $('#signup-confirm-password').attr("type");
    if (input == "password") {
        $('#signup-confirm-password').attr("type", "text");
    } else {
        $('#signup-confirm-password').attr("type", "password");
    }
});


$(function () {

    var pass_check = document.querySelector("#login-password");
    if(pass_check) {
        pass_check.addEventListener('keyup', function(){
            var pass_valid = document.querySelector("#pass-validate");
            var pass_border = document.querySelector("#login-password");
            var regexp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,24}$/;
            var str = pass_check.value;
    //        if(pass_check.value.length == 0 || pass_check.value.length <= 6){
            if(!regexp.test(str)){
                pass_valid.style.display = 'block';
                pass_border.style.borderColor = 'red';
                pass_valid.innerHTML = 'Password Should between 6 to 24 characters';
            }
            else {
                pass_valid.style.display = 'none';
                pass_border.style.borderColor = '#6255a5';
            }
        });
    }
});





$(function () {
    var input = document.getElementById( 'note-dp-file-upload' );
    var infoArea = document.getElementById( 'note-DP-file-upload-filename' );
    if(input) {
        input.addEventListener( 'change', showFileName );

        function showFileName( event ) {

          // the change event gives us the input it occurred in 
          var input = event.srcElement;

          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
          var fileName = input.files[0].name;

          // use fileName however fits your app best, i.e. add it into a div
          infoArea.textContent = 'File name: ' + fileName;
        }
    }
    
});
$(function () {
    var input = document.getElementById( 'note-preview-file-upload' );
    var infoArea = document.getElementById( 'note-preview-file-upload-filename' );
    if(input) {
        input.addEventListener( 'change', showFileName );

        function showFileName( event ) {

          // the change event gives us the input it occurred in 
          var input = event.srcElement;

          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
          var fileName = input.files[0].name;

          // use fileName however fits your app best, i.e. add it into a div
          infoArea.textContent = 'File name: ' + fileName;
          
        }
    }
    
});
function validate_change_pass() {
    var old_pass = $('#change-pass-old-password').val();
    var new_pass = $('#change-pass-new-password').val();
    var confirm_pass = $('#change-pass-confirm-password').val();
    if(old_pass == ''  || new_pass == '' || confirm_pass == '') {
        alert('field can not be empty');
        return false;
    }
    else if(old_pass === new_pass){
        alert('new password must different from old password');
        return false;
    }
    else if(new_pass !== confirm_pass){
        alert('new password and Confirm password must match');
        return false;
    }
    else {
        return true;
    }
}
$(function () {
    var input = document.getElementById( 'edit_profile_pic_file' );
    var infoArea = document.getElementById( 'edit_profile_pic_file-upload-filename' );
    if(input) {
        
        input.addEventListener( 'change', showFileName );

        function showFileName( event ) {

          // the change event gives us the input it occurred in 
          var input = event.srcElement;

          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
          var fileName = input.files[0].name;

          // use fileName however fits your app best, i.e. add it into a div
          infoArea.textContent = 'File name: ' + fileName;
        }
        
    }
    
});
function validate_edit_user_profile11_pic() {
    var display_pic = document.getElementById('edit_profile_pic_file');  
    var filePath = display_pic.value;
    var infoArea = document.getElementById( 'edit_profile_pic_file-upload-filename' );
    var allowedExtensions =  /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(filePath)) { 
        alert('Invalid file type'); 
        display_pic.value = ''; 
        infoArea.textContent = '';
        return false; 
    }  
    else  
    {
        return true; 
    } 
}
function validate_add_note_display_pic() {
    var display_pic = document.getElementById('note-dp-file-upload');  
    var filePath = display_pic.value;
    var infoArea = document.getElementById( 'note-DP-file-upload-filename' );
    var allowedExtensions =  /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(filePath)) { 
        alert('Invalid file type for Display Picture'); 
        display_pic.value = ''; 
        infoArea.textContent = '';
        return false; 
    }  
    else  
    {
        return true; 
    } 
}
function validate_add_note_preview() {
    var note_preview = document.getElementById('note-preview-file-upload');  
    var filePath = note_preview.value;
    var infoArea = document.getElementById( 'note-preview-file-upload-filename' );
    var allowedExtensions =  /(\.pdf)$/i;
    if (!allowedExtensions.exec(filePath)) { 
        alert('Invalid file type for Note Preview'); 
        note_preview.value = ''; 
        infoArea.textContent = '';
        if($('#selling-paid').is(':checked')) {
            document.getElementById( 'note-preview-warning' ).textContent = 'Please Upload note preview for paid notes.';
        }
        return false; 
    }  
    else  
    {
        document.getElementById( 'note-preview-warning' ).textContent = '';
        return true; 
    }
}
function validate_add_note_attachment() {
    var note_pdf = document.getElementById('note-pdf-file-upload');
    var infoArea = document.getElementById( 'note-pdf-file-upload-filename' );
    var allowedExtensions =  /(\.pdf)$/i;
     var final_fileName = "";
    for (i = 0; i < note_pdf.files.length; i++) {
        var filePath = note_pdf.files[i].name.substr(-4);
        
        if (!allowedExtensions.exec(filePath)) { 
            alert('Invalid file type for Notes'); 
            note_pdf.value = ''; 
            infoArea.innerHTML = '<b style="color:red;">Invalid file type, Please upload pdf file*</b>';
            return false; 
        }  
        else  
        {
            var note_pdf = event.srcElement;

          // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.


          // use fileName however fits your app best, i.e. add it into a div
            var fileName = note_pdf.files[i].name;
            if(i == 0) {
                final_fileName = final_fileName + fileName;
            }
            else {
                final_fileName = final_fileName +", "+ fileName;
            }
                
        }
        
    }
    infoArea.textContent = 'File name: ' + final_fileName;
    return true; 
    
}