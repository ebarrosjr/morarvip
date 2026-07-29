<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Listagem de Imóveis</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"> 
                Imóveis
            </li>
            <li class="breadcrumb-item active" aria-current="page">Listagem</li>
        </ol>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div class="d-flex gap-2">
            <div class="position-relative">
                <a href="<?= $this->Url->build(['controller' => 'Imoveis', 'action' => 'add']) ?>" class="btn btn-success btn-wave waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Adicionar imóvel" aria-describedby="tooltip968276" aria-expanded="false">
                    <i class="ri-user-add-line d-inline"></i> Adicionar imóvel
                </a>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body p-0">
        <table class="table table-responsive table-striped table-condensed">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'Código') ?></th>
                    <th><?= $this->Paginator->sort('titulo', 'Título') ?></th>
                    <th><?= $this->Paginator->sort('tipo_imovel_id', 'Tipo') ?></th>
                    <th><?= $this->Paginator->sort('negocio', 'Negócio') ?></th>
                    <th><?= $this->Paginator->sort('categoria_id', 'Categoria') ?></th>
                    <th><?= $this->Paginator->sort('bairro', 'Bairro') ?></th>
                    <th><?= $this->Paginator->sort('created', 'Cadastro') ?></th>
                    <th><?= $this->Paginator->sort('situacao', 'Situação') ?></th>
                    <th><?= $this->Paginator->sort('valor', 'Valor') ?></th>
                    <th class="actions"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody>
        <?php
        $situacao = ['D' => 'Disponível', 'V' => 'Vendido', 'A' => 'Alugado', 'S' => 'Suspenso']; 
        $negocio = ['V' => 'Venda', 'L' => 'Aluguel', 'A' => 'Arrendamento'];
        foreach ($imoveis as $imovei): ?>
            <tr>
                <td><?= $this->Number->format($imovei->id) ?></td>
                <td><?= h($imovei->titulo) ?></td>
                <td><?= $imovei->tipo_imovel_id === null ? '' : $imovei->tipo_imovei->nome ?></td>
                <td><?= h($negocio[$imovei->negocio]) ?></td>
                <td><?= $imovei->hasValue('categoria') ? $this->Html->link($imovei->categoria->nome, ['controller' => 'Categorias', 'action' => 'view', $imovei->categoria->id]) : '' ?></td>
                <td><?= $imovei->bairro ?></td>
                <td><?= $imovei->created->i18nFormat("dd/MM/YYYY H:s") ?></td>
                <td><?= h($situacao[$imovei->situacao]) ?></td>
                <td>R$ <?= $imovei->valor === null ? '' : number_format($imovei->valor, 2, ',', '.') ?></td>
                <td class="actions">
                    <div class="btn-list">
                        <a aria-label="Visualizar" href="<?= $this->Url->build(['action' => 'view', $imovei->id])?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Visualizar" class="btn btn-sm btn-icon btn-primary-light"><i class="ti ti-eye"></i></a>
                        <?php if ((int)$imovei->user_id === (int)$userId): ?>
                            <a aria-label="Editar" href="<?= $this->Url->build(['action' => 'edit', $imovei->id])?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Editar" class="btn btn-sm btn-icon btn-success-light"><i class="ti ti-pencil"></i></a>
                            <?= $this->Form->postLink(
                                '<i class="ti ti-trash"></i>',
                                ['action' => 'delete', $imovei->id],
                                [
                                    "data-bs-toggle" => "tooltip",
                                    "data-bs-placement" => "top", 
                                    "data-bs-title" => "Excluir",
                                    "class" => "btn btn-sm btn-icon btn-danger-light",
                                    "method" => 'delete',
                                    "confirm" => __('Excluir o imóvel # {0} não terá volta, deseja continuar?', $imovei->id),
                                    "escape" => false
                                ]
                            ) ?>
                        <?php endif; ?>
                    </div>                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
<?= $this->element('pagination') ?>
