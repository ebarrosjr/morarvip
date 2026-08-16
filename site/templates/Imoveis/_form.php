<?php
$imovei ??= $this->get('imovei');
$categorias ??= $this->get('categorias') ?? [];
$tipos ??= $this->get('tipos') ?? [];
$isEdit = !empty($imovei->id);
$pessoa = $imovei->pessoa ?? $this->request->getAttribute('identity');
$formUrl = $isEdit
    ? ['controller' => 'Imoveis', 'action' => 'edit', $imovei->id]
    : ['controller' => 'Imoveis', 'action' => 'add'];
?>
<div class="login-modal-content property-submit-modal-content" data-modal-size="xl">
    <?= $this->Flash->render() ?>
    <div class="auth-modal-message login-modal-error alert d-none" role="alert"></div>

    <h3><?= $isEdit ? 'Editar imóvel' : 'Anuncie seu imóvel' ?></h3>
    <p>Informe os dados principais. Após a submissão, a equipe validará o anúncio antes da publicação.</p>

    <?= $this->Form->create($imovei, [
        'class' => 'js-auth-form',
        'url' => $formUrl,
    ]) ?>
        <h5 class="mb-3">Dados do proprietário</h5>
        <div class="row">
            <div class="col-md-3">
                <?= $this->Form->control('pessoa.cpf', [
                    'label' => 'CPF',
                    'class' => 'form-control',
                    'value' => $pessoa->cpf ?? '',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $this->Form->control('pessoa.nome', [
                    'label' => 'Nome',
                    'class' => 'form-control',
                    'required' => true,
                    'value' => $pessoa->nome ?? '',
                ]) ?>
            </div>
            <div class="col-md-5">
                <?= $this->Form->control('pessoa.email', [
                    'label' => 'E-mail',
                    'class' => 'form-control',
                    'required' => true,
                    'value' => $pessoa->email ?? '',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $this->Form->control('pessoa.telefone', [
                    'label' => 'Whatsapp',
                    'class' => 'form-control',
                    'required' => true,
                    'value' => $pessoa->telefone ?? $pessoa->whatsapp ?? '',
                ]) ?>
            </div>
        </div>

        <hr>

        <h5 class="mb-3">Dados do imóvel</h5>
        <div class="row">
            <div class="col-md-4">
                <label for="tipo-imovel-id">Tipo</label>
                <?= $this->Form->select('tipo_imovel_id', $tipos, [
                    'id' => 'tipo-imovel-id',
                    'class' => 'form-control',
                    'empty' => 'Selecione',
                ]) ?>
            </div>
            <div class="col-md-8">
                <?= $this->Form->control('titulo', [
                    'label' => 'Título',
                    'class' => 'form-control',
                    'required' => true,
                ]) ?>
            </div>
            <div class="col-12">
                <?= $this->Form->control('chamada', [
                    'type' => 'textarea',
                    'rows' => 2,
                    'label' => 'Chamada',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-12">
                <?= $this->Form->control('descricao', [
                    'type' => 'textarea',
                    'rows' => 4,
                    'label' => 'Descrição',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-4">
                <label for="categoria-id">Categoria</label>
                <?= $this->Form->select('categoria_id', $categorias, [
                    'id' => 'categoria-id',
                    'class' => 'form-control',
                    'empty' => 'Selecione',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('cep', [
                    'label' => 'CEP',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-2">
                <?= $this->Form->control('numero', [
                    'label' => 'Número',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('complemento', [
                    'label' => 'Complemento',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('tamanho', [
                    'type' => 'number',
                    'label' => 'Área (m²)',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('quartos', [
                    'type' => 'number',
                    'label' => 'Quartos',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('banheiros', [
                    'type' => 'number',
                    'label' => 'Banheiros',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('vaga_garagem', [
                    'type' => 'number',
                    'label' => 'Vagas',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('negocio', [
                    'options' => ['V' => 'Venda', 'L' => 'Locação', 'A' => 'Arrendamento'],
                    'label' => 'Negócio',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('valor', [
                    'type' => 'number',
                    'step' => '0.01',
                    'label' => 'Valor',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('iptu', [
                    'type' => 'number',
                    'step' => '0.01',
                    'label' => 'IPTU',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $this->Form->control('condominio', [
                    'type' => 'number',
                    'step' => '0.01',
                    'label' => 'Condomínio',
                    'class' => 'form-control',
                ]) ?>
            </div>
            <div class="col-12 mt-2">
                <label for="financia" class="form-label">
                    <?= $this->Form->control('financia', [
                        'type' => 'checkbox',
                        'label' => false,
                        'value' => 1,
                        'class' => 'form-check-input',
                        'id' => 'financia',
                    ]) ?>
                    <span class="form-check-label">Aceita financiamento</span>
                </label>
            </div>
        </div>

        <button class="theme-btn-1 btn btn-effect-1 w-100 mt-3" type="submit">
            <?= $isEdit ? 'Salvar alterações' : 'Enviar imóvel' ?>
        </button>
    <?= $this->Form->end() ?>
</div>
