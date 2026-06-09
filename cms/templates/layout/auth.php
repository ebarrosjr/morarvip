<?php
$authBackground = $this->Html->Url->image('bg-' . random_int(1, 4) . '.jpg');
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <meta name="description" content="Faça login ou registre-se para acessar o painel de controle do Morar.VIP. Gerencie seus imóveis, planos e muito mais com facilidade.">
    <meta name="keywords" content="Gestão imobiliária, aplicação para corretores, Leads, CRM imobiliário, Cadastro de imóveis, gestão de aluguel, gestão de vendas, painel de controle imobiliário, Morar.VIP">
    <meta name="author" content="Morar.VIP">
    <meta name="robots" content="index, follow">
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?= $this->Html->css(['bootstrap.min', 'auth', 'remixicon']) ?>
    <?= $this->fetch('css') ?>
</head>
<body>
    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
    </footer>
    <?= $this->Html->script(['bootstrap.bundle.min']) ?>
    <?= $this->fetch('script') ?>
</body>
</html>
