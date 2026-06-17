<?php
$redirect = $redirect ?? $this->request->getQuery('redirect', '/');
$registerUrl = $this->Url->build([
    'controller' => 'Users',
    'action' => 'register',
    '?' => ['redirect' => $redirect],
]);
$forgotPasswordUrl = $this->Url->build([
    'controller' => 'Users',
    'action' => 'forgotPassword',
    '?' => ['redirect' => $redirect],
]);
?>
<div class="login-modal-content">
    <?= $this->Flash->render() ?>
    <div class="auth-modal-message login-modal-error alert d-none" role="alert"></div>

    <h3>Entrar</h3>
    <p>Acesse sua conta para continuar.</p>

    <?= $this->Form->create(null, [
        'id' => 'ajax-login-form',
        'class' => 'js-auth-form',
        'url' => ['controller' => 'Users', 'action' => 'login', '?' => ['redirect' => $redirect ?? '/']],
    ]) ?>
        <?= $this->Form->control('email', [
            'label' => 'E-mail',
            'required' => true,
            'autocomplete' => 'email',
        ]) ?>
        <?= $this->Form->control('password', [
            'label' => 'Senha',
            'required' => true,
            'autocomplete' => 'current-password',
        ]) ?>
        <button class="theme-btn-1 btn btn-effect-1 w-100" type="submit">Entrar</button>
    <?= $this->Form->end() ?>

    <div class="auth-modal-links text-center mt-3">
        <a class="js-auth-modal" href="<?= h($forgotPasswordUrl) ?>">Esqueci minha senha</a>
        <span class="mx-2">|</span>
        <a class="js-auth-modal" href="<?= h($registerUrl) ?>">Criar cadastro</a>
    </div>
</div>
