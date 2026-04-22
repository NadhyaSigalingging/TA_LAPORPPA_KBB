@props(['guest' => false])

<section id="cara-melapor" class="lp-section">
    <div class="section-inner">
        <div class="steps-layout">

            {{-- KIRI: Langkah-langkah --}}
            <div>
                <div class="section-eyebrow reveal">
                    <span class="section-eyebrow-line"></span>
                    <span class="section-eyebrow-text">Panduan Pelaporan</span>
                </div>
                <h2 class="section-title reveal">Cara <span class="accent">Melapor</span></h2>

                @if($guest)
                    {{-- Teks untuk halaman publik / belum login --}}
                    <p class="section-subtitle reveal" style="margin-bottom:36px;">
                        Proses pelaporan dirancang sesederhana mungkin. Ikuti langkah-langkah
                        berikut untuk membuat laporan secara online.
                    </p>
                    <div class="steps-list">
                        <div class="step-item reveal">
                            <div class="step-num">1</div>
                            <div class="step-body">
                                <div class="step-title">Buat Akun / Masuk</div>
                                <p class="step-desc">Daftarkan diri Anda dengan data yang valid. Akun Anda dilindungi enkripsi dan hanya Anda yang bisa mengaksesnya.</p>
                            </div>
                        </div>
                        <div class="step-item reveal reveal-delay-1">
                            <div class="step-num">2</div>
                            <div class="step-body">
                                <div class="step-title">Pilih Status Korban</div>
                                <p class="step-desc">Pilih apakah Anda melapor untuk diri sendiri (<em>"Korban adalah saya"</em>) atau mewakili orang lain yang membutuhkan pertolongan.</p>
                            </div>
                        </div>
                        <div class="step-item reveal reveal-delay-2">
                            <div class="step-num">3</div>
                            <div class="step-body">
                                <div class="step-title">Isi Formulir Laporan</div>
                                <p class="step-desc">Ceritakan kronologi kejadian, jenis kekerasan yang dialami, lokasi, dan informasi pelaku jika diketahui. Sertakan bukti pendukung (foto, video, atau dokumen) bila ada.</p>
                            </div>
                        </div>
                        <div class="step-item reveal reveal-delay-3">
                            <div class="step-num">4</div>
                            <div class="step-body">
                                <div class="step-title">Kirim Laporan</div>
                                <p class="step-desc">Setelah memastikan semua informasi benar, kirimkan laporan. Anda akan mendapat nomor referensi untuk memantau perkembangan kasus melalui akun Anda.</p>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Teks untuk halaman user yang sudah login --}}
                    <p class="section-subtitle reveal" style="margin-bottom:36px;">
                        Proses pelaporan dirancang sesederhana mungkin. Anda sudah masuk — ikuti
                        langkah-langkah berikut untuk membuat laporan baru.
                    </p>
                    <div class="steps-list">
                        <div class="step-item reveal">
                            <div class="step-num">1</div>
                            <div class="step-body">
                                <div class="step-title">Pilih Status Korban</div>
                                <p class="step-desc">Pilih apakah Anda melapor untuk diri sendiri (<em>"Korban adalah saya"</em>) atau mewakili orang lain yang membutuhkan pertolongan.</p>
                            </div>
                        </div>
                        <div class="step-item reveal reveal-delay-1">
                            <div class="step-num">2</div>
                            <div class="step-body">
                                <div class="step-title">Isi Formulir Laporan</div>
                                <p class="step-desc">Ceritakan kronologi kejadian, jenis kekerasan yang dialami, lokasi, dan informasi pelaku jika diketahui. Sertakan bukti pendukung bila ada.</p>
                            </div>
                        </div>
                        <div class="step-item reveal reveal-delay-2">
                            <div class="step-num">3</div>
                            <div class="step-body">
                                <div class="step-title">Kirim Laporan</div>
                                <p class="step-desc">Setelah memastikan semua informasi benar, kirimkan laporan. Anda akan mendapat nomor referensi untuk memantau perkembangan kasus.</p>
                            </div>
                        </div>
                        <div class="step-item reveal reveal-delay-3">
                            <div class="step-num">4</div>
                            <div class="step-body">
                                <div class="step-title">Pantau Perkembangan</div>
                                <p class="step-desc">Gunakan fitur <strong>Lacak Laporan</strong> atau cek <strong>Riwayat</strong> di akun Anda untuk memantau status laporan secara real-time.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- KANAN: Panel info --}}
            <div class="steps-panel reveal">
                <div class="steps-info-card">
                    <div class="steps-info-card-title">Butuh Bantuan <span>Segera?</span></div>
                    <p>Jika Anda atau orang lain dalam bahaya, segera hubungi layanan darurat. Jangan tunggu — keselamatan Anda adalah prioritas utama kami.</p>
                    <div class="steps-hotline">
                        <div class="steps-hotline-icon"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <div class="steps-hotline-label">Hotline DP2KBP3A KBB</div>
                            <div class="steps-hotline-num">0813-2322-2120</div>
                        </div>
                    </div>
                </div>

                <div class="steps-requirement-card">
                    <div class="steps-req-title">Yang Perlu Disiapkan</div>
                    <ul class="req-list">
                        <li><i class="fas fa-check-circle"></i> Identitas diri (KTP/Kartu Pelajar)</li>
                        <li><i class="fas fa-check-circle"></i> Kronologi kejadian secara lengkap</li>
                        <li><i class="fas fa-check-circle"></i> Foto/video/bukti pendukung (jika ada)</li>
                        <li><i class="fas fa-check-circle"></i> Data/identitas pelaku (jika diketahui)</li>
                        <li><i class="fas fa-check-circle"></i> Nomor kontak yang bisa dihubungi</li>
                    </ul>

                    {{-- Tombol CTA hanya muncul di halaman user login --}}
                    @unless($guest)
                    <div style="margin-top:20px;">
                        <a href="{{ route('choose_victim') }}" class="btn-cta-primary" style="width:100%;justify-content:center;font-size:13px;padding:13px 20px;">
                            <i class="fas fa-file-alt"></i> Buat Laporan Sekarang
                        </a>
                    </div>
                    @endunless
                </div>
            </div>

        </div>
    </div>
</section>