<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="auth-header text-center">
        <img src="<?= $this->Html->Url->image('logo-full.svg') ?>" alt="Morar.VIP Logo" class="auth-logo" />
        <h2 style="text-transform: uppercase;">Teste por 90 dias Grátis</h2>
        <p>Só paga se quiser após este período, não é necessário cartão de crédito.</p>
    </div>
    <?= $this->Form->create() ?>
        <div class="card">
            <div class="card-body p-5">
                <div class="form-group">
                    <label for="nome" class="form-label">
                        <i class="ri-shield-user-line"></i> Seu nome ou da Imobiliária
                    </label>
                    <?= $this->Form->control('nome', ['label' => false, 'class' => 'form-control']) ?>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="telefone" class="form-label">
                            <i class="ri-whatsapp-line"></i> Telefone
                        </label>
                        <?= $this->Form->control('telefone', ['label' => false, 'class' => 'form-control', 'placeholder' => "(00) 00000-0000"]) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="plan-id" class="form-label">
                            <i class="ri-trophy-line"></i> Plano
                        </label>
                        <?= $this->Form->control('plan_id', ['label' => false, 'class' => 'form-control', 'options' => $plans]) ?>
                        <small>Depois do período de teste: R$ 19,99/mês</small>
                    </div>
                </div>
                <div class="mt-1">
                    <label for="email" class="form-label">
                        <i class="ri-mail-check-line"></i> E-mail para Acesso
                    </label>
                    <?= $this->Form->control('email', ['label' => false, 'class' => 'form-control', 'placeholder' => "seu@email.com"]) ?>
                </div>
                <!-- Senha -->
                <div class="mt-3">
                    <label for="password" class="form-label">
                        <i class="ri-lock-password-line"></i> Senha para o Sistema
                    </label>
                    <?= $this->Form->control('password', ['label' => false, 'class' => 'form-control', 'type' => 'password', 'placeholder' => "Crie uma senha segura, minimo de 6 caracteres"]) ?>
                </div>
                <!-- Termos -->
                <div class="mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="check-read" name="check_read" required>
                        <label class="form-check-label" for="check-read">
                            Declaro que li e concordo com os Termos de Uso e Política de Privacidade.
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-50 mt-4 mx-auto d-block">
                    Criar conta
                </button>
            </div>
        </div>
    <?= $this->Form->end() ?>
    <div class="auth-notice">
        <i class="ri-information-2-line"></i>
        Ao clicar em "Criar conta", você receberá um e-mail para ativar sua conta, a veracidade dos dados é de responsabilidade única do usuário.
    </div>
</div>