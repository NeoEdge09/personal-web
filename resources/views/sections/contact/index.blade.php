    <section class="contact-section section-block" id="contact-section">
        <div class="section-title">
            <h2>Get in Touch</h2>
            <p class="lead">
                Duis aute irure dolor in reprehen pteur sint
                occaecat cupidatat non proident, sunt in culim id
                est.
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
                        Bardeshi, Amin Bazar, New York
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
                    <a href="#">+01234 567 890</a>
                </div>
            </div>
            <div class="col-lg-4 d-flex justify-content-xxl-center align-items-xl-center" data-aos="fade-down"
                data-aos-duration="1000" data-aos-delay="400">
                <div class="icon-box">
                    <i class="pe-7s-mail"></i>
                </div>
                <div class="content-wrapper">
                    <h4>Email</h4>
                    <a href="#">hello@poriweb.com</a>
                </div>
            </div>
        </div>
        <!-- .row -->

        <div class="row">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="600">
                <div class="map-wrapper" id="mapwrapper"></div>
            </div>
            <div class="col-lg-6 form-block" data-aos="fade-right" data-aos-duration="1500" data-aos-delay="1100">
                <h3>Write me a message</h3>
                <div class="form-message">
                    <p></p>
                </div>
                <form class="row g-3" id="fungi-contact" method="POST"
                    action="https://ethemestudio.com/demo/fungi/12_home_vcard/php/form-handler.php">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="inputName" class="form-label visually-hidden">Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Name*"
                                name="inputName" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="inputEmail" class="form-label visually-hidden">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="inputEmail"
                                placeholder="Email*" required />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="inputMessage" class="form-label visually-hidden">Message</label>
                        <textarea class="form-control mb-3" id="inputMessage" name="inputMessage" placeholder="Your message here*" required></textarea>
                        <button type="submit" class="btn btn-main" name="submit">
                            Send Message
                        </button>
                    </div>
                </form>
                <!-- .row -->
            </div>
        </div>
        <!-- .row -->
    </section>
