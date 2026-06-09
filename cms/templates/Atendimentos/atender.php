<?= $this->Form->create(null, [
    'url' => ['controller' => 'Atendimentos', 'action' => 'registraAtendimento'],
    'data-ajax-modal-form' => true,
]) ?>
<div class="modal-header">
    <h5 class="modal-title">Atender pessoa</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
</div>
<div class="modal-body">
    <h5><?= h($pessoa->nome) ?></h5>
    <p class="text-muted mb-4">
        <?php
        $sexo = $pessoa->sexo == 'F' ? 'Mulher' : ($pessoa->sexo == 'M' ? 'Homem' : 'Sexo não informado');
        $idade = $pessoa->nascimento ? $this->Idade->calcular($pessoa->nascimento) : 'idade não informada';
        $bairro = $pessoa->bairro ?: 'localidade não informada';
        ?>
        <?= h($sexo) ?> - <?= h($idade) ?>, residente em <?= h($bairro) ?>
    </p>

    <?= $this->Form->hidden('pessoa_id', ['value' => $pessoa->id]) ?>

    <div class="row">
        <div class="col-md-8">
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição do atendimento</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="6"></textarea>
            </div>
            <div class="row g-2">
                <?php if (!empty($pessoa->telefone)) { ?>
                    <div class="col-md-4">
                        <a href="tel:<?= h($pessoa->telefone) ?>" class="btn btn-primary w-100" target="_blank">
                            <i class="ri-phone-line"></i> <?= h($pessoa->telefone) ?>
                        </a>
                    </div>
                <?php } ?>

                <?php if (!empty($pessoa->whatsapp)) { ?>
                    <div class="col-md-4">
                        <a href="https://wa.me/<?= preg_replace('/\D+/', '', $pessoa->whatsapp) ?>" class="btn btn-success w-100" target="_blank">
                            <i class="ri-whatsapp-line"></i> <?= h($pessoa->whatsapp) ?>
                        </a>
                    </div>
                <?php } ?>

                <?php if (!empty($pessoa->email)) { ?>
                    <div class="col-md-4">
                        <a href="mailto:<?= h($pessoa->email) ?>" class="btn btn-warning w-100" target="_blank">
                            <i class="ri-mail-line"></i> <?= h($pessoa->email) ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="canal" class="form-label">Canal de atendimento</label>
                <select class="form-control" id="canal" name="canal">
                    <option value="T">Telefone</option>
                    <option value="W">WhatsApp</option>
                    <option value="E">E-mail</option>
                    <option value="O">Outros</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="conversao" class="form-label">Classificação do atendimento</label>
                <select class="form-control" id="conversao" name="conversao">
                    <option value="N">Negativa</option>
                    <option value="P">Positiva</option>
                    <option value="X">Não contactado</option>
                    <option value="O">Neutro</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nota" class="form-label">Nota</label>
                <div class="row align-items-center">
                    <div class="col-10">
                        <input type="range" class="form-range" id="nota" name="nota" min="0" max="10" step="1" value="5" oninput="document.getElementById('notasOutput').value = this.value">
                    </div>
                    <div class="col-2">
                        <output id="notasOutput">5</output>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
    <button type="submit" name="G" value="1" class="btn btn-success">Gravar</button>
    <button type="submit" name="N" value="1" class="btn btn-primary">Gravar e abrir próximo</button>
</div>
<?= $this->Form->end() ?>
