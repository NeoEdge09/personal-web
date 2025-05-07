<section class="portfolio-section section-block " id="portfolio-section">
    <div class="section-title">
        <h2>Portfolio</h2>
        <p class="lead">
            Explore my creative work and professional projects
        </p>
    </div>
    <!-- .section-title -->

    <!-- Filter Buttons -->
    <div class="button-group filter-button-group">
        <button class="active" data-filter="*">All</button>
        <button class="" data-filter=".web-development">Web Development</button>
        <button class="" data-filter=".mobile-app">Mobile App</button>
        <button class="" data-filter=".design">Design</button>
        <button class="" data-filter=".other">Other</button>
    </div>

    <!-- Portfolio Grid -->
    <div class="row grid" id="portfolio-grid" data-aos="fade-up" data-aos-duration="2000">
        @include('sections.portfolio.items', ['portfolios' => $portfolios->take(6)]) </div>

    <!-- Loading Indicator -->
    <div id="loading-indicator" class="text-center d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Load More Button -->
    @if ($portfolios->count() > 3)
        <div class="text-center mt-5">
            <button id="load-more" class="btn btn-main" data-offset="6">Load More</button>
        </div>
    @endif
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Isotope for filtering
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            layoutMode: 'fitRows'
        });

        // Filter items on button click
        $('.filter-button-group').on('click', 'button', function() {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });

            // Toggle active class
            $('.filter-button-group button').removeClass('active');
            $(this).addClass('active');
        });

        // Initialize Swiper for each portfolio gallery
        function initSwipers() {
            // Find all swiper containers
            document.querySelectorAll('.portfolio-swiper').forEach(function(swiperContainer) {
                new Swiper(swiperContainer, {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    breakpoints: {
                        768: {
                            slidesPerView: 3
                        }
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                });
            });
        }

        // Initialize GLightbox
        function initGLightbox() {
            const lightbox = GLightbox({
                touchNavigation: true,
                loop: true,
                autoplayVideos: true
            });
        }

        // Initialize Swipers and GLightbox on page load
        initSwipers();
        initGLightbox();

        // Load More functionality with AJAX
        $('#load-more').on('click', function() {
            var $button = $(this);
            var offset = parseInt($button.data('offset'));

            // Show loading indicator
            $('#loading-indicator').removeClass('d-none');

            // Disable button during loading
            $button.prop('disabled', true);

            // Make AJAX request to load more items
            $.ajax({
                url: '/load-more-portfolios/' + offset,
                type: 'GET',
                success: function(response) {
                    // Hide loading indicator
                    $('#loading-indicator').addClass('d-none');

                    if (response.html) {
                        // Append new items
                        var $newItems = $(response.html);
                        $('#portfolio-grid').append($newItems);

                        // Update Isotope layout
                        $grid.isotope('appended', $newItems);
                        $grid.isotope('layout');

                        // Initialize new Swipers for newly added items
                        initSwipers();

                        // Reinitialize GLightbox for new elements
                        initGLightbox();

                        // Update offset for next load
                        $button.data('offset', offset + 3);

                        // Hide button if no more items
                        if (!response.hasMore) {
                            $button.fadeOut();
                        } else {
                            $button.prop('disabled', false);
                        }
                    } else {
                        // No more items, hide button
                        $button.fadeOut();
                    }
                },
                error: function() {
                    // Hide loading indicator on error
                    $('#loading-indicator').addClass('d-none');
                    $button.prop('disabled', false);
                    alert('Error loading more items. Please try again.');
                }
            });
        });
    });
</script>
<style>
    #loading-indicator {
        margin: 30px auto;
    }

    .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.25em;
    }

    .swiper-pagination-bullet-active {
        background-color: var(--primary-color);
    }
</style>
