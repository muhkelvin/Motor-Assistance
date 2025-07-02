@extends('layouts.app')

@section('title', 'Katalog ' . $category->name)

@section('content')
    <!-- Hero Section Kategori -->
    <section class="bg-gradient-to-r from-honda-red to-vibrant-orange py-16 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-4xl md:text-5xl mb-6">Katalog {{ $category->name }}</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                {{ $category->description ?? 'Temukan semua model ' . $category->name . ' terbaru dari Honda' }}
            </p>
        </div>
    </section>

    <!-- Category Content -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="mb-8 text-center">
                <h2 class="font-heading text-3xl text-gray-800 mb-4">
                    Model {{ $category->name }} Terbaru
                </h2>
                <p class="max-w-2xl mx-auto text-gray-600">
                    Pilih model {{ $category->name }} sesuai kebutuhan Anda
                </p>
            </div>

            @if($motors->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($motors as $motor)
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                            <!-- Motor Image -->
                            @if($motor->images->first())
                                <div class="relative h-64 overflow-hidden">
                                    <img src="{{ asset('storage/' . $motor->images->first()->path) }}"
                                         alt="{{ $motor->name }}"
                                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                    @if($motor->is_featured)
                                        <div class="absolute top-4 left-4 bg-gradient-to-r from-sunny-yellow to-vibrant-orange text-white px-3 py-1 rounded-full text-sm font-bold">
                                            Unggulan
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <!-- Motor Details -->
                            <div class="p-6">
                                <h3 class="font-heading text-xl font-bold text-gray-800 mb-2">{{ $motor->name }}</h3>

                                <div class="mb-4">
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">Harga Mulai</span>
                                        <span class="font-bold text-honda-red">Rp {{ number_format($motor->price, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">CC Mesin</span>
                                        <span class="font-medium">{{ $motor->engine_capacity }}cc</span>
                                    </div>
                                    <div class="flex justify-between items-center py-2">
                                        <span class="text-gray-600">Tahun Model</span>
                                        <span class="font-medium">{{ $motor->model_year }}</span>
                                    </div>
                                </div>

                                <!-- Features Highlights -->
                                <div class="mb-6">
                                    <h4 class="font-semibold text-gray-700 mb-2">Fitur Unggulan:</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(array_slice($motor->features, 0, 3) as $feature)
                                            <span class="bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full">
                                {{ $feature }}
                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-3">
                                    <a href="{{ route('motors.show', ['slug' => $motor->slug]) }}"
                                       class="flex-1 text-center bg-gradient-to-r from-electric-blue to-fresh-green hover:from-blue-600 hover:to-green-600 text-white py-2 px-4 rounded-lg font-medium">
                                        Detail
                                    </a>
                                    <a href="{{ route('credit-simulation.index') }}?motor={{ $motor->id }}"
                                       class="flex-1 text-center bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-600 hover:to-gray-800 text-white py-2 px-4 rounded-lg font-medium">
                                        Kredit
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-10">
                    {{ $motors->links('pagination::tailwind') }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-gradient-to-br from-sunny-yellow to-vibrant-orange bg-opacity-10 rounded-2xl p-12 text-center">
                    <div class="mb-6 mx-auto w-24 h-24 rounded-full bg-gradient-to-r from-sunny-yellow to-vibrant-orange text-white flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="font-heading text-2xl text-gray-800 mb-4">Belum ada motor di kategori ini</h3>
                    <p class="text-gray-600 mb-6">
                        Saat ini belum ada model motor Honda di kategori {{ $category->name }}.
                    </p>
                    <a href="{{ route('catalog.index') }}" class="inline-block bg-gradient-to-r from-electric-blue to-fresh-green hover:from-blue-600 hover:to-green-600 text-white font-bold py-3 px-6 rounded-lg">
                        Lihat Katalog Lainnya
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-electric-blue to-fresh-green text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-heading text-3xl md:text-4xl mb-6">Butuh Bantuan Memilih {{ $category->name }}?</h2>
            <p class="max-w-2xl mx-auto mb-8 text-xl opacity-90">
                Konsultasikan kebutuhan Anda dengan tim ahli kami
            </p>
            <a href="{{ route('inquiry.create') }}" class="inline-block bg-white text-gray-800 hover:bg-gray-100 font-bold py-3 px-8 rounded-full shadow-lg transition-all transform hover:scale-105">
                Konsultasi Gratis
            </a>
        </div>
    </section>
@endsection
