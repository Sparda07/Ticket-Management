var userNameError = document.getElementById('username');
var passwordError = document.getElementById('password');
var emailError = document.getElementById('email');
var phoneNumberError = document.getElementById('phn-number');
var addressError = document.getElementById('address');

function validUserName(){
    var name = document.getElementById('input-username').value;
    if (name.length == 0)
    {
        userNameError.innerHTML = "Name is require";
        return false;
    }
    userNameError.innerHTML = "";
    return true;
}

function validPassword(){
    var password = document.getElementById('input-password').value;
    if(password.length == 0 )
    {
        passwordError.innerHTML = "Password is require";
        return false;
    }
    passwordError.innerHTML = "";
    return true;
}

function validEmail(){
    var email = document.getElementById('input-email').value;
    if( email.length == 0 )
    {
        emailError.innerHTML = "Email is require";
        return false;
    }

    emailError.innerHTML = "";
    return true;
}

function validPhnNumbe(){
    var phnNumber = document.getElementById('input-phn-number').value;
    if( phnNumber.length == 0 )
    {
        phnNumberError.innerHTML = "Phone number is require";
        return false;
    }

    var pattern = /^01\d{9}$/;

    if (!pattern.test(phnNumber)) {
        phoneNumberError.innerHTML = "Phone number must start with 01 and be 11 digits";
        return false;
    }
    phoneNumberError.innerHTML = "";
    return true;
}
function validAdrress(){
    var address = document.getElementById('input-address').value;
    if( address.length == 0 )
    {
        addressError.innerHTML = "address is require <br>";
        return false;
    }
    addressError.innerHTML = "";
    return true;
}




