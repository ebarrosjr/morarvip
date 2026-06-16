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
            $filterActionUrl = $filterActionUrl ?? $this->Url->build('/');
            ?>
            <form class="widget property-filter-card" method="get" action="<?= h($filterActionUrl) ?>">
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

                <?php foreach (['quartos' => 'Quartos', 'banheiros' => 'Banheiros', 'vagas' => 'Vagas'] as $campo => $label): ?>
                    <div class="property-filter-section">
                        <h4 class="property-filter-title"><?= h($label) ?></h4>
                        <div class="property-filter-options">
                            <?php foreach ([1, 2, 3, 4] as $valor): ?>
                                <label class="property-filter-pill">
                                    <input type="radio" name="<?= h($campo) ?>" value="<?= $valor ?>" <?= (int)($filtros[$campo] ?? 0) === $valor ? 'checked' : '' ?>>
                                    <span><?= $valor ?>+</span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

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
                    <a class="property-filter-clear" href="<?= h($filterActionUrl) ?>">Limpar</a>
                    <button class="property-filter-submit" type="submit">Buscar imóveis</button>
                </div>
            </form>
        </div>
    </aside>
</div>
