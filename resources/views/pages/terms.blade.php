@extends('layouts.app')

@section('title', 'Syarat & Ketentuan - Honda Care')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-gray-800 to-gray-900 py-16 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Syarat & Ketentuan</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Ketentuan penggunaan layanan dan produk Honda Care
            </p>
        </div>
    </section>

    <!-- Terms Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="prose max-w-none">
                        <h2 class="font-heading text-2xl text-gray-800 mb-6">Penggunaan Layanan</h2>

                        <p class="mb-4">
                            Dengan mengakses dan menggunakan layanan Honda Care, Anda setuju untuk terikat oleh syarat dan ketentuan berikut.
                            Jika Anda tidak setuju dengan syarat dan ketentuan ini, harap jangan gunakan layanan kami.
                        </p>

                        <h3 class="font-heading text-xl text-gray-800 mt-8 mb-4">1. Definisi</h3>
                        <p class="mb-4">
                            <strong>Honda Care</strong> mengacu pada semua layanan yang disediakan oleh PT. Honda Care Indonesia, termasuk
                            situs web, aplikasi mobile, dan layanan pelanggan.
                        </p>

                        <h3 class="font-heading text-xl text-gray-800 mt-8 mb-4">2. Akun Pengguna</h3>
                        <p class="mb-4">
                            Untuk mengakses beberapa layanan, Anda mungkin perlu membuat akun. Anda bertanggung jawab untuk:
                        </p>
                        <ul class="list-disc pl-6 mb-4 space-y-2">
                            <li>Memastikan informasi yang diberikan akurat dan terbaru</li>
                            <li>Menjaga kerahasiaan informasi akun Anda</li>
                            <li>Segera memberi tahu kami tentang penggunaan akun yang tidak sah</li>
                        </ul>

                        <h3 class="font-heading text-xl text-gray-800 mt-8 mb-4">3. Layanan dan Produk</h3>
                        <p class="mb-4">
                            Kami berusaha menyediakan informasi yang akurat tentang produk dan layanan, tetapi tidak menjamin
                            keakuratan atau kelengkapan informasi tersebut. Harga dapat berubah tanpa pemberitahuan sebelumnya.
                        </p>

                        <h3 class="font-heading text-xl text-gray-800 mt-8 mb-4">4. Pembatasan Penggunaan</h3>
                        <p class="mb-4">
                            Anda setuju untuk tidak:
                        </p>
                        <ul class="list-disc pl-6 mb-4 space-y-2">
                            <li>Menggunakan layanan untuk tujuan ilegal atau tidak sah</li>
                            <li>Mengganggu atau mencoba mengganggu keamanan layanan</li>
                            <li>Menyebarkan virus atau kode berbahaya lainnya</li>
                            <li>Mengumpulkan data pengguna lain tanpa izin</li>
                        </ul>

                        <h3 class="font-heading text-xl text-gray-800 mt-8 mb-4">5. Hak Kekayaan Intelektual</h3>
                        <p class="mb-4">
                            Semua konten, logo, dan materi lainnya pada layanan Honda Care dilindungi oleh hak cipta, merek dagang,
                            dan hak kekayaan intelektual lainnya. Anda tidak diperbolehkan menggunakan materi ini tanpa izin tertulis dari kami.
                        </p>

                        <h3 class="font-heading text-xl text-gray-800 mt-8 mb-4">6. Pembatasan Tanggung Jawab</h3>
                        <p class="mb-4">
                            Honda Care tidak bertanggung jawab atas kerusakan langsung, tidak langsung, insidental, atau konsekuensial
                            yang timbul dari penggunaan layanan kami.
                        </p>

                        <h3 class="font-heading text-xl text-gray-800 mt-8 mb-4">7. Perubahan Syarat dan Ketentuan</h3>
                        <p class="mb-4">
                            Kami dapat memperbarui syarat dan ketentuan ini dari waktu ke waktu. Perubahan akan efektif segera setelah
                            diposting di situs kami. Penggunaan layanan yang berkelanjutan setelah perubahan berarti Anda menerima syarat dan ketentuan baru.
                        </p>

                        <h3 class="font-heading text-xl text-gray-800 mt-8 mb-4">8. Hukum yang Berlaku</h3>
                        <p class="mb-4">
                            Syarat dan ketentuan ini diatur oleh hukum Indonesia. Setiap sengketa yang timbul akan diselesaikan
                            di pengadilan yang berwenang di Jakarta.
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
                        Jika Anda memiliki pertanyaan tentang Syarat & Ketentuan ini, silakan hubungi kami:
                    </p>
                    <a href="{{ route('contact') }}"
                       class="inline-block bg-gradient-to-r from-honda-red to-vibrant-orange hover:from-red-600 hover:to-orange-600 text-white font-bold py-3 px-8 rounded-lg">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
