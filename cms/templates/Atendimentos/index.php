<?php
$conversao = [
    'N' => 'Negativa', 
    'P' => 'Positiva', 
    'X' => 'Sem contato', 
    'O' => 'Neutra'
];
$pageTitle = $pageTitle ?? 'Atendimentos realizados';
$breadcrumbTitle = $breadcrumbTitle ?? 'Atendimentos';
$showNextButton = $showNextButton ?? true;
$rows = [];
if (isset($atendimentos)) {
    foreach ($atendimentos as $atendimento) {
        $rows[] = [
            'pessoa' => $atendimento->pessoa,
            'atendimento' => $atendimento,
        ];
    }
} else {
    foreach ($pessoas as $pessoa) {
        if (!empty($pessoa->atendimentos[0])) {
            $rows[] = [
                'pessoa' => $pessoa,
                'atendimento' => $pessoa->atendimentos[0],
            ];
        }
    }
}
?>
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2"><?= h($pageTitle) ?></h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item"> 
                <?= h($breadcrumbTitle) ?>
            </li>
        </ol>
    </div>
    <?php if ($showNextButton): ?>
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div class="d-flex gap-2">
            <div class="position-relative">
                <a href="<?= $this->Url->build(['controller' => 'Atendimentos', 'action' => 'atender']) ?>" class="btn btn-success btn-wave waves-effect waves-light" data-ajax-modal>
                    <i class="ri-chat-forward-line"></i> Atender o próximo
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<div class="row datatables-wrapper">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-responsive table-striped table-condensed">
                    <thead>
                        <tr>
                            <th><?= $this->Paginator->sort('id', 'Código') ?></th>
                            <th><?= $this->Paginator->sort('nome', 'Nome') ?></th>
                            <th><?= $this->Paginator->sort('nascimento', 'Idade') ?></th>
                            <th><?= $this->Paginator->sort('sexo', 'Sexo') ?></th>
                            <th>Localidade</th>
                            <th>Último Contato</th>
                            <th>Imóvel</th>
                            <th>Nota</th>
                            <th>Percepção</th>
                            <th class="actions"><?= __('Ações') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $row): ?>
                        <?php
                            $pessoa = $row['pessoa'];
                            $atendimento = $row['atendimento'];
                            $nota = $atendimento->nota;
                            $notaColor = $nota === null ? 'inherit' : ($nota < 5 ? 'red' : ($nota < 8 ? 'orange' : 'green'));
                        ?>
                        <tr>
                            <td><?= str_pad($pessoa->id, 5, '0', STR_PAD_LEFT) ?></td>
                            <td><?= h($pessoa->nome) ?></td>
                            <td><?= $this->Idade->calcular($pessoa->nascimento) ?></td>
                            <td><?= h($pessoa->sexo) ?></td>
                            <td><?= h($pessoa->bairro ?: 'Não informado') ?></td>
                            <td><?=$atendimento->created->i18nFormat("dd/MM/YYYY");?></td>
                            <td>
                                <?php if (!empty($atendimento->imovei)): ?>
                                    <?= h($atendimento->imovei->titulo ?: 'Imóvel #' . $atendimento->imovel_id) ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td style="font-weight:bold;color:<?= h($notaColor) ?>"><?= $nota ?? '-' ?></td>
                            <td><?=$conversao[$atendimento->conversao] ?? '-';?></td>
                            <td class="actions">
                                <div class="btn-list">
                                    <a aria-label="Visualizar" href="<?= $this->Url->build(['action' => 'view', $atendimento->id])?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Visualizar" class="btn btn-sm btn-icon btn-primary-light"><i class="ti ti-eye"></i></a>
                                </div>                    
                            </td>                            
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12">
        <?= $this->element('pagination') ?>
    </div>
</div>
