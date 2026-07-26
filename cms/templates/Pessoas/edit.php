<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <?php
    $returnTo = $returnTo ?? 'compradores';
    $returnUrl = $returnTo === 'proprietarios'
        ? ['controller' => 'Pessoas', 'action' => 'proprietarios']
        : ['controller' => 'Pessoas', 'action' => 'index'];
    $returnLabel = $returnTo === 'proprietarios' ? 'Proprietários' : 'Compradores/Locatários';
    ?>
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Editar dados de <?= h($pessoa->nome) ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"> 
                <a href="<?= $this->Url->build($returnUrl) ?>">
                    <?= h($returnLabel) ?>
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edição</li>
        </ol>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div class="d-flex gap-2">
            <div class="position-relative">
                <a href="<?= $this->Url->build($returnUrl) ?>" class="btn btn-danger btn-wave waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Voltar para <?= h($returnLabel) ?>" aria-describedby="tooltip968276" aria-expanded="false">
                    <i class="ri-share-forward-line" style="transform: scaleX(-1)"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <?= $this->Form->create($pessoa) ?>
    <?= $this->Form->hidden('return_to', ['value' => $returnTo]) ?>
    <h5 class="mb-3">Dados pessoais e contato</h5>    
    <div class="row mb-3">
        <div class="col-md-2">
            <label class="form-label" for="cpf">CPF</label>
            <?= $this->Form->control('cpf', ['label' => false, 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="nome">Nome</label>
            <?= $this->Form->control('nome', ['label' => false, 'class' => 'form-control', "required" => true ]) ?>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="nascimento">Data de nascimento</label>
            <?= $this->Form->control('nascimento', ['label' => false, 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="sexo">Sexo</label>
            <?= $this->Form->control('sexo', ['label' => false, 'class' => 'form-control', "options" => ['M' => 'Masculino', 'F' => 'Feminino'] ]) ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-2">
            <label class="form-label" for="telefone">Telefone</label>
            <?= $this->Form->control('telefone', ['label' => false, 'class' => 'form-control']) ?>
        </div>    
        <div class="col-md-2">
            <label class="form-label" for="whatsapp">Whatsapp</label>
            <?= $this->Form->control('whatsapp', ['label' => false, 'class' => 'form-control' ]) ?>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="email">E-mail</label>
            <?= $this->Form->control('email', ['label' => false, 'class' => 'form-control', "required" => true ]) ?>
        </div>
        <div class="col-md-2">
            <label class="form-label" for="instagram">@ instagram</label>
            <?= $this->Form->control('instagram', ['label' => false, 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="facebook">Perfil Facebook</label>
            <?= $this->Form->control('facebook', ['label' => false, 'class' => 'form-control']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-3">Dados econômicos</h5>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="estado-civil">Estado Civil</label>
                            <?= $this->Form->control('estado_civil', ['label' => false, 'class' => 'form-control', "options" => $estadoCivil ]) ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="escolaridade-id">Escolaridade</label>
                            <?= $this->Form->control('escolaridade_id', ['label' => false, 'class' => 'form-control', "options" => $escolaridades ]) ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="renda-id">Renda Familiar</label>
                            <?= $this->Form->control('renda_id', ['label' => false, 'class' => 'form-control', "options" => $rendaFamiliar ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h5 class="mb-3">Localização</h5>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="form-label" for="cep">CEP</label>
                            <?= $this->Form->control('cep', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-md-6" id="logradouro"></div>
                        <?= $this->Form->hidden('latitude', ['id' => 'latitude']) ?>
                        <?= $this->Form->hidden('longitude', ['id' => 'longitude']) ?>
                        <div class="col-md-2">
                            <label class="form-label" for="numero">Número</label>
                            <?= $this->Form->control('numero', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="complemento">Complemento</label>
                            <?= $this->Form->control('complemento', ['label' => false, 'class' => 'form-control']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <button type="submit" class="mt-2 btn btn-success">Editar</button>
    <?= $this->Form->end() ?>
</div>
<?php $this->append('script'); ?>
<style>
    .cep-loading-icon {
        animation: cep-spin 0.8s linear infinite;
        display: inline-block;
    }

    @keyframes cep-spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cepInput = document.getElementById('cep');
    const logradouroBox = document.getElementById('logradouro');
    const latitudeInput = document.getElementById('latitude');
    const longitudeInput = document.getElementById('longitude');
    const endpointBase = '<?= $this->Url->build(['controller' => 'Pessoas', 'action' => 'enderecoPorCep']) ?>';
    let lastCep = '';
    let timeoutId = null;

    if (!cepInput || !logradouroBox) {
        return;
    }

    function setLoading() {
        logradouroBox.innerHTML = '<label class="form-label d-block">Logradouro</label><div class="form-control-plaintext"><i class="ri-refresh-line cep-loading-icon"></i> Consultando CEP...</div>';
    }

    function setAddress(data) {
        const parts = [data.logradouro, data.bairro, data.cidade, data.uf].filter(Boolean);
        logradouroBox.innerHTML = '<label class="form-label d-block">Logradouro</label><div class="form-control-plaintext">' + escapeHtml(parts.join(' - ') || 'Endereço não informado') + '</div>';

        if (data.latitude) {
            latitudeInput.value = data.latitude;
        }

        if (data.longitude) {
            longitudeInput.value = data.longitude;
        }
    }

    function setError(message) {
        logradouroBox.innerHTML = '<label class="form-label d-block">Logradouro</label><div class="form-control-plaintext text-danger">' + escapeHtml(message) + '</div>';
        latitudeInput.value = '';
        longitudeInput.value = '';
    }

    function escapeHtml(value) {
        return String(value).replace(/[&<>"']/g, function (char) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[char];
        });
    }

    async function consultarCep() {
        const cep = cepInput.value.replace(/\D+/g, '');

        if (cep.length !== 8 || cep === lastCep) {
            return;
        }

        lastCep = cep;
        setLoading();

        try {
            const response = await fetch(endpointBase + '/' + cep, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });
            const data = await response.json();

            if (!response.ok || !data.success) {
                setError(data.message || 'CEP não encontrado.');
                return;
            }

            setAddress(data);
        } catch (error) {
            setError('Não foi possível consultar o CEP agora.');
        }
    }

    cepInput.addEventListener('input', function () {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(consultarCep, 500);
    });

    cepInput.addEventListener('blur', consultarCep);

    if (cepInput.value.replace(/\D+/g, '').length === 8) {
        consultarCep();
    }
});
</script>
<?php $this->end(); ?>
