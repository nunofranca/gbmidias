import axios from "axios";

document.addEventListener('DOMContentLoaded', async function () {
    const messagesContainer = document.querySelector('.messages-container');
    const messageInput = document.querySelector('.message-input');
    const sendButton = document.querySelector('.send-button');
    const chatMessages = document.querySelector('.chat-messages');


    // Garante threadId no localStorage
    if (!localStorage.getItem('threadId')) {
        const threadId = await axios.post('/createThread', {}, {
            headers: {
                "Accept": 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
       localStorage.setItem('threadId', threadId.data.id);
    }


    // Respostas automáticas
    const autoResponses = [
        "Tudo ótimo! E com você?",
        "Desculpe a demora, estou a caminho!",
        "Acabei de ver sua mensagem!",
        "Vou chegar em 10 minutos, pode ser?",
        "Estou com uma emergência, podemos remarcar?",
        "Não consegui encontrar o local. Pode mandar a localização?",
        "Entendi! Vamos combinar os detalhes depois.",
        "Que bom! Estou ansiosa para nosso encontro!"
    ];

    // Scroll para o final da conversa
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Adiciona uma nova mensagem
    function addMessage(text, type, withTime = true) {
        const message = document.createElement('div');
        message.className = `message ${type}`;

        const messageText = document.createElement('div');
        messageText.textContent = text;
        message.appendChild(messageText);

        if (withTime) {
            const now = new Date();
            const time = document.createElement('span');
            time.className = 'time';
            time.textContent = `${now.getHours()}:${String(now.getMinutes()).padStart(2, '0')}`;
            message.appendChild(time);
        }

        if (type === 'sent') {
            const delivered = document.createElement('span');
            delivered.className = 'message-delivered';
            delivered.innerHTML = '<i class="fas fa-check-double"></i>';
            message.appendChild(delivered);
        }

        messagesContainer.appendChild(message);
        scrollToBottom();
    }

    // Mostra indicador de digitação
    function showTypingIndicator() {
        const typing = document.createElement('div');
        typing.className = 'typing-indicator';

        for (let i = 0; i < 3; i++) {
            const dot = document.createElement('div');
            dot.className = 'typing-dot';
            typing.appendChild(dot);
        }

        messagesContainer.appendChild(typing);
        scrollToBottom();
        return typing;
    }

    // Envia a mensagem e responde automaticamente
    async function sendMessage() {
        const message = messageInput.value.trim();
        if (!message) return;


        addMessage(message, 'sent');
        messageInput.value = '';

        setTimeout(async () => {
            const typing = showTypingIndicator();


                const response = await axios.post('/page/message', {
                    message: message,
                    messageId: Math.random().toString(36).slice(2, 14),
                }, {
                    headers: {
                        "Accept": 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'threadId': localStorage.getItem('threadId')
                    },
                });
                typing.remove();
                addMessage(response.data, 'received');

        }, 1000);
    }

    // Eventos
    sendButton.addEventListener('click', sendMessage);
    messageInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') sendMessage();
    });


    // Mensagens iniciais
    addMessage('Olá! Tudo bem com você?', 'received');
    addMessage('Estou aqui para te ajudar, pode falar o que precisa.', 'received');
});
