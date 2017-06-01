// Key Events
window.addEventListener("load", function() {
    // Assign focus events to the phone textbox
    var phone = document.querySelector('input[type="tel"]');

    if (phone) {
        phone.onkeypress = updatePhone;
    }
});

function updatePhone(event) {
    // Stop regular key entry
    event.preventDefault();

    var phone = document.querySelector('input[name="phone"]');
    var text = phone.value;

    // prevent non-numerical characters
    if (!(event.charCode >= 48 && event.charCode <= 57)) {
        return;
    }

    // if we entered a backspace over our parenthesis
    if (text.length == 4) {
        text += ")";
    }

    // if entered a backspace over our space character
    if (text.length == 5) {
        text += " ";
    }

    if (text.length == 9) {
        text += "-";
    }

    if (text.length < 14) { // (xxx) yyy-zzzz
        text += event.key
    }

    if (text.length == 1) {
        text = "(" + text;
    }

    if (text.length == 4) {
        text += ") ";
    }

    if (text.length == 9) {
        text += "-";
    }

    phone.value = text;
}