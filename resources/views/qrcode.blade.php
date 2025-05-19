@if ($qrCode)
    <div class="text-center space-y-4">
        <img src="{{ $qrCode }}" alt="QR Code" class="mx-auto w-64 h-64" />

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Código PIX (copia e cola)</label>
            <input type="text" value="{{ $paymentLink }}" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm" onclick="this.select(); document.execCommand('copy')" />
            <small class="text-gray-500">Clique no código para copiar</small>
        </div>
    </div>


@endif
