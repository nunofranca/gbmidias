
<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Simulator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@vite('resources/css/whats.css')
</head>
<body>
<!-- Mensagem para dispositivos desktop -->
<div class="desktop-message">
    <h1><i class="fab fa-whatsapp"></i> WhatsApp Simulator</h1>
    <p>Este simulador foi projetado para ser visualizado em dispositivos móveis. Por favor, acesse esta página em seu smartphone ou tablet, ou redimensione seu navegador para um tamanho de tela menor.</p>
    <div class="qr-code">
        <img src="https://oqg-primary-prod-content.s3.us-east-1.amazonaws.com/uploads/qr_codes/682490af8dd35.svg?1747226835" alt="QR Code">
    </div>
    <p>Escaneie o código QR com seu celular para acessar o simulador!</p>
</div>

<!-- Container principal para visualização móvel -->
<div class="chat-container">
    <div class="chat-header">
        <div class="back-button">
            <i class="fas fa-arrow-left"></i>
        </div>
        <div class="contact-info">
            <div class="contact-avatar">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Contact Avatar">
            </div>
            <div>
                <div class="contact-name">GB Mídias</div>
                <div class="contact-status">online</div>
            </div>
        </div>
        <div class="header-icons">
            <i class="fas fa-video"></i>
            <i class="fas fa-phone"></i>
            <i class="fas fa-ellipsis-v"></i>
        </div>
    </div>
    <div class="chat-messages">
        <div class="messages-container">
            <!-- As mensagens serão inseridas dinamicamente aqui -->
        </div>
    </div>
    <div class="chat-input">
        <div class="emoji-button">
            <i class="far fa-smile"></i>
        </div>
        <div class="attach-button">
            <i class="fas fa-paperclip"></i>
        </div>
        <input type="text" class="message-input" placeholder="Digite uma mensagem">
        <button class="send-button">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>
</div>
@vite('resources/js/whats.js')
</body>
</html>
