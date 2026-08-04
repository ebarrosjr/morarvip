<?php
$redirect = $redirect ?? $this->request->getQuery('redirect', '/');
$loginUrl = $this->Url->build([
    'controller' => 'Users',
    'action' => 'login',
    '?' => ['redirect' => $redirect],
]);
?>
<div class="login-modal-content">
    <?= $this->Flash->render() ?>
    <div class="auth-modal-message login-modal-error alert d-none" role="alert"></div>

    <h3>Nova senha</h3>
    <p>Cadastre uma nova senha para acessar sua conta.</p>

    <?= $this->Form->create($pessoa ?? null, [
        'id' => 'ajax-reset-password-form',
        'class' => 'js-auth-form',
        'url' => ['controller' => 'Users', 'action' => 'resetPassword', $token, '?' => ['redirect' => $redirect]],
    ]) ?>
        <?= $this->Form->control('password', [
            'label' => 'Nova senha',
            'required' => true,
            'autocomplete' => 'new-password',
        ]) ?>
        <?= $this->Form->control('password_confirm', [
            'type' => 'password',
            'label' => 'Confirmar nova senha',
            'required' => true,
            'autocomplete' => 'new-password',
        ]) ?>
        <button class="theme-btn-1 btn btn-effect-1 w-100" type="submit">Alterar senha</button>
    <?= $this->Form->end() ?>

    <div class="auth-modal-links text-center mt-3">
        <a class="js-auth-modal" href="<?= h($loginUrl) ?>">Voltar para login</a>
    </div>
</div>
