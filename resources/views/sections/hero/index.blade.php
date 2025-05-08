<section class="hero-area py-3" id="hero-area">
    <div class="hero-content d-flex justify-content-center">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-xl-10 content-block text-center">
                @if (isset($about) && $about->image)
                    <div class="image-wrapper mb-4" data-tilt data-tilt-max="10">
                        <img class="img-fluid rounded-circle shadow" src="{{ asset('storage/' . $about->image) }}"
                            alt="{{ $about->name ?? 'Profile Picture' }}"
                            style="object-fit: cover; width: 180px; height: 180px; border: 4px solid #ffffff;" />
                    </div>
                @endif
                <!-- .image-wrapper -->
                <h1 class="hero-head mb-3">
                    <small class="d-block mb-2" style="color: #bdb9cb;">Hello There, I'm</small>
                    @php
                        $name = $about->name ?? '';
                        $nameArray = explode(' ', $name);
                        $lastName = count($nameArray) > 1 ? end($nameArray) : '';
                        $firstName =
                            count($nameArray) > 1
                                ? implode(' ', array_slice($nameArray, 0, count($nameArray) - 1))
                                : $name;
                    @endphp
                    {{ $firstName }}
                    <strong class="highlight-text">{{ $lastName }}</strong>
                </h1>
                <p class="mb-4 lead">
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $about->base ?? 'Location' }} based
                    <span class="typer" id="main"
                        data-words="{{ isset($about->title) ? implode(',', array_column($about->title, 'value')) : '' }}"
                        data-delay="100" data-deleteDelay="1000"></span>
                    <span class="cursor" data-owner="main"></span>
                </p>
                <div class="link-group">
                    <a class="btn-main" href="#contact-section">
                        <i class="fas fa-paper-plane me-2"></i>Hire Me
                    </a>
                    <a class="btn-ghost ms-3" href="#about-section">
                        <i class="fas fa-user me-2"></i>About Me
                    </a>
                </div>
                <!-- .link-group -->
            </div>
            <!-- .content-block -->
        </div>
        <!-- .row -->
    </div>
    <!-- .hero-content -->
    <div class="scroll-down">
        <a href="#about-section" class="smooth-scroll">
            <i class="fas fa-chevron-down"></i>
        </a>
    </div>
</section>
