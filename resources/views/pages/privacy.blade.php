@extends('layouts.app')

@section('title', 'Kebijakan Privasi - Honda Care')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-electric-blue to-fresh-green py-16 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Kebijakan Privasi</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda
            </p>
        </div>
    </section>

    <!-- Privacy Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="prose max-w-none">
                        <p class="mb-6">
                            Kebijakan Privasi ini menjelaskan bagaimana Honda Care mengumpulkan, menggunakan, dan mengungkapkan informasi pribadi
                            Anda ketika Anda menggunakan layanan kami. Dengan menggunakan layanan kami, Anda menyetujui pengumpulan dan penggunaan
                            informasi sesuai dengan kebijakan ini.
                        </p>

                        <h2 class="font-heading text-2xl text-gray-800 mb-6">Informasi yang Kami Kumpulkan</h2>

                        <h3 class="font-heading text-xl text-gray-800 mt-6 mb-3">1. Informasi yang Anda Berikan</h3>
                        <p class="mb-4">
                            Kami mengumpulkan informasi yang Anda berikan secara langsung saat:
                        </p>
                        <ul class="list-disc pl-6 mb-6 space-y-2">
                            <li>Membuat akun di platform kami</li>
                            <li>Mengisi formulir kontak atau permintaan informasi</li>
                            <li>Menggunakan layanan simulasi kredit</li>
                            <li>Berlangganan newsletter kami</li>
                            <li>Berpartisipasi dalam survei atau promosi</li>
                        </ul>

                        <h3 class="font-heading text-xl text-gray-800 mt-6 mb-3">2. Informasi yang Dikumpulkan Secara Otomatis</h3>
                        <p class="mb-4">
                            Saat Anda mengakses layanan kami, kami dapat mengumpulkan informasi tertentu secara otomatis, termasuk:
                        </p>
                        <ul class="list-disc pl-6 mb-6 space-y-2">
                            <li>Alamat IP dan jenis perangkat</li>
                            <li>Informasi browser dan sistem operasi</li>
                            <li>Halaman yang dikunjungi dan waktu akses</li>
                            <li>Data lokasi (jika diizinkan)</li>
                        </ul>

                        <h3 class="font-heading text-xl text-gray-800 mt-6 mb-3">3. Cookie dan Teknologi Pelacakan</h3>
                        <p class="mb-4">
                            Kami menggunakan cookie dan teknologi pelacakan serupa untuk meningkatkan pengalaman pengguna,
                            menganalisis lalu lintas, dan menayangkan iklan yang ditargetkan.
                        </p>

                        <h2 class="font-heading text-2xl text-gray-800 mt-10 mb-6">Penggunaan Informasi</h2>
                        <p class="mb-6">
                            Kami menggunakan informasi yang kami kumpulkan untuk berbagai tujuan, termasuk:
                        </p>
                        <ul class="list-disc pl-6 mb-6 space-y-2">
                            <li>Menyediakan, mengoperasikan, dan memelihara layanan kami</li>
                            <li>Memperbaiki, menyesuaikan, dan mengembangkan layanan kami</li>
                            <li>Memahami dan menganalisis bagaimana Anda menggunakan layanan kami</li>
                            <li>Mengembangkan produk, layanan, fitur, dan fungsi baru</li>
                            <li>Mengirimkan pemberitahuan dan informasi terkait layanan</li>
                            <li>Memproses transaksi dan mengelola pesanan</li>
                            <li>Mencegah penipuan dan meningkatkan keamanan</li>
                        </ul>

                        <h2 class="font-heading text-2xl text-gray-800 mt-10 mb-6">Berbagi Informasi</h2>
                        <p class="mb-6">
                            Kami dapat membagikan informasi pribadi Anda dalam situasi berikut:
                        </p>
                        <ul class="list-disc pl-6 mb-6 space-y-2">
                            <li><strong>Dengan Penyedia Layanan:</strong> Dengan pihak ketiga yang membantu kami mengoperasikan layanan kami</li>
                            <li><strong>Untuk Kepatuhan Hukum:</strong> Jika diwajibkan oleh hukum atau menanggapi permintaan pemerintah</li>
                            <li><strong>Untuk Melindungi Hak:</strong> Untuk melindungi hak, properti, atau keselamatan Honda Care, pengguna kami, atau publik</li>
                            <li><strong>Dengan Persetujuan Anda:</strong> Untuk tujuan lain dengan persetujuan Anda</li>
                        </ul>

                        <h2 class="font-heading text-2xl text-gray-800 mt-10 mb-6">Keamanan Data</h2>
                        <p class="mb-6">
                            Kami menggunakan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi informasi pribadi
                            Anda dari akses, penggunaan, atau pengungkapan yang tidak sah. Namun, tidak ada metode transmisi melalui internet
                            atau metode penyimpanan elektronik yang 100% aman.
                        </p>

                        <h2 class="font-heading text-2xl text-gray-800 mt-10 mb-6">Hak Privasi Anda</h2>
                        <p class="mb-4">
                            Tergantung pada yurisdiksi Anda, Anda mungkin memiliki hak berikut terkait informasi pribadi Anda:
                        </p>
                        <ul class="list-disc pl-6 mb-6 space-y-2">
                            <li>Mengakses informasi pribadi yang kami miliki tentang Anda</li>
                            <li>Memperbarui atau mengoreksi informasi yang tidak akurat</li>
                            <li>Menghapus informasi pribadi Anda</li>
                            <li>Membatasi pemrosesan informasi pribadi Anda</li>
                            <li>Menerima salinan informasi pribadi Anda dalam format terstruktur</li>
                        </ul>

                        <h2 class="font-heading text-2xl text-gray-800 mt-10 mb-6">Perubahan pada Kebijakan Privasi</h2>
                        <p class="mb-6">
                            Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan
                            penting dengan menempatkan pemberitahuan yang mencolok di layanan kami atau dengan mengirimkan pemberitahuan langsung.
                        </p>

                        <div class="mt-10 pt-6 border-t border-gray-200">
                            <p class="text-gray-700">
                                <strong>Tanggal Efektif:</strong> 1 Januari 2023
                            </p>
                            <p class="text-gray-700">
                                <strong>Terakhir Diperbarui:</strong> 15 Juni 2023
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 text-center">
                    <p class="text-gray-700 mb-6">
                        Untuk pertanyaan tentang Kebijakan Privasi kami, silakan hubungi:
                    </p>
                    <a href="{{ route('contact') }}"
                       class="inline-block bg-gradient-to-r from-honda-red to-vibrant-orange hover:from-red-600 hover:to-orange-600 text-white font-bold py-3 px-8 rounded-lg">
                        Hubungi Tim Privasi
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
