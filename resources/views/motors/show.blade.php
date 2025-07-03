@extends('layouts.app')

@section('title', $motor->name . ' - Detail Motor Honda')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-honda-red to-vibrant-orange py-12 text-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div>
                    <h1 class="font-heading text-3xl md:text-4xl mb-2">{{ $motor->name }}</h1>
                    <p class="text-xl">{{ $motor->category->name ?? 'Motor Honda' }}</p>
                    <p class="text-lg opacity-90">Model {{ $motor->model_year }}</p>
                </div>
                <div class="mt-4 md:mt-0 text-center">
                    <p class="text-lg">Harga Mulai</p>
                    <p class="font-bold text-3xl">Rp {{ number_format($motor->price, 0, ',', '.') }}</p>
                    @if($motor->is_featured)
                        <span class="inline-block mt-2 bg-sunny-yellow text-gray-800 px-3 py-1 rounded-full text-sm font-medium">Motor Unggulan</span>
                    @endif
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
                    @if($motor->galleryImages && $motor->galleryImages->count() > 0)
                        <div class="grid grid-cols-4 gap-4">
                            <!-- Main image as first thumbnail -->
                            @if($motor->main_image)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:opacity-75 transition-opacity gallery-thumbnail">
                                    <img src="{{ asset('storage/' . $motor->main_image) }}"
                                         alt="{{ $motor->name }} - Main Image"
                                         class="w-full h-24 object-cover">
                                </div>
                            @endif

                            @foreach($motor->galleryImages as $image)
                                <div class="bg-white rounded-lg shadow-md overflow-hidden cursor-pointer hover:opacity-75 transition-opacity gallery-thumbnail">
                                    <img src="{{ asset('storage/' . $image->path) }}"
                                         alt="{{ $motor->name }} - Gallery Image {{ $loop->iteration }}"
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
                               class="flex-1 text-center bg-gradient-to-r from-electric-blue to-fresh-green hover:from-blue-600 hover:to-green-600 text-white py-3 px-4 rounded-lg font-bold text-lg transition-all duration-300">
                                Simulasi Kredit
                            </a>
                            <a href="{{ route('inquiry.create') }}?motor={{ $motor->id }}"
                               class="flex-1 text-center bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-700 hover:to-gray-800 text-white py-3 px-4 rounded-lg font-bold text-lg transition-all duration-300">
                                Konsultasi
                            </a>
                        </div>

                        <!-- Quick Specifications -->
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
                            @if($motor->features)
                                <div>
                                    <h3 class="font-heading text-xl text-gray-800 mb-3">Fitur Unggulan</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($motor->features as $feature)
                                            <span class="bg-gradient-to-r from-electric-blue to-fresh-green text-white px-3 py-1 rounded-full text-sm font-medium">
                                                {{ $feature }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Colors -->
                            @if($motor->colors)
                                <div>
                                    <h3 class="font-heading text-xl text-gray-800 mb-3">Pilihan Warna</h3>
                                    <div class="flex flex-wrap gap-3">
                                        @foreach($motor->colors as $color)
                                            @if(is_array($color))
                                                <div class="text-center">
                                                    <div class="w-12 h-12 rounded-full border-2 border-gray-300 shadow-md mb-1"
                                                         style="background-color: {{ $color['hex'] ?? '#000000' }};"
                                                         title="{{ $color['name'] ?? 'Warna' }}"></div>
                                                    <p class="text-xs text-gray-600">{{ $color['name'] ?? 'Warna' }}</p>
                                                </div>
                                            @else
                                                <div class="text-center">
                                                    <div class="w-12 h-12 rounded-full border-2 border-gray-300 shadow-md mb-1"
                                                         style="background-color: {{ $color }};"
                                                         title="{{ $color }}"></div>
                                                    <p class="text-xs text-gray-600">{{ $color }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Leasing Partners -->
                            @if($leasingCompanies && $leasingCompanies->count() > 0)
                                <div>
                                    <h3 class="font-heading text-xl text-gray-800 mb-3">Mitra Leasing</h3>
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach($leasingCompanies as $leasing)
                                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 flex items-center justify-center">
                                                @if($leasing->logo)
                                                    <img src="{{ asset('storage/' . $leasing->logo) }}"
                                                         alt="{{ $leasing->name }}"
                                                         class="h-8 max-w-full object-contain">
                                                @else
                                                    <span class="text-sm font-medium text-gray-700">{{ $leasing->name }}</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Full Specifications -->
    @if($motor->specifications)
        <section class="py-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="border-b border-gray-200">
                        <h2 class="font-heading text-2xl text-gray-800 p-6">Spesifikasi Lengkap</h2>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @php
                                $specGroups = [
                                    'Mesin & Performa' => [
                                        'engine_type' => 'Tipe Mesin',
                                        'engine_capacity' => 'Kapasitas Mesin',
                                        'max_power' => 'Daya Maksimum',
                                        'max_torque' => 'Torsi Maksimum',
                                        'cooling_system' => 'Sistem Pendingin',
                                        'fuel_system' => 'Sistem Bahan Bakar',
                                        'ignition' => 'Sistem Pengapian',
                                        'max_speed' => 'Kecepatan Maksimum'
                                    ],
                                    'Transmisi & Suspensi' => [
                                        'transmission_type' => 'Tipe Transmisi',
                                        'clutch' => 'Kopling',
                                        'front_suspension' => 'Suspensi Depan',
                                        'rear_suspension' => 'Suspensi Belakang',
                                        'front_brake' => 'Rem Depan',
                                        'rear_brake' => 'Rem Belakang',
                                        'front_tire' => 'Ban Depan',
                                        'rear_tire' => 'Ban Belakang'
                                    ],
                                    'Dimensi & Kapasitas' => [
                                        'length' => 'Panjang',
                                        'width' => 'Lebar',
                                        'height' => 'Tinggi',
                                        'wheelbase' => 'Jarak Sumbu Roda',
                                        'ground_clearance' => 'Ground Clearance',
                                        'seat_height' => 'Tinggi Jok',
                                        'dry_weight' => 'Berat Kosong',
                                        'fuel_tank_capacity' => 'Kapasitas Tangki'
                                    ],
                                    'Kelistrikan & Lainnya' => [
                                        'battery' => 'Baterai',
                                        'headlight' => 'Lampu Depan',
                                        'taillight' => 'Lampu Belakang',
                                        'frame_type' => 'Tipe Rangka',
                                        'starter' => 'Starter',
                                        'alternator' => 'Alternator'
                                    ]
                                ];
                            @endphp

                            @foreach($specGroups as $groupName => $groupSpecs)
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800 mb-4 pb-2 border-b border-gray-200">{{ $groupName }}</h3>
                                    <div class="space-y-3">
                                        @foreach($groupSpecs as $specKey => $specLabel)
                                            @if(isset($motor->specifications[$specKey]) && $motor->specifications[$specKey])
                                                <div class="flex flex-col">
                                                    <span class="text-gray-600 text-sm">{{ $specLabel }}</span>
                                                    <span class="font-medium text-gray-800">{{ $motor->specifications[$specKey] }}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Description Section -->
    @if($motor->description)
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 border border-blue-200">
                    <h2 class="font-heading text-2xl text-gray-800 mb-6">Deskripsi Produk</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! $motor->description !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Related Motors -->
    @if($relatedMotors && $relatedMotors->count() > 0)
        <section class="py-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-10">
                    <h2 class="font-heading text-3xl text-gray-800 mb-4">Model Terkait</h2>
                    <p class="max-w-2xl mx-auto text-gray-600">
                        Lihat juga model Honda lainnya dalam kategori {{ $motor->category->name ?? 'yang sama' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedMotors as $related)
                        <a href="{{ route('motors.show', ['slug' => $related->slug]) }}"
                           class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 group">
                            @if($related->main_image)
                                <div class="h-48 overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $related->main_image) }}"
                                         alt="{{ $related->name }}"
                                         class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-105">
                                </div>
                            @else
                                <div class="h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif

                            <div class="p-5">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="font-semibold text-gray-800 mb-1 group-hover:text-honda-red transition-colors">{{ $related->name }}</h3>
                                        <span class="text-sm text-gray-500">{{ $related->category->name ?? '' }}</span>
                                    </div>
                                    @if($related->is_featured)
                                        <span class="text-xs bg-gradient-to-r from-sunny-yellow to-vibrant-orange text-white px-2 py-1 rounded-full">Unggulan</span>
                                    @endif
                                </div>

                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-600 mb-1">
                                        {{ $related->engine_cc }} cc • {{ $related->model_year }}
                                    </div>
                                </div>

                                <div class="flex justify-between items-center mt-3">
                                    <span class="font-bold text-honda-red">Rp {{ number_format($related->price, 0, ',', '.') }}</span>
                                    <span class="text-electric-blue text-sm font-medium group-hover:translate-x-1 transition-transform">Detail →</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script>
        // Enhanced gallery functionality
        document.addEventListener('DOMContentLoaded', function() {
            const galleryThumbnails = document.querySelectorAll('.gallery-thumbnail');
            const mainImage = document.getElementById('main-image');

            galleryThumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    const img = this.querySelector('img');
                    if (img && mainImage) {
                        // Add loading state
                        mainImage.style.opacity = '0.5';

                        // Change image
                        mainImage.src = img.src;
                        mainImage.alt = img.alt;

                        // Remove loading state
                        mainImage.onload = function() {
                            mainImage.style.opacity = '1';
                        };

                        // Remove active state from all thumbnails
                        galleryThumbnails.forEach(thumb => {
                            thumb.classList.remove('ring-2', 'ring-honda-red');
                        });

                        // Add active state to clicked thumbnail
                        this.classList.add('ring-2', 'ring-honda-red');
                    }
                });
            });

            // Set first thumbnail as active by default
            if (galleryThumbnails.length > 0) {
                galleryThumbnails[0].classList.add('ring-2', 'ring-honda-red');
            }
        });
    </script>
@endpush
