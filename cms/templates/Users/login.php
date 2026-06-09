<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="auth-header">
        <img src="<?= $this->Html->Url->image('logo-full.svg') ?>" alt="Morar.VIP Logo" class="auth-logo" />
        <?= $this->Flash->render() ?>
    </div>
    <?= $this->Form->create(null, ['style' => 'min-width: 50%;']) ?>
        <div class="card mt-5" style="min-width: 90%;">
            <div class="card-body p-5">
                <div>
                    <label for="email" class="form-label">
                        <i class="ri-mail-check-line"></i> Seu e-mail de cadastro
                    </label>
                    <?= $this->Form->control('email', ['label' => false, 'class' => 'form-control', 'placeholder' => "seu@email.com"]) ?>
                </div>
                <!-- Senha -->
                <div class="my-3">
                    <label for="password" class="form-label">
                        <i class="ri-lock-password-line"></i> Sua senha para o Sistema
                    </label>
                    <?= $this->Form->control('password', ['label' => false, 'class' => 'form-control', 'type' => 'password', 'placeholder' => "Crie uma senha segura, minimo de 6 caracteres"]) ?>
                </div>
                <?= $this->Form->button('Entrar', ['class' => 'btn btn-primary w-50 mt-4 mx-auto d-block']); ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    <div class="form-label mt-3 text-center">
        Ainda não tem conta? <?= $this->Html->link("Facilite sua vida", ['action' => 'add']) ?>
    </div>
</div>