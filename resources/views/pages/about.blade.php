@extends('layouts.app')

@section('title', 'Tentang Kami - Honda Care')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-honda-red to-vibrant-orange py-16 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Tentang Honda Care</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Menyediakan solusi terbaik untuk kebutuhan otomotif Anda sejak 2005
            </p>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Company Overview -->
                <div class="mb-16">
                    <div class="flex flex-col md:flex-row gap-8 items-center">
                        <div class="md:w-1/2">
                            <div class="bg-gradient-to-br from-sunny-yellow to-vibrant-orange bg-opacity-10 p-8 rounded-2xl border border-yellow-200">
                                <h2 class="font-heading text-2xl text-gray-800 mb-4">Visi Kami</h2>
                                <p class="text-gray-700 mb-6">
                                    Menjadi penyedia layanan otomotif terdepan di Indonesia dengan fokus pada kepuasan pelanggan dan inovasi berkelanjutan.
                                </p>

                                <h2 class="font-heading text-2xl text-gray-800 mb-4">Misi Kami</h2>
                                <ul class="space-y-3 text-gray-700">
                                    <li class="flex items-start">
                                        <div class="w-6 h-6 rounded-full bg-gradient-to-r from-honda-red to-vibrant-orange flex items-center justify-center mt-1 mr-3 flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span>Menyediakan produk dan layanan otomotif berkualitas tinggi</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-6 h-6 rounded-full bg-gradient-to-r from-honda-red to-vibrant-orange flex items-center justify-center mt-1 mr-3 flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span>Memberikan pengalaman pelanggan yang luar biasa</span>
                                    </li>
                                    <li class="flex items-start">
                                        <div class="w-6 h-6 rounded-full bg-gradient-to-r from-honda-red to-vibrant-orange flex items-center justify-center mt-1 mr-3 flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span>Mengembangkan solusi inovatif untuk kebutuhan otomotif modern</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="md:w-1/2">
                            <h2 class="font-heading text-2xl text-gray-800 mb-4">Perjalanan Kami</h2>
                            <p class="text-gray-700 mb-6">
                                Honda Care didirikan pada tahun 2005 dengan misi menyediakan layanan otomotif berkualitas tinggi.
                                Selama lebih dari 18 tahun, kami telah berkembang menjadi mitra terpercaya bagi ribuan pelanggan di seluruh Indonesia.
                            </p>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gradient-to-br from-electric-blue to-fresh-green bg-opacity-10 p-4 rounded-xl border border-blue-200">
                                    <p class="text-3xl font-bold text-honda-red">18+</p>
                                    <p class="text-gray-700">Tahun Pengalaman</p>
                                </div>
                                <div class="bg-gradient-to-br from-electric-blue to-fresh-green bg-opacity-10 p-4 rounded-xl border border-blue-200">
                                    <p class="text-3xl font-bold text-honda-red">50+</p>
                                    <p class="text-gray-700">Dealer Mitra</p>
                                </div>
                                <div class="bg-gradient-to-br from-electric-blue to-fresh-green bg-opacity-10 p-4 rounded-xl border border-blue-200">
                                    <p class="text-3xl font-bold text-honda-red">500K+</p>
                                    <p class="text-gray-700">Pelanggan</p>
                                </div>
                                <div class="bg-gradient-to-br from-electric-blue to-fresh-green bg-opacity-10 p-4 rounded-xl border border-blue-200">
                                    <p class="text-3xl font-bold text-honda-red">24/7</p>
                                    <p class="text-gray-700">Layanan Dukungan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Our Values -->
                <div class="mb-16">
                    <h2 class="font-heading text-3xl text-center text-gray-800 mb-10">Nilai Inti Kami</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-r from-honda-red to-vibrant-orange text-white flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="font-heading text-xl text-gray-800 mb-3">Keandalan</h3>
                            <p class="text-gray-700">
                                Produk dan layanan yang dapat diandalkan dengan standar kualitas tertinggi
                            </p>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-r from-electric-blue to-fresh-green text-white flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </div>
                            <h3 class="font-heading text-xl text-gray-800 mb-3">Pelayanan</h3>
                            <p class="text-gray-700">
                                Komitmen untuk memberikan pengalaman pelanggan yang luar biasa
                            </p>
                        </div>

                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-r from-sunny-yellow to-vibrant-orange text-white flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="font-heading text-xl text-gray-800 mb-3">Inovasi</h3>
                            <p class="text-gray-700">
                                Terus mengembangkan solusi baru untuk kebutuhan otomotif modern
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Our Team -->
                <div>
                    <h2 class="font-heading text-3xl text-center text-gray-800 mb-10">Tim Kami</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="mx-auto w-32 h-32 rounded-full bg-gradient-to-r from-electric-blue to-fresh-green p-1 mb-4">
                                <div class="bg-white rounded-full p-1">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-full w-full h-full"></div>
                                </div>
                            </div>
                            <h3 class="font-heading text-xl text-gray-800">Budi Santoso</h3>
                            <p class="text-honda-red font-medium">CEO & Founder</p>
                        </div>

                        <div class="text-center">
                            <div class="mx-auto w-32 h-32 rounded-full bg-gradient-to-r from-sunny-yellow to-vibrant-orange p-1 mb-4">
                                <div class="bg-white rounded-full p-1">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-full w-full h-full"></div>
                                </div>
                            </div>
                            <h3 class="font-heading text-xl text-gray-800">Dewi Lestari</h3>
                            <p class="text-honda-red font-medium">Direktur Pemasaran</p>
                        </div>

                        <div class="text-center">
                            <div class="mx-auto w-32 h-32 rounded-full bg-gradient-to-r from-honda-red to-vibrant-orange p-1 mb-4">
                                <div class="bg-white rounded-full p-1">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-full w-full h-full"></div>
                                </div>
                            </div>
                            <h3 class="font-heading text-xl text-gray-800">Agus Supriyadi</h3>
                            <p class="text-honda-red font-medium">Manajer Teknik</p>
                        </div>

                        <div class="text-center">
                            <div class="mx-auto w-32 h-32 rounded-full bg-gradient-to-r from-fresh-green to-electric-blue p-1 mb-4">
                                <div class="bg-white rounded-full p-1">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-full w-full h-full"></div>
                                </div>
                            </div>
                            <h3 class="font-heading text-xl text-gray-800">Rina Wijaya</h3>
                            <p class="text-honda-red font-medium">Manajer Layanan Pelanggan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-electric-blue to-fresh-green text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-heading text-3xl md:text-4xl mb-6">Tertarik Bergabung Dengan Kami?</h2>
            <p class="max-w-2xl mx-auto mb-8 text-xl opacity-90">
                Kami selalu mencari talenta berbakat untuk bergabung dengan tim Honda Care
            </p>
            <a href="{{ route('contact') }}"
               class="inline-block bg-white text-gray-800 hover:bg-gray-100 font-bold py-3 px-8 rounded-full shadow-lg transition-all transform hover:scale-105">
                Lihat Lowongan Kerja
            </a>
        </div>
    </section>
@endsection
