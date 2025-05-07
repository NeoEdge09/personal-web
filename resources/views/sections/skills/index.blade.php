<!-- filepath: c:\laragon\www\personal-web\resources\views\sections\skills\index.blade.php -->
<section class="skill-section section-block" id="skill-section">
    <div class="section-title">
        <h2>My Skills</h2>
        <p class="text-center mb-5 lead">Swipe to explore my professional competencies</p>
    </div>
    <!-- .section-title -->

    <!-- Swiper Container -->
    <div class="swiper-container skills-swiper">
        <div class="swiper-wrapper">
            @foreach ($mySkills as $skill)
                <div class="swiper-slide">
                    <div class="skill-block" data-aos="fade-up" data-aos-duration="800">
                        <h3 class="skill-title">{{ $skill->title }}</h3>

                        @if (isset($skill->skill_details) && is_array($skill->skill_details))
                            <div class="skill-details">
                                @foreach ($skill->skill_details as $detail)
                                    <div class="skill-item">
                                        <div class="skill-info">
                                            <span class="skill-name">{{ $detail['title'] }}</span>
                                            <span class="skill-percentage">{{ $detail['percentage'] }}%</span>
                                        </div>
                                        <div class="progress skill-progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $detail['percentage'] }}%"
                                                aria-valuenow="{{ $detail['percentage'] }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Add swiper navigation -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>

        <!-- Add swiper pagination -->
        <div class="swiper-pagination"></div>
    </div>
</section>

<style>
    /* Complementary styles to match with your main style.css */
    .skills-swiper {
        padding: 20px 50px 60px;
        overflow: hidden;
    }

    .skill-block {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        padding: 30px;
        height: 100%;
        min-height: 350px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .skill-block:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .skill-title {
        font-size: 22px;
        margin-bottom: 25px;
        color: #fff;
        font-weight: 600;
        text-align: center;
        padding-bottom: 10px;
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
    }

    .skill-item {
        margin-bottom: 20px;
    }

    .skill-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 15px;
    }

    .skill-name {
        font-weight: 500;
        color: #bdb9cb;
    }

    .skill-percentage {
        font-weight: 600;
        color: #fff;
    }

    .skill-progress {
        height: 8px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-bar {
        background: var(--primary-color);
        border-radius: 4px;
        transition: width 1.5s ease-in-out;
    }

    /* Swiper navigation styles */
    .swiper-button-next,
    .swiper-button-prev {
        color: var(--primary-color);
        background: rgba(255, 255, 255, 0.1);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .swiper-button-next:after,
    .swiper-button-prev:after {
        font-size: 18px;
    }

    .swiper-pagination-bullet {
        background: #fff;
        opacity: 0.5;
    }

    .swiper-pagination-bullet-active {
        opacity: 1;
        background: var(--primary-color);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new Swiper('.skills-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                // when window width is >= 768px
                768: {
                    slidesPerView: 2,
                },
                // when window width is >= 1200px
                1200: {
                    slidesPerView: 3,
                }
            }
        });
    });
</script>
