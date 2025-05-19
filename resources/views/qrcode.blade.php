@if ($qrCode)
    <div class="mt-4 text-center">
        <p class="text-sm font-medium mb-2">Escaneie o QR Code abaixo:</p>
        <img src="{{ $qrCode }}" alt="QR Code PIX" class="mx-auto" />
    </div>
@endif
