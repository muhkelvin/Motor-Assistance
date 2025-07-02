@extends('layouts.app')

@section('title', 'Perbandingan Leasing untuk Kredit Motor')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-vibrant-orange to-honda-red py-12 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Perbandingan Leasing</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Bandingkan penawaran dari berbagai leasing untuk motor Honda Anda
            </p>
        </div>
    </section>

    <!-- Comparison Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                <h2 class="font-heading text-2xl text-gray-800 mb-6">Parameter Perbandingan</h2>

                <form id="comparisonForm" method="GET" action="{{ route('credit-simulation.compare') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Motor Selection -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Pilih Motor</label>
                            <select name="motor_id"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue bg-gray-50"
                                    required>
                                <option value="">-- Pilih Model Motor --</option>
                                @foreach($motors as $m)
                                    <option value="{{ $m->id }}"
                                        {{ $motor && $motor->id == $m->id ? 'selected' : '' }}>
                                        {{ $m->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Down Payment -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Uang Muka</label>
                            <div class="flex items-center">
                                <span class="mr-2 text-gray-600">Rp</span>
                                <input type="number" name="down_payment"
                                       value="{{ $downPayment ?? 5000000 }}"
                                       class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                       placeholder="Contoh: 5000000"
                                       required>
                            </div>
                        </div>

                        <!-- Tenor -->
                        <div>
                            <label class="block text-gray-700 font-medium mb-2">Jangka Waktu</label>
                            <select name="tenor_months"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue bg-gray-50"
                                    required>
                                @foreach([12, 24, 36, 48] as $tenor)
                                    <option value="{{ $tenor }}" {{ ($tenorMonths ?? 36) == $tenor ? 'selected' : '' }}>
                                        {{ $tenor }} Bulan
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                                class="bg-gradient-to-r from-electric-blue to-fresh-green hover:from-blue-600 hover:to-green-600 text-white font-bold py-3 px-6 rounded-lg">
                            Bandingkan Leasing
                        </button>
                    </div>
                </form>
            </div>

            @if(isset($motor) && isset($comparisons))
                <!-- Results Section -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!-- Header -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 border-b border-gray-200">
                        <div class="flex flex-col md:flex-row justify-between items-center">
                            <div class="flex items-center mb-4 md:mb-0">
                                @if($motor->images->first())
                                    <div class="w-16 h-16 rounded-xl overflow-hidden mr-4">
                                        <img src="{{ asset('storage/' . $motor->images->first()->path) }}"
                                             alt="{{ $motor->name }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div>
                                    <h2 class="font-heading text-xl text-gray-800">{{ $motor->name }}</h2>
                                    <p class="text-gray-600">Uang Muka: Rp {{ number_format($downPayment, 0, ',', '.') }} | Tenor: {{ $tenorMonths }} Bulan</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-lg">Pinjaman: <span class="font-bold">Rp {{ number_format($motor->price - $downPayment, 0, ',', '.') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Comparison Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-max">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase">Leasing Company</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600 uppercase">Bunga</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600 uppercase">Biaya Admin</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600 uppercase">Angsuran Bulanan</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600 uppercase">Total Pembayaran</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600 uppercase">Aksi</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                            @foreach($comparisons as $comp)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($comp['leasing_company']->logo)
                                                <div class="w-10 h-10 flex-shrink-0 mr-3">
                                                    <img src="{{ asset('storage/' . $comp['leasing_company']->logo) }}"
                                                         alt="{{ $comp['leasing_company']->name }}"
                                                         class="w-full h-full object-contain">
                                                </div>
                                            @endif
                                            <span class="font-medium">{{ $comp['leasing_company']->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">{{ $comp['leasing_company']->interest_rate }}%</td>
                                    <td class="px-6 py-4 text-center">Rp {{ number_format($comp['leasing_company']->admin_fee, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center font-bold text-honda-red">{{ $comp['formatted_monthly'] }}</td>
                                    <td class="px-6 py-4 text-center font-medium">{{ $comp['formatted_total'] }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('credit-simulation.index') }}?motor_id={{ $motor->id }}&leasing_company_id={{ $comp['leasing_company']->id }}&down_payment={{ $downPayment }}&tenor_months={{ $tenorMonths }}"
                                           class="text-electric-blue hover:text-blue-800 font-medium">
                                            Hitung Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Chart Visualization -->
                    <div class="p-6 border-t border-gray-200">
                        <h3 class="font-heading text-xl text-gray-800 mb-4">Perbandingan Angsuran Bulanan</h3>
                        <div class="h-64 flex items-end justify-between gap-2 mt-8">
                            @php
                                // Find max monthly payment for chart scaling
                                $maxMonthly = 0;
                                foreach ($comparisons as $comp) {
                                    if ($comp['monthly_payment'] > $maxMonthly) {
                                        $maxMonthly = $comp['monthly_payment'];
                                    }
                                }
                                // Ensure maxMonthly is at least 1 to prevent division by zero
                                $maxMonthly = max($maxMonthly, 1);
                            @endphp

                            @foreach($comparisons as $comp)
                                <div class="flex-1 flex flex-col items-center">
                                    <div class="w-full flex justify-center">
                                        @php
                                            // Calculate bar height percentage
                                            $heightPercentage = min(100, max(20, ($comp['monthly_payment'] / $maxMonthly) * 100));
                                        @endphp
                                        <div class="w-3/4 bg-gradient-to-t from-electric-blue to-fresh-green rounded-t-lg"
                                             style="height: {{ $heightPercentage }}%">
                                        </div>
                                    </div>
                                    <div class="mt-2 text-center">
                                        <div class="font-bold text-gray-800">{{ $comp['formatted_monthly'] }}</div>
                                        <div class="text-sm text-gray-600 mt-1">{{ $comp['leasing_company']->name }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-12 text-center border border-orange-200">
                    <div class="mb-6 mx-auto w-24 h-24 rounded-full bg-gradient-to-r from-vibrant-orange to-honda-red text-white flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="font-heading text-2xl text-gray-800 mb-4">Bandingkan Penawaran Leasing</h3>
                    <p class="text-gray-600 mb-6">
                        Pilih motor, tentukan uang muka dan tenor untuk melihat perbandingan leasing
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection
