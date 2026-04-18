@extends('auth.admin.layouts.main')
@section('title', 'Dashboard | Laporppa')

@section('content')

    <style>
        /* ================= WRAPPER ================= */
        .dashboard-wrapper {
            width: 100%;
        }

        /* TITLE */
        .dashboard-title {
            font-weight: 700;
            color: #0B3C91;
        }

        .dashboard-subtitle {
            color: #6b7280;
            margin-bottom: 20px;
        }

        /* ================= CARD ================= */
        .card-modern {
            background: white;
            border-radius: 18px;

            /* 🔥 FIX UTAMA */
            border: 1px solid #e5e7eb;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.04);

            transition: 0.3s;
        }

        .card-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        }

        /* HEADER */
        .card-header-modern {
            background: linear-gradient(135deg, #0B3C91, #1E5ED7);
            padding: 18px;
            color: white;
        }

        /* BODY */
        .card-body-modern {
            padding: 20px;
            text-align: center;
        }

        /* AVATAR */
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }

        /* ================= STAT ================= */
        .stat-card {
            background: white;
            border-radius: 15px;

            /* 🔥 FIX */
            border: 1px solid #e5e7eb;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.04);

            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;

            transition: 0.25s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
        }

        /* TEXT */
        .stat-title {
            color: #64748b;
            font-size: 13px;
        }

        .stat-value {
            color: #0B3C91;
            font-weight: 700;
        }

        /* ICON */
        .icon-box {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, #1E5ED7, #0B3C91);
            border-radius: 10px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* FILTER */
        .year-filter {
            max-width: 200px;
        }

        /* CHART */
        .chart-card {
            margin-top: 15px;
            padding: 25px;

            /* 🔥 FIX */
            border: 1px solid #e5e7eb;
        }

        .chart-title {
            font-weight: 600;
            color: #0B3C91;
        }

        /* ================= DARK MODE ================= */
        body.dark-mode .card-modern,
        body.dark-mode .stat-card,
        body.dark-mode .chart-card {
            background: #1e293b;
            border: 1px solid #334155;
            /* 🔥 penting */
        }

        body.dark-mode .dashboard-title {
            color: #e5e7eb;
        }

        body.dark-mode .dashboard-subtitle {
            color: #94a3b8;
        }

        body.dark-mode .stat-title {
            color: #cbd5f5;
        }

        body.dark-mode .stat-value {
            color: #60a5fa;
        }

        body.dark-mode .chart-title {
            color: #e5e7eb;
        }
    </style>

    <div class="dashboard-wrapper pb-5">

        <!-- HEADER -->
        <h3 class="dashboard-title">Dashboard</h3>
        <p class="dashboard-subtitle">
            Ringkasan sistem pengaduan masyarakat
        </p>

        <!-- ALERT -->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm">
                {{$message}}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">

            <!-- PROFILE -->
            <div class="col-xl-4">
                <div class="card-modern">

                    <div class="card-header-modern">
                        <h5 style="margin:0;">Selamat Datang 👋</h5>
                        <small>Sistem Pengaduan Masyarakat</small>
                    </div>

                    <div class="card-body-modern">
                        <img src="{{url('avatar/' . Auth::user()->photo)}}" class="avatar">

                        <h5>{{Auth::user()->username}}</h5>
                        <small style="color:#6b7280;">Administrator</small>
                    </div>

                </div>
            </div>

            <!-- STATS -->
            <div class="col-xl-8">
                <div class="row g-3">

                    @php
                        $cards = [
                            ['title' => 'Pengaduan', 'value' => $complaints, 'icon' => 'bx-copy-alt'],
                            ['title' => 'Belum Diproses', 'value' => $unprocessed, 'icon' => 'bx-time'],
                            ['title' => 'Proses', 'value' => $process, 'icon' => 'bx-loader'],
                            ['title' => 'Selesai', 'value' => $finished, 'icon' => 'bx-check'],
                            ['title' => 'User', 'value' => $users, 'icon' => 'bx-user'],
                            ['title' => 'Masyarakat', 'value' => $society, 'icon' => 'bx-group'],
                        ];
                    @endphp

                    @foreach($cards as $c)
                        <div class="col-md-4">
                            <div class="stat-card">

                                <div>
                                    <small style="color:#64748b;">
                                        {{$c['title']}}
                                    </small>
                                    <h4 style="margin:0; color:#0B3C91;">
                                        {{$c['value']}}
                                    </h4>
                                </div>

                                <div class="icon-box">
                                    <i class="bx {{$c['icon']}}"></i>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

        <!-- FILTER -->
        <form method="GET" class="mt-4 mb-3">
            <select name="year" class="form-select year-filter shadow-sm" onchange="this.form.submit()">

                @for ($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor

            </select>
        </form>

        <!-- CHART -->
        <div class="card-modern chart-card">

            <h5 class="chart-title">
                Grafik Pengaduan Tahun {{ $year }}
            </h5>

            <div style="height:380px;">
                <canvas id="chartPengaduan"></canvas>
            </div>

        </div>

    </div>

@endsection


@push('script')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const ctx = document.getElementById('chartPengaduan').getContext('2d');

            // GRADIENT
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, "#1E5ED7");
            gradient.addColorStop(1, "#60A5FA");

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Jumlah Pengaduan',
                        data: {!! json_encode($data) !!},
                        backgroundColor: gradient,
                        borderRadius: 12,
                        barThickness: 45,
                        hoverBackgroundColor: "#0B3C91"
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            labels: {
                                color: '#374151',
                                font: { size: 13, weight: '600' }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0B3C91',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 12,
                            cornerRadius: 10
                        }
                    },

                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#6b7280' }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { color: '#6b7280', stepSize: 1 },
                            grid: {
                                color: '#e5e7eb',
                                borderDash: [4, 4]
                            }
                        }
                    },

                    animation: {
                        duration: 1200,
                        easing: 'easeOutQuart'
                    }
                }
            });

        });
    </script>

@endpush