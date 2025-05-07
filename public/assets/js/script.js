(function ($) {
    "use strict";

    /*================================================================= 
    pre loader 
==================================================================*/
    $(".js-preloader").preloadinator({
        animation: "fadeOut",
        animationDuration: 400,
    });

    /*================================================================= 
    Magic Mouse 
==================================================================*/

    var MagicMouseOptions = {
        cursorOuter: "circle-basic",
        hoverEffect: "circle-move",
        hoverItemMove: false,
        defaultCursor: false,
        outerWidth: 30,
        outerHeight: 30,
    };
    magicMouse(MagicMouseOptions);

    /*================================================================= 
    Isotope initialization 
==================================================================*/
    var $grid = $(".grid").isotope({
        // options
    });
    // layout Isotope after each image loads
    $grid.imagesLoaded().progress(function () {
        $grid.isotope("layout");
    });

    // filter items on button click
    $(".filter-button-group").on("click", "button", function () {
        var filterValue = $(this).attr("data-filter");
        $grid.isotope({ filter: filterValue });
    });

    /* checking active filter */
    // change is-checked class on buttons
    var buttonGroups = document.querySelectorAll(".button-group");
    for (var i = 0, len = buttonGroups.length; i < len; i++) {
        var buttonGroup = buttonGroups[i];
        radioButtonGroup(buttonGroup);
    }

    function radioButtonGroup(buttonGroup) {
        buttonGroup.addEventListener("click", function (event) {
            // only work with buttons
            if (!matchesSelector(event.target, "button")) {
                return;
            }
            buttonGroup.querySelector(".active").classList.remove("active");
            event.target.classList.add("active");
        });
    }

    /*================================================================= 
    Testimonial carousel
==================================================================*/
    const swiper = new Swiper(".swiper", {
        // Optional parameters
        breakpoints: {
            1200: {
                slidesPerView: 3,
            },
            992: {
                slidesPerView: 2,
            },
            576: {
                slidesPerView: 1,
            },
        },
        //slidesPerView: 3,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 5000,
        },

        // If we need pagination
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    /*================================================================= 
    Partner carousel
==================================================================*/
    const swiper2 = new Swiper(".partnerCarousel", {
        // Optional parameters
        breakpoints: {
            1200: {
                slidesPerView: 6,
            },
            992: {
                slidesPerView: 4,
            },
            576: {
                slidesPerView: 3,
            },
            320: {
                slidesPerView: 2,
            },
        },
        //slidesPerView: 6,
        spaceBetween: 24,
        loop: true,
        autoplay: {
            delay: 5000,
        },
    });

    /*================================================================= 
    Map
==================================================================*/
    var map = L.map("mapwrapper").setView([-37.81716, 144.955937], 12);

    L.tileLayer(
        "../../../../%7bs%7d.tile.openstreetmap.org/%7bz%7d/%7bx%7d/%7by%7d.png",
        {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }
    ).addTo(map);

    var greenIcon = L.icon({
        iconUrl: "image/location.png",

        iconSize: [48, 48], // size of the icon
    });

    L.marker([-37.81716, 144.955937], { icon: greenIcon }).addTo(map);

    /*================================================================= 
    Navbar fixed top
==================================================================*/

    $(document).ready(function () {
        // Function to handle scroll, resize, and scrollTop events
        function handleScrollResizeAndScrollTop() {
            // Get the current window width
            var windowWidth = $(window).width();

            var menu = $(".site-header nav");
            var origOffsetY = $(".hero-area").height();

            // Get the current scrollTop value
            var scrollTopValue = $(window).scrollTop();

            // Check if the window width is less than 1200 pixels and scrollTop is greater than 100 pixels
            if (windowWidth <= 1200 && scrollTopValue > origOffsetY) {
                $(".site-header nav").addClass("fixed-top");
            } else {
                $(".site-header nav").removeClass("fixed-top");
            }
        }

        // Bind the function to the scroll, resize, and scrollTop events
        $(window).on("scroll resize", function () {
            handleScrollResizeAndScrollTop();
        });

        // Trigger the function on page load
        handleScrollResizeAndScrollTop();
    });

    /*================================================================= 
    Contact form 
==================================================================*/
    $(function () {
        // Getting the contact form
        var form = $("#contact-form");

        // Getting the message div for feedback
        var formResponse = $("#form-response");

        // Setting up an event listener for the contact form
        $(form).submit(function (event) {
            // Stopping the browser from submitting the form
            event.preventDefault();

            // Resetting previous form messages
            formResponse.removeClass("alert-success alert-danger d-none");

            // Disabling submit button to prevent multiple submissions
            $("#contact-submit").prop("disabled", true).html("Sending...");

            // Getting CSRF token from meta tag
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            // Serializing the form data
            var formData = $(form).serialize();

            // Submitting the form using AJAX
            $.ajax({
                type: "POST",
                url: "/contact",
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
            })
                .done(function (response) {
                    // Show success message
                    formResponse
                        .addClass("alert-success")
                        .removeClass("d-none");
                    formResponse.html(response.message);

                    // Clearing the form after successful submission
                    $("#inputName").val("");
                    $("#inputEmail").val("");
                    $("#inputSubject").val("");
                    $("#inputMessage").val("");
                    $("#inputPhone").val("");
                })
                .fail(function (xhr) {
                    console.log(xhr);
                    if (xhr.status === 422) {
                        // Validation errors
                        var errors = xhr.responseJSON.errors;
                        var errorMessage =
                            "Please correct the following errors:<ul>";

                        $.each(errors, function (key, value) {
                            errorMessage += "<li>" + value + "</li>";
                            // Highlight error fields
                            $(
                                "#input" +
                                    key.charAt(0).toUpperCase() +
                                    key.slice(1)
                            ).addClass("is-invalid");
                        });

                        errorMessage += "</ul>";
                        formResponse
                            .addClass("alert-danger")
                            .removeClass("d-none");
                        formResponse.html(errorMessage);
                    } else {
                        formResponse
                            .addClass("alert-danger")
                            .removeClass("d-none");
                        formResponse.html(
                            "Oops! An error occurred. Please try again later."
                        );
                    }
                })
                .always(function () {
                    // Re-enable submit button
                    $("#contact-submit")
                        .prop("disabled", false)
                        .html("Send Message");
                });
        });

        // Clear validation errors when user starts typing
        $(form)
            .find("input, textarea")
            .on("focus", function () {
                $(this).removeClass("is-invalid");
            });
    });

    /*================================================================= 
    Animating numbers
==================================================================*/
    $(".counter").counterUp({
        delay: 10,
        time: 3000,
    });

    /*================================================================= 
    Progress bar animation
==================================================================*/
    var waypoint = new Waypoint({
        element: document.getElementById("skill-section"),
        handler: function () {
            $(".progress .progress-bar").css("width", function () {
                return $(this).attr("aria-valuenow") + "%";
            });
        },
        //offset: 'bottom-in-view',
        offset: 700,
    });

    /*================================================================= 
    Animate on scroll initialization
==================================================================*/
    AOS.init({
        once: true,
    });
})(jQuery);
