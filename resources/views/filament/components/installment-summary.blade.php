<div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 space-y-3">
    <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Calculation Summary</h4>

    <div class="grid grid-cols-2 gap-4">
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Motor Price:</span>
                <span class="text-sm font-medium">Rp {{ number_format($motor_price, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Down Payment:</span>
                <span class="text-sm font-medium">Rp {{ number_format($down_payment, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Loan Amount:</span>
                <span class="text-sm font-medium">Rp {{ number_format($motor_price - $down_payment, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Monthly Installment:</span>
                <span class="text-sm font-medium">Rp {{ number_format($installment_amount, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Total Installment:</span>
                <span class="text-sm font-medium">Rp {{ number_format($total_installment, 0, ',', '.') }}</span>
            </div>

            <div class="flex justify-between">
                <span class="text-sm text-gray-600 dark:text-gray-400">Total Payment:</span>
                <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">Rp {{ number_format($total_payment, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-200 dark:border-gray-700 pt-3 mt-3">
        <div class="flex justify-between items-center">
            <span class="text-sm text-gray-600 dark:text-gray-400">Interest Amount:</span>
            <span class="text-sm font-medium {{ $interest_amount > 0 ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}">
                Rp {{ number_format($interest_amount, 0, ',', '.') }}
            </span>
        </div>

        <div class="flex justify-between items-center mt-1">
            <span class="text-sm text-gray-600 dark:text-gray-400">Tenor:</span>
            <span class="text-sm font-medium">{{ $tenor_months }} months</span>
        </div>
    </div>
</div>
