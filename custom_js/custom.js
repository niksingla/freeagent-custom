(function ($) {
    'use strict';

    $(document).on('change', '#submit-hiring [name="job_old"]', function (e) {

        var $this = $(this),
            $value = $this.val();
        if ($value) {
            var formData = new FormData();
            formData.append('action', 'fetch_budget');
            formData.append('job_id', $value);
            $.ajax({
                url: jws_script.ajax_url,
                data: formData,
                method: 'POST',
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        if (response.data) {
                            $('[name="cost"]').val(response.data.budget).trigger('change')
                            // $('[name="cost"]').attr('disabled','disabled')

                        }
                    } else {
                        $('[name="cost"]').val(0)
                        $('[name="cost"]').removeAttr('disabled')
                    }
                },
                error: function () {
                    console.log('error');
                },
                complete: function () { },
            });
        } else {
            $('[name="cost"]').val(0)
            $('[name="cost"]').removeAttr('disabled')
        }

    });

    $(document).ready(function () {
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function () {
                const inputId = this.getAttribute('data-target');
                const input = document.getElementById(inputId);
        
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('bi-eye-slash');
                    this.classList.add('bi-eye');
                } else {
                    input.type = 'password';
                    this.classList.remove('bi-eye');
                    this.classList.add('bi-eye-slash');
                }
            });
        });
        
        $('.website-link a').each((index, linkEle) => {
            if (freelancer_id, employer_userID) {
                var formData = new FormData();
                formData.append('action', 'fetch_website_link');
                formData.append('freelancer_id', freelancer_id);
                formData.append('employer_userID', employer_userID);
                $.ajax({
                    url: jws_script.ajax_url,
                    data: formData,
                    method: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.success) {
                            if (response.data) {
                                linkEle.href = response.data.link
                                linkEle.innerHTML = website_lbl + ' <i class="fa-solid fa-arrow-up-right-from-square"></i>'
                            }
                        }
                    },
                    error: function () {
                        console.log('error');
                    },
                    complete: function () { },
                });
            }
        });

        const navLinks = document.querySelectorAll(".sidebar-menu a");
        const sections = document.querySelectorAll(".dashboard-section");

        function activateSection(sectionId) {
            // Remove active class from all nav links
            navLinks.forEach(nav => nav.parentElement.classList.remove("active"));

            // Find the link corresponding to the section
            const activeLink = document.querySelector(`.sidebar-menu a[data-section="${sectionId}"]`);
            if (activeLink) {
                activeLink.parentElement.classList.add("active");
            }

            // Remove active class from all sections
            sections.forEach(section => section.classList.remove("active"));

            // Add active class to the selected section
            const targetSection = document.getElementById(sectionId);
            if (targetSection) {
                targetSection.classList.add("active");
            }
        }
        navLinks.forEach(link => {
            link.addEventListener("click", function (e) {
                if (this.hasAttribute("data-section")) {
                    e.preventDefault();
                    const sectionId = this.getAttribute("data-section");
                    history.pushState(null, null, `#${sectionId}`); // Update the URL hash
                    activateSection(sectionId);

                    // Scroll to the target section smoothly for mobile view
                    if (window.innerWidth < 768) {
                        const targetSection = document.getElementById(sectionId);
                        if (targetSection) {
                            targetSection.scrollIntoView({ behavior: "smooth", block: "start" });
                        }
                    }
                }
            });
        });
        function handleHashChange() {
            if(window.location.hash){
                const hash = window.location.hash.replace("#", "") || "dashboard";                
                
                activateSection(hash);
            }
        }

        // Run on page load to check initial hash
        handleHashChange();

        // Listen for hash changes
        window.addEventListener("hashchange", handleHashChange);

        /** Change password functionality */
        
        $("#change-password-form").on("submit", function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            
            $.ajax({
                type: "POST",
                url: jws_script.ajax_url,
                data: formData + "&action=change_user_password",
                beforeSend: function() {
                    $("#password-message").html("<div class='alert alert-info'>Processing...</div>");
                },
                success: function(response) {
                    $("#password-message").html(response);
                    $("#change-password-form")[0].reset();
                    clearMessage();
                    // Reload page after 2 seconds on success
                    if (response.includes("success")) {
                        setTimeout(function() {
                            location.reload();
                        }, 4000);
                    }
                },
                error: function() {
                    $("#password-message").html("<div class='alert alert-danger'>Something is wrong.</div>");
                    clearMessage();
                }

            });
        });
        function clearMessage() {
            setTimeout(function() {
                $("#password-message").fadeOut("slow", function() {
                    $(this).html("").show();
                });
            }, 5000);
        }

        /** Delete Account */
        function showNotification(message, type = 'success') {
            const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
            const alertBox = $(`
                <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);

            $('#notification-container').append(alertBox);

            setTimeout(() => {
                alertBox.alert('close');
            }, 5000);
        }
        $('#delete-account-form').on('submit', function (e) {
            e.preventDefault();

            let password = $('#del-password').val();
            let confirm = $('#confirm-delete').is(':checked');
            let nonce = $('#delete-account-form').find('[name="delete_account_nonce"]').val();

            if (!confirm) {
                showNotification('Please confirm account deletion.', 'error');
                return;
            }

            $.ajax({
                url: jws_script.ajax_url,
                type: 'POST',
                data: {
                    action: 'delete_user_account',
                    password: password,
                    nonce: nonce
                },
                success: function (response) {
                    if (response.success) {
                        showNotification('Account deleted successfully. Redirecting...', 'success');
                        setTimeout(() => {
                            window.location.href = '/';
                        }, 1500);
                    } else {
                        showNotification(response.data, 'error');
                    }
                },
                error: (e) => {
                    showNotification('Something went wrong.', 'error');
                }
            });
        });
        $(document).on('click', '.portfolio-overview-inner .jws-portfolio-images,.portfolio-detail', function (e) {
            e.preventDefault();
        
            var imgSrc = $(this).find('img').attr('src');
            
            if (!imgSrc) return;
        
            $.magnificPopup.open({
                items: {
                    src: '<div class="mfp-figure"><img src="' + imgSrc + '" class="img-fluid" /></div>',
                    type: 'inline'
                },
                removalDelay: 360,
                callbacks: {
                    beforeOpen: function () {
                        this.st.mainClass = 'user-popup animation-popup';
                    }
                }
            });
        });
        
    })
})(jQuery);