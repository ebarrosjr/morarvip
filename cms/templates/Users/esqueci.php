<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="auth-header">
        <img src="<?= $this->Html->Url->image('logo-full.svg') ?>" alt="Morar.VIP Logo" class="auth-logo" />
    </div>
    <?= $this->Form->create(null, ['style' => 'min-width: 50%;']) ?>
        <div class="card mt-5" style="min-width: 90%;">
            <div class="card-body p-5">
                <h5 class="card-title mb-3 text-center">Recuperar senha</h5>
                <p class="text-center mb-4">Informe o e-mail cadastrado. Enviaremos um link por SMS para o telefone da sua conta.</p>
                <div>
                    <label for="email" class="form-label">
                        <i class="ri-mail-check-line"></i> E-mail cadastrado
                    </label>
                    <?= $this->Form->control('email', [
                        'label' => false,
                        'class' => 'form-control',
                        'type' => 'email',
                        'placeholder' => 'seu@email.com',
                        'required' => true,
                    ]) ?>
                </div>
                <?= $this->Form->button('Enviar link por SMS', ['class' => 'btn btn-primary w-50 mt-4 mx-auto d-block']); ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
    <div class="form-label mt-3 text-center">
        <?= $this->Html->link('Lembrou a senha? Entrar', ['action' => 'login'], ['class' => 'btn btn-outline-dark']) ?>
    </div>
</div>
