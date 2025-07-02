@extends('layouts.app')

@section('title', $motor->name . ' - Detail Motor Honda')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-honda-red to-vibrant-orange py-12 text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="font-heading text-3xl md:text-4xl mb-2">{{ $motor->name }}</h1>
                    <p class="text-xl">{{ $motor->category->name }}</p>
                </div>
                <div class="mt-4 md:mt-0 text-center">
                    <p class="text-lg">Harga Mulai</p>
                    <p class="font-bold text-3xl">Rp {{ number_format($motor->price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Motor Gallery & Main Info -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Image Gallery -->
                <div>
                    <!-- Main Image -->
                    <div class="bg-white rounded-2xl shadow-xl p-4 mb-6">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-100 rounded-xl overflow-hidden">
                            @if($motor->main_image)
                                <img src="{{ asset('storage/' . $motor->main_image) }}"
                                     alt="{{ $motor->name }}"
                                     class="w-full h-full object-contain" id="main-image">
                            @else
                                <img src="{{ asset('motor.jpg') }}"
                                     alt="Default Motor"
                                     class="w-full h-full object-contain" id="main-image">
                            @endif
                        </div>
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if($motor->galleryImages->count() > 0)
                        <div class="grid grid-cols-4 gap-4">
                            @foreach($motor->galleryImages as $image)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:opacity-75 transition-opacity gallery-thumbnail">
                                    <img src="{{ asset('storage/' . $image->path ) }}"
                                         alt="{{ $motor->name }} - Gallery Image {{ $loop->index+1 }}"
                                         class="w-full h-24 object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Motor Details -->
                <div>
                    <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-24">
                        <!-- Action Buttons -->
                        <div class="flex gap-4 mb-8">
                            <a href="{{ route('credit-simulation.index') }}?motor={{ $motor->id }}"
                               class="flex-1 text-center bg-gradient-to-r from-electric-blue to-fresh-green hover:from-blue-600 hover:to-green-600 text-white py-3 px-4 rounded-lg font-bold text-lg">
                                Simulasi Kredit
                            </a>
                            <a href="{{ route('inquiry.create') }}?motor={{ $motor->id }}"
                               class="flex-1 text-center bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-700 hover:to-gray-800 text-white py-3 px-4 rounded-lg font-bold text-lg">
                                Konsultasi
                            </a>
                        </div>

                        <!-- Specifications -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="font-heading text-2xl text-gray-800 mb-4">Spesifikasi Utama</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="border-b pb-3">
                                        <p class="text-gray-600">Kapasitas Mesin</p>
                                        <p class="font-bold text-lg">{{ $motor->engine_cc }} cc</p>
                                    </div>
                                    <div class="border-b pb-3">
                                        <p class="text-gray-600">Tahun Model</p>
                                        <p class="font-bold text-lg">{{ $motor->model_year }}</p>
                                    </div>
                                    <div class="border-b pb-3">
                                        <p class="text-gray-600">Jenis Bahan Bakar</p>
                                        <p class="font-bold text-lg">{{ $motor->fuel_type }}</p>
                                    </div>
                                    <div class="border-b pb-3">
                                        <p class="text-gray-600">Transmisi</p>
                                        <p class="font-bold text-lg">{{ $motor->transmission }}</p>
                                    </div>
                                    @if($motor->fuel_capacity)
                                        <div class="border-b pb-3">
                                            <p class="text-gray-600">Kapasitas Bahan Bakar</p>
                                            <p class="font-bold text-lg">{{ $motor->fuel_capacity }} liter</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Features -->
                            <div>
                                <h3 class="font-heading text-xl text-gray-800 mb-3">Fitur Utama</h3>
                                <div class="flex flex-wrap gap-2">
                                    @if($motor->features && is_array($motor->features))
                                        @foreach($motor->features as $feature)
                                            <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                                {{ $feature }}
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Colors -->
                            <div>
                                <h3 class="font-heading text-xl text-gray-800 mb-3">Warna Tersedia</h3>
                                <div class="flex flex-wrap gap-3">
                                    @if($motor->colors && is_array($motor->colors))
                                        @foreach($motor->colors as $color)
                                            <div class="w-10 h-10 rounded-full border border-gray-300"
                                                 style="background-color: {{ $color }};"
                                                 title="{{ $color }}"></div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Leasing Partners -->
                            <div>
                                <h3 class="font-heading text-xl text-gray-800 mb-3">Mitra Leasing</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($leasingCompanies as $leasing)
                                        <div class="bg-white border border-gray-200 rounded-lg p-2 flex items-center">
                                            @if($leasing->logo)
                                                <img src="{{ asset('storage/' . $leasing->logo) }}"
                                                     alt="{{ $leasing->name }}"
                                                     class="h-8 object-contain">
                                            @else
                                                <span class="text-sm font-medium">{{ $leasing->name }}</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Full Specifications -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="border-b border-gray-200">
                    <h2 class="font-heading text-2xl text-gray-800 p-6">Detail Spesifikasi</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    <!-- Group specifications by category -->
                    @php
                        $specGroups = [
                            'Mesin & Transmisi' => [
                                'Tipe Mesin', 'Kapasitas Mesin', 'Sistem Pendingin',
                                'Sistem Bahan Bakar', 'Tipe Transmisi', 'Jumlah Percepatan'
                            ],
                            'Dimensi' => [
                                'Panjang', 'Lebar', 'Tinggi', 'Jarak Sumbu Roda', 'Berat Kosong'
                            ],
                            'Kapasitas' => [
                                'Kapasitas Tangki', 'Kapasitas Bagasi', 'Ban Depan', 'Ban Belakang'
                            ],
                            'Kinerja' => [
                                'Daya Maksimum', 'Torsi Maksimum', 'Kecepatan Maksimum'
                            ],
                            'Kelistrikan' => [
                                'Sistem Pengapian', 'Baterai', 'Lampu Depan', 'Lampu Belakang'
                            ],
                            'Lainnya' => [
                                'Tipe Rangka', 'Suspensi Depan', 'Suspensi Belakang',
                                'Rem Depan', 'Rem Belakang'
                            ]
                        ];
                    @endphp

                    @foreach($specGroups as $groupName => $groupSpecs)
                        <div>
                            <h3 class="font-semibold text-lg text-gray-800 mb-4 pb-2 border-b border-gray-200">{{ $groupName }}</h3>
                            <div class="space-y-3">
                                @foreach($groupSpecs as $specName)
                                    @if(isset($motor->specifications[$specName]))
                                        <div class="flex justify-between">
                                            <span class="text-gray-600">{{ $specName }}</span>
                                            <span class="font-medium">{{ $motor->specifications[$specName] }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Description Section -->
    @if($motor->description)
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border border-blue-200">
                    <h2 class="font-heading text-2xl text-gray-800 mb-6">Deskripsi Produk</h2>
                    <div class="prose max-w-none">
                        {!! $motor->description !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Related Motors -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="font-heading text-3xl text-gray-800 mb-4">Model Terkait</h2>
                <p class="max-w-2xl mx-auto text-gray-600">
                    Lihat juga model Honda lainnya dalam kategori yang sama
                </p>
            </div>

            @if($relatedMotors->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedMotors as $related)
                        <a href="{{ route('motors.show', ['slug' => $related->slug]) }}"
                           class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                            @if($related->main_image)
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $related->main_image) }}"
                                         alt="{{ $related->name }}"
                                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                </div>
                            @endif

                            <div class="p-5">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-1">{{ $related->name }}</h3>
                                        <span class="text-sm text-gray-500">{{ $related->category->name }}</span>
                                    </div>
                                    @if($related->is_featured)
                                        <span class="text-xs bg-gradient-to-r from-sunny-yellow to-vibrant-orange text-white px-2 py-1 rounded">Unggulan</span>
                                    @endif
                                </div>

                                <div class="mt-4 flex justify-between items-center">
                                    <span class="font-bold text-honda-red">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                    <span class="text-electric-blue text-sm font-medium">Detail →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-600">Tidak ada motor terkait saat ini.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Simple gallery functionality
        document.querySelectorAll('.gallery-thumbnail').forEach(thumb => {
            thumb.addEventListener('click', function() {
                const img = this.querySelector('img');
                if (img) {
                    const mainImg = document.getElementById('main-image');
                    if (mainImg) {
                        mainImg.src = img.src;
                        mainImg.alt = img.alt;
                    }
                }
            });
        });
    </script>
@endpush
