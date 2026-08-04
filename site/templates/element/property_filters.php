<div class="col-lg-4 property-filter-column">
    <aside id="ltn__utilize-filter-menu" class="sidebar ltn__shop-sidebar ltn__right-sidebar ltn__utilize property-filter-drawer">
        <div class="ltn__utilize-menu-inner ltn__scrollbar property-filter-drawer-inner">
            <div class="ltn__utilize-menu-head property-filter-drawer-head d-lg-none">
                <h4 class="ltn__utilize-menu-title">Filtros</h4>
                <button class="ltn__utilize-close">×</button>
            </div>
            <?php
            $filtros = $filtros ?? [];
            $cidades = $cidades ?? [];
            $bairros = $bairros ?? [];
            $cidadeSelecionada = $filtros['cidade'] ?? '';
            $bairroSelecionado = $filtros['bairro'] ?? '';
            $corretorId = $corretorId ?? null;
            $negocioSelecionado = $filtros['negocio'] ?? 'V';
            $tiposSelecionados = array_map('intval', $filtros['tipo_imovel'] ?? []);
            $todosTiposSelecionados = empty($tiposSelecionados);
            $filterActionUrl = $filterActionUrl ?? $this->Url->build('/');
            $bairrosEndpoint = $this->Url->build(['controller' => 'Index', 'action' => 'bairrosPorCidade']);
            ?>
            <form class="widget property-filter-card" method="get" action="<?= h($filterActionUrl) ?>">
                <?php if (!empty($filtros['q'])): ?>
                    <input type="hidden" name="q" value="<?= h($filtros['q']) ?>">
                <?php endif; ?>
                <div class="property-filter-tabs">
                    <?php foreach (['V' => 'Comprar', 'L' => 'Alugar'] as $negocioValor => $negocioLabel): ?>
                        <label class="property-filter-tab <?= $negocioSelecionado === $negocioValor ? 'active' : '' ?>">
                            <input type="radio" name="negocio" value="<?= h($negocioValor) ?>" <?= $negocioSelecionado === $negocioValor ? 'checked' : '' ?>>
                            <span><?= h($negocioLabel) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="property-filter-section">
                    <div class="property-filter-select-fields">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="property-filter-select-field">
                                    <label for="property-filter-cidade">Cidade</label>
                                    <select
                                        name="cidade"
                                        id="property-filter-cidade"
                                        data-property-city-select
                                        data-bairros-endpoint="<?= h($bairrosEndpoint) ?>"
                                        data-corretor-id="<?= h((string)($corretorId ?? '')) ?>"
                                    >
                                        <option value="">Todas as cidades</option>
                                        <?php foreach ($cidades as $cidade): ?>
                                            <option value="<?= h($cidade) ?>" <?= $cidadeSelecionada === $cidade ? 'selected' : '' ?>>
                                                <?= h($cidade) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="property-filter-select-field">
                                    <label for="property-filter-bairro">Bairro</label>
                                    <select
                                        name="bairro"
                                        id="property-filter-bairro"
                                        data-property-neighborhood-select
                                        data-selected-bairro="<?= h($bairroSelecionado) ?>"
                                        <?= $cidadeSelecionada === '' ? 'disabled' : '' ?>
                                    >
                                        <option value="">Todos os bairros</option>
                                        <?php foreach ($bairros as $bairro): ?>
                                            <option value="<?= h($bairro) ?>" <?= $bairroSelecionado === $bairro ? 'selected' : '' ?>>
                                                <?= h($bairro) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <span><?= $valor . ($valor == 4 ? '+' : '') ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="property-filter-section">
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
<?php $this->append('script'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.property-filter-card').forEach(function (form) {
        const citySelect = form.querySelector('[data-property-city-select]');
        const neighborhoodSelect = form.querySelector('[data-property-neighborhood-select]');

        if (!citySelect || !neighborhoodSelect || citySelect.dataset.filtersReady === '1') {
            return;
        }

        citySelect.dataset.filtersReady = '1';

        function refreshSelect(select) {
            if (window.jQuery && window.jQuery.fn && window.jQuery.fn.niceSelect) {
                window.jQuery(select).niceSelect('update');
            }
        }

        function bindChange(element, handler) {
            if (window.jQuery) {
                window.jQuery(element).off('change.propertyFilters').on('change.propertyFilters', handler);
                return;
            }

            element.addEventListener('change', handler);
        }

        function getSelectedBusinessType() {
            const selected = form.querySelector('input[name="negocio"]:checked');
            return selected ? selected.value : '';
        }

        function resetNeighborhood(label, disabled = true) {
            neighborhoodSelect.innerHTML = '';
            const option = document.createElement('option');
            option.value = '';
            option.textContent = label;
            neighborhoodSelect.appendChild(option);
            neighborhoodSelect.disabled = disabled;
            refreshSelect(neighborhoodSelect);
        }

        function fillNeighborhoods(neighborhoods, selectedNeighborhood = '') {
            resetNeighborhood('Todos os bairros', false);

            neighborhoods.forEach(function (neighborhood) {
                const option = document.createElement('option');
                option.value = neighborhood;
                option.textContent = neighborhood;
                option.selected = neighborhood === selectedNeighborhood;
                neighborhoodSelect.appendChild(option);
            });

            refreshSelect(neighborhoodSelect);
        }

        async function loadNeighborhoods(selectedNeighborhood = '') {
            const city = citySelect.value;

            if (!city) {
                resetNeighborhood('Todos os bairros');
                return;
            }

            resetNeighborhood('Carregando bairros...', true);

            const url = new URL(citySelect.dataset.bairrosEndpoint, window.location.origin);
            url.searchParams.set('cidade', city);

            if (citySelect.dataset.corretorId) {
                url.searchParams.set('corretor_id', citySelect.dataset.corretorId);
            }

            const negocio = getSelectedBusinessType();
            if (negocio) {
                url.searchParams.set('negocio', negocio);
            }

            try {
                const response = await fetch(url.toString(), {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                });
                const data = await response.json();
                fillNeighborhoods(Array.isArray(data.bairros) ? data.bairros : [], selectedNeighborhood);
            } catch (error) {
                resetNeighborhood('Não foi possível carregar os bairros');
            }
        }

        bindChange(citySelect, function () {
            neighborhoodSelect.dataset.selectedBairro = '';
            loadNeighborhoods();
        });

        form.querySelectorAll('input[name="negocio"]').forEach(function (input) {
            bindChange(input, function () {
                if (citySelect.value) {
                    neighborhoodSelect.dataset.selectedBairro = '';
                    loadNeighborhoods();
                }
            });
        });
    });
});
</script>
<?php $this->end(); ?>
