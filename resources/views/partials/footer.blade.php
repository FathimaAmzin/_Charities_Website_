<!-- Full-Width Pure Black Footer (#000000) -->
<footer class="site-footer">
    <div class="container">
        <div class="row g-4 g-lg-5">
            <!-- Column 1: Organization -->
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ asset('images/logo-sdc.jpg') }}" alt="SDC Charity Logo" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; border: 2px solid var(--secondary-blue);" onerror="this.src='https://ui-avatars.com/api/?name=SDC&background=12345A&color=fff&size=80'">
                    <div>
                        <h4 class="text-white mb-0 fs-5 fw-bold">Social Development Council</h4>
                        <div class="text-blue small fw-semibold">Maligaikadu • Sri Lanka</div>
                    </div>
                </div>
                <p class="text-muted pe-lg-4" style="color: #D0D5DD !important; font-size: 0.92rem; line-height: 1.65;">
                    The Social Development Council (SDC) is a non-governmental humanitarian organization committed to serving vulnerable families through sustainable education, clean water, healthcare access, food relief, and youth empowerment.
                </p>
                <div class="d-flex align-items-center gap-2 mt-4">
                    <a href="https://facebook.com" target="_blank" class="footer-social-btn" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://twitter.com" target="_blank" class="footer-social-btn" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://instagram.com" target="_blank" class="footer-social-btn" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://linkedin.com" target="_blank" class="footer-social-btn" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://youtube.com" target="_blank" class="footer-social-btn" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="col-lg-2 col-md-6 col-6">
                <h5 class="footer-heading">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="fa-solid fa-angle-right small"></i> Home</a></li>
                    <li><a href="{{ route('about') }}"><i class="fa-solid fa-angle-right small"></i> About Us</a></li>
                    <li><a href="{{ route('teams.index') }}"><i class="fa-solid fa-angle-right small"></i> Leadership & Teams</a></li>
                    <li><a href="{{ route('services.index') }}"><i class="fa-solid fa-angle-right small"></i> Services</a></li>
                    <li><a href="{{ route('courses.index') }}"><i class="fa-solid fa-angle-right small"></i> Vocational Courses</a></li>
                    <li><a href="{{ route('campaigns.index') }}"><i class="fa-solid fa-angle-right small"></i> Campaigns</a></li>
                    <li><a href="{{ route('gallery.index') }}"><i class="fa-solid fa-angle-right small"></i> Gallery</a></li>
                </ul>
            </div>

            <!-- Column 3: Useful Links -->
            <div class="col-lg-3 col-md-6 col-6">
                <h5 class="footer-heading">Useful Links</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('news.index') }}"><i class="fa-solid fa-angle-right small"></i> News & Events</a></li>
                    <li><a href="{{ route('contact') }}"><i class="fa-solid fa-angle-right small"></i> Contact Us</a></li>
                    <li><a href="{{ route('donate') }}"><i class="fa-solid fa-angle-right small"></i> Donate Now</a></li>
                    <li><a href="{{ route('volunteer.register') }}"><i class="fa-solid fa-angle-right small"></i> Volunteer Registration</a></li>
                    @guest
                        <li><a href="{{ route('login') }}"><i class="fa-solid fa-angle-right small"></i> Member Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa-solid fa-angle-right small"></i> Join as Donor</a></li>
                    @endguest
                </ul>
            </div>

            <!-- Column 4: Contact Information -->
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Contact Information</h5>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <div>
                        <span class="text-white fw-semibold d-block">Headquarters:</span>
                        <span>Main Street, Maligaikadu West, Eastern Province, Sri Lanka</span>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <div>
                        <span class="text-white fw-semibold d-block">Official Email:</span>
                        <a href="mailto:info@sdcmksl.org" style="color: #D0D5DD;">info@sdcmksl.org</a>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <div>
                        <span class="text-white fw-semibold d-block">Phone:</span>
                        <a href="tel:+94672229180" style="color: #D0D5DD;">+94 (0) 67 222 9180</a>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-clock"></i>
                    <div>
                        <span class="text-white fw-semibold d-block">Office Hours:</span>
                        <span>Monday – Friday: 8:30 AM – 5:00 PM (GMT+5:30)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright Bar -->
    <div class="footer-bottom-bar">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <div>
                &copy; {{ date('Y') }} <strong>Social Development Council Maligaikadu Sri Lanka</strong> (SDC). All rights reserved.
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('about') }}">About SDC</a>
                <span class="text-muted">&bull;</span>
                <a href="{{ route('contact') }}">Privacy Policy</a>
                <span class="text-muted">&bull;</span>
                <a href="{{ route('contact') }}">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>
