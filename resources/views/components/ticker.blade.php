@section('ticker')
<div class="ticker-wrap">
    <div class="ticker-track">
        @php
            $items = [
                'Laporan Aman & Rahasia',
                'Layanan 24 Jam / 7 Hari',
                'DP2KBP3A Kab. Bandung Barat',
                'Lindungi Hak Perempuan & Anak',
                'Berani Lapor, Berani Berubah',
                'Hotline: 0813-2322-2120',
                'Gratis & Tanpa Biaya',
            ];
        @endphp
        @for ($i = 0; $i < 4; $i++)
            @foreach ($items as $item)
                <span class="ticker-item">{{ $item }} <span class="ticker-sep">✦</span></span>
            @endforeach
        @endfor
    </div>
</div>
<div class="ticker-spacer"></div>
@endsection