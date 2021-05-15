$(".toggle-password").click(function () {
    var input = $('#login-password').attr("type");
    if (input == "password") {
        $('#login-password').attr("type", "text");
    } else {
        $('#login-password').attr("type", "password");
    }
});
$(function () {
    var input = document.getElementById( 'myprofile-profile-picture' );
    var infoArea = document.getElementById( 'admin_edit_profile_file-upload-filename' );
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
function validate_edit_admin_profile_pic() {
    var display_pic = document.getElementById('myprofile-profile-picture');  
    var filePath = display_pic.value;
    var infoArea = document.getElementById( 'admin_edit_profile_file-upload-filename' );
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
$(function () {
    var input = document.getElementById( 'msc-default-note-img' );
    var infoArea = document.getElementById( 'default_note_img_file-upload-filename' );
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
function validate_msc_note_pic() {
    var display_pic = document.getElementById('msc-default-note-img');  
    var filePath = display_pic.value;
    var infoArea = document.getElementById( 'default_note_img_file-upload-filename' );
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
$(function () {
    var input = document.getElementById( 'msc-default-profile-picture' );
    var infoArea = document.getElementById( 'default_profile_pic_file-upload-filename' );
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
function validate_msc_profile_pic() {
    var display_pic = document.getElementById('msc-default-profile-picture');  
    var filePath = display_pic.value;
    var infoArea = document.getElementById( 'default_profile_pic_file-upload-filename' );
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