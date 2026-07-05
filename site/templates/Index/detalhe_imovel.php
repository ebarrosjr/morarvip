<?php
use Cake\Utility\Text;

echo $this->Html->css('property-detail');

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

$tipoNome = $imovel->tipo_imovei->nome ?? 'Imóvel';
$corretor = $imovel->user;
$corretorAvatar = !empty($corretor->logo) ? IMAGE_BASE_URL . '/' . $corretor->logo : $this->Url->build('/img/no-photo.png');
$corretorSlug = !empty($corretor->nome) ? strtolower(Text::slug($corretor->nome)) : null;
$corretorUrl = (!empty($corretor->id) && $corretorSlug)
    ? $this->Url->build(['controller' => 'Index', 'action' => 'corretor', 'id' => (int)$corretor->id, 'name' => $corretorSlug])
    : '#';
$preco = $imovel->show_preco_site ? 'R$ ' . number_format((float)$imovel->valor, 2, ',', '.') : 'Consulte o valor';
switch ($imovel->situacao) {
    case 'V':
        $status = 'Vendido';
        break;
    case 'A':
        $status = 'Alugado';
        break;
    case 'S':
        $status = 'Suspenso';
        break;
    default:
        $status = 'Disponível';
}
switch ($imovel->negocio) {
    case 'A':
        $negocio = 'Aluguel';
        break;
    case 'L':
        $negocio = 'Lançamento';
        break;
    default:
        $negocio = 'Venda';
}
$localizacao = $imovel->bairro . ' - ' . ($imovel->cidade ?? '') . ' - ' . ($imovel->uf ?? '');
?>
<div class="col-lg-12">
    <div class="property-detail-page">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div id="propertyDetailGallery" class="carousel slide property-detail-gallery" data-bs-ride="false">
                    <div class="carousel-inner">
                        <?php foreach ($fotos as $index => $fotoUrl): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <img src="<?= h($fotoUrl) ?>" alt="<?= h($imovel->titulo ?: 'Foto do imóvel') ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (count($fotos) > 1): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#propertyDetailGallery" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#propertyDetailGallery" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Próxima</span>
                        </button>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-12">
                        <section class="property-detail-section">
                            <h1><?= h($imovel->titulo ?: $tipoNome) ?>
                            <small><?= h($negocio) ?></small>
                            </h1>
                            <p class="property-detail-location"><i class="flaticon-pin"></i> <?= h($localizacao ?: 'Localização sob consulta') ?></p>
                            <div class="property-description">
                                <i class="flaticon-quote"></i> <?= nl2br(h($imovel->chamada)) ?>
                            </div>
                            <div class="property-description">
                                <?= nl2br(h($imovel->descricao ?: 'Descrição em breve. Entre em contato com o corretor para mais informações sobre este imóvel.')) ?>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row property-detail-main">
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-3 align-items-center property-detail-features">
                            <div><i class="flaticon-measure"></i> <?= (int)$imovel->tamanho ?> m²</div>
                            <div><i class="flaticon-bed"></i> <?= (int)$imovel->quartos ?></div>
                            <div><i class="flaticon-bathtub"></i> <?= (int)$imovel->banheiros ?></div>
                            <div><i class="flaticon-car"></i> <?= (int)$imovel->vaga_garagem ?></div>
                        </div>
                    </div>
                </div>

                <section class="property-agent-contact property-detail-section">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="property-agent-card">
                                <img src="<?= h($corretorAvatar) ?>" alt="<?= h($corretor->nome ?? 'Corretor') ?>">
                                <div>
                                    <h2><?= h($corretor->nome ?? 'Corretor') ?></h2>
                                    <p>Entre em contato para tirar dúvidas, agendar uma visita ou receber mais detalhes deste imóvel.</p>
                                    <ul>
                                        <?php if (!empty($corretor->telefone)): ?>
                                            <li><strong>Telefone:</strong> <a href="tel:<?= h(preg_replace('/\D+/', '', $corretor->telefone)) ?>"><?= h($corretor->telefone) ?></a></li>
                                        <?php endif; ?>
                                        <?php if (!empty($corretor->whatsapp)): ?>
                                            <li><strong>WhatsApp:</strong> <a href="https://wa.me/<?= h(preg_replace('/\D+/', '', $corretor->whatsapp)) ?>"><?= h($corretor->whatsapp) ?></a></li>
                                        <?php endif; ?>
                                        <?php if (!empty($corretor->email)): ?>
                                            <li><strong>E-mail:</strong> <a href="mailto:<?= h($corretor->email) ?>"><?= h($corretor->email) ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                    <a class="property-agent-profile-link" href="<?= h($corretorUrl) ?>">Ver perfil <i class="fas fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <?= $this->Form->create(null, [
                                'class' => 'property-contact-form',
                                'url' => ['controller' => 'Atendimentos', 'action' => 'interesse'],
                            ]) ?>
                            <?= $this->Flash->render('property_contact') ?>
                            <?= $this->Form->hidden('imovel_id', ['value' => $imovel->id]) ?>
                            <label>Seu nome*</label>
                            <input type="text" name="nome">
                            <label>Seu e-mail*</label>
                            <input type="email" name="email">
                                <label>Sua mensagem*</label>
                                <textarea name="mensagem" rows="4"></textarea>
                                <button type="submit">Enviar mensagem</button>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </section>

                <section class="property-detail-section">
                    <h2>Imóveis similares</h2>
                    <div class="row">
                        <?php foreach ($imoveisSimilares as $similar): ?>
                            <?php
                            $similarFoto = $this->Url->build('/img/no-imovel-photo.png');
                            foreach ($similar->foto_imoveis ?? [] as $foto) {
                                if (!empty($foto->arquivo)) {
                                    $similarFoto = IMAGE_BASE_URL . '/' . $foto->arquivo;
                                    break;
                                }
                            }
                            $similarSlug = strtolower(Text::slug($similar->titulo ?: 'imovel'));
                            $similarUrl = $this->Url->build(['controller' => 'Index', 'action' => 'detalheImovel', 'id' => (int)$similar->id, 'slug' => $similarSlug]);
                            ?>
                            <div class="col-md-4">
                                <a class="similar-property-card" href="<?= h($similarUrl) ?>">
                                    <img src="<?= h($similarFoto) ?>" alt="<?= h($similar->titulo ?: 'Imóvel similar') ?>">
                                    <span><?= $similar->show_preco_site ? 'R$ ' . number_format((float)$similar->valor, 2, ',', '.') : 'Consulte' ?></span>
                                    <strong><?= h($similar->titulo ?: 'Imóvel') ?></strong>
                                    <small><?= h($similar->chamada ?: ($similar->tipo_imovei->nome ?? 'Imóvel')) ?></small>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>

            <div class="col-xl-3 col-lg-4">
                <aside class="property-detail-sidebar">
                    <section>
                        <h2>Imóveis deste corretor</h2>
                        <?php foreach ($imoveisCorretor as $item): ?>
                            <?php
                            $itemFoto = $this->Url->build('/img/no-imovel-photo.png');
                            foreach ($item->foto_imoveis ?? [] as $foto) {
                                if (!empty($foto->arquivo)) {
                                    $itemFoto = IMAGE_BASE_URL . '/' . $foto->arquivo;
                                    break;
                                }
                            }
                            $itemSlug = strtolower(Text::slug($item->titulo ?: 'imovel'));
                            $itemUrl = $this->Url->build(['controller' => 'Index', 'action' => 'detalheImovel', 'id' => (int)$item->id, 'slug' => $itemSlug]);
                            ?>
                            <a class="broker-property-mini" href="<?= h($itemUrl) ?>">
                                <img src="<?= h($itemFoto) ?>" alt="<?= h($item->titulo ?: 'Imóvel') ?>">
                                <span>
                                    <strong><?= h($item->titulo ?: 'Imóvel') ?></strong>
                                    <small><?= h($item->chamada ?: ($item->tipo_imovei->nome ?? 'Imóvel')) ?></small>
                                    <em><?= $item->show_preco_site ? 'R$ ' . number_format((float)$item->valor, 2, ',', '.') : 'Consulte' ?></em>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </section>

                    <section>
                        <h2>Guias</h2>
                        <a class="property-guide-link" href="#"><i class="fas fa-home"></i> Simule seu financiamento <i class="fas fa-angle-right"></i></a>
                        <a class="property-guide-link" href="#"><i class="fas fa-umbrella"></i> Precisa de ajuda? <i class="fas fa-angle-right"></i></a>
                    </section>
                </aside>
            </div>
        </div>
    </div>
</div>
