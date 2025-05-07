<section class="contact-section section-block" id="contact-section">
    <div class="section-title">
        <h2>Get in Touch</h2>
        <p class="lead">
            I would love to hear from you! Whether you have a question, a project in mind, or just want to say hello,
            feel free to reach out. I'm here to help and connect with you.
        </p>
    </div>
    <!-- .section-title -->

    <div class="row contact-options">
        <div class="col-lg-4 d-flex justify-content-xxl-center align-items-xl-center" data-aos="fade-down"
            data-aos-duration="1000">
            <div class="icon-box">
                <i class="pe-7s-map-marker"></i>
            </div>
            <div class="content-wrapper">
                <h4>Address</h4>
                <address>
                    {{ $about->address ?? 'N/A' }}
                </address>
            </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-xxl-center align-items-xl-center" data-aos="fade-down"
            data-aos-duration="1000" data-aos-delay="200">
            <div class="icon-box">
                <i class="pe-7s-call"></i>
            </div>
            <div class="content-wrapper">
                <h4>Phone</h4>
                {{ $about->phone ?? 'N/A' }}
            </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-xxl-center align-items-xl-center" data-aos="fade-down"
            data-aos-duration="1000" data-aos-delay="400">
            <div class="icon-box">
                <i class="pe-7s-mail"></i>
            </div>
            <div class="content-wrapper">
                <h4>Email</h4>
                {{ $about->email ?? 'N/A' }}
            </div>
        </div>
    </div>
    <!-- .row -->

    <!-- Rest of the code remains unchanged -->
