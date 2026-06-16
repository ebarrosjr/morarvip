<?php $this->assign('hasFilterDrawer', '1'); ?>
<?= $this->Html->css('listagem') ?>
<div class="col-lg-8">
    <div class="advertinsig">
        <span>PUBLICIDADE</span>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="liton_product_grid">
            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                <div class="property-list-summary">
                    <?= count($imoveis) ?> imóveis encontrados
                </div>
                <?php foreach ($imoveis as $imovel): ?>
                    <?php
                    $carouselId = 'propertyPhotos' . (int)$imovel->id;
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
                    $corretorNome = $imovel->user->nome ?? 'Corretor';
                    $corretorAvatar = $this->Url->build('/img/no-photo.png');
                    $localizacao = $imovel->chamada ?: 'Consulte a localização';
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
                            <div class="property-agent-overlay">
                                <img src="<?= h($corretorAvatar) ?>" alt="<?= h($corretorNome) ?>">
                                <span><?= h($corretorNome) ?></span>
                            </div>
                        </div>
                        <div class="property-result-info">
                            <div class="property-result-kicker">
                                <?= h($tipoNome) ?> para <?= h($negocioLabel) ?>
                            </div>
                            <h2 class="property-result-title"><?= h($imovel->titulo ?: $tipoNome) ?></h2>
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
                                <a class="property-details-btn" href="#">Mais detalhes</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="tab-pane fade" id="liton_product_list">
            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Search Widget -->
                        <div class="ltn__search-widget mb-30">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search your keyword...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/1.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/2.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/3.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/4.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/5.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
    <div class="ltn__pagination-area text-center">
        <div class="ltn__pagination">
            <ul>
                <?= $this->Paginator->prev('<i class="fas fa-angle-double-left"></i>', [
                    'escape' => false,
                    'templates' => [
                        'prevActive' => '<li><a rel="prev" href="{{url}}">{{text}}</a></li>',
                        'prevDisabled' => '<li class="disabled"><span>{{text}}</span></li>',
                    ],
                ]) ?>
                <?= $this->Paginator->numbers([
                    'modulus' => 4,
                    'templates' => [
                        'number' => '<li><a href="{{url}}">{{text}}</a></li>',
                        'current' => '<li class="active"><a href="">{{text}}</a></li>',
                        'ellipsis' => '<li><a href="">...</a></li>',
                    ],
                ]) ?>
                <?= $this->Paginator->next('<i class="fas fa-angle-double-right"></i>', [
                    'escape' => false,
                    'templates' => [
                        'nextActive' => '<li><a rel="next" href="{{url}}">{{text}}</a></li>',
                        'nextDisabled' => '<li class="disabled"><span>{{text}}</span></li>',
                    ],
                ]) ?>
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-4 property-filter-column">
    <aside id="ltn__utilize-filter-menu" class="sidebar ltn__shop-sidebar ltn__right-sidebar ltn__utilize property-filter-drawer">
        <div class="ltn__utilize-menu-inner ltn__scrollbar property-filter-drawer-inner">
            <div class="ltn__utilize-menu-head property-filter-drawer-head d-lg-none">
                <h4 class="ltn__utilize-menu-title">Filtros</h4>
                <button class="ltn__utilize-close">×</button>
            </div>
        <?php
        $filtros = $filtros ?? [];
        $negocioSelecionado = $filtros['negocio'] ?? 'V';
        $tiposSelecionados = array_map('intval', $filtros['tipo_imovel'] ?? []);
        $todosTiposSelecionados = empty($tiposSelecionados);
        ?>
        <form class="widget property-filter-card" method="get" action="<?= $this->Url->build('/') ?>">
            <?php if (!empty($filtros['q'])): ?>
                <input type="hidden" name="q" value="<?= h($filtros['q']) ?>">
            <?php endif; ?>
            <div class="property-filter-tabs">
                <?php foreach (['V' => 'Comprar', 'A' => 'Alugar', 'L' => 'Imóvel novo'] as $negocioValor => $negocioLabel): ?>
                    <label class="property-filter-tab <?= $negocioSelecionado === $negocioValor ? 'active' : '' ?>">
                        <input type="radio" name="negocio" value="<?= h($negocioValor) ?>" <?= $negocioSelecionado === $negocioValor ? 'checked' : '' ?>>
                        <span><?= h($negocioLabel) ?></span>
                    </label>
                <?php endforeach; ?>
            </div>

            <div class="property-filter-section">
                <h4 class="property-filter-title">Tipo de imóvel</h4>
                <ul class="property-filter-list">
                    <?php foreach ($tipoimoveis as $tipoimovel): ?>
                        <li>
                            <label for="imv-<?= (int)$tipoimovel->id ?>" class="property-filter-check">
                                <input
                                    type="checkbox"
                                    name="tipo_imovel[]"
                                    value="<?= (int)$tipoimovel->id ?>"
                                    id="imv-<?= (int)$tipoimovel->id ?>"
                                    <?= ($todosTiposSelecionados || in_array((int)$tipoimovel->id, $tiposSelecionados, true)) ? 'checked' : '' ?>
                                >
                                <span><?= h($tipoimovel->nome) ?></span>
                            </label>
                            <span class="property-filter-count"><?= (int)$tipoimovel->quantidade_imoveis ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="property-filter-section">
                <h4 class="property-filter-title">Quartos</h4>
                <div class="property-filter-options">
                    <?php foreach ([1, 2, 3, 4] as $quartos): ?>
                        <label class="property-filter-pill">
                            <input type="radio" name="quartos" value="<?= $quartos ?>" <?= (int)($filtros['quartos'] ?? 0) === $quartos ? 'checked' : '' ?>>
                            <span><?= $quartos ?>+</span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="property-filter-section">
                <h4 class="property-filter-title">Banheiros</h4>
                <div class="property-filter-options">
                    <?php foreach ([1, 2, 3, 4] as $banheiros): ?>
                        <label class="property-filter-pill">
                            <input type="radio" name="banheiros" value="<?= $banheiros ?>" <?= (int)($filtros['banheiros'] ?? 0) === $banheiros ? 'checked' : '' ?>>
                            <span><?= $banheiros ?>+</span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="property-filter-section">
                <h4 class="property-filter-title">Vagas</h4>
                <div class="property-filter-options">
                    <?php foreach ([1, 2, 3, 4] as $vagas): ?>
                        <label class="property-filter-pill">
                            <input type="radio" name="vagas" value="<?= $vagas ?>" <?= (int)($filtros['vagas'] ?? 0) === $vagas ? 'checked' : '' ?>>
                            <span><?= $vagas ?>+</span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="property-filter-section">
                <h4 class="property-filter-title">Preço</h4>
                <div class="property-price-fields">
                    <div class="property-price-field">
                        <label for="preco-minimo">Mínimo</label>
                        <div class="property-price-input">
                            <span>R$</span>
                            <input type="text" name="preco_minimo" id="preco-minimo" value="<?= h($filtros['preco_minimo'] ?? '') ?>" placeholder="0">
                        </div>
                    </div>
                    <div class="property-price-field">
                        <label for="preco-maximo">Máximo</label>
                        <div class="property-price-input">
                            <span>R$</span>
                            <input type="text" name="preco_maximo" id="preco-maximo" value="<?= h($filtros['preco_maximo'] ?? '') ?>" placeholder="0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="property-filter-actions">
                <a class="property-filter-clear" href="<?= $this->Url->build('/') ?>">Limpar</a>
                <button class="property-filter-submit" type="submit">Buscar imóveis</button>
            </div>
        </form>
        <!-- Category Widget -->
        <div class="widget ltn__menu-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
            <ul>
                <li><a href="#">Body <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Interior <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Lights <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Parts <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Tires <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Uncategorized <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Wheel <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
            </ul>
        </div>
        <!-- Price Filter Widget -->
        <div class="widget ltn__price-filter-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
            <div class="price_filter">
                <div class="price_slider_amount">
                    <input type="submit"  value="Your range:"/> 
                    <input type="text" class="amount" name="price"  placeholder="Add Your Price" /> 
                </div>
                <div class="slider-range"></div>
            </div>
        </div>
        <!-- Top Rated Product Widget -->
        <div class="widget ltn__top-rated-product-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
            <ul>
                <li>
                    <div class="top-rated-product-item clearfix">
                        <div class="top-rated-product-img">
                            <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                        </div>
                        <div class="top-rated-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h6><a href="product-details.html">Mixel Solid Seat Cover</a></h6>
                            <div class="product-price">
                                <span>$49.00</span>
                                <del>$65.00</del>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="top-rated-product-item clearfix">
                        <div class="top-rated-product-img">
                            <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                        </div>
                        <div class="top-rated-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h6><a href="product-details.html">3 Rooms Manhattan</a></h6>
                            <div class="product-price">
                                <span>$49.00</span>
                                <del>$65.00</del>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="top-rated-product-item clearfix">
                        <div class="top-rated-product-img">
                            <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                        </div>
                        <div class="top-rated-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h6><a href="product-details.html">Coil Spring Conversion</a></h6>
                            <div class="product-price">
                                <span>$49.00</span>
                                <del>$65.00</del>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Search Widget -->
        <div class="widget ltn__search-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Search Objects</h4>
            <form action="#">
                <input type="text" name="search" placeholder="Search your keyword...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <!-- Tagcloud Widget -->
        <div class="widget ltn__tagcloud-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Popular Tags</h4>
            <ul>
                <li><a href="#">Popular</a></li>
                <li><a href="#">desgin</a></li>
                <li><a href="#">ux</a></li>
                <li><a href="#">usability</a></li>
                <li><a href="#">develop</a></li>
                <li><a href="#">icon</a></li>
                <li><a href="#">Car</a></li>
                <li><a href="#">Service</a></li>
                <li><a href="#">Repairs</a></li>
                <li><a href="#">Auto Parts</a></li>
                <li><a href="#">Oil</a></li>
                <li><a href="#">Dealer</a></li>
                <li><a href="#">Oil Change</a></li>
                <li><a href="#">Body Color</a></li>
            </ul>
        </div>
        <!-- Size Widget -->
        <div class="widget ltn__tagcloud-widget ltn__size-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Product Size</h4>
            <ul>
                <li><a href="#">S</a></li>
                <li><a href="#">M</a></li>
                <li><a href="#">L</a></li>
                <li><a href="#">XL</a></li>
                <li><a href="#">XXL</a></li>
            </ul>
        </div>
        <!-- Color Widget -->
        <div class="widget ltn__color-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Product Color</h4>
            <ul>
                <li class="black"><a href="#"></a></li>
                <li class="white"><a href="#"></a></li>
                <li class="red"><a href="#"></a></li>
                <li class="silver"><a href="#"></a></li>
                <li class="gray"><a href="#"></a></li>
                <li class="maroon"><a href="#"></a></li>
                <li class="yellow"><a href="#"></a></li>
                <li class="olive"><a href="#"></a></li>
                <li class="lime"><a href="#"></a></li>
                <li class="green"><a href="#"></a></li>
                <li class="aqua"><a href="#"></a></li>
                <li class="teal"><a href="#"></a></li>
                <li class="blue"><a href="#"></a></li>
                <li class="navy"><a href="#"></a></li>
                <li class="fuchsia"><a href="#"></a></li>
                <li class="purple"><a href="#"></a></li>
                <li class="pink"><a href="#"></a></li>
                <li class="nude"><a href="#"></a></li>
                <li class="orange"><a href="#"></a></li>

                <li><a href="#" class="orange"></a></li>
                <li><a href="#" class="orange"></a></li>
            </ul>
        </div>
        <!-- Banner Widget -->
        <div class="widget ltn__banner-widget d-none">
            <a href="shop.html"><img src="img/banner/banner-2.jpg" alt="#"></a>
        </div>

        </div>
    </aside>
</div>
