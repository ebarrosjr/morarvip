<?php
$currentUrl = $this->request->getRequestTarget();
$loginUrl = $this->Url->build([
    'controller' => 'Users',
    'action' => 'login',
    '?' => ['redirect' => $currentUrl],
]);
?>
<!doctype html>
<html class="no-js" lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Imóveis à venda e para alugar | Morar VIP</title>
    <meta name="description" content="Encontre imóveis à venda e para alugar com corretores e imobiliárias parceiras. Casas, apartamentos, terrenos e imóveis comerciais com fotos, localização, preço e contato direto." />
    <meta name="keywords" content="imóveis à venda, imóveis para alugar, casas à venda, apartamentos à venda, aluguel de imóveis, imobiliárias, corretores de imóveis, terrenos, imóveis comerciais, comprar imóvel, alugar imóvel" />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="https://morar.vip/" />
    <link rel="shortcut icon" href="/img/icons/favicon.ico" type="image/x-icon" />

    <meta property="og:type" content="website" />
    <meta property="og:title" content="Imóveis à venda e para alugar | Morar VIP" />
    <meta property="og:description" content="Busque casas, apartamentos, terrenos e imóveis comerciais à venda ou para alugar com fotos, preços, localização e contato direto." />
    <meta property="og:url" content="https://morar.vip/" />
    <meta property="og:image" content="https://morar.vip/img/imoveis.jpg" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Imóveis à venda e para alugar | Morar VIP" />
    <meta name="twitter:description" content="Encontre imóveis à venda e para alugar com fotos, preços, localização e contato direto." />
    <meta name="twitter:image" content="https://morar.vip/img/imoveis.jpg" />    

    <?= $this->Html->css(['font-icons', 'plugins', 'style', 'responsive', 'search']) ?>
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div class="wrapper">

    <!-- HEADER AREA START (header-5) -->
    <header class="ltn__header-area ltn__header-5 ltn__header-transparent--- gradient-color-4---">
        <!-- ltn__header-top-area start -->
        <div class="ltn__header-top-area section-bg-6 top-area-color-white---">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="ltn__social-media">
                            <ul>
                                <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>                                                
                                <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="top-bar-right text-end">
                            <div class="ltn__top-bar-menu">
                                <ul>
                                    <li>
                                        <!-- header-top-btn -->
                                        <div class="header-top-btn">
                                            <a href="#">Anuncie seu imóvel</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__header-top-area end -->
        
        <!-- ltn__header-middle-area start -->
        <div class="ltn__header-middle-area ltn__header-sticky ltn__sticky-bg-white">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="site-logo-wrap">
                            <div class="site-logo">
                                <a href="/"><img src="<?= $this->Url->build('/img/logo-full.svg') ?>" alt="Logo"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col header-menu-column">
                        <div class="header-menu d-none d-xl-block">
                            <nav>
                                <div class="ltn__main-menu">
                                    <ul>
                                        <li>
                                            <a href="/">Home</a>
                                        </li>
                                        <li class="menu-icon"><a href="#">Serviços</a>
                                            <ul>
                                                <li><a href="#">Corretores</a></li>
                                                <li><a href="#">Financiamento imobiliário</a></li>
                                                <li><a href="#">Consultoria imobiliária</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="col ltn__header-options ltn__header-options-2 mb-sm-20">
                        <!-- user-menu -->
                        <div class="ltn__drop-menu user-menu">
                            <ul>
                                <li>
                                    <a href="#"><i class="icon-user"></i></a>
                                    <ul>
                                        <li><a class="js-login-modal" href="<?= h($loginUrl) ?>">Entrar</a></li>
                                        <li><a href="/users/dashboard">Minha Conta</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <?php if ($this->fetch('hasFilterDrawer')): ?>
                            <div class="property-filter-header-toggle d-lg-none">
                                <a href="#ltn__utilize-filter-menu" class="property-filter-mobile-toggle ltn__utilize-toggle" aria-label="Abrir filtros">
                                    <i class="fas fa-filter"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                        <!-- Mobile Menu Button -->
                        <div class="mobile-menu-toggle d-xl-none">
                            <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ltn__header-middle-area end -->
        <div class="morarvip-header-search-area">
            <div class="container">
                <form class="morarvip-header-search-form" method="get" action="<?= $this->Url->build('/') ?>">
                    <i class="fas fa-search"></i>
                    <input
                        type="text"
                        name="q"
                        value="<?= h((string)$this->request->getQuery('q', '')) ?>"
                        placeholder="Busque por bairro, cidade ou tipo de imóvel"
                    >
                    <button type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </header>
    <!-- HEADER AREA END -->
    <!-- Utilize Mobile Menu Start -->
    <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
        <div class="ltn__utilize-menu-inner ltn__scrollbar">
            <div class="ltn__utilize-menu-head">
                <div class="site-logo">
                    <a href="index.html"><img src="<?= $this->Url->build('/img/logo-full.svg') ?>" alt="Logo"></a>
                </div>
                <button class="ltn__utilize-close">×</button>
            </div>
            <div class="ltn__utilize-menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Serviços</a>
                        <ul class="sub-menu">
                            <li><a href="#">Corretores</a></li>
                            <li><a href="#">Financiamento imobiliário</a></li>
                            <li><a href="#">Consultoria imobiliária</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                <ul>
                    <li>
                        <a class="js-login-modal" href="<?= h($loginUrl) ?>" title="My Account">
                            <span class="utilize-btn-icon">
                                <i class="far fa-user"></i>
                            </span>
                            Entrar
                        </a>
                    </li>
                    <li>
                        <a href="/users/dashboard" title="Wishlist">
                            <span class="utilize-btn-icon">
                                <i class="far fa-building"></i>
                                <sup>3</sup>
                            </span>
                            Minha conta
                        </a>
                    </li>
                </ul>
            </div>
            <div class="ltn__social-media-2">
                <ul>
                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                    <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Utilize Mobile Menu End -->
    <div class="ltn__utilize-overlay"></div>
    <!-- PRODUCT DETAILS AREA START -->
    <div class="ltn__product-area ltn__product-gutter mb-120">
        <div class="container">
            <div class="row">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS AREA END -->

    <!-- CALL TO ACTION START (call-to-action-6) -->
    <div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                        <div class="coll-to-info text-color-white">
                            <h1>Looking for a dream home?</h1>
                            <p>We can help you realize your dream of a new home</p>
                        </div>
                        <div class="btn-wrapper">
                            <a class="btn btn-effect-3 btn-white" href="contact.html">Explore Properties <i class="icon-next"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CALL TO ACTION END -->

    <!-- FOOTER AREA START -->
    <footer class="ltn__footer-area  ">
        <div class="footer-top-area  section-bg-2 plr--5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-about-widget">
                            <div class="footer-logo">
                                <div class="site-logo">
                                    <img src="img/logo-2.png" alt="Logo">
                                </div>
                            </div>
                            <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is dummy text of the printing.</p>
                            <div class="footer-address">
                                <ul>
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-placeholder"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p>Brooklyn, New York, United States</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-call"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p><a href="tel:+0123-456789">+0123-456789</a></p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="footer-address-icon">
                                            <i class="icon-mail"></i>
                                        </div>
                                        <div class="footer-address-info">
                                            <p><a href="mailto:example@example.com">example@example.com</a></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="ltn__social-media mt-20">
                                <ul>
                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Company</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="shop.html">All Products</a></li>
                                    <li><a href="locations.html">Locations Map</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Services</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="order-tracking.html">Order tracking</a></li>
                                    <li><a href="wishlist.html">Wish List</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="account.html">My account</a></li>
                                    <li><a href="about.html">Terms & Conditions</a></li>
                                    <li><a href="about.html">Promotional Offers</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-sm-6 col-12">
                        <div class="footer-widget footer-menu-widget clearfix">
                            <h4 class="footer-title">Customer Care</h4>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="account.html">My account</a></li>
                                    <li><a href="wishlist.html">Wish List</a></li>
                                    <li><a href="order-tracking.html">Order tracking</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-12 col-12">
                        <div class="footer-widget footer-newsletter-widget">
                            <h4 class="footer-title">Newsletter</h4>
                            <p>Subscribe to our weekly Newsletter and receive updates via email.</p>
                            <div class="footer-newsletter">
                                <form action="#">
                                    <input type="email" name="email" placeholder="Email*">
                                    <div class="btn-wrapper">
                                        <button class="theme-btn-1 btn" type="submit"><i class="fas fa-location-arrow"></i></button>
                                    </div>
                                </form>
                            </div>
                            <h5 class="mt-30">We Accept</h5>
                            <img src="img/icons/payment-4.png" alt="Payment Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ltn__copyright-area ltn__copyright-2 section-bg-7  plr--5">
            <div class="container-fluid ltn__border-top-2">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="ltn__copyright-design clearfix">
                            <p>All Rights Reserved @ Company <span class="current-year"></span></p>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 align-self-center">
                        <div class="ltn__copyright-menu text-end">
                            <ul>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Claim</a></li>
                                <li><a href="#">Privacy & Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER AREA END -->
    <!-- MODAL AREA -->
    <div class="ltn__modal-area ltn__add-to-cart-modal-area">
        <div class="modal fade" id="default_modal" tabindex="-1">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-loading text-center p-4">Carregando...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL AREA END -->
