@extends('layouts.app')

@section('title', 'Simulasi Kredit Motor Honda')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-electric-blue to-fresh-green py-12 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="font-heading text-3xl md:text-4xl mb-6">Simulasi Kredit Motor Honda</h1>
            <p class="max-w-2xl mx-auto text-xl opacity-90">
                Hitung angsuran bulanan dan biaya lainnya dengan mudah
            </p>
        </div>
    </section>

    <!-- Simulation Form -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Form Section -->
                <div class="bg-white rounded-2xl shadow-xl p-6 lg:p-8">
                    <h2 class="font-heading text-2xl text-gray-800 mb-6">Pilih Motor & Leasing</h2>

                    <form id="simulationForm" method="POST" action="{{ route('credit-simulation.calculate') }}">
                        @csrf

                        <!-- Motor Selection -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Pilih Motor</label>
                            <select name="motor_id"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue bg-gray-50"
                                    required id="motorSelect">
                                <option value="">-- Pilih Model Motor --</option>
                                @foreach($motors as $motor)
                                    <option value="{{ $motor->id }}"
                                            data-price="{{ $motor->price }}"
                                        {{ old('motor_id') == $motor->id ? 'selected' : '' }}>
                                        {{ $motor->name }} - Rp {{ number_format($motor->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Leasing Company Selection -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Pilih Leasing</label>
                            <select name="leasing_company_id"
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue bg-gray-50"
                                    required id="leasingSelect">
                                <option value="">-- Pilih Leasing --</option>
                                @foreach($leasingCompanies as $leasing)
                                    <option value="{{ $leasing->id }}"
                                            data-interest="{{ $leasing->interest_rate }}"
                                            data-admin="{{ $leasing->admin_fee }}"
                                        {{ old('leasing_company_id') == $leasing->id ? 'selected' : '' }}>
                                        {{ $leasing->name }} (Bunga: {{ $leasing->interest_rate }}% / Admin: Rp {{ number_format($leasing->admin_fee, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Paket Cicilan -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">
                                Pilih Paket Cicilan
                                <span class="text-sm font-normal text-gray-500" id="packageHelp"></span>
                            </label>
                            <div id="installmentPackages" class="space-y-3">
                                <!-- Paket akan diisi oleh JavaScript -->
                            </div>
                        </div>

                        <!-- Additional Costs -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-2">Biaya Tambahan</label>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="insurance" value="1"
                                               class="rounded text-electric-blue focus:ring-electric-blue"
                                               id="insuranceCheckbox">
                                        <span class="ml-2">Asuransi (Rp 1.000.000)</span>
                                    </label>
                                    <input type="hidden" name="insurance_fee" id="insuranceFeeInput" value="0">
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">Biaya Lainnya (STNK, Plat, dll)</label>
                                    <div class="flex items-center">
                                        <span class="mr-2 text-gray-600">Rp</span>
                                        <input type="number" name="additional_costs"
                                               value="{{ old('additional_costs', 0) }}"
                                               class="w-full px-4 py-3 border rounded-lg focus:ring-electric-blue focus:border-electric-blue"
                                               placeholder="Contoh: 500000">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-honda-red to-vibrant-orange hover:from-red-600 hover:to-orange-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition-all transform hover:scale-[1.02]">
                                Hitung Simulasi Kredit
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Preview Section -->
                <div class="sticky top-24">
                    <div class="bg-gradient-to-br from-sunny-yellow to-vibrant-orange bg-opacity-10 rounded-2xl p-6 border border-yellow-200">
                        <h2 class="font-heading text-2xl text-gray-800 mb-6">Ringkasan Simulasi</h2>

                        <div class="space-y-6" id="previewContainer">
                            <div class="text-center py-12">
                                <div class="mb-6 mx-auto w-24 h-24 rounded-full bg-gradient-to-r from-gray-200 to-gray-300 text-gray-400 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="font-heading text-xl text-gray-800 mb-3">Lengkapi Form Simulasi</h3>
                                <p class="text-gray-600">
                                    Pilih motor, leasing, dan paket cicilan untuk melihat perhitungan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('simulationForm');
            const motorSelect = form.querySelector('#motorSelect');
            const leasingSelect = form.querySelector('#leasingSelect');
            const insuranceCheckbox = document.getElementById('insuranceCheckbox');
            const insuranceFeeInput = document.getElementById('insuranceFeeInput');
            const previewContainer = document.getElementById('previewContainer');
            const installmentPackages = document.getElementById('installmentPackages');
            const packageHelp = document.getElementById('packageHelp');

            let motorPrice = 0;
            let interestRate = 0.08; // Default 8%
            let adminFee = 0;
            let currentPackages = [];

            // Form submission handler
            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                // Validasi form
                if (!motorSelect.value || !leasingSelect.value) {
                    previewContainer.innerHTML = `
            <div class="text-center py-12">
                <div class="mb-6 mx-auto w-24 h-24 rounded-full bg-red-100 text-red-500 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="font-heading text-xl text-gray-800 mb-3">Form Tidak Lengkap</h3>
                <p class="text-gray-600">
                    Silakan pilih motor dan leasing terlebih dahulu
                </p>
            </div>
        `;
                    return;
                }

                // Show loading indicator
                previewContainer.innerHTML = `
        <div class="text-center py-12">
            <div class="mb-6 mx-auto w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center">
                <svg class="animate-spin h-12 w-12 text-honda-red" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <h3 class="font-heading text-xl text-gray-800 mb-3">Memproses Simulasi</h3>
            <p class="text-gray-600">
                Sedang menghitung dan menyimpan simulasi Anda...
            </p>
        </div>
    `;

                try {
                    const formData = new FormData(form);

                    // Tambahkan CSRF token
                    formData.append('_token', '{{ csrf_token() }}');

                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.error || 'Terjadi kesalahan saat menghitung simulasi.');
                    }

                    // Redirect to result page
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        throw new Error('URL hasil tidak ditemukan');
                    }
                } catch (error) {
                    // Show error message
                    previewContainer.innerHTML = `
            <div class="text-center py-12">
                <div class="mb-6 mx-auto w-24 h-24 rounded-full bg-red-100 text-red-500 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="font-heading text-xl text-gray-800 mb-3">Gagal Menghitung</h3>
                <p class="text-gray-600">
                    ${error.message}
                </p>
                <div class="mt-4">
                    <button onclick="window.location.reload()" class="text-honda-red hover:underline">
                        Coba Lagi
                    </button>
                </div>
            </div>
        `;
                }
            });

            // Update motor price when selection changes
            motorSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                motorPrice = selectedOption ? parseFloat(selectedOption.dataset.price) : 0;
                fetchInstallmentPackages(this.value);
                updatePreview();
            });

            // Fetch installment packages from server
            function fetchInstallmentPackages(motorId) {
                if (!motorId) {
                    installmentPackages.innerHTML = '<p class="text-gray-500 py-4 text-center">Pilih motor terlebih dahulu</p>';
                    return;
                }

                // Clear packages
                installmentPackages.innerHTML = '<p class="text-gray-500 py-4 text-center">Memuat paket cicilan...</p>';

                // Fetch packages from server
                fetch(`/api/motors/${motorId}/installments`)
                    .then(response => response.json())
                    .then(packages => {
                        currentPackages = packages;
                        renderInstallmentPackages(packages);
                    })
                    .catch(() => {
                        installmentPackages.innerHTML = '<p class="text-red-500 py-4 text-center">Gagal memuat paket cicilan</p>';
                    });
            }

            // Render installment packages
            function renderInstallmentPackages(packages) {
                if (packages.length === 0) {
                    installmentPackages.innerHTML = '<p class="text-gray-500 py-4 text-center">Tidak ada paket cicilan tersedia</p>';
                    return;
                }

                let html = '';
                packages.forEach((pkg, index) => {
                    const isRecommended = pkg.down_payment >= motorPrice * 0.2;

                    html += `
                    <div class="relative">
                        <input type="radio" name="installment_id" value="${pkg.id}"
                               id="package-${pkg.id}"
                               class="hidden peer"
                               data-dp="${pkg.down_payment}"
                               data-tenor="${pkg.tenor_months}"
                               data-monthly="${pkg.installment_amount}"
                               ${index === 0 ? 'checked' : ''}>
                        <label for="package-${pkg.id}"
                               class="block p-4 border rounded-lg cursor-pointer transition-all
                                      peer-checked:border-honda-red peer-checked:ring-2 peer-checked:ring-honda-red
                                      hover:border-electric-blue ${isRecommended ? 'bg-blue-50 border-blue-200' : ''}">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="font-medium">Rp ${pkg.down_payment.toLocaleString('id-ID')}</div>
                                    <div class="text-sm text-gray-500 mt-1">${pkg.tenor_months} Bulan</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-honda-red">Rp ${pkg.installment_amount.toLocaleString('id-ID')}/bln</div>
                                    <div class="text-xs text-gray-500 mt-1">Total: Rp ${(pkg.installment_amount * pkg.tenor_months).toLocaleString('id-ID')}</div>
                                </div>
                            </div>
                            ${isRecommended ? `
                            <div class="mt-2 inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Direkomendasikan
                            </div>` : ''}
                        </label>
                    </div>
                    `;
                });

                installmentPackages.innerHTML = html;
                packageHelp.textContent = `Tersedia ${packages.length} paket cicilan`;

                // Add event listeners to packages
                document.querySelectorAll('input[name="installment_id"]').forEach(radio => {
                    radio.addEventListener('change', updatePreview);
                });

                // Trigger initial preview update
                updatePreview();
            }

            // Update leasing details when selection changes
            leasingSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption && selectedOption.dataset.interest) {
                    interestRate = parseFloat(selectedOption.dataset.interest) / 100;
                    adminFee = parseFloat(selectedOption.dataset.admin) || 0;
                } else {
                    interestRate = 0.08; // Default 8%
                    adminFee = 0;
                }
                updatePreview();
            });

            // Insurance checkbox
            insuranceCheckbox.addEventListener('change', function() {
                insuranceFeeInput.value = this.checked ? 1000000 : 0;
                updatePreview();
            });

            // Update preview on any change
            form.addEventListener('change', updatePreview);
            form.addEventListener('input', updatePreview);

            function updatePreview() {
                const selectedPackage = form.querySelector('input[name="installment_id"]:checked');
                const additionalCostsInput = form.querySelector('input[name="additional_costs"]');
                const additionalCosts = additionalCostsInput ? parseFloat(additionalCostsInput.value) || 0 : 0;

                if (!motorPrice || !selectedPackage) {
                    previewContainer.innerHTML = `
                    <div class="text-center py-12">
                        <div class="mb-6 mx-auto w-24 h-24 rounded-full bg-gradient-to-r from-gray-200 to-gray-300 text-gray-400 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-heading text-xl text-gray-800 mb-3">Pilih Motor dan Paket Cicilan</h3>
                        <p class="text-gray-600">
                            Silakan pilih model motor dan paket cicilan untuk melihat perhitungan
                        </p>
                    </div>
                `;
                    return;
                }

                const downPayment = parseFloat(selectedPackage.dataset.dp);
                const tenor = parseInt(selectedPackage.dataset.tenor);
                const monthlyPayment = parseFloat(selectedPackage.dataset.monthly);
                const insuranceFee = insuranceCheckbox.checked ? 1000000 : 0;
                const totalPayment = downPayment + (monthlyPayment * tenor) + additionalCosts + insuranceFee + adminFee;

                previewContainer.innerHTML = `
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-gray-600">Harga Motor</span>
                        <span class="font-bold">Rp ${motorPrice.toLocaleString('id-ID')}</span>
                    </div>

                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-gray-600">Uang Muka</span>
                        <span class="font-bold">Rp ${downPayment.toLocaleString('id-ID')} <span class="text-sm text-gray-500">(${Math.round((downPayment/motorPrice)*100)}%)</span></span>
                    </div>

                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-gray-600">Pinjaman</span>
                        <span class="font-bold">Rp ${(motorPrice - downPayment).toLocaleString('id-ID')}</span>
                    </div>

                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-gray-600">Jangka Waktu</span>
                        <span class="font-bold">${tenor} Bulan</span>
                    </div>

                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-gray-600">Suku Bunga</span>
                        <span class="font-bold">${(interestRate * 100).toFixed(2)}%</span>
                    </div>

                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-gray-600">Biaya Admin</span>
                        <span class="font-bold">Rp ${adminFee.toLocaleString('id-ID')}</span>
                    </div>

                    <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                        <span class="text-gray-600">Biaya Tambahan</span>
                        <span class="font-bold">Rp ${(additionalCosts + insuranceFee).toLocaleString('id-ID')}</span>
                    </div>

                    <div class="pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600 text-lg">Angsuran Bulanan</span>
                            <span class="font-bold text-xl text-honda-red">Rp ${monthlyPayment.toLocaleString('id-ID')}</span>
                        </div>

                        <div class="flex justify-between items-center mt-2">
                            <span class="text-gray-600">Total Pembayaran</span>
                            <span class="font-bold text-lg">Rp ${totalPayment.toLocaleString('id-ID')}</span>
                        </div>
                    </div>

                    <div class="mt-6 text-center text-sm text-gray-500">
                        <p>Total pembayaran termasuk uang muka, angsuran, biaya admin, dan biaya tambahan.</p>
                    </div>
                </div>
            `;
            }

            // Initial update if motor is preselected
            if (motorSelect.value) {
                const selectedMotor = motorSelect.options[motorSelect.selectedIndex];
                motorPrice = selectedMotor ? parseFloat(selectedMotor.dataset.price) : 0;
                fetchInstallmentPackages(motorSelect.value);
            }
        });
    </script>
@endpush
