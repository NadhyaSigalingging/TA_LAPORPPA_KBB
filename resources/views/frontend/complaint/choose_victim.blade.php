@extends('frontend.layouts.app')
@section('title', 'Pilih Korban - LAPORPPA-KBB')

@section('css')
<style>
    .section-label {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #D891B5;
        margin-bottom: 8px;
    }

    .victim-card {
        border-radius: 18px !important;
        border: 2.5px solid #e0e0e0 !important;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        background: #fff;
        animation: fadeUp 0.5s ease both;
    }
    .victim-card:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 16px 40px rgba(0,0,0,0.13) !important;
        border-color: #D891B5 !important;
    }
    .victim-card.selected {
        border-color: #D891B5 !important;
        box-shadow: 0 0 0 4px rgba(216,145,181,0.25), 0 12px 32px rgba(216,145,181,0.25) !important;
        transform: translateY(-4px) !important;
        background: #fffafd !important;
    }

    .check-badge {
        position: absolute;
        top: 16px; right: 16px;
        width: 32px; height: 32px;
        border-radius: 50%;
        background: #D891B5;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 14px;
        opacity: 0;
        transform: scale(0.5);
        transition: all 0.25s ease;
        z-index: 2;
    }
    .victim-card.selected .check-badge {
        opacity: 1;
        transform: scale(1);
    }

    .victim-icon {
        width: 88px; height: 88px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 36px;
        margin: 0 auto 20px;
        transition: transform 0.3s ease;
    }
    .victim-icon.self  { background: linear-gradient(135deg, #E9A5C5, #D891B5); color: white; }
    .victim-icon.other { background: linear-gradient(135deg, #1a1a2e, #16213e); color: white; }
    .victim-card:hover .victim-icon,
    .victim-card.selected .victim-icon { transform: scale(1.1) rotate(-5deg); }

    .victim-tag {
        display: inline-block;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 4px 12px;
        border-radius: 50px;
        margin-bottom: 12px;
    }
    .victim-tag.self  { background: rgba(216,145,181,0.15); color: #B5618E; }
    .victim-tag.other { background: rgba(26,26,46,0.08); color: #1a1a2e; }

    .victim-card h5 { font-size: 18px; font-weight: 700; color: #1a1a2e; margin-bottom: 10px; }
    .victim-card p  { font-size: 13.5px; color: #6c757d; line-height: 1.65; margin: 0; }

    .victim-delay-1 { animation-delay: 0.1s; }
    .victim-delay-2 { animation-delay: 0.25s; }

    .btn-lanjutkan {
        background: linear-gradient(135deg, #D891B5, #B5618E);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 13px 40px;
        font-size: 15px;
        font-weight: 600;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(184,97,142,0.3);
        opacity: 0.5;
        pointer-events: none;
        cursor: not-allowed;
    }
    .btn-lanjutkan.active {
        opacity: 1;
        pointer-events: all;
        cursor: pointer;
    }
    .btn-lanjutkan.active:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(184,97,142,0.45);
    }

    .select-hint { font-size: 13px; color: #aaa; margin-top: 12px; transition: color 0.3s; }
    .select-hint.ready { color: #D891B5; font-weight: 500; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 576px) {
        .victim-icon { width: 72px; height: 72px; font-size: 28px; }
        .victim-card h5 { font-size: 16px; }
    }
</style>
@endsection

@section('content')

<x-hero
    title="Buat Laporan Kekerasan"
    subtitle="Isi dengan informasi yang jelas dan lengkap untuk membantu proses penanganan"
/>

<div class="container pb-5">

    <div class="text-center mb-5" style="animation: fadeUp 0.6s ease both;">
        <div class="section-label">Langkah 1 dari 2</div>
        <h2 class="fw-bold mb-2" style="color:#1a1a2e; font-size:clamp(20px,3vw,28px);">
            Siapa Korbannya?
        </h2>
        <p class="text-muted" style="font-size:15px;">
            Pilih salah satu opsi di bawah ini untuk melanjutkan
        </p>
    </div>

    <div class="row justify-content-center g-4 mb-5">

        <div class="col-12 col-sm-10 col-md-5">
            <div class="card victim-card victim-delay-1 h-100 text-center p-4 p-md-5"
                 id="card-self"
                 onclick="selectVictim('self', this)">
                <div class="check-badge"><i class="fas fa-check"></i></div>
                <div class="victim-icon self mx-auto">
                    <i class="fas fa-user"></i>
                </div>
                <div class="victim-tag self mb-3">Korban Langsung</div>
                <h5>Saya Sendiri</h5>
                <p>Saya sendiri mengalami kekerasan atau pelecehan dan ingin melaporkannya secara langsung</p>
            </div>
        </div>

        <div class="col-12 col-sm-10 col-md-5">
            <div class="card victim-card victim-delay-2 h-100 text-center p-4 p-md-5"
                 id="card-other"
                 onclick="selectVictim('other', this)">
                <div class="check-badge"><i class="fas fa-check"></i></div>
                <div class="victim-icon other mx-auto">
                    <i class="fas fa-users"></i>
                </div>
                <div class="victim-tag other mb-3">Pelapor / Saksi</div>
                <h5>Orang Lain</h5>
                <p>Saya melihat atau mengetahui orang lain mengalami kekerasan dan ingin membantu melaporkan</p>
            </div>
        </div>

    </div>

    <div class="text-center" style="animation: fadeUp 0.6s ease 0.35s both;">
        <button class="btn-lanjutkan" id="continueBtn" onclick="continueReport()">
            Lanjutkan <i class="fas fa-arrow-right ms-2"></i>
        </button>
        <div class="select-hint" id="selectHint">
            Pilih salah satu opsi terlebih dahulu
        </div>
    </div>

</div>

@endsection

@push('script')
<script>
    let selectedVictim = null;

    function selectVictim(type, el) {
        selectedVictim = type;
        document.querySelectorAll('.victim-card').forEach(c => c.classList.remove('selected'));
        el.classList.add('selected');

        const btn  = document.getElementById('continueBtn');
        const hint = document.getElementById('selectHint');
        btn.classList.add('active');

        const label = type === 'self' ? 'Saya Sendiri' : 'Orang Lain';
        hint.textContent = '✓ Anda memilih: ' + label;
        hint.classList.add('ready');
    }

    function continueReport() {
        if (selectedVictim) {
            window.location.href = "{{ route('add_complaint') }}?victim_type=" + selectedVictim;
        }
    }
</script>
@endpush