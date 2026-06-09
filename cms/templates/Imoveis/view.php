<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Detalhes do Imóvel: <?= $imovei->titulo ?></h1>
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
            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
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
<div class="row">
    <div class="col-xxl-5">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row">
                    <?php 
                    if(count($imovei->foto_imoveis ?? []) === 0) { ?>
                        <div class="col-3 mb-3">
                            <img src="<?= $this->Url->build('/img/no-imovel-photo.png') ?>" alt="Foto do imóvel" class="img-fluid rounded">
                        </div>
                    <?php 
                    } 
                    foreach($imovei->foto_imoveis ?? [] as $foto) { ?>
                        <div class="col-3 mb-3">
                            <img src="<?= $this->Url->build('/img/imoveis/' . $foto->arquivo) ?>" alt="Foto do imóvel" class="img-fluid rounded">
                            <?php if ($foto->principal) { ?>
                                <span class="badge bg-primary mt-1">Principal</span>
                            <?php } else { ?>
                                <?= $this->Form->postLink(
                                    'Principal',
                                    ['controller' => 'Imoveis', 'action' => 'setPrincipal', $foto->id],
                                    [
                                        'class' => 'badge bg-primary-transparent mt-1 text-decoration-none',
                                        'escape' => false,
                                    ]
                                ) ?>
                            <?php } ?>
                            <?= $this->Form->postLink(
                                '<i class="ri-delete-bin-2-line"></i>',
                                ['controller' => 'Imoveis', 'action' => 'deleteFoto', $foto->id],
                                [
                                    'class' => 'badge bg-danger-transparent mt-1 text-decoration-none',
                                    'escape' => false,
                                    'confirm' => __('Excluir esta foto não terá volta, deseja continuar?'),
                                ]
                            ) ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="card-footer text-center d-flex gap-2 flex-wrap justify-content-center">
                <button type="button" class="btn btn-primary btn-w-lg me-2" data-bs-toggle="modal" data-bs-target="#modalAdicionarFoto">
                    <i class="ri-image-add-fill"></i> Adicionar Foto
                </button>
            </div>
        </div>
    </div>
    <div class="col-xxl-7">
        <div class="card custom-card">
            <div class="card-body">
                <div>
                    <p class="fs-20 fw-semibold mb-3"><?= $imovei->titulo ?></p>
                    <p class="fs-16 mb-2">
                        <?php
                        if($imovei->votos == 0 || $imovei->nota == 0) {
                            $texto = 'Sem avaliações';
                            $nota = 0;
                        } else {
                            $nota = number_format($imovei->nota / $imovei->votos, 1, ',', '.');
                            $texto = $nota . ' (' . $imovei->votos . ' Reviews)';
                        }
                        for($str = 1; $str <= 5; $str++) {
                            if($str <= floor($nota)) {
                                echo '<i class="ri ri-star-fill text-warning"></i>';
                            } elseif($str == ceil($nota) && floor($nota) != ceil($nota)) {
                                echo '<i class="ri ri-star-half-fill text-warning"></i>';
                            } else {
                                echo '<i class="ri ri-star-line text-warning"></i>';
                            }
                        }
                        ?>
                        <span class="fw-medium ms-1 fs-13 text-muted"><?= $texto ?></span>
                    </p>
                    <div class="d-flex gap-3 align-items-center mb-3 flex-wrap">
                        <p class="mb-1"><span class="h2 fw-semibold">R$ <?= number_format($imovei->valor, 2, ',', '.') ?></span></p>
                        <div class="mb-0 text-muted fs-12">
                            <p class="mb-0 text-info fw-medium fs-15">
                                <?= ($imovei->corretor_opcionista ? 'Você é opcionista' : '') ?>
                            </p>                            
                            <p class="mb-0 text-info fw-medium fs-15">
                                <?= ($imovei->exclusividade && ($imovei->fim_exclusividade >= date('Y-m-d')) ? 'Você é corretor exclusivo até ' . date('d/m/Y', strtotime($imovei->fim_exclusividade)) : '') ?>
                            </p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p class="fs-15 fw-semibold mb-1">Chamada (lead) :</p>
                        <p class="text-muted mb-0 fs-13">
                            <?= $imovei->chamada ?>
                        </p>
                        <p class="fs-15 fw-semibold mt-3 mb-1">Descrição :</p>
                        <p class="text-muted mb-0 fs-13">
                            <?= $imovei->descricao ?>
                        </p>
                        <p class="fs-15 fw-semibold mt-3 mb-1">Proprietário :</p>
                        <p class="text-muted mb-0 fs-13">
                            <span class="fw-bold fs-15"><?= $imovei->pessoa->nome ?></span>
                            <small class="d-block"><?= $imovei->pessoa->email ?></small>
                            <small class="d-block"><?= $imovei->pessoa->telefone ?></small>
                        </p>
                    </div>
                    <div class="d-flex gap-1 align-items-center mb-3 justify-content-between flex-wrap">
                        <div class="btn btn-info my-1 me-2" style="border:none;background-color: #af9c74 !important">
                            Vagas garagem <span class="badge ms-2 bg-warning"><?= $imovei->vaga_garagem ?></span>
                        </div>
                        <div class="btn btn-info my-1 me-2" style="border:none;background-color: #af9c74 !important">
                            Banheiros <span class="badge ms-2 bg-warning"><?= $imovei->banheiros ?></span>
                        </div>
                        <div class="btn btn-info my-1 me-2" style="border:none;background-color: #af9c74 !important">
                            Quartos <span class="badge ms-2 bg-warning"><?= $imovei->quartos ?></span>
                        </div>
                        <div class="btn btn-info my-1 me-2" style="border:none;background-color: #af9c74 !important">
                            Área (m²) <span class="badge ms-2 bg-warning"><?= $imovei->tamanho ?></span>
                        </div>
                        <div class="btn btn-info my-1 me-2" style="border:none;background-color: #af9c74 !important">
                            Notifications <span class="badge ms-2 bg-warning">32</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAdicionarFoto" tabindex="-1" aria-labelledby="modalAdicionarFotoLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <?= $this->Form->create(null, [
                'url' => ['controller' => 'Imoveis', 'action' => 'fotos', $imovei->id],
                'type' => 'file',
            ]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdicionarFotoLabel">Adicionar foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="fotos" class="form-label">Foto</label>
                    <input type="file" name="fotos[]" id="fotos" class="form-control" accept="image/*" multiple required>
                    <div class="form-text">Você pode selecionar uma ou mais fotos.</div>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="principal" value="1" id="principal" class="form-check-input">
                    <label for="principal" class="form-check-label">Definir como foto principal</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar foto</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
