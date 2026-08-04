<?php
$redirect = $redirect ?? $this->request->getQuery('redirect', '/');
$loginUrl = $this->Url->build([
    'controller' => 'Users',
    'action' => 'login',
    '?' => ['redirect' => $redirect],
]);
$registerUrl = $this->Url->build([
    'controller' => 'Users',
    'action' => 'register',
    '?' => ['redirect' => $redirect],
]);
?>
<div class="login-modal-content">
    <?= $this->Flash->render() ?>
    <div class="auth-modal-message login-modal-error alert d-none" role="alert"></div>

    <h3>Esqueci a senha</h3>
    <p><?= h($message ?? 'Informe seu e-mail para receber as instruções de recuperação.') ?></p>

    <?= $this->Form->create(null, [
        'id' => 'ajax-forgot-password-form',
        'class' => 'js-auth-form',
        'url' => ['controller' => 'Users', 'action' => 'forgotPassword', '?' => ['redirect' => $redirect]],
    ]) ?>
        <?= $this->Form->control('email', [
            'label' => 'E-mail',
            'required' => true,
            'autocomplete' => 'email',
        ]) ?>
        <button class="theme-btn-1 btn btn-effect-1 w-100" type="submit">Enviar instruções</button>
    <?= $this->Form->end() ?>

    <div class="auth-modal-links text-center mt-3">
        <a class="js-auth-modal" href="<?= h($loginUrl) ?>">Voltar para login</a>
        <span class="mx-2">|</span>
        <a class="js-auth-modal" href="<?= h($registerUrl) ?>">Criar cadastro</a>
    </div>
</div>
