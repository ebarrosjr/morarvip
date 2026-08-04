<div class="col-lg-8">
    <?= $headerContent ?? '' ?>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="liton_product_grid">
            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                <div class="property-list-summary">
                    <?= count($imoveis) ?> imóveis encontrados
                </div>
                <?php if (count($imoveis) === 0): ?>
                    <div class="property-empty-state">
                        Nenhum imóvel encontrado para os filtros selecionados.
                    </div>
                <?php endif; ?>
                <?php foreach ($imoveis as $imovel): ?>
                    <?= $this->element('property_card', [
                        'imovel' => $imovel,
                        'carouselId' => 'propertyPhotos' . (int)$imovel->id,
                    ]) ?>
                <?php endforeach; ?>
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
