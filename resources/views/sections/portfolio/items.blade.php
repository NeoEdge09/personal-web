<!-- filepath: c:\laragon\www\personal-web\resources\views\sections\portfolio\items.blade.php -->
@foreach ($portfolios as $portfolio)
    <div class="col-lg-4 col-md-6 grid-item py-4 {{ $portfolio->category }}">
        <div class="box">
            <img src="{{ asset('storage/' . $portfolio->featured_image) }}" alt="{{ $portfolio->title }}"
                class="portfolio-image" style="height: 310px; object-fit: cover; width: 100%;" />
            <div class="box-content">
                <span class="category">{{ ucwords(str_replace('-', ' ', $portfolio->category)) }}</span>
                <h3 class="title">{{ \Illuminate\Support\Str::words($portfolio->title, 7, '...') }}</h3>
            </div>
            <div class="icon-box">
                <a href="#" data-bs-toggle="modal" data-bs-target="#portfolioModal{{ $portfolio->id }}">
                </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="portfolioModal{{ $portfolio->id }}" tabindex="-1"
                aria-labelledby="portfolioModal{{ $portfolio->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="bi bi-x"></i>
                            </button>
                            <div class="row item-content">

                                <div class="col-12">
                                    <img class="img-fluid w-100" style="height: 400px; object-fit: cover;"
                                        src="{{ asset('storage/' . $portfolio->featured_image) }}"
                                        alt="{{ $portfolio->title }}" />
                                </div>
                                <!-- Content -->
                                <div class="col-12">
                                    <div class="content-wrapper">
                                        <h2 class="item-title">{{ $portfolio->title }}</h2>
                                        <div>{!! $portfolio->description !!}</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!-- Gallery -->
                                    @if ($portfolio->gallery && count($portfolio->gallery) > 0)
                                        <div class="portfolio-gallery mt-4">
                                            <h4>Project Gallery</h4>
                                            <div class="swiper portfolio-swiper mt-2"
                                                id="portfolio-swiper-{{ $portfolio->id }}">
                                                <div class="swiper-wrapper">
                                                    @foreach ($portfolio->gallery as $galleryImage)
                                                        <div class="swiper-slide">
                                                            <a href="{{ asset('storage/' . $galleryImage) }}"
                                                                class="glightbox"
                                                                data-gallery="gallery-{{ $portfolio->id }}"
                                                                data-title="{{ $portfolio->title }} - Gallery Image">
                                                                <img src="{{ asset('storage/' . $galleryImage) }}"
                                                                    alt="Gallery image" class="img-fluid rounded">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="swiper-pagination"></div>
                                                <div class="swiper-button-prev"></div>
                                                <div class="swiper-button-next"></div>
                                            </div>
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
@endforeach
