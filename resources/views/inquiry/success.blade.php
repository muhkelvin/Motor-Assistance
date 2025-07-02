@extends('layouts.app')

@section('title', 'Konsultasi Terkirim')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-fresh-green to-electric-blue py-16 text-white">
        <div class="container mx-auto px-4 text-center">
            <div class="mb-6 mx-auto w-24 h-24 rounded-full bg-white flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Konsultasi Berhasil Dikirim!</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Terima kasih atas minat Anda pada produk Honda
            </p>
        </div>
    </section>

    <!-- Success Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <div class="bg-white rounded-2xl shadow-xl p-8 mb-10">
                    <h2 class="font-heading text-2xl text-gray-800 mb-4">Apa Selanjutnya?</h2>
                    <p class="text-gray-600 mb-6">
                        Tim Customer Service kami akan menghubungi Anda dalam waktu 1x24 jam melalui
                        <span class="font-medium">{{ session('success') }}</span>
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('home') }}"
                           class="bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg">
                            Kembali ke Beranda
                        </a>
                        <a href="{{ route('catalog.index') }}"
                           class="bg-gradient-to-r from-electric-blue to-fresh-green hover:from-blue-600 hover:to-green-600 text-white font-bold py-3 px-6 rounded-lg">
                            Lihat Katalog Motor
                        </a>
                    </div>
                </div>

                <!-- Additional Resources -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <a href="{{ route('credit-simulation.index') }}"
                       class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 border border-blue-200 hover:border-electric-blue transition-colors">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-electric-blue to-fresh-green text-white flex items-center justify-center mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Simulasi Kredit</h3>
                        <p class="text-sm text-gray-600">
                            Hitung angsuran bulanan untuk motor Honda impian Anda
                        </p>
                    </a>

                    <a href="{{ route('motors.compare') }}"
                       class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-xl p-6 border border-yellow-200 hover:border-vibrant-orange transition-colors">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-vibrant-orange to-honda-red text-white flex items-center justify-center mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Bandingkan Motor</h3>
                        <p class="text-sm text-gray-600">
                            Bandingkan spesifikasi motor Honda untuk pilihan terbaik
                        </p>
                    </a>

                    <a href="{{ route('inquiry.create') }}"
                       class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 border border-green-200 hover:border-fresh-green transition-colors">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-r from-fresh-green to-electric-blue text-white flex items-center justify-center mb-4 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-800 mb-2">Konsultasi Lain</h3>
                        <p class="text-sm text-gray-600">
                            Ajukan pertanyaan tambahan tentang produk Honda
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
