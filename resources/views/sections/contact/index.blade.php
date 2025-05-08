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
            <div class="content-wrapper" style="color: #fff;">
                <h4 style="color: #fff;">Address</h4>
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
            <div class="content-wrapper" style="color: #fff;">
                <h4 style="color: #fff;">Phone</h4>
                {{ $about->phone ?? 'N/A' }}
            </div>
        </div>
        <div class="col-lg-4 d-flex justify-content-xxl-center align-items-xl-center" data-aos="fade-down"
            data-aos-duration="1000" data-aos-delay="400">
            <div class="icon-box">
                <i class="pe-7s-mail"></i>
            </div>
            <div class="content-wrapper" style="color: #fff;">
                <h4 style="color: #fff;">Email</h4>
                {{ $about->email ?? 'N/A' }}
            </div>
        </div>
    </div>
    <!-- .row -->

    <!-- Rest of the code remains unchanged -->
    <div class="row">
        <div class="col-lg-12 form-block  p-4 rounded" data-aos="fade-right" data-aos-duration="1500"
            data-aos-delay="1100" style="background-color:  var(--dark-mode-background);">
            <h3 class="text-light">Write me a message</h3>
            <div id="form-response" class="alert d-none"></div>
            <form class="row g-3" id="contact-form" method="POST" action="/contact">
                @csrf
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <label for="inputName" class="form-label visually-hidden">Name</label>
                        <input type="text" class="form-control  border-secondary" id="inputName" placeholder="Name*"
                            name="name" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <label for="inputEmail" class="form-label visually-hidden">Email</label>
                        <input type="email" class="form-control  border-secondary" id="inputEmail" name="email"
                            placeholder="Email*" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <label for="inputSubject" class="form-label visually-hidden">Subject</label>
                        <input type="text" class="form-control  border-secondary" id="inputSubject" name="subject"
                            placeholder="Subject*" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <label for="inputPhone" class="form-label visually-hidden">Phone</label>
                        <input type="text" class="form-control  border-secondary" id="inputPhone" name="phone"
                            placeholder="Phone " />
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="inputMessage" class="form-label visually-hidden">Message</label>
                    <textarea class="form-control mb-3  border-secondary" id="inputMessage" name="message" placeholder="Your message here*"
                        required></textarea>
                    <button type="submit" class=" btn-main" id="contact-submit">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
        <div id="mapwrapper"></div>
    </div>

</section>
