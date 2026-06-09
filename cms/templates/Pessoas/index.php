<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Listagem de clientes</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"> Pessoas </li>
            <li class="breadcrumb-item active" aria-current="page">Clientes</li>
        </ol>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div class="d-flex gap-2">
            <div class="position-relative">
                <a href="<?= $this->Url->build(['controller' => 'Pessoas', 'action' => 'add']) ?>" class="btn btn-success btn-wave waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Adicionar cliente" aria-describedby="tooltip968276" aria-expanded="false">
                    <i class="ri-user-add-line d-inline"></i> Adicionar cliente
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
                    <th>Nome</th>
                    <th>Sexo</th>
                    <th>Bairro</th>
                    <th>Origem</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $origem = [
                    'C' => 'Cadastro Manual', 
                    'S' => 'Site', 
                    'A' => 'App', 
                    'T' => 'TeleAtendimento', 
                    'W' => 'WhatsApp'
                ];

                $sexo = [
                    'M' => 'Masculino',
                    'F' => 'Feminino',
                    'N' => '<i class="text-danger">Não informado</i>'
                ];
                foreach ($pessoas as $pessoa) : ?>
                    <tr>
                        <td><?= h($pessoa->nome) ?></td>
                        <td><?= $sexo[$pessoa->sexo] ?></td>
                        <td><?= ($pessoa->bairro ?? '<i class="text-danger">Não informado</i>') ?></td>
                        <td><?= h($origem[$pessoa->origem]) ?></td>
                        <td><?= h($pessoa->created->format('d/m/Y H:i')) ?></td>
                        <td class="actions">
                            <div class="btn-list">
                                <?= $this->Html->link('<i class="ri-discuss-line"></i>', ['controller' => 'Atendimentos', 'action' => 'atender', $pessoa->id], [
                                    'class' => 'btn btn-sm btn-secondary-light btn-xs',
                                    'data-ajax-modal' => true,
                                    'escape' => false
                                ]) ?>
                                <a aria-label="anchor" href="<?= $this->Url->build(['action' => 'view', $pessoa->id])?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" class="btn btn-sm btn-icon btn-primary-light"><i class="ti ti-eye"></i></a>
                                <a aria-label="anchor" href="<?= $this->Url->build(['action' => 'edit', $pessoa->id])?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit" class="btn btn-sm btn-icon btn-success-light"><i class="ti ti-pencil"></i></a>
                                <a aria-label="anchor" href="<?= $this->Url->build([])?>" ></a>
                                <?= $this->Form->postLink(
                                    '<i class="ti ti-trash"></i>',
                                    ['action' => 'delete', $pessoa->id],
                                    [
                                        "data-bs-toggle" => "tooltip",
                                        "data-bs-placement" => "top", 
                                        "data-bs-title" => "Delete",
                                        "class" => "btn btn-sm btn-icon btn-danger-light",
                                        "method" => 'delete',
                                        "confirm" => __('Excluir o imóvel # {0} não terá volta, deseja continuar?', $pessoa->id),
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
