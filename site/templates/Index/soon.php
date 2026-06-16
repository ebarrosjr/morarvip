
<!doctype html>
<html class="no-js" lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Morar.VIP</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/icons/favicon.png" type="image/x-icon" />
    <?= $this->Html->css(['style', 'responsive']) ?>
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
        }

        .soon-wrapper {
            align-items: center;
            display: flex;
            justify-content: center;
            min-height: 100vh;
            padding: 30px;
            text-align: center;
        }

        .soon-content img {
            margin-bottom: 30px;
            max-width: 280px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="soon-wrapper">
        <div class="soon-content">
            <img src="<?= $this->Url->build('/img/logo-full.svg') ?>" alt="Logo">
            <h1>Em breve</h1>
            <p>Estamos trabalhando para trazer uma experiência incrível para você.</p>
            <p>
                Fique atento às nossas redes sociais para novidades!
            </p>
        </div>
    </div>
</body>
</html>
