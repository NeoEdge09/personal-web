@foreach ($blogs as $blog)
    @if ($loop->first && request()->route()->getName() != 'load-more-blogs')
        <div class="col-lg-6 large-post" data-aos="fade-right" data-aos-duration="1200">
            <!-- Modal -->
            <div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1"
                aria-labelledby="blogModal{{ $blog->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                            <div class="row blog-content">
                                <div class="col-xl-12">
                                    <img class="img-fluid w-100" style="height: 400px; object-fit: cover;"
                                        src="{{ asset('storage/' . $blog->featured_image) }}"
                                        alt="{{ $blog->title }}" />
                                </div>
                                <div class="col-xl-8 offset-xl-2">
                                    <div class="content-wrapper">
                                        <h2 class="blog-title">
                                            {{ \Illuminate\Support\Str::words($blog->title, 7, '...') }}</h2>
                                        <ul class="blog-meta d-md-flex align-items-center justify-content-md-center">
                                            <li>
                                                <a href="#"><i class="bi bi-folder-fill"></i>
                                                    {{ ucfirst($blog->category) }}</a>
                                            </li>
                                            <li>
                                                <i class="bi bi-calendar3"></i>
                                                {{ $blog->created_at->format('F d, Y') }}
                                            </li>
                                            <li>
                                                <i class="bi bi-clock"></i>
                                                {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min
                                            </li>
                                        </ul>
                                        <div>{!! $blog->content !!}</div>

                                        <div class="post-footer row">
                                            @if ($blog->tags)
                                                <div class="blog-tags col-lg-8 d-md-flex align-items-md-center">
                                                    <h4>Tags:</h4>
                                                    <ul class="tag-list list-inline">
                                                        @foreach (is_array($blog->tags) ? $blog->tags : explode(',', $blog->tags) as $tag)
                                                            <li class="list-inline-item">
                                                                <a href="#">{{ trim($tag) }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-wrapper">
                <div class="post-content">
                    <ul class="post-meta">
                        <li class="post-date">
                            <i class="pe-7s-clock"></i>
                            {{ $blog->created_at->format('F d, Y') }}
                        </li>
                        <li class="post-cat">
                            <a href="#"><i class="pe-7s-folder"></i>
                                {{ ucfirst($blog->category) }}</a>
                        </li>
                    </ul>
                    <h3>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#blogModal{{ $blog->id }}">
                            {{ \Illuminate\Support\Str::words($blog->title, 5, '...') }}
                        </a>
                    </h3>
                </div>
                <div class="image-wrapper">
                    <img class="img-fluid fixed-height-img" src="{{ asset('storage/' . $blog->featured_image) }}"
                        alt="{{ $blog->title }}" />
                </div>
            </div>
        </div>

        <div class="col-lg-6 post-group">
            <div class="row">
            @else
                <div class="col-md-6" data-aos="fade-up" data-aos-duration="1200"
                    data-aos-delay="{{ 400 + $loop->index * 200 }}">
                    <!-- Modal -->
                    <div class="modal fade" id="blogModal{{ $blog->id }}" tabindex="-1"
                        aria-labelledby="blogModal{{ $blog->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="bi bi-x"></i>
                                    </button>
                                    <div class="row blog-content">
                                        <div class="col-xl-12">
                                            <img class="img-fluid w-100" style="height: 400px; object-fit: cover;"
                                                src="{{ asset('storage/' . $blog->featured_image) }}"
                                                alt="{{ $blog->title }}" />
                                        </div>
                                        <div class="col-xl-8 offset-xl-2">
                                            <div class="content-wrapper">
                                                <h2 class="blog-title">
                                                    {{ \Illuminate\Support\Str::words($blog->title, 7, '...') }}</h2>
                                                <ul
                                                    class="blog-meta d-md-flex align-items-center justify-content-md-center">
                                                    <li>
                                                        <a href="#"><i class="bi bi-folder-fill"></i>
                                                            {{ ucfirst($blog->category) }}</a>
                                                    </li>
                                                    <li>
                                                        <i class="bi bi-calendar3"></i>
                                                        {{ $blog->created_at->format('F d, Y') }}
                                                    </li>
                                                    <li>
                                                        <i class="bi bi-clock"></i>
                                                        {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }}
                                                        min
                                                    </li>
                                                </ul>
                                                <div>{!! $blog->content !!}</div>

                                                <div class="post-footer row">
                                                    @if ($blog->tags)
                                                        <div class="blog-tags col-lg-8 d-md-flex align-items-md-center">
                                                            <h4>Tags:</h4>
                                                            <ul class="tag-list list-inline">
                                                                @foreach (is_array($blog->tags) ? $blog->tags : explode(',', $blog->tags) as $tag)
                                                                    <li class="list-inline-item">
                                                                        <a href="#">{{ trim($tag) }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-wrapper">
                        <div class="post-content">
                            <ul class="post-meta">
                                <li class="post-date">
                                    <i class="pe-7s-clock"></i>
                                    {{ $blog->created_at->format('F d, Y') }}
                                </li>
                                <li class="post-cat">
                                    <a href="#"><i class="pe-7s-folder"></i>
                                        {{ ucfirst($blog->category) }}</a>
                                </li>
                            </ul>
                            <h3>
                                <a href="#" data-bs-toggle="modal"
                                    data-bs-target="#blogModal{{ $blog->id }}">
                                    {{ \Illuminate\Support\Str::words($blog->title, 7, '...') }}
                                </a>
                            </h3>
                        </div>
                        <div class="image-wrapper">
                            <img class="img-fluid fixed-height-img"
                                src="{{ asset('storage/' . $blog->featured_image) }}" alt="{{ $blog->title }}" />
                        </div>
                    </div>
                </div>
    @endif

    @if ($loop->last && $loop->index > 0)
        </div>
        </div>
    @endif
@endforeach


<style>
    .fixed-height-img {
        height: 250px;
        /* Set your desired fixed height here */
        width: 100%;
        object-fit: cover;
        /* This ensures images maintain aspect ratio and cover the container */
        object-position: center;
        /* Centers the image within the container */
    }

    /* For the large post (first post), you might want a taller image */
    .large-post .fixed-height-img {
        height: 525px;
        /* Adjust height for the larger featured post */
    }
</style>
