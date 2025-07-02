@extends('layouts.app')

@section('title', 'Ajukan Pertanyaan')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-electric-blue to-fresh-green py-12 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Konsultasi Motor Honda</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Tim ahli kami siap membantu Anda memilih motor Honda terbaik
            </p>
        </div>
    </section>

    <!-- Inquiry Form -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Motor/Simulation Info -->
                <div class="lg:col-span-1">
                    <div class="bg-gradient-to-br from-sunny-yellow to-vibrant-orange bg-opacity-10 rounded-2xl p-6 border border-yellow-200 sticky top-24">
                        <h2 class="font-heading text-xl text-gray-800 mb-4">Detail Konsultasi</h2>

                        @if($motor || $simulation)
                            <div class="space-y-6">
                                @if($motor)
                                    <div>
                                        <h3 class="font-semibold text-gray-700 mb-2">Motor yang Ditanyakan</h3>
                                        <div class="flex items-center">
                                            @if($motor->images->first())
                                                <div class="w-16 h-16 rounded-xl overflow-hidden mr-4">
                                                    <img src="{{ asset('storage/' . $motor->images->first()->path) }}"
                                                         alt="{{ $motor->name }}"
                                                         class="w-full h-full object-cover">
                                                </div>
                                            @endif
                                            <div>
                                                <h4 class="font-bold text-gray-800">{{ $motor->name }}</h4>
                                                <p class="text-sm text-gray-600">{{ $motor->category->name }}</p>
                                                <p class="text-honda-red font-bold">Rp {{ number_format($motor->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($simulation)
                                    <div>
                                        <h3 class="font-semibold text-gray-700 mb-2">Simulasi Kredit</h3>
                                        <div class="space-y-2">
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Leasing:</span>
                                                <span class="font-medium">{{ $simulation->leasingCompany->name }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Angsuran:</span>
                                                <span class="font-bold text-honda-red">{{ $simulation->formatted_monthly_payment }}</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Tenor:</span>
                                                <span class="font-medium">{{ $simulation->tenor_months }} Bulan</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600">Uang Muka:</span>
                                                <span class="font-medium">Rp {{ number_format($simulation->down_payment, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="pt-4 border-t border-yellow-200">
                                    <h3 class="font-semibold text-gray-700 mb-3">Tim Support Kami</h3>
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-electric-blue to-fresh-green text-white flex items-center justify-center mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium">Customer Service</p>
                                            <p class="text-sm text-gray-600">+62 21 1234 5678</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="mb-4 mx-auto w-16 h-16 rounded-full bg-gradient-to-r from-gray-200 to-gray-300 text-gray-400 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                </div>
                                <h3 class="font-heading text-lg text-gray-800 mb-2">Pertanyaan Umum</h3>
                                <p class="text-gray-600">
                                    Ajukan pertanyaan umum tentang produk Honda atau layanan kami
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 bg-gradient-to-br from-honda-red to-vibrant-orange bg-opacity-10 rounded-2xl p-6 border border-red-200">
                        <h3 class="font-heading text-lg text-gray-800 mb-4">Respon Cepat via WhatsApp</h3>
                        <p class="text-gray-600 mb-4">
                            Untuk respon lebih cepat, hubungi kami langsung melalui WhatsApp
                        </p>
                        <a href="https://wa.me/622112345678"
                           target="_blank"
                           class="inline-flex items-center justify-center w-full bg-gradient-to-r from-green-600 to-green-800 hover:from-green-500 hover:to-green-700 text-white py-3 px-4 rounded-lg font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.361.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Chat via WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl p-6 lg:p-8">
                        <h2 class="font-heading text-2xl text-gray-800 mb-6">Form Konsultasi</h2>

                        <form action="{{ route('inquiry.store') }}" method="POST">
                            @csrf

                            @if($motor)
                                <input type="hidden" name="motor_id" value="{{ $motor->id }}">
                            @endif

                            @if($simulation)
                                <input type="hidden" name="simulation_id" value="{{ $simulation->id }}">
                            @endif

                            <!-- Customer Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                                    <input type="text" name="customer_name"
                                           value="{{ old('customer_name') }}"
                                           class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                           placeholder="Nama Anda"
                                           required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                                    <input type="email" name="email"
                                           value="{{ old('email') }}"
                                           class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                           placeholder="email@contoh.com"
                                           required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                                    <input type="tel" name="phone"
                                           value="{{ old('phone') }}"
                                           class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                           placeholder="0812-3456-7890"
                                           required>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Subjek</label>
                                    <input type="text" name="subject"
                                           value="{{ old('subject', $motor ? 'Pertanyaan tentang ' . $motor->name : '') }}"
                                           class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                           placeholder="Subjek pertanyaan"
                                           required>
                                </div>
                            </div>

                            <!-- Inquiry Details -->
                            <div class="mb-6">
                                <label class="block text-gray-700 font-medium mb-2">Pertanyaan/Konsultasi</label>
                                <textarea name="notes"
                                          rows="5"
                                          class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                          placeholder="Tulis pertanyaan atau kebutuhan Anda secara detail"
                                          required>{{ old('notes') }}</textarea>
                            </div>

                            <!-- Preferred Contact -->
                            <div class="mb-8">
                                <label class="block text-gray-700 font-medium mb-3">Metode Kontak yang Dipilih</label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <div>
                                        <input type="radio" name="preferred_contact" id="contact-phone"
                                               value="phone" class="hidden peer" checked>
                                        <label for="contact-phone"
                                               class="block text-center py-3 border rounded-lg cursor-pointer peer-checked:border-electric-blue peer-checked:bg-blue-50 peer-checked:ring-2 peer-checked:ring-electric-blue">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            Telepon
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="preferred_contact" id="contact-email"
                                               value="email" class="hidden peer">
                                        <label for="contact-email"
                                               class="block text-center py-3 border rounded-lg cursor-pointer peer-checked:border-electric-blue peer-checked:bg-blue-50 peer-checked:ring-2 peer-checked:ring-electric-blue">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            Email
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="preferred_contact" id="contact-whatsapp"
                                               value="whatsapp" class="hidden peer">
                                        <label for="contact-whatsapp"
                                               class="block text-center py-3 border rounded-lg cursor-pointer peer-checked:border-electric-blue peer-checked:bg-blue-50 peer-checked:ring-2 peer-checked:ring-electric-blue">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-1" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.361.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                            </svg>
                                            WhatsApp
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button type="submit"
                                        class="w-full bg-gradient-to-r from-honda-red to-vibrant-orange hover:from-red-600 hover:to-orange-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition-all transform hover:scale-[1.02]">
                                    Kirim Konsultasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
