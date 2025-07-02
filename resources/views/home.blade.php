@extends('layouts.app')

@section('title', 'Homepage - Honda Care')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-honda-red to-vibrant-orange py-16 md:py-24 text-white overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-3xl">
                <h1 class="font-heading text-4xl md:text-6xl mb-4 leading-tight">
                    Temukan Motor Honda Impian Anda
                </h1>
                <p class="text-xl mb-8 opacity-90">
                    Layanan terbaik untuk perawatan, pembelian, dan simulasi kredit motor Honda
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('catalog.index') }}" class="bg-white text-gray-800 hover:bg-gray-100 font-bold py-3 px-8 rounded-full transition-all transform hover:scale-105 shadow-lg">
                        Lihat Katalog
                    </a>
                    <a href="{{ route('credit-simulation.index') }}" class="bg-transparent border-2 border-white hover:bg-white hover:text-gray-800 font-bold py-3 px-8 rounded-full transition-all">
                        Simulasi Kredit
                    </a>
                </div>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-20">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#FFD700" d="M45.2,-58.2C59.1,-49.5,71.1,-36.9,73.7,-22.1C76.3,-7.3,69.5,9.7,62.5,26.3C55.5,42.9,48.4,59.1,36.2,67.4C24,75.6,6.7,75.9,-8.3,73.3C-23.3,70.7,-36.1,65.2,-48.1,56.4C-60,47.6,-71.1,35.6,-74.1,21.5C-77.2,7.4,-72.3,-8.9,-65.1,-23.8C-57.9,-38.8,-48.5,-52.4,-36.5,-61.7C-24.4,-71,-12.2,-76,1.1,-77.7C14.4,-79.5,28.9,-77.9,45.2,-58.2Z" transform="translate(100 100)" />
            </svg>
        </div>
    </section>

    <!-- Kategori Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl md:text-4xl text-gray-800 mb-4">
                    Jelajahi Kategori
                </h2>
                <p class="max-w-2xl mx-auto text-gray-600">
                    Temukan motor Honda sesuai dengan kebutuhan Anda
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('catalog.category', ['slug' => $category->slug]) }}"
                       class="block bg-white rounded-xl overflow-hidden shadow-lg transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                        <div class="p-6">
                            <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center"
                                 style="background: linear-gradient(135deg, {{ $loop->index % 2 == 0 ? '#00B0F0' : '#FFD700' }}, {{ $loop->index % 3 == 0 ? '#7FFF00' : '#E40521' }});">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-center text-gray-800 mb-1">{{ $category->name }}</h3>
                            <p class="text-center text-sm text-gray-500">{{ $category->active_motors_count }} model tersedia</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Motors Section -->
    <section class="py-16 bg-gradient-to-br from-[#F3F4F6] to-[#E0E7FF]">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="font-heading text-3xl md:text-4xl text-gray-800">
                        Motor Unggulan
                    </h2>
                    <p class="text-gray-600">Pilihan terbaik dari Honda</p>
                </div>
                <a href="{{ route('motors.search') }}" class="text-honda-red font-semibold hover:underline">
                    Lihat Semua →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredMotors as $motor)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-xl transition-all duration-300 hover:shadow-2xl">
                        @if($motor->images->first())
                            <div class="h-56 overflow-hidden">
                                <img src="{{ asset('storage/' . $motor->images->first()->path) }}"
                                     alt="{{ $motor->name }}"
                                     class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="font-heading text-xl font-bold text-gray-800">{{ $motor->name }}</h3>
                                    <span class="text-sm text-gray-500">{{ $motor->category->name }}</span>
                                </div>
                                <span class="px-3 py-1 bg-gradient-to-r from-sunny-yellow to-vibrant-orange text-white text-sm font-bold rounded-full">
                            Unggulan
                        </span>
                            </div>

                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-gray-600">Harga Mulai</span>
                                    <span class="font-bold text-lg text-honda-red">Rp {{ number_format($motor->price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">CC Mesin</span>
                                    <span class="font-medium">{{ $motor->engine_cc }}cc</span>
                                </div>
                            </div>

                            <div class="flex justify-between gap-3">
                                <a href="{{ route('motors.show', ['slug' => $motor->slug]) }}"
                                   class="flex-1 bg-gradient-to-r from-electric-blue to-fresh-green hover:from-blue-500 hover:to-green-500 text-white text-center py-2 px-4 rounded-lg font-medium transition-all">
                                    Detail
                                </a>
                                <a href="{{ route('credit-simulation.index') }}?motor={{ $motor->id }}"
                                   class="flex-1 bg-gradient-to-r from-gray-800 to-gray-600 hover:from-gray-700 hover:to-gray-500 text-white text-center py-2 px-4 rounded-lg font-medium transition-all">
                                    Kredit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Motors Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl md:text-4xl text-gray-800 mb-4">
                    Motor Terbaru
                </h2>
                <p class="max-w-2xl mx-auto text-gray-600">
                    Model terbaru dari Honda yang baru saja dirilis
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($latestMotors as $motor)
                    <div class="group bg-white rounded-xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-xl border border-gray-100">
                        @if($motor->images->first())
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $motor->images->first()->path) }}"
                                     alt="{{ $motor->name }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                        @endif

                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800 mb-1">{{ $motor->name }}</h3>
                                    <span class="text-sm text-gray-500">{{ $motor->category->name }}</span>
                                </div>
                                <span class="text-xs bg-honda-red text-white px-2 py-1 rounded">Baru</span>
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                <span class="font-bold text-honda-red">Rp {{ number_format($motor->price, 0, ',', '.') }}</span>
                                <a href="{{ route('motors.show', ['slug' => $motor->slug]) }}" class="text-electric-blue hover:underline text-sm">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-honda-red to-vibrant-orange text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-heading text-3xl md:text-4xl mb-6">Butuh Bantuan Memilih Motor?</h2>
            <p class="max-w-2xl mx-auto mb-8 text-xl opacity-90">
                Tim ahli kami siap membantu Anda menemukan motor Honda yang sempurna sesuai kebutuhan
            </p>
            <a href="{{ route('inquiry.create') }}" class="inline-block bg-white text-gray-800 hover:bg-gray-100 font-bold py-3 px-8 rounded-full shadow-lg transition-all transform hover:scale-105">
                Konsultasi Gratis
            </a>
        </div>
    </section>
@endsection
