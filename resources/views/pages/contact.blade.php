@extends('layouts.app')

@section('title', 'Hubungi Kami - Honda Care')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-electric-blue to-fresh-green py-16 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Hubungi Kami</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Tim dukungan kami siap membantu Anda 24/7
            </p>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8 border border-gray-200">
                        <h2 class="font-heading text-2xl text-gray-800 mb-6">Informasi Kontak</h2>

                        <div class="space-y-6">
                            <div class="flex">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-honda-red to-vibrant-orange text-white flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Telepon</h3>
                                    <p class="text-gray-700">+62 21 1234 5678</p>
                                    <p class="text-gray-700">+62 812 3456 7890 (WhatsApp)</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-electric-blue to-fresh-green text-white flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Email</h3>
                                    <p class="text-gray-700">info@hondacare.id</p>
                                    <p class="text-gray-700">support@hondacare.id</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-sunny-yellow to-vibrant-orange text-white flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Kantor Pusat</h3>
                                    <p class="text-gray-700">Jl. Sudirman Kav. 1, Jakarta Selatan</p>
                                    <p class="text-gray-700">DKI Jakarta, 12920, Indonesia</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-r from-fresh-green to-electric-blue text-white flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Jam Operasional</h3>
                                    <p class="text-gray-700">Senin - Jumat: 08:00 - 17:00 WIB</p>
                                    <p class="text-gray-700">Sabtu: 09:00 - 14:00 WIB</p>
                                    <p class="text-gray-700">Minggu & Hari Libur: Tutup</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h3 class="font-semibold text-lg text-gray-800 mb-4">Ikuti Kami</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-600 to-blue-800 text-white flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-700 to-blue-900 text-white flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gradient-to-r from-red-600 to-red-800 text-white flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                    </svg>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 text-white flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 bg-gradient-to-br from-sunny-yellow to-vibrant-orange bg-opacity-10 rounded-2xl p-6 border border-yellow-200">
                        <h3 class="font-heading text-xl text-gray-800 mb-4">Layanan Darurat 24/7</h3>
                        <p class="text-gray-700 mb-4">
                            Untuk layanan darurat seperti mogok atau kecelakaan, hubungi:
                        </p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-honda-red to-vibrant-orange text-white flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-lg">+62 812 3456 7890</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div>
                    <div class="bg-white rounded-2xl shadow-xl p-8">
                        <h2 class="font-heading text-2xl text-gray-800 mb-6">Kirim Pesan</h2>

                        <form>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                                    <input type="text"
                                           class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                           placeholder="Nama Anda">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Email</label>
                                    <input type="email"
                                           class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                           placeholder="email@contoh.com">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-medium mb-2">Subjek</label>
                                <input type="text"
                                       class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                       placeholder="Subjek pesan">
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 font-medium mb-2">Pesan</label>
                                <textarea rows="5"
                                          class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                          placeholder="Tulis pesan Anda"></textarea>
                            </div>

                            <div>
                                <button type="submit"
                                        class="w-full bg-gradient-to-r from-honda-red to-vibrant-orange hover:from-red-600 hover:to-orange-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition-all transform hover:scale-[1.02]">
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-8 bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="font-heading text-xl text-gray-800 mb-4">Dealer Terdekat</h3>
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 bg-gray-200 rounded-xl overflow-hidden mr-4"></div>
                            <div>
                                <h4 class="font-bold text-gray-800">Honda Sudirman Jakarta</h4>
                                <p class="text-sm text-gray-600">Jl. Sudirman Kav. 12, Jakarta Selatan</p>
                                <p class="text-sm text-gray-600">+62 21 2345 6789</p>
                            </div>
                        </div>
                        <a href="#" class="inline-block w-full text-center bg-gradient-to-r from-gray-800 to-gray-900 hover:from-gray-700 hover:to-gray-800 text-white py-3 px-4 rounded-lg font-medium">
                            Lihat Semua Dealer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="h-96 w-full bg-gray-300">
                    <!-- Google Map Embed -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613506864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x57b4c5a10d5c5b5d!2sJl.%20Sudirman%2C%20RT.1%2FRW.3%2C%20Karet%20Tengah%2C%20Kecamatan%20Setiabudi%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012920!5e0!3m2!1sen!2sid!4v1650000000000!5m2!1sen!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>
@endsection
