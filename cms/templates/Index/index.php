<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">CRM</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">CRM</li>
        </ol>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div class="d-flex gap-2">
        </div>
    </div>
</div>
<!-- div class="row mb-4">
    <div class="col-md-6"><div class="bg-primary p-2">BANNER #1 - FINANCIAMENTO</div></div>
    <div class="col-md-6"><div class="bg-secondary p-2">BANNER #2 - CONSULTORIA IMOBILIÁRIO</div></div>
</div -->
<div class="row">
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card custom-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-1">
                    <div>
                        <p class="mb-0">Imóveis Cadastrados</p>
                    </div>
                    <div class="main-card-icon">
                        <div class="avatar avatar-sm bg-primary border border-primary border-opacity-10">
                            <i class="ri-building-line"></i>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-3 fw-semibold"><?= $this->Number->format($imoveisCadastrados ?? 0) ?></h5>
                        <span class="text-muted d-inline-block fs-12">No seu escopo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card custom-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-1">
                    <div>
                        <p class="mb-0">Pessoas cadastradas</p>
                    </div>
                    <div class="main-card-icon">
                        <div class="avatar avatar-sm bg-secondary border border-secondary border-opacity-10">
                            <i class="ri-group-line"></i>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-3 fw-semibold"><?= $this->Number->format($pessoasCadastradas ?? 0) ?></h5>
                        <span class="text-muted d-inline-block fs-12">Proprietários dos seus imóveis</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card custom-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-1">
                    <div>
                        <p class="mb-0">Visitas agendadas no mês</p>
                    </div>
                    <div class="main-card-icon">
                        <div class="avatar avatar-sm bg-success border border-success border-opacity-10">
                            <i class="ri-bar-chart-line"></i>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-3 fw-semibold"><?= $this->Number->format($visitasAgendadasMes ?? 0) ?></h5>
                        <span class="text-muted d-inline-block fs-12">Atendimentos com interesse no mês</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
        <div class="card custom-card">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-1">
                    <div>
                        <p class="mb-0">Atendimentos pendentes</p>
                    </div>
                    <div class="main-card-icon">
                        <div class="avatar avatar-sm bg-pink border border-pink border-opacity-10">
                            <i class="ri-thumb-up-line"></i>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 align-items-center justify-content-between">
                    <div>
                        <h5 class="mb-3 fw-semibold"><?= $this->Number->format($atendimentosPendentes ?? 0) ?></h5>
                        <span class="text-muted d-inline-block fs-12">Sem conversão concluída</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xxl-9">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Média qualitativa dos atendimentos
                </div>
                <div class="dropdown"> 
                    <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown" aria-expanded="true"> Sort By <i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i> </a> 
                    <ul class="dropdown-menu"> 
                        <li><a class="dropdown-item" href="javascript:void(0);">This Week</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Last Week</a></li> 
                        <li><a class="dropdown-item" href="javascript:void(0);">This Month</a></li> 
                    </ul> 
                </div>
            </div>
            <div class="card-body"></div>
        </div>
    </div>
    <div class="col-xxl-3">
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Imóveis por bairro
                </div>
                <a href="javascript:void(0);" class="fs-12 text-muted"> View All<i class="ti ti-arrow-narrow-right ms-1"></i> </a>
            </div> 
            <div class="card-body p-0">
                <ul class="list-group list-group-flush active-customers-list">
                    <?php if (!empty($imoveisPorBairro)): ?>
                        <?php foreach ($imoveisPorBairro as $bairro): ?>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <div class="fw-medium"><?= h($bairro['bairro']) ?></div>
                                    <div><span class="fw-medium">(<?= $this->Number->format($bairro['total']) ?>)</span></div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-muted">
                            Não há dados de bairro cadastrados para os imóveis.
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>                    
