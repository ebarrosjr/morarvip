<?php
/**
 * @var \App\View\AppView $this
 */
$this->disableAutoLayout();

$loginUrl = $this->Url->build(['controller' => 'Users', 'action' => 'login']);
$registerUrl = $this->Url->build(['controller' => 'Users', 'action' => 'add']);
$heroImage = 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=920&q=80';
$brokerImage = 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=920&q=80';
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr" data-theme-mode="light">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Morar.VIP CRM para corretores autônomos</title>
    <meta name="description" content="CRM imobiliário para corretores autônomos organizarem imóveis, leads, atendimentos, agenda e publicação em uma plataforma simples.">
    <meta name="keywords" content="CRM imobiliário, corretores autônomos, gestão de imóveis, leads imobiliários, Morar.VIP">
    <meta name="author" content="Morar.VIP">
    <meta name="robots" content="index, follow">
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['bootstrap.min', 'styles', 'icons', 'landing']) ?>
</head>
<body class="landing-page">
    <header class="landing-header">
        <nav class="container landing-nav" aria-label="Navegação principal">
            <a class="landing-logo" href="<?= $this->Url->build('/') ?>" aria-label="Morar.VIP">
                <?= $this->Html->image('logo-full.svg', ['alt' => 'Morar.VIP']) ?>
            </a>
            <div class="landing-menu">
                <a href="#produto">Home</a>
                <a href="#recursos">Recursos</a>
                <a href="#para-quem">Para quem é</a>
                <a href="#como-funciona">Como funciona</a>
                <a href="#planos">Planos</a>
            </div>
            <div class="landing-actions">
                <a class="landing-login" href="<?= h($loginUrl) ?>">Entrar</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="landing-hero" id="produto">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <span class="landing-eyebrow">CRM imobiliário para corretores autônomos</span>
                        <h1>Organize seus imóveis. Atenda melhor seus clientes. Venda com mais controle.</h1>
                        <p class="landing-lead">
                            O Morar.VIP reúne catálogo de imóveis, leads, atendimentos, agenda e publicação em uma plataforma simples para quem trabalha sozinho e precisa manter tudo sob controle.
                        </p>
                        <div class="landing-hero-actions">
                            <a class="btn btn-outline-primary btn-lg" href="<?= h($loginUrl) ?>">Entrar no CRM</a>
                        </div>
                        <div class="landing-proof">
                            <span><i class="ri-check-line"></i> Imóveis e proprietários</span>
                            <span><i class="ri-check-line"></i> Leads e atendimentos</span>
                            <span><i class="ri-check-line"></i> Rotina comercial</span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="landing-preview" aria-label="Prévia do painel Morar.VIP">
                            <img src="<?= h($heroImage) ?>" alt="Ambiente imobiliário moderno usado como imagem provisória da landing">
                            <div class="landing-preview-panel">
                                <div>
                                    <span>Novos leads</span>
                                    <strong>Organizados por imóvel</strong>
                                </div>
                                <div>
                                    <span>Visitas</span>
                                    <strong>Agenda comercial</strong>
                                </div>
                                <div>
                                    <span>Propostas</span>
                                    <strong>Acompanhamento</strong>
                                </div>
                                <div>
                                    <span>Imóveis</span>
                                    <strong>Catálogo centralizado</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-section" id="recursos">
            <div class="container">
                <div class="landing-section-heading">
                    <span class="landing-eyebrow">Recursos</span>
                    <h2>O essencial para conduzir sua carteira sem planilhas soltas.</h2>
                    <p>Cadastro, publicação, atendimento e acompanhamento comercial ficam no mesmo fluxo.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-xl-3">
                        <article class="landing-card">
                            <i class="ri-building-2-line"></i>
                            <h3>Catálogo de imóveis</h3>
                            <p>Cadastre imóveis, fotos, dados do proprietário, endereço e características em uma base única.</p>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <article class="landing-card">
                            <i class="ri-user-heart-line"></i>
                            <h3>Leads e interesses</h3>
                            <p>Receba interessados pelo site e acompanhe cada contato vinculado ao imóvel anunciado.</p>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <article class="landing-card">
                            <i class="ri-calendar-check-line"></i>
                            <h3>Agenda comercial</h3>
                            <p>Registre retornos, visitas e próximas ações para reduzir perda de oportunidades.</p>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <article class="landing-card">
                            <i class="ri-line-chart-line"></i>
                            <h3>Painel de controle</h3>
                            <p>Visualize imóveis, proprietários, atendimentos pendentes e evolução da sua operação.</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-section landing-split" id="para-quem">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <img loading="lazy" src="<?= h($brokerImage) ?>" alt="Corretor trabalhando em escritório, imagem provisória">
                    </div>
                    <div class="col-lg-6">
                        <span class="landing-eyebrow">Para quem é</span>
                        <h2>Feito inicialmente para corretores autônomos.</h2>
                        <p>
                            A proposta é simplificar a rotina de quem prospecta, cadastra, atende e negocia sem uma grande estrutura operacional por trás.
                        </p>
                        <ul class="landing-list">
                            <li><i class="ri-checkbox-circle-line"></i> Centralizar imóveis próprios e parcerias.</li>
                            <li><i class="ri-checkbox-circle-line"></i> Saber quais clientes precisam de retorno.</li>
                            <li><i class="ri-checkbox-circle-line"></i> Publicar imóveis com dados consistentes.</li>
                            <li><i class="ri-checkbox-circle-line"></i> Separar proprietários, compradores e interessados.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-section" id="como-funciona">
            <div class="container">
                <div class="landing-section-heading">
                    <span class="landing-eyebrow">Como funciona</span>
                    <h2>Do cadastro ao atendimento, sem perder o contexto.</h2>
                </div>
                <div class="landing-flow">
                    <article>
                        <span>1</span>
                        <h3>Cadastre o imóvel</h3>
                        <p>Inclua dados principais, fotos, proprietário, endereço e condições comerciais.</p>
                    </article>
                    <article>
                        <span>2</span>
                        <h3>Publique e receba interesse</h3>
                        <p>O imóvel fica pronto para ser exibido no site e captar interessados qualificados.</p>
                    </article>
                    <article>
                        <span>3</span>
                        <h3>Acompanhe o atendimento</h3>
                        <p>Transforme contatos em retornos, visitas, propostas e histórico comercial.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="landing-section" id="planos">
            <div class="container">
                <div class="landing-section-heading">
                    <span class="landing-eyebrow">Planos</span>
                    <h2>Comece pelo necessário e evolua a operação.</h2>
                    <p>Os planos serão ajustados conforme o uso real dos corretores e a evolução do produto.</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-xl-4">
                        <article class="landing-plan">
                            <h3>Autônomo</h3>
                            <p>Para o corretor organizar carteira, proprietários e interessados. São 90 dias de teste grátis. E depois: apenas R$ 19,90/mês</p>
                            <a class="btn btn-primary btn-wave" href="<?= h($registerUrl) ?>">Cadastre-se</a>
                        </article>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <article class="landing-plan landing-plan-featured">
                            <h3>Profissional</h3>
                            <p>Para quem precisa acompanhar parcerias, publicação e rotina comercial.</p>
                            <div class="btn btn-light">Em breve</div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="landing-final">
            <div class="container">
                <div class="landing-final-box">
                    <span class="landing-eyebrow">Morar.VIP CRM</span>
                    <h2>Leve sua operação imobiliária para um fluxo mais claro.</h2>
                    <p>Entre no CRM se você já possui acesso ou solicite uma demonstração para entender o encaixe na sua rotina.</p>
                    <div>
                        <a class="btn btn-primary btn-lg btn-wave" href="<?= h($loginUrl) ?>">Entrar</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="landing-footer">
        <div class="container">
            <span>&copy; <?= date('Y') ?> Morar.VIP. Todos os direitos reservados.</span>
            <a href="<?= h($loginUrl) ?>">Entrar no CRM</a>
        </div>
    </footer>
    <?= $this->Html->script(['bootstrap.bundle.min']) ?>
</body>
</html>
