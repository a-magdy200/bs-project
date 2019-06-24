
document.body.onload = function () {
    const form = $('#registerForm');
    form.on('submit', e => {
        handleSubmit(e, form);
    });
    $("#signup-btn").on("click", e => {
        $(".alert.alert-danger").remove();
        handleSubmit(e, form);
    });
};

function handleSubmit(e, form) {
    let errors = validateForm(form);
    if (errors) {
        errors.forEach(error => {
            const form = $('#registerForm');
            form.before("<div class='alert alert-danger'>" + error + "</div>");
        });
        e.preventDefault();
        console.log(errors);
    }
    e.preventDefault();
    console.log("ss");
}

function validateForm(form) {
    const fields = $('input', form);
    const errors = [];
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    fields.each( index => {
        let field = fields.eq(index);
        let value = field.val();
        let name = field.attr('placeholder');
        if (value.length === 0 && field.attr('name') !== 'img') {
            errors.push(name + " is required.");
            return;
        }
        switch (field.attr('type')) {
            case 'text':
                if (!/[A-Za-z]/.test(value)) {
                    errors.push(name + " must have letters only.")
                }
                console.log(value);
                break;
            case 'email':

                if (!re.test(value)) {
                    errors.push("Invalid email.")
                }
                break;
            case 'password':
                if (value < 6) {
                    errors.push("Password must be longer then 6 characters.");
                }
                break;
            case 'file':
                break;
            case 'checkbox':
                if (value !== "on") {
                    errors.push("You must agree on our terms.");
                }
                break;
            default:
                break;
        }
    });
    const pass_fields = $('input[type=\'password\']');
    if (pass_fields.eq(1).val() !== pass_fields.eq(0).val()) {
        errors.push("Password doesn't match.");
    }
    return errors.length > 0 ? errors : false;
}


function formValidation (e, Form) {
    var errorInputs = validateInputs(Form.id);
    if (errorInputs) {
        e.preventDefault();
    }
}

function validateInputs(FormID) {
    var error = false;
    $('input[type="password"], input[type="email"]', $('#' + FormID)).each(function () {
        var input = $(this),
            regEx = input.data('check'),
            v = input.val();
        if (v === '' || v.match(regEx)) {
            input.addClass('border-danger');
            error = true;
        } else {
            input.removeClass('border-danger');
        }
    });
    return error;
}

var check = function() {
    if (document.getElementById('pass1').value ==
        document.getElementById('pass2').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'matching';
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'not matching';
    }
}
