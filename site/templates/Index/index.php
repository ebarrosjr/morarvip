<?php $this->assign('hasFilterDrawer', '1'); ?>
<?= $this->Html->css('listagem') ?>
<?= $this->element('property_results', [
    'imoveis' => $imoveis,
    'headerContent' => '<div class="advertinsig"><span>PUBLICIDADE</span></div>',
]) ?>
<?= $this->element('property_filters', [
    'tipoimoveis' => $tipoimoveis,
    'filtros' => $filtros,
    'filterActionUrl' => $this->Url->build('/'),
]) ?>
