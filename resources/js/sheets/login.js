$(document).on('submit', '#login_form', function (event) {
    if (!validation()) {
        event.preventDefault()
        event.stopPropagation()
    }
})

$(document).on('input', '#user_input', function () {
    validation()
})

const validation = () => {
    const user = $('#user_input').val()
    let isValid = false
    switch (serverToJs.user_type) {
        case 1:
            if (checkNationalCode(user)) isValid = true
            break;
        case 2:
            if (!checkMobileFormat(user)) {
                $('#user_input').val('')
                return false;
            }
            if (checkMobileNumber(user)) isValid = true
            break;
        case 3:
            if (checkEmailFormat(user)) isValid = true
            break;
    }

    $('#user_input').removeClass('is-invalid')
    $('#user_input').removeClass('is-valid')
    if (isValid) {
        $('#user_input').addClass('is-valid')
        return true
    }
    $('#user_input').addClass('is-invalid')
    return false;
}


const checkNationalCode = code => {

    if (code == "1111111111" || code == "2222222222" || code == "3333333333" || code == "4444444444" || code == "5555555555" || code == "6666666666" || code == "7777777777" || code == "8888888888" || code == "9999999999" || code == "123456789") return false

    var L = code.length;

    if (L < 8 || parseInt(code, 10) == 0) return false;
    code = ('0000' + code).substr(L + 4 - 10);
    if (parseInt(code.substr(3, 6), 10) == 0) return false;
    var c = parseInt(code.substr(9, 1), 10);
    var s = 0;
    for (var i = 0; i < 9; i++)
        s += parseInt(code.substr(i, 1), 10) * (10 - i);
    s = s % 11;
    return (s < 2 && c == s) || (s >= 2 && c == (11 - s));
}

const checkMobileFormat = code => {
    if (code.length <= 1 && code != '0') return false

    return true;
}

const checkMobileNumber = code => {
    if (code.length != 11 || code.substr(0, 2) != '09') return false

    return true
}

const checkEmailFormat = email => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
