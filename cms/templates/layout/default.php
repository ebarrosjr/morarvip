<!DOCTYPE html>
<html lang="pt-br" dir="ltr" data-theme-mode="light">
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="Description" content="Sistema de Gerenciamento de Oficinas e Concessionárias">
        <meta name="Author" content="Everton Barros jr">
        <meta name="keywords" content="SISCAR">
		<!-- Title -->
        <title> SISCAR - Sistema de Gerenciamento de Oficinas e Concessionárias </title>
        <!-- Favicon -->
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <!-- Start::Styles -->
        <?=  $this->Html->css(['bootstrap.min', 'styles', 'icons']) ?>        
        <!-- End::Styles -->
        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body class="">

        <div id="loader" >
            <img src="/img/loader.svg" alt="">
        </div>
        <div class="page">

            <!-- Start::main-header -->
            
			<header class="app-header sticky" id="header">

				<!-- Start::main-header-container -->
				<div class="main-header-container container-fluid">

					<!-- Start::header-content-left -->
					<div class="header-content-left">

						<!-- Start::header-element -->
						<div class="header-element">
							<div class="horizontal-logo">
								<a href="/" class="header-logo">
                                    <img src="/img/logo-full.svg" alt="logo" class="desktop-logo">
                                    <img src="/img/logo-1024.png" alt="logo" class="toggle-dark">
                                    <img src="/img/logo.svg" alt="logo" class="desktop-dark">
                                    <img src="/img/logo-1024.png" alt="logo" class="toggle-logo">
								</a>
							</div>
						</div>
						<!-- End::header-element -->

						<!-- Start::header-element -->
						<div class="header-element mx-lg-0 mx-2">
							<a aria-label="Hide Sidebar" class="sidemenu-toggle header-link" data-bs-toggle="sidebar" href="javascript:void(0);">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon menu-btn" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 5h12M4 12h16M4 19h8" color="currentColor"/></svg>
								<svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon menu-btn-close" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m18 6l-6 6m0 0l-6 6m6-6l6 6m-6-6L6 6" color="currentColor"/></svg>
							</a>
						</div>
						<!-- End::header-element -->

					</div>
					<!-- End::header-content-left -->

					<!-- Start::header-content-right -->
					<ul class="header-content-right">

						<!-- Start::header-element -->
						<li class="header-element d-md-none d-block">
							<a href="javascript:void(0);" class="header-link" data-bs-toggle="modal" data-bs-target="#header-responsive-search">
								<!-- Start::header-link-icon -->
								<i class="bi bi-search header-link-icon"></i>
								<!-- End::header-link-icon -->
							</a>  
						</li>
						<!-- End::header-element -->

						<!-- Start::header-element -->
						<li class="header-element header-theme-mode">
							<!-- Start::header-link|layout-setting -->
							<a href="javascript:void(0);" class="header-link layout-setting">
								<span class="light-layout">
									<!-- Start::header-link-icon -->
									<svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.5 14.078A8.557 8.557 0 0 1 9.922 2.5C5.668 3.497 2.5 7.315 2.5 11.873a9.627 9.627 0 0 0 9.627 9.627c4.558 0 8.376-3.168 9.373-7.422" color="currentColor"/></svg>
									<!-- End::header-link-icon -->
								</span>
								<span class="dark-layout">
									<!-- Start::header-link-icon -->
									<svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 12a5 5 0 1 1-10 0a5 5 0 0 1 10 0M12 2v1.5m0 17V22m7.07-2.929l-1.06-1.06M5.99 5.989L4.928 4.93M22 12h-1.5m-17 0H2m17.071-7.071l-1.06 1.06M5.99 18.011l-1.06 1.06" color="currentColor"/></svg>
									<!-- End::header-link-icon -->
								</span>
							</a>
							<!-- End::header-link|layout-setting -->
						</li>
						<!-- End::header-element -->

						<!-- Start::header-element -->
						<li class="header-element notifications-dropdown d-xl-block d-none dropdown">
							<!-- Start::header-link|dropdown-toggle -->
							<a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M2.53 14.77c-.213 1.394.738 2.361 1.902 2.843c4.463 1.85 10.673 1.85 15.136 0c1.164-.482 2.115-1.45 1.902-2.843c-.13-.857-.777-1.57-1.256-2.267c-.627-.924-.689-1.931-.69-3.003C19.525 5.358 16.157 2 12 2S4.475 5.358 4.475 9.5c0 1.072-.062 2.08-.69 3.003c-.478.697-1.124 1.41-1.255 2.267"/><path d="M8 19c.458 1.725 2.076 3 4 3c1.925 0 3.541-1.275 4-3"/></g></svg>
								<span class="header-icon-pulse bg-pink rounded pulse pulse-pink"></span>
							</a>
							<!-- End::header-link|dropdown-toggle -->
							<!-- Start::main-header-dropdown -->
							<div class="main-header-dropdown dropdown-menu dropdown-menu-end" data-popper-placement="none">
								<div class="p-3">
									<div class="d-flex align-items-center justify-content-between">
										<p class="mb-0 fs-16">Notifications</p>
										<span class="badge bg-secondary-transparent" id="notifiation-data">5 Unread</span>
									</div>
								</div>
								<div class="dropdown-divider"></div>
								<ul class="list-unstyled mb-0" id="header-notification-scroll">
									<li class="dropdown-item">
										<div class="d-flex align-items-center gap-3">
											<span class="avatar avatar-md flex-shrink-0">
												<img src="/img/no-photo.png" alt="img">
												<a href="javascript:void(0);" class="badge rounded-pill bg-warning avatar-badge"><i class="fe fe-plus"></i></a>
											</span>
											<div class="flex-grow-1 d-flex align-items-center justify-content-between">
												<div class="fs-13">
													<div class="text-muted">
														<a href="javascript:void(0);" class="fw-medium">Purni </a>commented on your <span class="fw-medium text-default">post</span>
													</div>
													<div class="text-muted fw-normal fs-12">2mins ago</div>
												</div>
												<div>
													<a href="javascript:void(0);" class="min-w-fit-content text-muted dropdown-item-close1"><i class="ri-delete-bin-2-line fs-16"></i></a>
												</div>
											</div>
										</div>
									</li>
								</ul>
								<div class="p-3 empty-header-item1 border-top">
									<div class="d-grid">
										<a href="javascript:void(0);" class="btn btn-primary btn-wave">View All</a>
									</div>
								</div>
								<div class="p-5 empty-item1 d-none">
									<div class="text-center">
										<span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
											<i class="ri-notification-off-line fs-2"></i>
										</span>
										<h6 class="fw-medium mt-3">No New Notifications</h6>
									</div>
								</div>
							</div>
							<!-- End::main-header-dropdown -->
						</li>
						<!-- End::header-element -->

						<!-- Start::header-element -->
						<li class="header-element dropdown">
							<!-- Start::header-link|dropdown-toggle -->
							<a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
								<div class="d-flex align-items-center">
									<div>
										<img src="/img/no-photo.png" alt="img" class="avatar avatar-sm avatar-rounded">
									</div>
								</div>
							</a>
							<!-- End::header-link|dropdown-toggle -->
							<ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end" aria-labelledby="mainHeaderProfile">
								<li class="p-3 border-bottom">
									<div class="d-flex align-items-center justify-content-center text-center">
										<div>
											<p class="mb-0 fw-semibold lh-1"><?= h($this->Identity->get('nome') ?? '') ?></p>
											<span class="fs-11 text-muted"><?= h($this->Identity->get('email') ?? '') ?></span>
											<span class="fs-11 text-muted"><?= h($this->Identity->get('telefone') ?? '') ?></span>
										</div>
									</div>
								</li>
								<li><a class="dropdown-item d-flex align-items-center" href="profile.php.html"><i class="ri-user-line fs-15 me-2 text-gray fw-normal"></i>Perfil</a></li>
								<li><a class="dropdown-item d-flex align-items-center" href="mail.php.html"><i class="ri-chat-1-line fs-15 me-2 text-gray fw-normal"></i>Mensagens <span class="badge bg-pink ms-auto">02</span></a></li>
								<li><a class="dropdown-item d-flex align-items-center" href="mail-settings.php.html"><i class="ri-trophy-line fs-15 me-2 text-gray fw-normal"></i>Meu plano</a></li>
								<li> <hr class="dropdown-divider"> </li>
								<li><a class="dropdown-item d-flex align-items-center text-danger" href="/users/logout"><i class="ri-logout-circle-line fs-15 me-2 text-danger fw-normal"></i>Sair</a></li>
							</ul>
						</li>  
						<!-- End::header-element -->

						<!-- Start::header-element -->
						<li class="header-element">
							<!-- Start::header-link|switcher-icon -->
							<a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas" data-bs-target="#switcher-canvas">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-link-icon" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="m21.318 7.141l-.494-.856c-.373-.648-.56-.972-.878-1.101c-.317-.13-.676-.027-1.395.176l-1.22.344c-.459.106-.94.046-1.358-.17l-.337-.194a2 2 0 0 1-.788-.967l-.334-.998c-.22-.66-.33-.99-.591-1.178c-.261-.19-.609-.19-1.303-.19h-1.115c-.694 0-1.041 0-1.303.19c-.261.188-.37.518-.59 1.178l-.334.998a2 2 0 0 1-.789.967l-.337.195c-.418.215-.9.275-1.358.17l-1.22-.345c-.719-.203-1.078-.305-1.395-.176c-.318.129-.505.453-.878 1.1l-.493.857c-.35.608-.525.911-.491 1.234c.034.324.268.584.736 1.105l1.031 1.153c.252.319.431.875.431 1.375s-.179 1.056-.43 1.375l-1.032 1.152c-.468.521-.702.782-.736 1.105s.14.627.49 1.234l.494.857c.373.647.56.971.878 1.1s.676.028 1.395-.176l1.22-.344a2 2 0 0 1 1.359.17l.336.194c.36.23.636.57.788.968l.334.997c.22.66.33.99.591 1.18c.262.188.609.188 1.303.188h1.115c.694 0 1.042 0 1.303-.189s.371-.519.59-1.179l.335-.997c.152-.399.428-.738.788-.968l.336-.194c.42-.215.9-.276 1.36-.17l1.22.344c.718.204 1.077.306 1.394.177c.318-.13.505-.454.878-1.101l.493-.857c.35-.607.525-.91.491-1.234s-.268-.584-.736-1.105l-1.031-1.152c-.252-.32-.431-.875-.431-1.375s.179-1.056.43-1.375l1.032-1.153c.468-.52.702-.781.736-1.105s-.14-.626-.49-1.234"/><path d="M15.52 12a3.5 3.5 0 1 1-7 0a3.5 3.5 0 0 1 7 0"/></g></svg>
							</a>
							<!-- End::header-link|switcher-icon -->
						</li>
						<!-- End::header-element -->

					</ul>
					<!-- End::header-content-right -->

				</div>
				<!-- End::main-header-container -->

			</header>
					            <!-- End::main-header -->

            <!-- Start::main-sidebar -->
            
			<aside class="app-sidebar sticky" id="sidebar">

				<!-- Start::main-sidebar-header -->
				<div class="main-sidebar-header">
					<a href="/" class="header-logo">
                        <img src="/img/logo-full.svg" alt="logo" class="desktop-logo">
                        <img src="/img/logo-1024.png" alt="logo" class="toggle-dark">
                        <img src="/img/logo-full.svg" alt="logo" class="desktop-dark">
                        <img src="/img/logo-1024.png" alt="logo" class="toggle-logo">
					</a>
				</div>
				<!-- End::main-sidebar-header -->

				<!-- Start::main-sidebar -->
				<div class="main-sidebar" id="sidebar-scroll">

					<!-- Start::nav -->
					<nav class="main-menu-container nav nav-pills flex-column sub-open">
							<div class="slide-left" id="slide-left">
								<i class="ri-arrow-left-s-line"></i>
							</div>
							<ul class="main-menu">
								<li class="slide__category"><span class="category-name">Menu</span></li>

								<li class="slide<?= $this->AdminMenu->activeClass('Index', 'index') ?>">
									<a href="<?= $this->Url->build(['controller' => 'Index', 'action' => 'index']) ?>" class="side-menu__item<?= $this->AdminMenu->activeClass('Index', 'index') ?>">
										<i class="ri-dashboard-line side-menu__icon"></i>
										<span class="side-menu__label">Dashboard</span>
									</a>
								</li>
								<li class="slide has-sub<?= $this->AdminMenu->openClass(['Clients', 'Clientes', 'Fornecedores', 'Users']) ?>">
									<a href="javascript:void(0);" class="side-menu__item<?= $this->AdminMenu->activeClass(['Clients', 'Clientes', 'Fornecedores', 'Users']) ?>">
										<i class="ri-group-line side-menu__icon"></i>
										<span class="side-menu__label">Pessoas</span>
										<i class="ri-arrow-down-s-line side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide side-menu__label1"><a href="javascript:void(0)">Pessoas</a></li>
										<li class="slide<?= $this->AdminMenu->activeClass('Users', ['index', 'add', 'edit', 'view']) ?>"><a href="/users" class="side-menu__item<?= $this->AdminMenu->activeClass('Users', ['index', 'add', 'edit']) ?>">Corretores</a></li>
										<li class="slide<?= $this->AdminMenu->activeClass('Pessoas', ['index', 'add', 'edit', 'view']) ?>"><a href="/pessoas" class="side-menu__item<?= $this->AdminMenu->activeClass('Pessoas', 'index') ?>">Clientes</a></li>
										<li class="slide<?= $this->AdminMenu->activeClass('Users', 'parceiros') ?>"><a href="/users/parceiros" class="side-menu__item<?= $this->AdminMenu->activeClass('Users', 'parceiros') ?>">Parceiros</a></li>
										<li class="slide<?= $this->AdminMenu->activeClass('Pessoas', 'proprietarios') ?>"><a href="/pessoas/proprietarios" class="side-menu__item<?= $this->AdminMenu->activeClass('Pessoas', 'proprietarios') ?>">Proprietários</a></li>
									</ul>
								</li>
									<li class="slide has-sub<?= $this->AdminMenu->openClass(['Imoveis', 'TipoImoveis', 'Categories']) ?>">
										<a href="javascript:void(0);" class="side-menu__item<?= $this->AdminMenu->activeClass(['Products', 'Supplies', 'Categories']) ?>">
										<i class="ri-community-line side-menu__icon"></i>
										<span class="side-menu__label">Imóveis</span>
										<i class="ri-arrow-down-s-line side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide side-menu__label1"><a href="javascript:void(0)">Estoque</a></li>
										<li class="slide<?= $this->AdminMenu->activeClass('Imoveis', 'index') ?>"><a href="/imoveis" class="side-menu__item<?= $this->AdminMenu->activeClass('Imoveis', ['index', 'add', 'edit', 'view']) ?>">Cadastro de Imóveis</a></li>
                                        <li class="slide<?= $this->AdminMenu->activeClass('Interesses', 'index') ?>"><a href="/interesses" class="side-menu__item<?= $this->AdminMenu->activeClass('Interesses', ['index', 'view']) ?>">Interesses</a></li>
									</ul>
								</li>
                                <li class="slide<?= $this->AdminMenu->activeClass('Atendimentos') ?>">
                                    <a href="/atendimentos" class="side-menu__item<?= $this->AdminMenu->activeClass('Atendimentos', ['index', 'add', 'edit']) ?>">
										<i class="ri-question-answer-line side-menu__icon"></i>
										<span class="side-menu__label">Atendimentos</span>
									</a>
								</li>
								<li class="slide has-sub<?= $this->AdminMenu->openClass(['ContasPagar', 'ValoresReceber']) ?>">
									<a href="javascript:void(0);" class="side-menu__item<?= $this->AdminMenu->activeClass(['ContasPagar', 'ValoresReceber']) ?>">
										<i class="ri-money-dollar-circle-line side-menu__icon"></i>
										<span class="side-menu__label">Financeiro</span>
										<i class="ri-arrow-down-s-line side-menu__angle"></i>
									</a>
									<ul class="slide-menu child1">
										<li class="slide side-menu__label1"><a href="javascript:void(0)">Financeiro</a></li>
										<li class="slide<?= $this->AdminMenu->activeClass('ContasPagar') ?>"><a href="javascript:void(0);" class="side-menu__item<?= $this->AdminMenu->activeClass('ContasPagar') ?>">Contas a pagar</a></li>
										<li class="slide<?= $this->AdminMenu->activeClass('ValoresReceber') ?>"><a href="javascript:void(0);" class="side-menu__item<?= $this->AdminMenu->activeClass('ValoresReceber') ?>">Valores a receber</a></li>
									</ul>
								</li>

								<li class="slide<?= $this->AdminMenu->activeClass('Configuracoes') ?>">
									<a href="javascript:void(0);" class="side-menu__item<?= $this->AdminMenu->activeClass('Configuracoes') ?>">
										<i class="ri-settings-3-line side-menu__icon"></i>
										<span class="side-menu__label">Configurações</span>
									</a>
								</li>
							</ul>
							<div class="slide-right" id="slide-right">
								<i class="ri-arrow-right-s-line"></i>
							</div>
					</nav>
					<!-- End::nav -->

				</div>
				<!-- End::main-sidebar -->

			</aside>            <!-- End::main-sidebar -->

            <!-- Start::app-content -->
            <div class="main-content app-content">
                <div class="container-fluid">
                    <div class="p-3">
                        <?= $this->Flash->render() ?>
                        <?= $this->fetch('content') ?>
                    </div>
                </div>
            </div>
            <!-- End::app-content -->

			<!-- End::main-modal -->
            <div class="modal fade" id="ajax-modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content" id="ajax-modal-content"></div>
                </div>
            </div>
            <!-- Start::main-footer -->
            
			<footer class="footer mt-auto py-3 bg-white text-center">
				<div class="container">
					<span class="text-muted"> Copyright &copy; <span id="year">2026</span> <a
							href="javascript:void(0);" class="text-dark fw-medium">Morar.VIP</a>.
						Designed with <span class="bi bi-heart-fill text-danger"></span> by <a  href="https://agenciam2u.com.br/" target="_blank" rel="noopener noreferrer">
							<span class="fw-medium text-primary">Agencia M2U</span>
						</a> All
						rights
						reserved
					</span>
				</div>
			</footer>            <!-- End::main-footer -->

        </div>

        <!-- Start::main-scripts -->
        
         <!-- Scroll To Top -->
         <div class="scrollToTop">
            <span class="arrow lh-1"><i class="ri-rocket-line align-middle fs-18"></i></span>
         </div>
         <div id="responsive-overlay"></div>
         <!-- Scroll To Top -->

         <!-- Bootstrap JS -->
         <script src="/js/popper.min.js"></script>
         <script src="/js/bootstrap.bundle.min.js"></script>

        <!-- Defaultmenu JS -->
        <script src="/js/defaultmenu.js"></script>

        <!-- Custom JS -->
	        <script src="/js/custom.js?v=2026052801"></script>
    </body> 

</html>
