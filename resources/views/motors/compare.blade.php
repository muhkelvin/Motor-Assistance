@extends('layouts.app')

@section('title', 'Bandingkan Motor Honda')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-electric-blue to-fresh-green py-12 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Perbandingan Motor</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Bandingkan spesifikasi motor Honda pilihan Anda
            </p>
        </div>
    </section>

    <!-- Comparison Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl overflow-x-auto">
                <table class="w-full min-w-max">
                    <thead>
                    <tr>
                        <th class="px-6 py-4 bg-gray-50 text-left text-sm font-semibold text-gray-600 uppercase border-b">Spesifikasi</th>
                        @foreach($motors as $motor)
                            <th class="px-6 py-4 bg-gray-50 text-center border-b">
                                <div class="flex flex-col items-center">
                                    <div class="h-32 mb-3 flex items-center justify-center">
                                        @if($motor->images->first())
                                            <img src="{{ asset('storage/' . $motor->images->first()->path) }}"
                                                 alt="{{ $motor->name }}"
                                                 class="max-h-full object-contain">
                                        @endif
                                    </div>
                                    <h3 class="font-bold text-lg text-gray-800">{{ $motor->name }}</h3>
                                    <p class="text-honda-red font-bold">Rp {{ number_format($motor->price, 0, ',', '.') }}</p>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <!-- Engine -->
                    <tr class="bg-gray-50">
                        <td colspan="{{ count($motors) + 1 }}" class="px-6 py-3 font-heading text-xl text-gray-800">Mesin</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Kapasitas Mesin</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->engine_capacity }} cc</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Daya Maksimum</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->engine_power }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Torsi Maksimum</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->engine_torque }}</td>
                        @endforeach
                    </tr>

                    <!-- Dimensi -->
                    <tr class="bg-gray-50">
                        <td colspan="{{ count($motors) + 1 }}" class="px-6 py-3 font-heading text-xl text-gray-800">Dimensi</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Panjang</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->dimension_length }} mm</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Lebar</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->dimension_width }} mm</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Tinggi</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->dimension_height }} mm</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Berat Kosong</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->weight }} kg</td>
                        @endforeach
                    </tr>

                    <!-- Kapasitas -->
                    <tr class="bg-gray-50">
                        <td colspan="{{ count($motors) + 1 }}" class="px-6 py-3 font-heading text-xl text-gray-800">Kapasitas</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Tangki Bensin</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->fuel_capacity }} L</td>
                        @endforeach
                    </tr>

                    <!-- Transmisi -->
                    <tr class="bg-gray-50">
                        <td colspan="{{ count($motors) + 1 }}" class="px-6 py-3 font-heading text-xl text-gray-800">Transmisi</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Tipe Transmisi</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->transmission_type }}</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Jumlah Percepatan</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4 text-center">{{ $motor->transmission_speed }}</td>
                        @endforeach
                    </tr>

                    <!-- Fitur -->
                    <tr class="bg-gray-50">
                        <td colspan="{{ count($motors) + 1 }}" class="px-6 py-3 font-heading text-xl text-gray-800">Fitur</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">Fitur Utama</td>
                        @foreach($motors as $motor)
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    @foreach(array_slice($motor->features, 0, 3) as $feature)
                                        <span class="text-sm">{{ $feature }}</span>
                                    @endforeach
                                </div>
                            </td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('catalog.index') }}" class="inline-block bg-gradient-to-r from-honda-red to-vibrant-orange hover:from-red-600 hover:to-orange-600 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-all transform hover:scale-105">
                    Bandingkan Motor Lainnya
                </a>
            </div>
        </div>
    </section>
@endsection
