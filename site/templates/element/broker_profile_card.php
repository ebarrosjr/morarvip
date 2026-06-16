<?php
$avatar = !empty($corretor->logo) ? IMAGE_BASE_URL . '/' . $corretor->logo : $this->Url->build('/img/no-photo.png');
?>
<div class="advertising broker-profile-card">
    <div class="broker-profile-avatar">
        <img src="<?= h($avatar) ?>" alt="<?= h($corretor->nome) ?>">
    </div>
    <div class="broker-profile-info">
        <span>Corretor</span>
        <h1><?= h($corretor->nome) ?></h1>
        <?php if (!empty($corretor->creci)): ?>
            <p>CRECI <?= h($corretor->creci) ?><?= !empty($corretor->uf_creci) ? '/' . h($corretor->uf_creci) : '' ?></p>
        <?php endif; ?>
        <?php if (!empty($corretor->telefone)): ?>
            <a href="tel:<?= h(preg_replace('/\D+/', '', $corretor->telefone)) ?>">
                <i class="icon-call"></i> <?= h($corretor->telefone) ?>
            </a>
        <?php endif; ?>
    </div>
</div>
