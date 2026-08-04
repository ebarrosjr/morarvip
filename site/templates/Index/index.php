<?php $this->assign('hasFilterDrawer', '1'); ?>
<?= $this->Html->css('listagem') ?>
<?= $this->element('property_results', [
    'imoveis' => $imoveis,
    'headerContent' => '<div class="advertinsig"><span>PUBLICIDADE</span><img src="https://imagens.morar.vip/main/images/financiar_202606161700.png" alt="Publicidade"></div>',
]) ?>
<?= $this->element('property_filters', [
    'tipoimoveis' => $tipoimoveis,
    'cidades' => $cidades,
    'bairros' => $bairros,
    'filtros' => $filtros,
    'filterActionUrl' => $this->Url->build('/'),
]) ?>
