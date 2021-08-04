$(document).ready(function() {

    // setInterval(function() {
    //     checkTokenExpirationTime();
    // }, 10000);

});


function checkToken() {
    var data = {
        "token": localStorage['token']
    };
    $.ajax({
        url: "api/user/validate_token.php",
        type: "POST",
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(result) {
            // console.log(result);
            $('#user_name').text(result.data.data.firstname +" "+result.data.data.lastname);
			
            if(localStorage['role']=='admin'){
                // console.log("I am admin");
                $("#show_campaign_menu").css("display", "block");
                $("#show_blood_request_menu").css("display", "block");
                $("#show_user_menu").css("display", "block");
                $("#show_profile_menu").css("display", "none");
                $("#show_my_campaign_menu").css("display", "none");
                $("#show_my_blood_request_menu").css("display", "none");
				 $("#show_usr_role").css("display", "block");
				
            } else {
                // console.log("I am donaor");
                $("#show_campaign_menu").css("display", "none");
                $("#show_blood_request_menu").css("display", "none");
                $("#show_user_menu").css("display", "none");
                $("#show_profile_menu").css("display", "block");
                $("#show_my_campaign_menu").css("display", "block");
                $("#show_my_blood_request_menu").css("display", "block");
				$("#show_usr_role").css("display", "none");
            }
			
			
        },
        error: function(xhr, resp, text) {
            removeLocalStorage();
            window.location = 'login.html';
        }
    });
    // if (localStorage['token']) {
    //     $('#user').text(localStorage['firstname']);
    // } else {
    //     window.location = 'login.html';
    // }
}

function removeLocalStorage() {
    localStorage['token'] = '';
    localStorage['id'] = '';
    localStorage['role'] = '';
    localStorage['blood_group'] = '';
    // localStorage['email'] = '';
    // localStorage['password'] = '';
    // localStorage['expireAt'] = '';
    // localStorage['expires'] = '';
}

function logout() {
    removeLocalStorage();
    window.location = 'login.html';
}

function checkTokenExpirationTime() {
    var d = new Date().getTime();
    if (d > localStorage['expireAt']) {
        alert('Your token expired form now. Please login again. Sorry for the inconvieniance');
        localStorage['token'] = '';
        window.location = 'login.html';
    }
}