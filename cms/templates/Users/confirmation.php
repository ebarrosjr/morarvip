<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 90vh;">
    <div class="auth-header px-5 text-center">
        <img src="<?= $this->Html->Url->image('logo-full.svg') ?>" alt="Morar.VIP Logo" class="auth-logo" />
        <?= $this->Flash->render() ?>
        <h5 class="card-title mt-3">Confirmação de Cadastro</h5>
        <p>Digite o código de ativação enviado para seu e-mail para ativar sua conta.</p>
    </div>
    <div class="card mt-2" style="min-width: 90%;">
        <div class="card-body p-5">
            <?= $this->Form->create(null, ['style' => 'min-width: 80%;']) ?>
                <div class="mb-3">
                    <label for="activation-code-1" class="form-label text-center w-100">
                        <i class="ri-mail-check-line"></i> Código de Ativação
                    </label>
                    <div class="activation-code-inputs">
                        <?php for ($i = 0; $i < 6; $i++) : ?>
                            <input
                                type="text"
                                name="activation_code[]"
                                id="activation-code-<?= $i + 1 ?>"
                                class="form-control activation-code-input"
                                maxlength="1"
                                inputmode="text"
                                autocomplete="one-time-code"
                                required
                            />
                        <?php endfor; ?>
                    </div>
                </div>
                <?= $this->Form->button('Ativar Conta', ['class' => 'btn btn-primary w-50 mt-4 mx-auto d-block']); ?>
            <?= $this->Form->end() ?>
            <div class="auth-notice mt-4">
                <p><i class="ri-information-line"></i> Não recebeu o código de ativação? <a href="#">Clique aqui para reenviar</a></p>
            </div>
        </div>
    </div>
</div>
<?php $this->append('script'); ?>
<script>
document.querySelectorAll('.activation-code-input').forEach((input, index, inputs) => {
    input.addEventListener('input', () => {
        input.value = input.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 1);

        if (input.value && inputs[index + 1]) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener('keydown', (event) => {
        if (event.key === 'Backspace' && !input.value && inputs[index - 1]) {
            inputs[index - 1].focus();
        }
    });

    input.addEventListener('paste', (event) => {
        const code = event.clipboardData.getData('text').toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 6);

        if (code.length <= 1) {
            return;
        }

        event.preventDefault();
        code.split('').forEach((char, charIndex) => {
            if (inputs[charIndex]) {
                inputs[charIndex].value = char;
            }
        });
        inputs[Math.min(code.length, inputs.length) - 1].focus();
    });
});
</script>
<?php $this->end(); ?>
