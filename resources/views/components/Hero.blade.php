@props([
    'title',
    'subtitle' => null,
])

<div class="lapor-hero">
    <h1>{{ $title }}</h1>
    @if($subtitle)
        <p>{{ $subtitle }}</p>
    @endif
</div>

@once
@push('css')
<style>
    .lapor-hero {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        padding: 50px 20px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
    }
    .lapor-hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 260px; height: 260px;
        border-radius: 50%;
        background: rgba(216,145,181,0.12);
        pointer-events: none;
    }
    .lapor-hero::after {
        content: '';
        position: absolute;
        bottom: -50px; left: -50px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(216,145,181,0.08);
        pointer-events: none;
    }
    .lapor-hero h1 {
        position: relative;
        z-index: 1;
        font-size: clamp(22px, 3vw, 30px);
        font-weight: 700;
        color: #fff;
        margin-bottom: 10px;
        animation: fadeUp 0.6s ease both;
    }
    .lapor-hero p {
        position: relative;
        z-index: 1;
        font-size: 15px;
        color: rgba(255,255,255,0.72);
        font-weight: 300;
        margin: 0;
        animation: fadeUp 0.6s ease 0.15s both;
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush
@endonce