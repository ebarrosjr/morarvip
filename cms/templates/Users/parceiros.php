<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Parcerias em imóveis</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"> Pessoas </li>
            <li class="breadcrumb-item active" aria-current="page">Parceiros</li>
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
                        <th scope="col">Imóvel</th>
                        <th scope="col">Porcentagem</th>
                        <th scope="col">Inicio</th>
                        <th scope="col">Fim</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="actions">Ações</th>
                    </tr>
                </thead>                
                <tbody>
                    <?php
                    foreach($parcerias as $parceria) {
                        $user = $parceria->parceiro;
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
                            <span class=""><?= h($parceria->imovei->titulo ?? 'Imóvel não informado') ?></span>
                        </td>
                        <td>
                            <span class=""><?= $parceria->porcentagem_parceiro ?? 'Não informada' ?></span>
                        </td>
                        <td>
                            <span><?= $parceria->inicio_parceria ? $parceria->inicio_parceria->format('d/m/Y') : 'Não informada' ?></span>
                        </td>
                        <td>
                            <span><?= $parceria->fim_parceria ? $parceria->fim_parceria->format('d/m/Y') : 'Não informada' ?></span>
                        </td>
                        <td>
                            <span><?= $parceria->situacao ?? 'Não informada' ?></span>
                        </td>
                        <td class="actions">
                            <div class="btn-list">
                                <a aria-label="anchor" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" class="btn btn-sm btn-icon btn-primary-light"><i class="ti ti-eye"></i></a>
                                <a aria-label="anchor" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" class="btn btn-sm btn-icon btn-success-light"><i class="ti ti-pencil"></i></a>
                                <a aria-label="anchor" href="#" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" class="btn btn-sm btn-icon  btn-danger-light"><i class="ti ti-trash"></i></a>
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
