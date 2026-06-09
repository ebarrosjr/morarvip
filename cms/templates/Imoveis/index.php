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
                <a href="<?= $this->Url->build(['controller' => 'Imoveis', 'action' => 'add']) ?>" class="btn btn-success btn-wave waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Adicionar cliente" aria-describedby="tooltip968276" aria-expanded="false">
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
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('titulo') ?></th>
                    <th><?= $this->Paginator->sort('tipo_imovel_id') ?></th>
                    <th><?= $this->Paginator->sort('negocio') ?></th>
                    <th><?= $this->Paginator->sort('categoria_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('situacao') ?></th>
                    <th><?= $this->Paginator->sort('valor') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
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
                <td><?= $imovei->created->i18nFormat("dd/MM/YYYY H:s") ?></td>
                <td><?= h($situacao[$imovei->situacao]) ?></td>
                <td>R$ <?= $imovei->valor === null ? '' : number_format($imovei->valor, 2, ',', '.') ?></td>
                <td class="actions">
                    <div class="btn-list">
                        <a aria-label="anchor" href="<?= $this->Url->build(['action' => 'view', $imovei->id])?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" class="btn btn-sm btn-icon btn-primary-light"><i class="ti ti-eye"></i></a>
                        <a aria-label="anchor" href="<?= $this->Url->build(['action' => 'edit', $imovei->id])?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" class="btn btn-sm btn-icon btn-success-light"><i class="ti ti-pencil"></i></a>
                        <a aria-label="anchor" href="<?= $this->Url->build([])?>" ></a>
                        <?= $this->Form->postLink(
                            '<i class="ti ti-trash"></i>',
                            ['action' => 'delete', $imovei->id],
                            [
                                "data-bs-toggle" => "tooltip",
                                "data-bs-placement" => "top", 
                                "data-bs-title" => "Delete",
                                "class" => "btn btn-sm btn-icon btn-danger-light",
                                "method" => 'delete',
                                "confirm" => __('Excluir o imóvel # {0} não terá volta, deseja continuar?', $imovei->id),
                                "escape" => false
                            ]
                        ) ?>
                    </div>                    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
    <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
</div>