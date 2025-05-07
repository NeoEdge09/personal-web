<section class="blog-section section-block" id="blog-section">
    <div class="section-title">
        <h2>From My Blog</h2>
        <p class="lead">
            Thoughts and insights on web development, design, and technology
        </p>
    </div>
    <!-- .section-title -->

    <div class="row" id="blog-grid">
        @include('sections.blog.items', ['blogs' => $blogs->take(5)])
    </div>

    <!-- Loading Indicator -->
    <div id="blog-loading-indicator" class="text-center d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Load More Button -->
    @if ($blogs->count() > 5)
        <div class="text-center mb-5">
            <button id="load-more-blogs" class="btn btn-main" data-offset="4">Load More</button>
        </div>
    @endif
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load More functionality with AJAX
        $('#load-more-blogs').on('click', function() {
            var $button = $(this);
            var offset = parseInt($button.data('offset'));

            // Show loading indicator
            $('#blog-loading-indicator').removeClass('d-none');

            // Disable button during loading
            $button.prop('disabled', true);

            // Make AJAX request to load more items
            $.ajax({
                url: '/load-more-blogs/' + offset,
                type: 'GET',
                success: function(response) {
                    // Hide loading indicator
                    $('#blog-loading-indicator').addClass('d-none');

                    if (response.html) {
                        // Append new items
                        $('#blog-grid').append(response.html);

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
                    $('#blog-loading-indicator').addClass('d-none');
                    $button.prop('disabled', false);
                    alert('Error loading more blog posts. Please try again.');
                }
            });
        });
    });
</script>
