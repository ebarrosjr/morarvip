<div class="container-fluid">
    <!-- Page Header -->
    <div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div>
            <h1 class="page-title fw-medium fs-18 mb-2">Timeline</h1>
            <div class="">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Timeline</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <div class="d-flex gap-2">
                <div class="position-relative">
                    <button class="btn btn-primary btn-wave waves-effect waves-light" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        Filter By <i class="ri-arrow-down-s-fill ms-1"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
                        <li><a class="dropdown-item" href="javascript:void(0);">Today</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Yesterday</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Last 7 Days</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Last 30 Days</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Last 6 Months</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Last Year</a></li>
                    </ul>
                </div>
                <button class="btn btn-secondary btn-icon btn-wave waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download">
                    <i class="ti ti-download"></i>
                </button>
                <button class="btn btn-success btn-icon btn-wave waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Share">
                    <i class="ti ti-share-3"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <ul class="notification">
                <?php
                    $canais = [
                        "T" => "Telefone",
                        "W" => "WhatsApp",
                        "E" => "E-mail",
                        "O" => "Outros"
                    ];

                    $classificacoes = [
                        "N" => "Negativa",
                        "P" => "Positiva",
                        "X" => "Não contactado",
                        "O" => "Neutro"
                    ];

                foreach($atendimentos as $atendimento):
                ?>
                <li>
                    <div class="notification-time">
                    <span class="date"><?= $atendimento->created->format('d/m/Y') ?></span>
                    <span class="time"><?= $atendimento->created->format('H:i') ?></span>
                    </div>
                    <div class="notification-icon">
                    <a href="javascript:void(0);"></a>
                    </div>
                    <div class="notification-body">
                        <div class="d-flex align-items-start gap-3 flex-wrap">
                            <div>
                                <span class="avatar avatar-lg">
                                    <img src="<?= $atendimento->pessoa->foto ?? '/img/no-photo.png' ?>" alt="">
                                </span>
                            </div>
                            <div class="flex-fill w-50">
                                <h5 class="mb-1 fs-15 fw-medium text-dark"><?= $atendimento->pessoa->nome ?></h5>
                                <p class="mb-0 mb-0 text-info">Media: <?= $canais[$atendimento->canal] ?></p>
                                <?php
                                if($atendimento->interesse) {
                                ?>
                                <p class="mb-0 mb-0 text-success">
                                    Pessoa interessada no imóvel <a href="<?= $this->Url->build(['controller' => 'Imoveis', 'action' => 'view', $atendimento->imovel_id]) ?>" target="_blank"><?= $atendimento->imovei->titulo ?></a>
                                </p>
                                <?php
                                }
                                ?>
                                <p class="mb-0 mb-0 text-muted"><?= $atendimento->descricao ?></p>
                                <p class="mt-3">Classificação: <?= $classificacoes[$atendimento->conversao] ?></p>
                            </div>
                            <div>
                                <span class="badge bg-secondary-transparent">
                                    Avaliação: <?= number_format($atendimento->nota, 2, ',', '.') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
    </div>
</div>