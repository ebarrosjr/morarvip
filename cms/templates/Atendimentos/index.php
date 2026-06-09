<?php
$conversao = [
    'N' => 'Negativa', 
    'P' => 'Positiva', 
    'X' => 'Sem contato', 
    'O' => 'Neutra'
];
?>
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Atendimentos realizados</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"> 
                Atendimentos    
            </li>
        </ol>
    </div>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div class="d-flex gap-2">
            <div class="position-relative">
                <a href="<?= $this->Url->build(['controller' => 'Atendimentos', 'action' => 'atender']) ?>" class="btn btn-success btn-wave waves-effect waves-light" data-ajax-modal>
                    <i class="ri-chat-forward-line"></i> Atender o próximo
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row datatables-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive table-striped table-condensed">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id') ?></th>
                            <th><?= $this->Paginator->sort('nome') ?></th>
                            <th><?= $this->Paginator->sort('nascimento') ?></th>
                            <th><?= $this->Paginator->sort('sexo') ?></th>
                            <th>Localidade</th>
                            <th>Contato</th>
                            <th>Nota</th>
                            <th>Percepção</th>
                            <th class="actions"><?= __('Ações') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pessoas as $pessoa): ?>
                        <tr>
                            <td><?= str_pad($pessoa->id, 5, '0', STR_PAD_LEFT) ?></td>
                            <td><?= h($pessoa->nome) ?></td>
                            <td><?= $this->Idade->calcular($pessoa->nascimento) ?></td>
                            <td><?= h($pessoa->sexo) ?></td>
                            <td><?= h($pessoa->bairro ?: 'Não informado') ?></td>
                            <td><?=$pessoa->atendimentos[0]->created->i18nFormat("dd/MM/YYYY");?></td>
                            <td style="font-weight:bold;color:<?=($pessoa->atendimentos[0]->nota < 5 ? 'red' : ($pessoa->atendimentos[0]->nota < 8 ? 'orange' : 'green'));?>"><?=$pessoa->atendimentos[0]->nota;?></td>
                            <td><?=$conversao[$pessoa->atendimentos[0]->conversao];?></td>
                            <td class="actions">
                                <div class="btn-list">
                                    <a aria-label="anchor" href="<?= $this->Url->build(['action' => 'view', $pessoa->id])?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View" class="btn btn-sm btn-icon btn-primary-light"><i class="ti ti-eye"></i></a>
                                </div>                    
                            </td>                            
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
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
</div>
