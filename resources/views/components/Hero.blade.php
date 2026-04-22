@props([
    'title',
    'subtitle' => null,
])

<div class="lapor-hero">
    <div class="lapor-hero-inner">
        <div class="lapor-hero-tag">Layanan Resmi DP2KBP3A</div>
        <h1>{{ $title }}</h1>
        @if($subtitle)
            <p>{{ $subtitle }}</p>
        @endif
    </div>
</div>

@once
@push('css')
<style>
    .lapor-hero {
        background: linear-gradient(135deg, #1E1B4B 0%, #2D1B4E 100%);
        padding: 56px 56px;
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
    }

    /* Dot pattern */
    .lapor-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(212,83,126,0.10) 1.5px, transparent 1.5px);
        background-size: 32px 32px;
        pointer-events: none;
    }

    /* Dekorasi lingkaran kanan atas */
    .lapor-hero::after {
        content: '';
        position: absolute;
        top: -80px; right: -80px;
        width: 320px; height: 320px;
        border-radius: 50%;
        background: rgba(212,83,126,0.10);
        pointer-events: none;
    }

    .lapor-hero-inner {
        position: relative;
        z-index: 1;
        max-width: 640px;
    }

    .lapor-hero-tag {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #E8839F;
        margin-bottom: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        animation: fadeUp 0.5s ease both;
    }
    .lapor-hero-tag::before {
        content: '';
        width: 22px;
        height: 2px;
        background: #D4537E;
        border-radius: 2px;
        flex-shrink: 0;
    }

    .lapor-hero h1 {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: clamp(24px, 3vw, 38px);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #fff;
        line-height: 1.1;
        margin-bottom: 12px;
        animation: fadeUp 0.6s ease 0.08s both;
    }

    .lapor-hero p {
        font-size: 15px;
        color: rgba(255,255,255,0.65);
        font-weight: 400;
        line-height: 1.75;
        margin: 0;
        animation: fadeUp 0.6s ease 0.16s both;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 900px) {
        .lapor-hero { padding: 44px 24px; }
    }
    @media (max-width: 600px) {
        .lapor-hero { padding: 36px 16px; }
    }
</style>
@endpush
@endonce