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

    <h3>Criar cadastro</h3>
    <p>Informe seus dados para acessar sua conta.</p>

    <?= $this->Form->create($pessoa ?? null, [
        'id' => 'ajax-register-form',
        'class' => 'js-auth-form',
        'url' => ['controller' => 'Users', 'action' => 'register', '?' => ['redirect' => $redirect]],
    ]) ?>
        <?= $this->Form->control('nome', [
            'label' => 'Nome',
            'required' => true,
            'autocomplete' => 'name',
        ]) ?>
        <?= $this->Form->control('email', [
            'label' => 'E-mail',
            'required' => true,
            'autocomplete' => 'email',
        ]) ?>
        <?= $this->Form->control('telefone', [
            'label' => 'Telefone (WhatsApp)',
            'required' => true,
            'autocomplete' => 'tel',
        ]) ?>
        <?= $this->Form->control('password', [
            'label' => 'Senha',
            'required' => true,
            'autocomplete' => 'new-password',
        ]) ?>
        <?= $this->Form->control('password_confirm', [
            'type' => 'password',
            'label' => 'Confirmar senha',
            'required' => true,
            'autocomplete' => 'new-password',
        ]) ?>
        <button class="theme-btn-1 btn btn-effect-1 w-100" type="submit">Cadastrar</button>
    <?= $this->Form->end() ?>

    <div class="auth-modal-links text-center mt-3">
        Já tem cadastro?
        <a class="js-auth-modal" href="<?= h($loginUrl) ?>">Entrar</a>
    </div>
</div>
