// Ensure script runs after DOM elements are fully loaded
document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("contactForm");

    if (form) {
        form.addEventListener("submit", validateData);
    }
});

// SINGLE function to handle all validation 
function validateData(event) {
    var isFormValid = true;

    // --- REUSABLE VALIDATION HELPERS ---

    // Shared Status Modifier
    function setStatus(inputId, isValid, errorMessage) {
        var group = document.getElementById("fg-" + inputId);
        var messageSpan = document.getElementById("err-" + inputId);

        if (!isValid) {
            group.classList.remove("has-success");
            group.classList.add("has-error");
            messageSpan.textContent = errorMessage;
            messageSpan.style.display = "block";
            isFormValid = false;
        } else {
            group.classList.remove("has-error");
            group.classList.add("has-success");
            messageSpan.textContent = "";
            messageSpan.style.display = "none";
        }
    }

    // Same function validating both First and Last Name 
    function validateNameField(inputId, fieldLabel) {
        var value = document.getElementById(inputId).value.trim();
        var nameRegex = /^[A-Za-z'-]{2,}$/;

        if (value === "") {
            setStatus(inputId, false, fieldLabel + " cannot be empty.");
        } else if (!nameRegex.test(value)) {
            setStatus(inputId, false, "Must be at least 2 characters and only contain letters, hyphens, or apostrophes.");
        } else {
            setStatus(inputId, true);
        }
    }

    // Same function validating both Username and Password 
    function validateUserAuthField(inputId, fieldLabel, minLength, standardTrim) {
        var element = document.getElementById(inputId);
        var value = standardTrim ? element.value.trim() : element.value;

        if (value === "") {
            setStatus(inputId, false, fieldLabel + " cannot be empty.");
        } else if (value.length < minLength) {
            setStatus(inputId, false, fieldLabel + " must contain at least " + minLength + " characters.");
        } else {
            setStatus(inputId, true);
        }
    }

    // --- EXECUTE VALIDATIONS ---

    // 1 & 2. Name fields run through the exact same shared function
    validateNameField("firstName", "First Name");
    validateNameField("lastName", "Last Name");

    // 3. Email Validation
    var email = document.getElementById("email").value.trim();
    var validRegex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (email === "") {
        setStatus("email", false, "Email address cannot be empty.");
    } else if (!validRegex.test(email)) {
        setStatus("email", false, "Please enter a valid email address.");
    } else {
        setStatus("email", true);
    }

    // 4. Phone Number Validation
    var phone = document.getElementById("phone").value.trim();
    var phoneRegex = /^[0-9]{10}$/;
    if (phone === "") {
        setStatus("phone", false, "Phone number cannot be empty.");
    } else if (!phoneRegex.test(phone)) {
        setStatus("phone", false, "Phone number must be exactly 10 digits without spaces, hyphens, or parentheses.");
    } else {
        setStatus("phone", true);
    }

    // 5 & 6. Username and Password fields run through the exact same shared function
    validateUserAuthField("username", "Username", 6, true);
    validateUserAuthField("password", "Password", 8, false); // false to keep intentional spaces intact

    // 7. Comments Validation
    var comments = document.getElementById("comments").value.trim();
    if (comments === "") {
        setStatus("comments", false, "Comments cannot be empty.");
    } else {
        setStatus("comments", true);
    }

    // Stop form execution if any function set isFormValid to false
    if (!isFormValid) {
        event.preventDefault();
    }
}