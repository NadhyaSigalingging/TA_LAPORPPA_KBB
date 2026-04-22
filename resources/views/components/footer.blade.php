<footer class="lp-footer">
    <div class="footer-top">
        <div class="footer-brand">
            <div class="footer-brand-logo">
                Lapor<span class="accent">PPA</span><span class="muted">·KBB</span>
            </div>
            <p class="footer-brand-desc">
                Sistem pelaporan online kekerasan perempuan dan anak
                Kabupaten Bandung Barat yang resmi, aman, dan terpercaya.
            </p>
            <div class="footer-social-grid">
                <a href="https://www.instagram.com/dp2kbp3akbb" target="_blank" rel="noopener" class="footer-social-link" title="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com/dp2kbp3akbb" target="_blank" rel="noopener" class="footer-social-link" title="X (Twitter)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                    </svg>
                </a>
                <a href="https://www.tiktok.com/@dp2kbp3akbb" target="_blank" rel="noopener" class="footer-social-link" title="TikTok">
                    <i class="fab fa-tiktok"></i>
                </a>
                <a href="https://web.facebook.com/dp2kbp3akbb" target="_blank" rel="noopener" class="footer-social-link" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.youtube.com/@dp2kbp3akbb" target="_blank" rel="noopener" class="footer-social-link" title="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
        </div>

        <div class="footer-divider"></div>

        <div class="footer-col">
            <div class="footer-col-heading">Menu</div>
            <ul class="footer-links-list">
                <li><a href="{{ url('user/home') }}#beranda"><i class="fas fa-chevron-right"></i> Beranda</a></li>
                <li><a href="{{ url('user/home') }}#mengapa-melapor"><i class="fas fa-chevron-right"></i> Mengapa Melapor?</a></li>
                <li><a href="{{ url('user/home') }}#cara-melapor"><i class="fas fa-chevron-right"></i> Cara Melapor</a></li>
                <li><a href="{{ url('user/home') }}#jenis-kekerasan"><i class="fas fa-chevron-right"></i> Jenis Kekerasan</a></li>
                <li><a href="{{ url('user/home') }}#kerahasiaan"><i class="fas fa-chevron-right"></i> Kerahasiaan</a></li>
                {{ $extraLinks ?? '' }}
            </ul>
        </div>

        <div class="footer-divider"></div>

        <div class="footer-col">
            <div class="footer-col-heading">Hubungi Kami</div>
            <ul class="footer-contact-list">
                <li>
                    <div class="fc-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="fc-text">
                        <span class="fc-label">Hotline</span>
                        <span class="fc-val"><a href="tel:+6281323222120">0813-2322-2120</a></span>
                    </div>
                </li>
                <li>
                    <div class="fc-icon"><i class="fas fa-envelope"></i></div>
                    <div class="fc-text">
                        <span class="fc-label">Email</span>
                        <span class="fc-val"><a href="mailto:dp2kbp3a.kbb@gmail.com">dp2kbp3a.kbb@gmail.com</a></span>
                    </div>
                </li>
                <li>
                    <div class="fc-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="fc-text">
                        <span class="fc-label">Alamat</span>
                        <span class="fc-val">Jl. Padalarang - Cisarua, Komplek Pemda KBB, Ngamprah, Jawa Barat</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <span class="footer-copy">
            © {{ date('Y') }} <strong>DP2KBP3A Kabupaten Bandung Barat</strong>. Hak cipta dilindungi.
        </span>
        <span class="footer-badge">
            <i class="fas fa-shield-alt"></i> Layanan Resmi Pemerintah Daerah
        </span>
    </div>
</footer>