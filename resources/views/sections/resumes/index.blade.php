<section class="resume-section section-block" id="resume-section">
    <div class="section-title">
        <h2>My Resume</h2>
        <p class="lead">
            My educational background and professional experience that have shaped my career path
        </p>
    </div>
    <!-- .section-title -->
    <div class="row">
        <div class="col-lg-6 education-block" data-aos="fade-right" data-aos-duration="1500">
            <h3>My Education</h3>
            <ul>
                @if (isset($myResume->education) && is_array($myResume->education))
                    @foreach ($myResume->education as $education)
                        <li class="d-flex align-items-start">
                            <div class="icon-block">
                                <div class="icon-box">
                                    <i class="pe-7s-study"></i>
                                </div>
                            </div>
                            <div class="content-wrapper">
                                <h4>
                                    {{ $education['title'] }}
                                    <span class="ms-1">{{ $education['year'] }}</span>
                                </h4>
                                <h5>{{ $education['school'] }}</h5>
                                <p>
                                    {{ $education['desc'] }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
        <div class="col-lg-6 education-block" data-aos="fade-right" data-aos-duration="1500" data-aos-delay="400">
            <h3>My Experience</h3>
            <ul>
                @if (isset($myResume->experience) && is_array($myResume->experience))
                    @foreach ($myResume->experience as $experience)
                        <li class="d-flex align-items-start">
                            <div class="icon-block">
                                <div class="icon-box">
                                    <i class="pe-7s-portfolio"></i>
                                </div>
                            </div>
                            <div class="content-wrapper">
                                <h4>
                                    {{ $experience['title'] }}
                                    <span class="ms-1">{{ $experience['year'] }}</span>
                                </h4>
                                <h5>{{ $experience['company'] }}</h5>
                                <p>
                                    {{ $experience['desc'] }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
    <!-- .row -->
</section>

<style>
    .resume-section {
        background-color: var(--dark-mode-background);
    }

    .resume-section:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.1);
        z-index: -1;
        border-radius: 18px;
    }

    .resume-section .section-title h2 {
        color: #fff;
    }

    .resume-section .lead {
        color: #bdb9cb;
    }

    .resume-section h3 {
        color: #fff;
        position: relative;
        padding-bottom: 15px;
    }

    .resume-section h3:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background-color: var(--primary-color);
    }

    .resume-section h4 {
        color: #fff;
        font-size: 21px;
        margin-bottom: 12px;
    }

    .resume-section h4 span {
        font-family: "Open Sans", sans-serif;
        color: var(--primary-color);
        font-size: 70%;
        float: right;
        background: var(--background-color);
        padding: 3px 10px;
        border-radius: 4px;
    }

    .resume-section h5 {
        color: #e0e0e0;
        font-size: 16px;
        text-transform: uppercase;
        margin-bottom: 18px;
    }

    .resume-section p {
        color: #b0aac0;
    }

    .resume-section .icon-box {
        background: var(--background-color);
        color: var(--primary-color);
        border: 2px solid var(--background-color);

        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .resume-section li:hover .icon-box {
        transform: scale(1.1);
        background-color: var(--primary-color);
        color: var(--heading-color);
    }

    .resume-section .content-wrapper {
        background: rgba(255, 255, 255, 0.05);
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .resume-section li:hover .content-wrapper {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }

    .resume-section .icon-box:after {
        background: rgba(255, 255, 255, 0.1);
    }

    /* Media queries to maintain responsiveness */
    @media (max-width: 768px) {
        .resume-section h4 span {
            display: inline-block;
            float: none;
            margin-top: 8px;
        }
    }
</style>
