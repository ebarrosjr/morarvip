<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="auth-header">
        <img src="<?= $this->Html->Url->image('logo-full.svg') ?>" alt="Morar.VIP Logo" class="auth-logo" />
    </div>
    <?= $this->Form->create(null, ['style' => 'min-width: 50%;']) ?>
        <div class="card mt-5" style="min-width: 90%;">
            <div class="card-body p-5">
                <h5 class="card-title mb-3 text-center">Criar nova senha</h5>
                <p class="text-center mb-4">Informe e confirme sua nova senha de acesso.</p>
                <div>
                    <label for="password" class="form-label">
                        <i class="ri-lock-password-line"></i> Nova senha
                    </label>
                    <?= $this->Form->control('password', [
                        'label' => false,
                        'class' => 'form-control',
                        'type' => 'password',
                        'required' => true,
                        'placeholder' => 'Nova senha',
                    ]) ?>
                </div>
                <div class="mt-3">
                    <label for="confirm-password" class="form-label">
                        <i class="ri-lock-password-fill"></i> Confirme a nova senha
                    </label>
                    <?= $this->Form->control('confirm_password', [
                        'label' => false,
                        'class' => 'form-control',
                        'type' => 'password',
                        'required' => true,
                        'placeholder' => 'Confirme a nova senha',
                    ]) ?>
                </div>
                <?= $this->Form->button('Alterar senha', ['class' => 'btn btn-primary w-50 mt-4 mx-auto d-block']); ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    <div class="form-label mt-3 text-center">
        <?= $this->Html->link('Voltar para o login', ['action' => 'login'], ['class' => 'btn btn-outline-dark']) ?>
    </div>
</div>
