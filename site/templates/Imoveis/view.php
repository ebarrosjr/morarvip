<?php
$fotos = [];
foreach ($imovei->foto_imoveis ?? [] as $foto) {
    if (!empty($foto->arquivo)) {
        $fotos[] = IMAGE_BASE_URL . '/' . $foto->arquivo;
    }
}
if (!$fotos) {
    $fotos[] = $this->Url->build('/img/no-imovel-photo.png');
}
$localizacao = implode(', ', array_filter([
    $imovei->chamada,
    $imovei->bairro ?? null,
    $imovei->cidade ?? null,
    $imovei->uf ?? null,
]));
?>
<div class="col-12">
    <div class="ltn__myaccount-tab-content-inner">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <div>
                <h2><?= h($imovei->titulo ?: 'Imóvel #' . $imovei->id) ?></h2>
                <?php if ($localizacao): ?>
                    <p class="mb-0"><i class="icon-placeholder"></i> <?= h($localizacao) ?></p>
                <?php endif; ?>
            </div>
            <a class="btn theme-btn-1 btn-effect-1" href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard', '#' => 'ltn_tab_1_5']) ?>">Voltar</a>
        </div>

        <div class="row">
            <div class="col-lg-5">
                <div class="row">
                    <?php foreach ($fotos as $fotoUrl): ?>
                        <div class="col-6 mb-3">
                            <img class="img-fluid rounded" src="<?= h($fotoUrl) ?>" alt="<?= h($imovei->titulo ?: 'Imóvel') ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-7">
                <h4>Resumo</h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Tipo</th>
                            <td><?= h($imovei->tipo_imovei->nome ?? 'Imóvel') ?></td>
                        </tr>
                        <tr>
                            <th>Categoria</th>
                            <td><?= h($imovei->categoria->nome ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Valor</th>
                            <td><?= $imovei->valor ? 'R$ ' . number_format((float)$imovei->valor, 2, ',', '.') : '-' ?></td>
                        </tr>
                        <tr>
                            <th>Área</th>
                            <td><?= (int)$imovei->tamanho ?> m²</td>
                        </tr>
                        <tr>
                            <th>Quartos / Banheiros / Vagas</th>
                            <td><?= (int)$imovei->quartos ?> / <?= (int)$imovei->banheiros ?> / <?= (int)$imovei->vaga_garagem ?></td>
                        </tr>
                        <tr>
                            <th>Situação</th>
                            <td><?= (int)$imovei->show_site === 1 ? 'Publicado' : 'Em análise' ?></td>
                        </tr>
                    </tbody>
                </table>

                <h4>Descrição</h4>
                <p><?= nl2br(h($imovei->descricao ?: 'Descrição não informada.')) ?></p>

                <div class="btn-wrapper">
                    <a class="btn btn-outline-secondary js-auth-modal" href="<?= $this->Url->build(['controller' => 'Imoveis', 'action' => 'edit', $imovei->id]) ?>">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <?= $this->Form->postLink(
                        '<i class="fas fa-trash"></i> Remover',
                        ['controller' => 'Imoveis', 'action' => 'delete', $imovei->id],
                        [
                            'class' => 'btn btn-outline-danger',
                            'escape' => false,
                            'confirm' => 'Remover este imóvel? Esta ação não poderá ser desfeita.',
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>
