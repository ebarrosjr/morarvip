<?php
use Cake\Utility\Text;

$carouselId = $carouselId ?? 'propertyPhotos' . (int)$imovel->id;
$fotos = [];
foreach ($imovel->foto_imoveis ?? [] as $foto) {
    if (!empty($foto->arquivo)) {
        $fotos[] = IMAGE_BASE_URL . '/' . $foto->arquivo;
    }
}
if (!$fotos && !empty($imovel->foto_principal)) {
    $fotos[] = IMAGE_BASE_URL . '/' . $imovel->foto_principal;
}
if (!$fotos) {
    $fotos[] = $this->Url->build('/img/no-imovel-photo.png');
}

$negocioLabel = match ($imovel->negocio) {
    'A' => 'alugar',
    'L' => 'lançamento',
    default => 'comprar',
};
$tipoNome = $imovel->tipo_imovei->nome ?? 'Imóvel';
$corretor = $imovel->user ?? null;
$corretorNome = $corretor->nome ?? 'Corretor';
$corretorAvatar = !empty($corretor?->logo) ? IMAGE_BASE_URL . '/' . $corretor->logo : $this->Url->build('/img/no-photo.png');
$corretorSlug = $corretor?->nome ? strtolower(Text::slug($corretor->nome)) : null;
$corretorUrl = ($corretor?->id && $corretorSlug)
    ? $this->Url->build([
        'controller' => 'Index',
        'action' => 'corretor',
        'id' => (int)$corretor->id,
        'name' => $corretorSlug,
    ])
    : '#';
$imovelSlug = strtolower(Text::slug($imovel->titulo ?: 'imovel'));
$imovelUrl = $this->Url->build([
    'controller' => 'Index',
    'action' => 'detalheImovel',
    'id' => (int)$imovel->id,
    'slug' => $imovelSlug,
]);
$localizacao = $imovel->bairro ? $imovel->bairro . ', ' . $imovel->cidade . ' - ' . $imovel->uf : 'Consulte a localização';
?>
<div class="property-result-card">
    <div class="property-result-media">
        <span class="property-featured-badge"><?= h($imovel->negocio === 'L' ? 'Imóvel novo' : ucfirst($negocioLabel)) ?></span>
        <div id="<?= h($carouselId) ?>" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                <?php foreach ($fotos as $index => $fotoUrl): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <img class="property-photo" src="<?= h($fotoUrl) ?>" alt="<?= h($imovel->titulo ?: 'Foto do imóvel') ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (count($fotos) > 1): ?>
                <button class="carousel-control-prev" type="button" data-bs-target="#<?= h($carouselId) ?>" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#<?= h($carouselId) ?>" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próxima</span>
                </button>
            <?php endif; ?>
        </div>
        <a class="property-agent-overlay" href="<?= h($corretorUrl) ?>">
            <img src="<?= h($corretorAvatar) ?>" alt="<?= h($corretorNome) ?>">
            <span><?= h($corretorNome) ?></span>
        </a>
    </div>
    <div class="property-result-info">
        <div class="property-result-kicker">
            <?= h($tipoNome) ?> para <?= h($negocioLabel) ?>
        </div>
        <h2 class="property-result-title">
            <a href="<?= h($imovelUrl) ?>"><?= h($imovel->titulo ?: $tipoNome) ?></a>
        </h2>
        <div class="property-result-address">
            <i class="flaticon-pin"></i> <?= h($localizacao) ?>
        </div>
        <div class="property-result-features">
            <span class="property-result-feature">
                <i class="flaticon-measure"></i> <?= (int)$imovel->tamanho ?> m<sup>2</sup>
            </span>
            <span class="property-result-feature">
                <i class="flaticon-bed"></i> <?= (int)$imovel->quartos ?>
            </span>
            <span class="property-result-feature">
                <i class="flaticon-bathtub"></i> <?= (int)$imovel->banheiros ?>
            </span>
            <span class="property-result-feature">
                <i class="flaticon-car"></i> <?= (int)$imovel->vaga_garagem ?>
            </span>
        </div>
        <div class="property-result-bottom">
            <div>
                <div class="property-result-price">
                    <?= $imovel->show_preco_site ? 'R$ ' . number_format((float)$imovel->valor, 2, ',', '.') : 'Consulte o valor' ?>
                </div>
                <?php if (!empty($imovel->iptu)): ?>
                    <div class="property-result-meta">IPTU R$ <?= number_format((float)$imovel->iptu, 2, ',', '.') ?></div>
                <?php endif; ?>
            </div>
            <a class="property-details-btn" href="<?= h($imovelUrl) ?>">Mais detalhes</a>
        </div>
    </div>
</div>
