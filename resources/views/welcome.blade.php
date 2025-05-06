<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OptimiZap - Agência de Mídias Sociais</title>
  <!-- Bootstrap 5.3 CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    :root {
      --primary-color: #7952b3;
      --secondary-color: #61428f;
      --accent-color: #4723c2;
      --dark-bg: #121212;
      --dark-secondary: #1e1e1e;
      --dark-card: #252525;
      --dark-element: #333333;
      --dark-text: #f5f5f5;
      --dark-text-muted: #b0b0b0;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--dark-bg);
      color: var(--dark-text);
    }
    
    .navbar {
      background-color: var(--dark-card) !important;
    }
    
    .navbar-light .navbar-brand,
    .navbar-light .navbar-nav .nav-link {
      color: var(--dark-text);
    }
    
    .navbar-light .navbar-nav .nav-link:hover,
    .navbar-light .navbar-nav .nav-link:focus {
      color: var(--primary-color);
    }
    
    .hero-section {
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: white;
      padding: 80px 0;
    }
    
    .navbar-brand {
      font-weight: 700;
      font-size: 1.8rem;
    }
    
    .navbar-brand span {
      color: var(--primary-color);
    }
    
    .service-card {
      transition: all 0.3s ease;
      border-radius: 10px;
      overflow: hidden;
      height: 100%;
      background-color: var(--dark-card);
      border: 1px solid var(--dark-element);
    }
    
    .service-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    }
    
    .testimonial-card {
      border-radius: 10px;
      overflow: hidden;
      background-color: var(--dark-card);
      border: 1px solid var(--dark-element);
    }
    
    .stats-counter {
      font-size: 2.5rem;
      font-weight: bold;
      color: var(--primary-color);
    }
    
    .stats-title {
      font-size: 1.1rem;
      color: var(--dark-text);
    }
    
    .cta-section {
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: white;
    }
    
    .carousel-caption {
      background-color: rgba(0,0,0,0.6);
      border-radius: 10px;
      padding: 20px;
    }
    
    .footer {
      background-color: var(--dark-secondary);
      color: white;
    }
    
    .social-icon {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: var(--primary-color);
      color: white;
      border-radius: 50%;
      margin-right: 10px;
      transition: all 0.3s ease;
    }
    
    .social-icon:hover {
      background-color: var(--accent-color);
      transform: scale(1.1);
    }
    
    .section-dark {
      background-color: var(--dark-secondary);
    }
    
    .section-darker {
      background-color: var(--dark-bg);
    }
    
    .whatsapp-btn {
      background-color: #25D366;
      color: white;
      border: none;
    }
    
    .whatsapp-btn:hover {
      background-color: #128C7E;
      color: white;
    }
    
    .card-text, .text-muted {
      color: var(--dark-text-muted) !important;
    }
    
    .form-control {
      background-color: var(--dark-element);
      border-color: var(--dark-secondary);
      color: var(--dark-text);
    }
    
    .form-control:focus {
      background-color: var(--dark-element);
      color: var(--dark-text);
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(121, 82, 179, 0.25);
    }
    
    .form-label {
      color: var(--dark-text);
    }
    
    .btn-outline-primary {
      border-color: var(--primary-color);
      color: var(--primary-color);
    }
    
    .btn-outline-primary:hover {
      background-color: var(--primary-color);
      color: white;
    }
    
    .follow-price {
      font-size: 2.5rem;
      font-weight: bold;
      color: var(--primary-color);
      margin-bottom: 1rem;
    }
    
    .price-highlight {
      font-size: 3rem;
      font-weight: bold;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      display: inline-block;
      margin-bottom: 0.5rem;
    }
    
    .mobile-nav {
      position: fixed;
      top: 0;
      left: -100%;
      width: 80%;
      height: 100%;
      background-color: var(--dark-card);
      z-index: 1050;
      transition: all 0.3s ease;
      overflow-y: auto;
      padding: 20px;
    }
    
    .mobile-nav.active {
      left: 0;
    }
    
    .mobile-nav-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1049;
      display: none;
    }
    
    .mobile-nav-overlay.active {
      display: block;
    }
    
    .mobile-nav-close {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 1.5rem;
      cursor: pointer;
      color: var(--dark-text);
    }
    
    .mobile-nav-menu {
      list-style: none;
      padding: 0;
      margin-top: 50px;
    }
    
    .mobile-nav-menu li {
      margin-bottom: 15px;
    }
    
    .mobile-nav-menu a {
      color: var(--dark-text);
      font-size: 1.2rem;
      text-decoration: none;
      display: block;
      padding: 10px;
      border-radius: 5px;
      transition: all 0.3s ease;
    }
    
    .mobile-nav-menu a:hover {
      background-color: var(--dark-element);
    }
    
    @media (max-width: 767.98px) {
      .navbar-brand {
        font-size: 1.5rem;
      }
      .carousel-item {
        height: 400px !important;
      }
      .carousel-caption h1 {
        font-size: 1.8rem !important;
      }
      .follow-price, .price-highlight {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <!-- Mobile Navigation -->
  <div class="mobile-nav-overlay" id="mobileNavOverlay"></div>
  <div class="mobile-nav" id="mobileNav">
    <span class="mobile-nav-close" id="mobileNavClose"><i class="bi bi-x-lg"></i></span>
    <a class="navbar-brand mb-4 d-block" href="#">Optimi<span>Zap</span></a>
    <ul class="mobile-nav-menu">
      <li><a href="#"><i class="bi bi-house me-2"></i> Home</a></li>
      <li><a href="#services"><i class="bi bi-briefcase me-2"></i> Serviços</a></li>
      <li><a href="#pricing"><i class="bi bi-credit-card me-2"></i> Preços</a></li>
      <li><a href="#testimonials"><i class="bi bi-chat-quote me-2"></i> Depoimentos</a></li>
      <li>
        <a href="https://wa.me/5575997140438" target="_blank">
          <i class="bi bi-whatsapp me-2"></i> Contato
        </a>
      </li>
    </ul>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">Optimi<span>Zap</span></a>
      <button class="navbar-toggler border-0" type="button" id="mobileNavToggle">
        <i class="bi bi-list text-white"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#services">Serviços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#pricing">Preços</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#testimonials">Depoimentos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://wa.me/5575997140438" target="_blank">
              <i class="bi bi-whatsapp"></i> Contato
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Carousel Section -->
  <div id="heroCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" style="height: 600px; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1611162616305-c69b3fa7fbe0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1567&q=80') no-repeat center center; background-size: cover;">
        <div class="carousel-caption d-flex flex-column justify-content-center h-100">
          <h1 class="display-3 fw-bold mb-4">Cresça seu Instagram com a OptimiZap</h1>
          <p class="lead mb-5">Atinja mais seguidores, aumente seu engajamento e transforme sua presença online</p>
          <div class="d-grid d-md-flex gap-3">
        
            <a href="https://wa.me/5575997140438" target="_blank" class="btn whatsapp-btn btn-lg px-5 py-3">
              <i class="bi bi-whatsapp me-2"></i>Fale Conosco
            </a>
          </div>
        </div>
      </div>
      <div class="carousel-item" style="height: 600px; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1611162618071-b39a2ec055fb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1567&q=80') no-repeat center center; background-size: cover;">
        <div class="carousel-caption d-flex flex-column justify-content-center h-100">
          <h1 class="display-3 fw-bold mb-4">Estratégias Comprovadas para Mídias Sociais</h1>
          <p class="lead mb-5">Metodologia exclusiva para aumentar sua visibilidade e engajamento</p>
          <div class="d-grid d-md-flex gap-3">
        
            <a href="#testimonials" class="btn btn-outline-light btn-lg px-5 py-3">Depoimentos</a>
          </div>
        </div>
      </div>
      <div class="carousel-item" style="height: 600px; background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80') no-repeat center center; background-size: cover;">
        <div class="carousel-caption d-flex flex-column justify-content-center h-100">
          <h1 class="display-3 fw-bold mb-4">Resultados Reais. Seguidores Reais.</h1>
          <p class="lead mb-5">Milhares de seguidores orgânicos e engajados para sua marca</p>
          <div class="d-grid d-md-flex gap-3">
            <a href="https://wa.me/5575997140438" target="_blank" class="btn whatsapp-btn btn-lg px-5 py-3">
              <i class="bi bi-whatsapp me-2"></i>Comprar Agora
            </a>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Próximo</span>
    </button>
  </div>
  
  <!-- Stats Section -->
  <section id="stats" class="py-5 section-darker">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="stats-counter" data-count="5000">5.000+</div>
          <div class="stats-title">Clientes Satisfeitos</div>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="stats-counter" data-count="10000000">10M+</div>
          <div class="stats-title">Seguidores Entregues</div>
        </div>
        <div class="col-md-4">
          <div class="stats-counter" data-count="98">98%</div>
          <div class="stats-title">Taxa de Retenção</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="py-5 section-dark">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Nossos Serviços</h2>
        <p class="lead">Soluções completas para impulsionar sua presença no Instagram</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="service-card card h-100">
            <div class="card-body text-center p-4">
              <div class="mb-4">
                <i class="bi bi-people-fill text-primary" style="font-size: 3rem;"></i>
              </div>
              <h4 class="card-title fw-bold">Crescimento de Seguidores</h4>
              <p class="card-text">Aumente sua base de seguidores de forma orgânica e sustentável, atraindo pessoas realmente interessadas no seu conteúdo.</p>
              <a href="#pricing" class="btn btn-outline-primary mt-3">Saiba Mais</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-card card h-100">
            <div class="card-body text-center p-4">
              <div class="mb-4">
                <i class="bi bi-graph-up text-primary" style="font-size: 3rem;"></i>
              </div>
              <h4 class="card-title fw-bold">Aumento de Engajamento</h4>
              <p class="card-text">Melhore a interação em suas publicações com estratégias de conteúdo que estimulam curtidas, comentários e compartilhamentos.</p>
              <a href="#pricing" class="btn btn-outline-primary mt-3">Saiba Mais</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="service-card card h-100">
            <div class="card-body text-center p-4">
              <div class="mb-4">
                <i class="bi bi-stars text-primary" style="font-size: 3rem;"></i>
              </div>
              <h4 class="card-title fw-bold">Gestão de Perfil</h4>
              <p class="card-text">Deixe sua presença no Instagram em mãos profissionais, desde a criação de conteúdo até a interação com seus seguidores.</p>
              <a href="#pricing" class="btn btn-outline-primary mt-3">Saiba Mais</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="py-5 section-darker">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Como Trabalhamos</h2>
        <p class="lead">Nosso processo é simples, transparente e eficiente</p>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <div class="text-center">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
              <span class="h3 m-0">1</span>
            </div>
            <h4 class="fw-bold">Escolha seu pacote</h4>
            <p>Selecione a quantidade de seguidores que deseja para seu perfil</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
          <div class="text-center">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
              <span class="h3 m-0">2</span>
            </div>
            <h4 class="fw-bold">Entre em contato</h4>
            <p>Envie-nos uma mensagem pelo WhatsApp para finalizar a compra</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <div class="text-center">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
              <span class="h3 m-0">3</span>
            </div>
            <h4 class="fw-bold">Faça o pagamento</h4>
            <p>Realize o pagamento de forma segura pelos métodos disponíveis</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="text-center">
            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 80px; height: 80px;">
              <span class="h3 m-0">4</span>
            </div>
            <h4 class="fw-bold">Receba seus seguidores</h4>
            <p>Começamos a entrega imediatamente após a confirmação do pagamento</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pricing Section -->
  <section id="pricing" class="py-5 section-dark">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Compre Seguidores</h2>
        <p class="lead">Seguidores reais e engajados para o seu Instagram</p>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="text-center p-5" style="background-color: var(--dark-card); border-radius: 15px; border: 1px solid var(--dark-element);">
            <h3 class="mb-4">Preços Acessíveis</h3>
            <div class="price-highlight">R$ 1,50</div>
            <p class="mb-4 fs-5">por 1.000 seguidores</p>
            <div class="alert alert-info mb-4">
              <i class="bi bi-info-circle me-2"></i>Seguidores reais de alta qualidade para seu perfil!
            </div>
            <ul class="list-unstyled mb-4 text-start">
              <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Seguidores de alta qualidade</li>
              <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Entrega rápida</li>
              <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Suporte via WhatsApp</li>
              <li class="mb-3"><i class="bi bi-check-circle-fill text-success me-2"></i>Garantia de reposição</li>
            </ul>
            <a href="https://wa.me/5575997140438?text=Olá! Gostaria de comprar seguidores para o Instagram." target="_blank" class="btn whatsapp-btn btn-lg px-5 py-3 w-100">
              <i class="bi bi-whatsapp me-2"></i>Comprar Agora pelo WhatsApp
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials" class="py-5 section-darker">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="display-5 fw-bold">Prova Social</h2>
        <p class="lead">O que nossos clientes dizem sobre nós</p>
      </div>
      <div class="row g-4">
        <div class="col-lg-4 col-md-6">
          <div class="testimonial-card card h-100">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </div>
              <p class="card-text mb-4">"Em apenas 3 meses, conseguimos mais de 10 mil seguidores reais para nossa marca. O engajamento aumentou significativamente e as vendas pelo Instagram cresceram 300%. Equipe profissional e resultados impressionantes!"</p>
              <div class="d-flex align-items-center">
                <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Cliente" class="rounded-circle me-3" width="60">
                <div>
                  <h5 class="card-title mb-0">Ana Oliveira</h5>
                  <p class="text-muted mb-0">@moda.estilo</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="testimonial-card card h-100">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </div>
              <p class="card-text mb-4">"Transformação total no meu perfil! Passei de 2 mil para 50 mil seguidores em 6 meses. O melhor é que são seguidores reais que interagem com meu conteúdo. Fechei várias parcerias pagas graças ao crescimento. Vale cada centavo!"</p>
              <div class="d-flex align-items-center">
                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Cliente" class="rounded-circle me-3" width="60">
                <div>
                  <h5 class="card-title mb-0">Carlos Santos</h5>
                  <p class="text-muted mb-0">@viagem.aventura</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mx-auto">
          <div class="testimonial-card card h-100">
            <div class="card-body p-4">
              <div class="mb-3">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </div>
              <p class="card-text mb-4">"Como influenciadora iniciante, estava tendo dificuldades para crescer. A OptimiZap me ajudou a encontrar meu público-alvo e a criar conteúdo que realmente engaja. Recomendo para todos que querem levar seu Instagram a sério!"</p>
              <div class="d-flex align-items-center">
                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Cliente" class="rounded-circle me-3" width="60">
                <div>
                  <h5 class="card-title mb-0">Mariana Costa</h5>
                  <p class="text-muted mb-0">@mari.fitness</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8 text-center text-lg-start mb-4 mb-lg-0">
          <h2 class="display-6 fw-bold text-white mb-3">Pronto para transformar seu Instagram?</h2>
          <p class="lead text-white mb-0">Entre em contato agora mesmo pelo WhatsApp e adquira seguidores para seu perfil!</p>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
          <a href="https://wa.me/5575997140438" target="_blank" class="btn whatsapp-btn btn-lg px-5 py-3">
            <i class="bi bi-whatsapp me-2"></i>Fale Conosco
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 mb-4 mb-lg-0">
          <h3 class="text-white mb-4">Optimi<span class="text-primary">Zap</span></h3>
          <p class="text-white-50">Transformamos sua presença no Instagram com estratégias comprovadas para crescimento de seguidores e engajamento.</p>
          <div class="d-flex mt-4">
            <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
            <a href="https://wa.me/5575997140438" target="_blank" class="social-icon"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
          <h5 class="text-white mb-4">Links Rápidos</h5>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#" class="text-white-50 text-decoration-none">Home</a></li>
            <li class="mb-2"><a href="#services" class="text-white-50 text-decoration-none">Serviços</a></li>
            <li class="mb-2"><a href="#pricing" class="text-white-50 text-decoration-none">Preços</a></li>
            <li><a href="#testimonials" class="text-white-50 text-decoration-none">Depoimentos</a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h5 class="text-white mb-4">Contato</h5>
          <p class="text-white-50">Entre em contato para mais informações ou fazer um pedido personalizado.</p>
          <div class="d-flex align-items-center mb-3">
            <div class="me-3 text-primary">
              <i class="bi bi-whatsapp fs-4"></i>
            </div>
            <div>
              <h5 class="mb-0 text-white">WhatsApp</h5>
              <p class="mb-0 text-white-50">(75) 99714-0438</p>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <div class="me-3 text-primary">
              <i class="bi bi-envelope-fill fs-4"></i>
            </div>
            <div>
              <h5 class="mb-0 text-white">Email</h5>
              <p class="mb-0 text-white-50">contato@optimizap.com.br</p>
            </div>
          </div>
        </div>
      </div>
      <hr class="mt-5 mb-4 border-secondary">
      <div class="row">
        <div class="col-md-12 text-center">
          <p class="text-white-50 mb-0">&copy; 2025 OptimiZap. Todos os direitos reservados.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap 5.3 JS and Popper Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom JavaScript for Mobile Menu -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const mobileNavToggle = document.getElementById('mobileNavToggle');
      const mobileNav = document.getElementById('mobileNav');
      const mobileNavOverlay = document.getElementById('mobileNavOverlay');
      const mobileNavClose = document.getElementById('mobileNavClose');
      const mobileNavLinks = document.querySelectorAll('.mobile-nav-menu a');
      
      // Function to open mobile menu
      function openMobileNav() {
        mobileNav.classList.add('active');
        mobileNavOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
      }
      
      // Function to close mobile menu
      function closeMobileNav() {
        mobileNav.classList.remove('active');
        mobileNavOverlay.classList.remove('active');
        document.body.style.overflow = '';
      }
      
      // Toggle mobile menu
      mobileNavToggle.addEventListener('click', openMobileNav);
      
      // Close mobile menu when clicking close button
      mobileNavClose.addEventListener('click', closeMobileNav);
      
      // Close mobile menu when clicking overlay
      mobileNavOverlay.addEventListener('click', closeMobileNav);
      
      // Close mobile menu when clicking menu links
      mobileNavLinks.forEach(link => {
        link.addEventListener('click', function() {
          // Check if link is not external (doesn't have target="_blank")
          if (!this.getAttribute('target')) {
            closeMobileNav();
          }
        });
      });
    });
  </script>
</body>
</html>