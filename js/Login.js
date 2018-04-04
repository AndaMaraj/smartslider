$(document).ready(function () {
    $('.login').submit(function (e) {
       Login.Username = $('#username').val();
       Login.Password = $('#password').val();
        Login.Login();
        e.preventDefault();
    });

});


var Login = {
    Username: '',
    Password: '',

    Login: function () {
        $.post('core/Services/Person.php', {
            t: 1,
            username: Login.Username,
            password: Login.Password
        }, function (response) {
            console.log(response);
        });
    }
}
