@extends('layouts.app')

@section('title', 'Katalog Motor Honda')

@section('content')
    <!-- Hero Section Katalog -->
    <section class="bg-gradient-to-r from-electric-blue to-fresh-green py-16 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-4xl md:text-5xl mb-6">Katalog Motor Honda</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Temukan semua model motor Honda dengan fitur filter lengkap
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Filters -->
                <div class="lg:w-1/4">
                    <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-24">
                        <h2 class="font-heading text-2xl text-gray-800 mb-6 pb-2 border-b border-gray-200">
                            Filter Motor
                        </h2>

                        <form id="filterForm">
                            <!-- Kategori Filter -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-700 mb-3">Kategori</h3>
                                <div class="space-y-2">
                                    @foreach($categories as $category)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="category-{{ $category->id }}" name="category[]"
                                                   value="{{ $category->id }}"
                                                   {{ in_array($category->id, (array)request('category')) ? 'checked' : '' }}
                                                   class="rounded text-electric-blue focus:ring-electric-blue">
                                            <label for="category-{{ $category->id }}" class="ml-2 text-gray-600">
                                                {{ $category->name }} ({{ $category->motors_count }})
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Rentang Harga -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-700 mb-3">Rentang Harga</h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Minimal (Rp)</label>
                                        <input type="number" name="min_price"
                                               value="{{ request('min_price') }}"
                                               class="w-full px-4 py-2 border rounded-lg focus:ring-electric-blue focus:border-electric-blue">
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Maksimal (Rp)</label>
                                        <input type="number" name="max_price"
                                               value="{{ request('max_price') }}"
                                               class="w-full px-4 py-2 border rounded-lg focus:ring-electric-blue focus:border-electric-blue">
                                    </div>
                                </div>
                            </div>

                            <!-- CC Mesin -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-700 mb-3">Kapasitas Mesin (CC)</h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Minimal</label>
                                        <input type="number" name="min_cc"
                                               value="{{ request('min_cc') }}"
                                               class="w-full px-4 py-2 border rounded-lg focus:ring-electric-blue focus:border-electric-blue">
                                    </div>
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">Maksimal</label>
                                        <input type="number" name="max_cc"
                                               value="{{ request('max_cc') }}"
                                               class="w-full px-4 py-2 border rounded-lg focus:ring-electric-blue focus:border-electric-blue">
                                    </div>
                                </div>
                            </div>

                            <!-- Tahun Model -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-700 mb-3">Tahun Model</h3>
                                <select name="year" class="w-full px-4 py-2 border rounded-lg focus:ring-electric-blue focus:border-electric-blue">
                                    <option value="">Pilih Tahun</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Warna -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-700 mb-3">Warna Tersedia</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($availableColors as $color)
                                        <div>
                                            <input type="checkbox" id="color-{{ $loop->index }}" name="color[]"
                                                   value="{{ $color }}"
                                                   {{ in_array($color, (array)request('color')) ? 'checked' : '' }}
                                                   class="hidden">
                                            <label for="color-{{ $loop->index }}"
                                                   class="inline-block w-8 h-8 rounded-full cursor-pointer border-2 border-gray-300 {{ in_array($color, (array)request('color')) ? 'border-honda-red' : '' }}"
                                                   style="background-color: {{ $color }};"
                                                   title="{{ $color }}">
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Fitur -->
                            <div class="mb-6">
                                <h3 class="font-semibold text-gray-700 mb-3">Fitur</h3>
                                <div class="space-y-2">
                                    @foreach($availableFeatures as $feature)
                                        <div class="flex items-center">
                                            <input type="checkbox" id="feature-{{ $loop->index }}" name="features[]"
                                                   value="{{ $feature }}"
                                                   {{ in_array($feature, (array)request('features')) ? 'checked' : '' }}
                                                   class="rounded text-electric-blue focus:ring-electric-blue">
                                            <label for="feature-{{ $loop->index }}" class="ml-2 text-gray-600">
                                                {{ $feature }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Tombol Filter -->
                            <div class="flex gap-3">
                                <button type="submit" class="flex-1 bg-gradient-to-r from-electric-blue to-fresh-green hover:from-blue-600 hover:to-green-600 text-white py-2 px-4 rounded-lg font-medium">
                                    Terapkan Filter
                                </button>
                                <a href="{{ route('catalog.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-lg font-medium">
                                    Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="lg:w-3/4">
                    <!-- Search & Sorting -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <!-- Search Box -->
                            <div class="flex-1">
                                <form action="{{ route('catalog.index') }}" method="GET">
                                    <div class="relative">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                               placeholder="Cari model motor..."
                                               class="w-full pl-12 pr-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue">
                                        <div class="absolute left-4 top-3.5 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Sorting -->
                            <div class="flex items-center space-x-3">
                                <span class="text-gray-600">Urutkan:</span>
                                <form id="sortForm">
                                    <select name="sort_by" onchange="this.form.submit()"
                                            class="px-4 py-2 border rounded-lg focus:ring-electric-blue focus:border-electric-blue">
                                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nama (A-Z)</option>
                                        <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga Terendah</option>
                                        <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                                        <option value="engine_cc" {{ request('sort_by') == 'engine_cc' ? 'selected' : '' }}>CC Terkecil</option>
                                        <option value="engine_cc_desc" {{ request('sort_by') == 'engine_cc_desc' ? 'selected' : '' }}>CC Terbesar</option>
                                        <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                                        <option value="popularity" {{ request('sort_by') == 'popularity' ? 'selected' : '' }}>Populer</option>
                                    </select>
                                    <input type="hidden" name="sort_order" value="{{ request('sort_order') }}">
                                    @foreach(request()->except('sort_by', 'sort_order') as $key => $value)
                                        @if(is_array($value))
                                            @foreach($value as $val)
                                                <input type="hidden" name="{{ $key }}[]" value="{{ $val }}">
                                            @endforeach
                                        @else
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endif
                                    @endforeach
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Results Info -->
                    <div class="mb-6">
                        <p class="text-gray-600">
                            Menampilkan <span class="font-bold text-honda-red">{{ $motors->total() }}</span> motor
                            @if(request()->anyFilled(['search', 'category', 'min_price', 'max_price', 'min_cc', 'max_cc', 'year', 'color', 'features']))
                                berdasarkan filter yang dipilih
                            @endif
                        </p>
                    </div>

                    <!-- Motor Grid -->
                    @if($motors->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($motors as $motor)
                                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                                    <!-- Motor Image -->
                                    @if($motor->images->first())
                                        <div class="relative h-56 overflow-hidden">
                                            <img src="{{ asset('storage/' . $motor->images->first()->path) }}"
                                                 alt="{{ $motor->name }}"
                                                 class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                            <!-- Category Badge -->
                                            <div class="absolute top-4 right-4 bg-gradient-to-r from-vibrant-orange to-honda-red text-white px-3 py-1 rounded-full text-sm font-bold">
                                                {{ $motor->category->name }}
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Motor Details -->
                                    <div class="p-6">
                                        <div class="flex justify-between items-start mb-3">
                                            <h3 class="font-heading text-xl font-bold text-gray-800">{{ $motor->name }}</h3>
                                            @if($motor->is_featured)
                                                <span class="px-2 py-1 bg-gradient-to-r from-sunny-yellow to-vibrant-orange text-white text-xs rounded-full">
                                    Unggulan
                                </span>
                                            @endif
                                        </div>

                                        <!-- Specifications -->
                                        <div class="mb-4">
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-gray-600">Harga</span>
                                                <span class="font-bold text-honda-red">Rp {{ number_format($motor->price, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                                <span class="text-gray-600">CC Mesin</span>
                                                <span class="font-medium">{{ $motor->engine_cc }}cc</span>
                                            </div>
                                            <div class="flex justify-between items-center py-2">
                                                <span class="text-gray-600">Tahun</span>
                                                <span class="font-medium">{{ $motor->model_year }}</span>
                                            </div>
                                        </div>

                                        <!-- Colors -->
                                        <div class="mb-4">
                                            <p class="text-gray-600 mb-2">Warna Tersedia:</p>
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($motor->colors as $color)
                                                    <div class="w-5 h-5 rounded-full border border-gray-300" style="background-color: {{ $color }};"></div>
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
                            {{ $motors->withQueryString()->links('pagination::tailwind') }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="bg-gradient-to-br from-sunny-yellow to-vibrant-orange bg-opacity-10 rounded-2xl p-12 text-center">
                            <div class="mb-6 mx-auto w-24 h-24 rounded-full bg-gradient-to-r from-sunny-yellow to-vibrant-orange text-white flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="font-heading text-2xl text-gray-800 mb-4">Motor tidak ditemukan</h3>
                            <p class="text-gray-600 mb-6">
                                Tidak ada motor yang sesuai dengan filter yang Anda pilih.
                            </p>
                            <a href="{{ route('catalog.index') }}" class="inline-block bg-gradient-to-r from-electric-blue to-fresh-green hover:from-blue-600 hover:to-green-600 text-white font-bold py-3 px-6 rounded-lg">
                                Reset Filter
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Submit form saat filter checkbox diubah
        document.querySelectorAll('#filterForm input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        });

        // Color picker langsung submit saat dipilih
        document.querySelectorAll('label[for^="color-"]').forEach(label => {
            label.addEventListener('click', function() {
                const checkboxId = this.getAttribute('for');
                document.getElementById(checkboxId).checked = !document.getElementById(checkboxId).checked;
                document.getElementById('filterForm').submit();
            });
        });
    </script>
@endpush
