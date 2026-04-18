@props(['status'])

@php
    $config = match((string)$status) {
        '0'                     => ['label' => 'Menunggu Verifikasi', 'bg' => '#fff3cd', 'color' => '#856404', 'icon' => 'fa-clock'],
        '1', 'process'          => ['label' => 'Diproses',            'bg' => '#d1ecf1', 'color' => '#0c5460', 'icon' => 'fa-spinner'],
        '2', 'finished'         => ['label' => 'Selesai',             'bg' => '#d1e7dd', 'color' => '#0f5132', 'icon' => 'fa-check-double'],
        '3', 'rejected'         => ['label' => 'Ditolak',             'bg' => '#f8d7da', 'color' => '#842029', 'icon' => 'fa-times-circle'],
        default                 => ['label' => 'Tidak Diketahui',     'bg' => '#e2e3e5', 'color' => '#41464b', 'icon' => 'fa-question'],
    };
@endphp

<span style="
    background: {{ $config['bg'] }};
    color: {{ $config['color'] }};
    padding: 4px 12px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
">
    <i class="fas {{ $config['icon'] }}" style="font-size:11px;"></i>
    {{ $config['label'] }}
</span>