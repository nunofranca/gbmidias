@if ($qrCode)
    <div class="text-center space-y-4">
        <img src="{{ $qrCode }}" alt="QR Code" class="mx-auto w-64 h-64" />

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Código PIX (copia e cola)</label>
            <input
                type="text"
                value="{{ $paymentLink }}"
                readonly
                onclick="this.select(); document.execCommand('copy')"
                style="background-color: white; color: black; border: 1px solid #ccc; padding: 10px; font-size: 14px; width: 100%;"
            />


            <small class="text-gray-500">Clique no código para copiar</small>
        </div>
    </div>


@endif