</div>
<!-- Body main wrapper end -->
    <!-- All JS Plugins -->
    <?=  $this->Html->script(['plugins', 'main']) ?>
    <script>
        (function () {
            const modalElement = document.getElementById('default_modal');
            if (!modalElement) {
                return;
            }

            const modalBody = modalElement.querySelector('.modal-body');
            const getModal = function () {
                if (window.bootstrap && window.bootstrap.Modal) {
                    return window.bootstrap.Modal.getOrCreateInstance(modalElement);
                }
                return null;
            };

            const showModalMessage = function (form, message, type) {
                const messageBox = form.closest('.login-modal-content')?.querySelector('.auth-modal-message');
                if (!messageBox) {
                    return;
                }

                messageBox.classList.remove('d-none', 'alert-danger', 'alert-success');
                messageBox.classList.add(type === 'success' ? 'alert-success' : 'alert-danger');
                messageBox.textContent = message;
            };

            const openAuthModal = async function (url) {
                modalBody.innerHTML = '<div class="modal-loading text-center p-4">Carregando...</div>';
                const modal = getModal();
                if (modal) {
                    modal.show();
                } else if (window.jQuery) {
                    window.jQuery(modalElement).modal('show');
                }

                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                });

                if (response.headers.get('content-type')?.includes('application/json')) {
                    const payload = await response.json();
                    if (payload.success) {
                        if (payload.redirect) {
                            window.location.href = payload.redirect;
                        }
                        return;
                    }
                }

                modalBody.innerHTML = await response.text();
                bindAuthModalContent();
            };

            const bindAuthForm = function (form) {
                form.addEventListener('submit', async function (event) {
                    event.preventDefault();

                    const messageBox = form.closest('.login-modal-content')?.querySelector('.auth-modal-message');
                    if (messageBox) {
                        messageBox.classList.add('d-none');
                        messageBox.classList.remove('alert-danger', 'alert-success');
                        messageBox.textContent = '';
                    }

                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin',
                        body: new FormData(form)
                    });
                    const payload = await response.json();

                    if (payload.success) {
                        if (payload.redirect) {
                            window.location.href = payload.redirect;
                            return;
                        }

                        showModalMessage(form, payload.message || 'Solicitação enviada com sucesso.', 'success');
                        return;
                    }

                    showModalMessage(form, payload.message || 'Não foi possível processar sua solicitação.', 'danger');
                });
            };

            const bindAuthModalContent = function () {
                modalBody.querySelectorAll('.js-auth-form').forEach(bindAuthForm);
                modalBody.querySelectorAll('.js-auth-modal').forEach(bindAuthLink);
            };

            const bindAuthLink = function (link) {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    openAuthModal(link.href).catch(function () {
                        window.location.href = link.href;
                    });
                });
            };

            document.querySelectorAll('.js-login-modal, .js-auth-modal').forEach(function (link) {
                bindAuthLink(link);
            });
        })();
    </script>
</body>
</html>
