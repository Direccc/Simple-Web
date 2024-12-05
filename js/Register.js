// Grab the form and toast elements
const form = document.getElementById("signupForm");
const toast = document.getElementById("toastMessage");

document.addEventListener("DOMContentLoaded", function () {
    // Change nav-bar appearance on scroll
    window.addEventListener("scroll", function () {
        if (window.scrollY >= 100) {
            document.querySelector('.fixed-nav-bar').classList.add('scrolled');
            document.querySelector('.the-bass').classList.add('scrolled');
        } else {
            document.querySelector('.fixed-nav-bar').classList.remove('scrolled');
            document.querySelector('.the-bass').classList.remove('scrolled');
        }
    });

    // Toggle dropdown on checkbox state
    const menuButton = document.getElementById('menuButton');
    if (menuButton) {
        menuButton.addEventListener('change', function () {
            const bassElement = document.querySelector('.the-bass');
            if (menuButton.checked) {
                bassElement.classList.add('dropped');
            } else {
                bassElement.classList.remove('dropped');
            }
        });
    }
});

form.addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent the form from submitting normally
    
    // Collect form values
    const email = form.user_email.value.trim();
    const password = form.user_password.value.trim();
    const age = form.user_age.value;
    const job = form.user_job.value;
    
    // Collect the checked interests
    const interests = []; form.querySelectorAll('input[name="user_interest[]"]:checked').forEach(function(checkbox) { interests.push(checkbox.value); });

    // Validate form fields
    if (!email || !password || !age || !job) {
        // Show error toast for missing fields
        toast.textContent = "Please fill in all fields.";
        toast.setAttribute('aria-hidden', 'false');
        toast.classList.add('show');
        
        setTimeout(function () {
            toast.classList.remove('show');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
        return;  // Stop form submission if validation fails
    }

    if (age < 17) {
        toast.textContent = "You must be at least 17 years old to register.";
        toast.setAttribute('aria-hidden', 'false');
        toast.classList.add('show');
        
        setTimeout(function () {
            toast.classList.remove('show');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
        return; // Stop form submission if age is below 17
    }

    if (age >= 100) {
        toast.textContent = "Age too high, registration not allowed.";
        toast.setAttribute('aria-hidden', 'false');
        toast.classList.add('show');
        
        setTimeout(function () {
            toast.classList.remove('show');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
        return; // Stop form submission if age is 100 or above
    }

    // Password validation
    if (password.length < 6) {
        toast.textContent = "Password must be at least 6 characters.";
        toast.setAttribute('aria-hidden', 'false');
        toast.classList.add('show');
        
        setTimeout(function () {
            toast.classList.remove('show');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
        return;
    }

    const formData = new FormData(form);
    
    // Append interests to the formData without duplicates
    interests.forEach(interest => {
        if (!formData.has('user_interest[]')) {  // Check if the interest already exists
            formData.append('user_interest[]', interest);  // Add the interest only once
        }
    });
    
    // Send data via AJAX
    fetch('/php/Process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Check the response from the server
        if (data.trim() === "success") {
            // Show success toast if registration is successful
            toast.textContent = "Registered Successfully!";
            toast.setAttribute('aria-hidden', 'false');
            toast.classList.add('show');
        } else {
            // Show error toast if registration fails
            toast.textContent = "Registration Failed. Please try again.";
            toast.setAttribute('aria-hidden', 'false');
            toast.classList.add('show');
        }

        setTimeout(function () {
            toast.classList.remove('show');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
    })
    .catch(error => {
        // Show error toast if there's an issue with the AJAX request
        toast.textContent = "Error registering. Please try again later.";
        toast.setAttribute('aria-hidden', 'false');
        toast.classList.add('show');
        
        setTimeout(function () {
            toast.classList.remove('show');
            toast.setAttribute('aria-hidden', 'true');
        }, 3000);
    });
});