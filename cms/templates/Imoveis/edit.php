<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Edição do imóvel: <?= $imovei->titulo ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"> 
                <a href="/imoveis">
                    Imóveis
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Editar imóvel</li>
        </ol>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div class="d-flex gap-2">
            <div class="position-relative">
                <a href="<?= $this->Url->build(['controller' => 'Imoveis', 'action' => 'index']) ?>" class="btn btn-danger btn-wave waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Adicionar cliente" aria-describedby="tooltip968276" aria-expanded="false">
                    <i class="ri-share-forward-line" style="transform: scaleX(-1)"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <?= $this->Form->create($imovei) ?>
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="tipo-imovel-id">Tipo</label>
                    <?= $this->Form->select('tipo_imovel_id', $tipos, ['id' => 'tipo-imovel-id', 'class' => 'form-control']) ?>
                </div>
                <div class="col-md-9">
                    <label class="form-label" for="titulo">Título</label>
                    <?= $this->Form->control('titulo', ['label' => false, 'class' => 'form-control']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label" for="chamada">Chamada</label>
                    <?= $this->Form->control('chamada', ['type' => 'textarea', 'rows' => 3, 'label' => false, 'class' => 'form-control']) ?>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label" for="descricao">Descrição</label>
                    <?= $this->Form->control('descricao', ['type' => 'textarea', 'rows' => 6, 'label' => false, 'class' => 'form-control']) ?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="categoria-id">Categoria</label>
                    <?= $this->Form->select('categoria_id', $categorias, ['id' => 'categoria-id', 'class' => 'form-control']) ?>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="cep">CEP</label>
                    <?= $this->Form->control('cep', ['label' => false, 'class' => 'form-control']) ?>                    </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="numero">Número</label>
                    <?= $this->Form->control('numero', ['label' => false, 'class' => 'form-control']) ?>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="complemento">Complemento</label>
                    <?= $this->Form->control('complemento', ['label' => false, 'class' => 'form-control']) ?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="tamanho">Tamanho</label>
                    <?=$this->Form->control('tamanho', ['type' => 'number', 'label' => false, 'class' => 'form-control'])?>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="quartos">Quartos</label>
                    <?=$this->Form->control('quartos', ['type' => 'number', 'label' => false, 'class' => 'form-control'])?>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="banheiros">Banheiros</label>
                    <?=$this->Form->control('banheiros', ['type' => 'number', 'label' => false, 'class' => 'form-control'])?>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="vaga-garagem">Vaga Garagem</label>
                    <?=$this->Form->control('vaga_garagem', ['type' => 'number', 'label' => false, 'class' => 'form-control'])?>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="negocio">Negocio</label>
                    <?=$this->Form->control('negocio', ['options' => ['V' => 'Venda', 'L' => 'Locação', 'A' => 'Arrendamento'], 'label' => false, 'class' => 'form-control'])?>
                </div>
                <div class="mb-3 mt-1 pt-4 col-md-3">
                    <label for="financia" class="form-label">
                        <?=$this->Form->control('financia', ['type' => 'checkbox', 'label' => false, 'value' => 1, 'class' => 'form-check-input'])?>
                        <span class="form-check-label">Aceita financiamento</span>
                    </label>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="valor">Valor</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <?= $this->Form->control('valor', ['type' => 'number', 'step' => '0.1', 'label' => false, 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="mb-3 col-md-3">
                    <label class="form-label" for="iptu">IPTU</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <?= $this->Form->control('iptu', ['type' => 'number', 'step' => '0.1', 'label' => false, 'class' => 'form-control']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <label class="form-label" for="comissao">Comissão</label>
            <div class="input-group">
                <span class="input-group-text">
                    <?= $this->Form->control('tipo_comissao', ['options' => ['P' => '%', 'D' => 'R$'], 'label' => false]) ?>
                </span>
                <?= $this->Form->control('comissao', ['type' => 'number', 'step' => '0.1', 'label' => false, 'class' => 'form-control']) ?>
            </div>
        </div>
        <div class="mb-3 mt-1 pt-4 col-md-2">
            <label for="comissao-permanente" class="form-label">
                <input type="checkbox" class="form-check-input me-1" name="comissao_permanente" id="comissao-permanente" value="1">
                <span class="form-check-label">Comissão permanente</span>
            </label>
        </div>        
        <div class="mb-3 mt-1 pt-4 col-md-2">
            <label for="show-site" class="form-label">
                <input type="checkbox" class="form-check-input me-1" name="show_site" id="show-site" value="1">
                <span class="form-check-label">Mostrar imóvel no site</span>
            </label>
        </div>
        <div class="mb-3 mt-1 pt-4 col-md-2">
            <label for="show-preco-site" class="form-label">
                <input type="checkbox" class="form-check-input me-1" name="show_preco_site" id="show-preco-site" value="1">
                <span class="form-check-label">Mostrar preço no site</span>
            </label>
        </div>        
        <div class="mb-3 mt-1 pt-4 col-md-2">
            <label for="corretor-opcionista" class="form-label">
                <input type="checkbox" class="form-check-input me-1" name="corretor_opcionista" id="corretor-opcionista" value="1">
                <span class="form-check-label">Sou opcionista</span>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 mt-1 pt-4 col-md-2">
            <label for="exclusividade" class="form-label pt-4 mt-2">
                <input type="checkbox" class="form-check-input me-1" name="exclusividade" id="exclusividade" value="1">
                <span class="form-check-label">Exclusividade</span>
            </label>
        </div>
        <div class="mb-3 mt-1 pt-4 col-md-3">
            <label for="inicio-exclusividade" class="form-label excluvivo">Início da exclusividade</label>
            <?= $this->Form->control('inicio_exclusividade', ['type' => 'date', 'label' => false, 'class' => 'form-control']) ?>
        </div>
        <div class="mb-3 mt-1 pt-4 col-md-3">
            <label for="fim-exclusividade" class="form-label excluvivo">Fim da exclusividade</label>
            <?= $this->Form->control('fim_exclusividade', ['type' => 'date', 'label' => false, 'class' => 'form-control']) ?>
        </div>
        <div class="mb-3 mt-1 pt-4 col-md-2">
            <label for="parceiria" class="form-label pt-4 mt-2">
                <input type="checkbox" class="form-check-input me-1" name="parceiria" id="parceiria" value="1"<?= $imovei->parceiria ? ' checked' : '' ?>>
                <span class="form-check-label">Aceita parceria</span>
            </label>
        </div>
        <div class="mb-3 mt-1 pt-4 col-md-2">
            <label for="porcentagem-parceiro" class="form-label excluvivo">Porcentagem do parceiro</label>
            <?= $this->Form->control('porcentagem_parceiro', ['type' => 'number', 'step' => '1', 'label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <button type="submit" class="mt-2 btn btn-success">Editar</button>
    <?= $this->Form->hidden('id', ['id' => 'imovel-id', 'value' => $imovei->id]) ?>
    <?= $this->Form->end() ?>
</div>
<?php $this->append('script'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const exclusividadeCheckbox = document.getElementById('exclusividade');
    const inicioExclusividadeInput = document.getElementById('inicio-exclusividade');
    const fimExclusividadeInput = document.getElementById('fim-exclusividade');
    const parceriaCheckbox = document.getElementById('parceiria');
    const porcentagemParceiroInput = document.getElementById('porcentagem-parceiro');

    function toggleExclusividadeFields() {
        const isChecked = exclusividadeCheckbox.checked;
        inicioExclusividadeInput.disabled = !isChecked;
        fimExclusividadeInput.disabled = !isChecked;
    }

    function toggleParceriaField() {
        const isChecked = parceriaCheckbox.checked;
        porcentagemParceiroInput.disabled = !isChecked;
        porcentagemParceiroInput.required = isChecked;
    }

    exclusividadeCheckbox.addEventListener('change', toggleExclusividadeFields);
    parceriaCheckbox.addEventListener('change', toggleParceriaField);
    toggleExclusividadeFields();
    toggleParceriaField();
});
</script>
<?php $this->end(); ?>
