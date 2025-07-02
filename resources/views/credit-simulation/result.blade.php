@extends('layouts.app')

@section('title', 'Hasil Simulasi Kredit')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-electric-blue to-fresh-green py-12 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Hasil Simulasi Kredit</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Detail perhitungan kredit untuk pembelian motor Honda
            </p>
        </div>
    </section>

    <!-- Result Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <!-- Simulation Summary -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6 mb-8">
                    <div class="flex items-center">
                        @if($simulation->motor->main_image)
                            <div class="w-24 h-24 rounded-xl overflow-hidden mr-4">
                                <img src="{{ asset('storage/' . $simulation->motor->main_image) }}"
                                     alt="{{ $simulation->motor->name }}"
                                     class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div>
                            <h2 class="font-heading text-xl md:text-2xl text-gray-800">{{ $simulation->motor->name }}</h2>
                            <p class="text-gray-600">{{ $simulation->leasingCompany->name }}</p>
                        </div>
                    </div>

                    <div class="text-center">
                        <p class="text-gray-600">Angsuran Bulanan</p>
                        <p class="font-heading text-3xl text-honda-red">{{ $simulation->formatted_monthly_payment }}</p>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Financing Details -->
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-5">
                        <h3 class="font-semibold text-gray-700 mb-3">Rincian Pembiayaan</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Harga Motor</span>
                                <span class="font-medium">Rp {{ number_format($simulation->motor_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Uang Muka</span>
                                <span class="font-medium">Rp {{ number_format($simulation->down_payment, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pinjaman</span>
                                <span class="font-medium">Rp {{ number_format($simulation->motor_price - $simulation->down_payment, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Bunga ({{ $simulation->interest_rate }}%)</span>
                                <span class="font-medium">Rp {{ number_format($simulation->total_interest, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Biaya Admin</span>
                                <span class="font-medium">Rp {{ number_format($simulation->admin_fee, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Asuransi</span>
                                <span class="font-medium">Rp {{ number_format($simulation->insurance_fee, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Biaya Lainnya</span>
                                <span class="font-medium">Rp {{ number_format($simulation->additional_costs, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-gray-200 font-bold">
                                <span>Total Pembayaran</span>
                                <span class="text-honda-red">{{ $simulation->formatted_total_payment }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Installment Details -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-5">
                        <h3 class="font-semibold text-gray-700 mb-3">Detail Angsuran</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Jumlah Angsuran</span>
                                <span class="font-medium">{{ $simulation->tenor_months }} Bulan</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Angsuran Pokok</span>
                                <span class="font-medium">Rp {{ number_format(($simulation->motor_price - $simulation->down_payment) / $simulation->tenor_months, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Angsuran Bunga</span>
                                <span class="font-medium">Rp {{ number_format($simulation->total_interest / $simulation->tenor_months, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-gray-200 font-bold">
                                <span>Angsuran per Bulan</span>
                                <span class="text-honda-red">{{ $simulation->formatted_monthly_payment }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('inquiry.create') }}?simulation={{ $simulation->id }}"
                               class="block w-full text-center bg-gradient-to-r from-honda-red to-vibrant-orange hover:from-red-600 hover:to-orange-600 text-white py-3 px-4 rounded-lg font-bold">
                                Ajukan Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Payment Schedule -->
                <div class="mb-8">
                    <h3 class="font-semibold text-gray-700 mb-4">Jadwal Angsuran (3 Bulan Pertama)</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-max">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-gray-600">Bulan</th>
                                <th class="px-4 py-2 text-right text-gray-600">Pokok</th>
                                <th class="px-4 py-2 text-right text-gray-600">Bunga</th>
                                <th class="px-4 py-2 text-right text-gray-600">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 1; $i <= min(3, $simulation->tenor_months); $i++)
                                <tr class="border-b border-gray-200">
                                    <td class="px-4 py-3">Angsuran ke-{{ $i }}</td>
                                    <td class="px-4 py-3 text-right">Rp {{ number_format(($simulation->motor_price - $simulation->down_payment) / $simulation->tenor_months, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right">Rp {{ number_format($simulation->total_interest / $simulation->tenor_months, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right font-bold">{{ $simulation->formatted_monthly_payment }}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Leasing Comparison -->
            @if(count($comparisons) > 0)
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                    <h3 class="font-heading text-xl text-gray-800 mb-6">Perbandingan dengan Leasing Lain</h3>
                    <p class="text-gray-600 mb-6">Berikut perbandingan dengan leasing lainnya untuk pilihan yang sama:</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($comparisons as $comparison)
                            <div class="border rounded-xl p-5 hover:shadow-lg transition-shadow {{ $loop->first ? 'border-2 border-honda-red' : '' }}">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="font-bold text-lg">{{ $comparison['leasing']->name }}</h4>
                                    @if($loop->first)
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">TERBAIK</span>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-600">Angsuran Bulanan:</span>
                                        <span class="font-bold">{{ $comparison['monthly'] }}</span>
                                    </div>
                                    <div class="flex justify-between mb-1">
                                        <span class="text-gray-600">Total Pembayaran:</span>
                                        <span class="font-bold">{{ $comparison['total'] }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Rating:</span>
                                        <span class="font-bold">{{ $comparison['rating'] }} / 100</span>
                                    </div>
                                </div>

                                <div class="pt-3 border-t border-gray-200">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Anda Hemat:</span>
                                        <span class="font-bold text-green-600">{{ $comparison['savings'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Save & New Simulation -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
                <div class="flex flex-wrap gap-4 justify-center">
                    <button class="flex items-center bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-700 hover:to-gray-800 text-white py-2 px-4 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Simpan PDF
                    </button>
                    <a href="{{ route('credit-simulation.index') }}"
                       class="flex items-center bg-gradient-to-r from-honda-red to-vibrant-orange hover:from-red-600 hover:to-orange-600 text-white py-2 px-4 rounded-lg">
                        Buat Simulasi Baru
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
