<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">CRM</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"> Pessoas </li>
            <li class="breadcrumb-item active" aria-current="page">Corretores</li>
        </ol>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div class="d-flex gap-2">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th scope="col">Matrícula</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Contato</th>
                        <th scope="col">Corretora</th>
                        <th scope="col">GeoPreferência</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data</th>
                        <th scope="col" class="actions">Ações</th>
                    </tr>
                </thead>                
                <tbody>
                    <?php
                    foreach($users as $user) {
                    ?>
                    <tr>
                        <td>
                            <span class=""><?= $user->id ?></span>
                        </td>
                        <td>
                            <div class="d-flex">
                                <div class="flex-1 ms-2">
                                    <span class="d-block fw-semibold lh-1"><?= $user->nome ?></span>
                                    <a href="javascript:void(0);" class="text-muted fs-12"><?= $user->email ?></a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class=""><?= $user->telefone ?></span>
                        </td>
                        <td>
                            <span class=""><?= $user->corretora ?? 'Não informada' ?></span>
                        </td>
                        <td>
                            <span><i class="ri-map-pin-fill text-muted me-1"></i>Bairro ou CEP?</span>
                        </td>
                        <td>
                            <span class="badge bg-<?= $user->activation_date ? 'success' : 'danger' ?>-transparent">
                                <?= $user->activation_date ? 'Ativo' : 'Inativo' ?>
                            </span>
                        </td>
                        <td>
                            <span><?= $user->created->format('d/m/Y') ?></span>
                        </td>
                        <td class="actions">
                            <div class="btn-list">
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" class="btn btn-sm btn-icon btn-primary-light"><i class="ti ti-eye"></i></a>
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" class="btn btn-sm btn-icon btn-success-light"><i class="ti ti-pencil"></i></a>
                                <a aria-label="anchor" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" class="btn btn-sm btn-icon  btn-danger-light"><i class="ti ti-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>