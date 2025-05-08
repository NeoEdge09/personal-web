<section class="about-section section-block" id="about-section" data-aos="fade-up">
    <div class="row">
        <div class="col-xl-6 image-block" data-aos="fade-right" data-aos-delay="200" data-aos-duration="2000">
            <div class="img-wrapper about-img-wrap" data-tilt data-tilt-max="10"
                style="overflow: hidden; position: relative; padding-bottom: 100%; height: 0;">
                <img class="about-img-1 img-fluid"
                    src="{{ asset('storage/' . ($about->image_2 ?? ($about->image ?? 'default-image.jpg'))) }}"
                    alt="about image"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" />
            </div>
        </div>
        <div class="col-xl-6 content-block" data-aos="fade-right" data-aos-delay="400" data-aos-duration="2000">
            <h2>
                <span>About Me</span>{{ $about->main_title ?? '' }}
            </h2>
            <p style="color:#fff;">{{ $about->desc ?? 'Information not available.' }}</p>
            <div class="personal-details row">
                <div class="col-md-6">
                    <ul class="personal-info">
                        <li>
                            <h4>Name</h4>
                            <p>{{ $about->name ?? 'N/A' }}</p>
                        </li>
                        <li>
                            <h4>Email</h4>
                            <p>{{ $about->email ?? 'N/A' }}</p>
                        </li>
                        <li>
                            <h4>Phone</h4>
                            <p>{{ $about->phone ?? 'N/A' }}</p>
                        </li>
                    </ul>
                    <!-- .personal-info -->
                </div>
                <!-- .col-md-6 -->
                <div class="col-md-6">
                    <ul class="personal-info">
                        <li>
                            <h4>Age</h4>
                            <p>{{ isset($about->birth_date) ? $about->birth_date->age . ' Years' : 'N/A' }}</p>
                        </li>
                        <li>
                            <h4>Education</h4>
                            <p>{{ $about->education ?? 'N/A' }}</p>
                        </li>
                        <li>
                            <h4>Freelance</h4>
                            <p>{{ ucfirst($about->freelance_status ?? 'N/A') }}</p>
                        </li>
                    </ul>
                    <!-- .personal-info -->
                </div>
                <!-- .col-md-6 -->
            </div>
            <!-- .personal-details -->
            @if (isset($about->cv) && $about->cv)
                <a class="btn-main" href="{{ asset('storage/' . $about->cv) }}" target="_blank">Download CV</a>
            @endif
        </div>
    </div>
    <!-- .row -->
</section>
