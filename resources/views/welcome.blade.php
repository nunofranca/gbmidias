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
    // ... keep existing code (CSS styles) the same
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
`}} />

{/* React Carousel Section */}
<div className="carousel-wrapper py-5" style={{ background: "linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7))" }}>
<div className="container mx-auto px-4">
  <Carousel
    opts={{
      align: "start",
      loop: true,
    }}
    className="w-full"
  >
    <CarouselContent>
      <CarouselItem className="md:basis-full">
        <div className="carousel-slide p-4 md:p-8" style={{
          backgroundImage: "linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1611162616305-c69b3fa7fbe0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1567&q=80')",
          backgroundSize: "cover",
          backgroundPosition: "center",
          borderRadius: "12px",
          height: "500px",
        }}>
          <div className="flex flex-col justify-center items-center text-center h-full text-white space-y-6 p-4">
            <h1 className="text-3xl md:text-5xl font-bold mb-4">Cresça seu Instagram com a OptimiZap</h1>
            <p className="text-lg md:text-xl mb-6">Atinja mais seguidores, aumente seu engajamento e transforme sua presença online</p>
            <div className="flex flex-col md:flex-row gap-4">
              <a href="https://wa.me/5575997140438" target="_blank" className="bg-[#25D366] hover:bg-[#128C7E] text-white px-6 py-3 rounded-lg font-medium text-lg flex items-center justify-center">
                <i className="bi bi-whatsapp me-2"></i>Fale Conosco
              </a>
            </div>
          </div>
        </div>
      </CarouselItem>
      <CarouselItem className="md:basis-full">
        <div className="carousel-slide p-4 md:p-8" style={{
          backgroundImage: "linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1611162618071-b39a2ec055fb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1567&q=80')",
          backgroundSize: "cover",
          backgroundPosition: "center",
          borderRadius: "12px",
          height: "500px",
        }}>
          <div className="flex flex-col justify-center items-center text-center h-full text-white space-y-6 p-4">
            <h1 className="text-3xl md:text-5xl font-bold mb-4">Estratégias Comprovadas para Mídias Sociais</h1>
            <p className="text-lg md:text-xl mb-6">Metodologia exclusiva para aumentar sua visibilidade e engajamento</p>
            <div className="flex flex-col md:flex-row gap-4">
              <a href="#pricing" className="bg-[#7952b3] hover:bg-[#61428f] text-white px-6 py-3 rounded-lg font-medium text-lg flex items-center justify-center">
                1.000 seguidores por R$1,50
              </a>
              <a href="#testimonials" className="border border-white hover:bg-white/20 text-white px-6 py-3 rounded-lg font-medium text-lg">
                Depoimentos
              </a>
            </div>
          </div>
        </div>
      </CarouselItem>
      <CarouselItem className="md:basis-full">
        <div className="carousel-slide p-4 md:p-8" style={{
          backgroundImage: "linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80')",
          backgroundSize: "cover",
          backgroundPosition: "center",
          borderRadius: "12px",
          height: "500px",
        }}>
          <div className="flex flex-col justify-center items-center text-center h-full text-white space-y-6 p-4">
            <h1 className="text-3xl md:text-5xl font-bold mb-4">Resultados Reais. Seguidores Reais.</h1>
            <p className="text-lg md:text-xl mb-6">Milhares de seguidores orgânicos e engajados para sua marca</p>
            <div className="flex flex-col md:flex-row gap-4">
              <a href="#stats" className="bg-[#7952b3] hover:bg-[#61428f] text-white px-6 py-3 rounded-lg font-medium text-lg">
                Ver Resultados
              </a>
              <a href="https://wa.me/5575997140438" target="_blank" className="bg-[#25D366] hover:bg-[#128C7E] text-white px-6 py-3 rounded-lg font-medium text-lg flex items-center justify-center">
                <i className="bi bi-whatsapp me-2"></i>Comprar Agora
              </a>
            </div>
          </div>
        </div>
      </CarouselItem>
    </CarouselContent>
    <div className="hidden md:flex">
      <CarouselPrevious className="left-2" />
      <CarouselNext className="right-2" />
    </div>
  </Carousel>
</div>
</div>

{/* Rest of the HTML content */}
<div dangerouslySetInnerHTML={{ __html: `
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
    // ... keep existing code (Services Section) the same
  </section>

  <!-- How It Works Section -->
  <section class="py-5 section-darker">
    // ... keep existing code (How It Works Section) the same
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
    // ... keep existing code (Testimonials Section) the same
  </section>

  <!-- CTA Section -->
  <section class="cta-section py-5">
    // ... keep existing code (CTA Section) the same
  </section>

  <!-- Footer -->
  <footer class="footer py-5">
    // ... keep existing code (Footer) the same
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