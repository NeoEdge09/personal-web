            <footer class="site-footer" id="site-footer">
                <div class="footer-main">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-lg-6 text-center branding-block">
                            @if (isset($siteSettings) && $siteSettings && $siteSettings->logo)
                                <a class="footer-brand" href="#">
                                    <img src="{{ asset('storage/' . $siteSettings->logo) }}" alt="Logo"
                                        class="img-fluid">
                                </a>
                            @else
                            @endif
                            @if (isset($siteSettings) && $siteSettings && $siteSettings->description)
                                <p>
                                    {{ $siteSettings->description }}
                                </p>
                            @endif
                            <ul class="list-inline footer-social">
                                @forelse($socialMedia as $social)
                                    <li class="list-inline-item">
                                        <a href="{{ $social->url }}" target="_blank" title="{{ $social->name }}">
                                            <i class="{{ $social->icon }}"></i>
                                        </a>
                                    </li>
                                @empty
                                    <!-- No social links available -->
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!-- .row -->
                </div>
                <!-- .footer-main -->
                <div class="back-to-top">
                    <a href="#site-header"><i class="bi bi-box-arrow-up"></i></a>
                </div>
                <div class="row footer-bottom">
                    <div class="col-md-6">
                        <p>
                        <p>© {{ date('Y') }} {{ $siteSettings->site_name ?? 'Personal Web' }} - All rights reserved
                        </p>

                        </p>
                    </div>

                </div>
                <!-- .footer-bottom -->
            </footer>
