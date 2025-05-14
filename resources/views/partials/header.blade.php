<header class="site-header" id="site-header">
    <nav class="navbar navbar-expand-xl" id="site-navbar">
        <div class="container">
            @if (isset($siteSettings) && $siteSettings && $siteSettings->logo)
                <a class="navbar-brand" href="#site-header">
                    <img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="Logo" class="img-fluid">
                </a>
            @endif
            <!-- download button -->
            @if (isset($about) && $about && $about->cv)
                <a class="btn btn-main header-btn ms-auto d-xl-none" href="{{ asset('storage/' . $about->cv) }}"
                    target="_blank">Download CV</a>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="bi bi-list"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#site-header"><i
                                class="pe-7s-home"></i><span>Home</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about-section"><i class="pe-7s-user"></i><span>About</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio-section"><i
                                class="pe-7s-portfolio"></i><span>Portfolio</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog-section"><i class="pe-7s-news-paper"></i><span>Blog</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact-section"><i
                                class="pe-7s-mail-open"></i><span>Contact</span></a>
                    </li>
                </ul>
                <!-- .navbar-nav -->
                <ul class="nav-social">
                    @forelse(isset($socialMedia) && $socialMedia ? $socialMedia : [] as $social)
                        <li class="{{ $social->platform ?? '' }}">
                            <a href="{{ $social->url ?? '#' }}" target="_blank" title="{{ $social->name ?? '' }}">
                                <i class="{{ $social->icon ?? 'bi bi-question' }}"></i>
                            </a>
                        </li>
                    @empty
                        <li class="no-social">
                            <span>No social media links available</span>
                        </li>
                    @endforelse
                </ul>
                <!-- .hero-social -->
            </div>
            <!-- .collapse -->

            <!-- download button -->
            @if (isset($about) && $about && $about->cv)
                <a class="btn btn-main header-btn d-none d-xl-flex" href="{{ asset('storage/' . $about->cv) }}"
                    target="_blank">Download CV</a>
            @endif
        </div>
        <!-- .container -->
    </nav>
    <!-- .navbar -->
</header>
