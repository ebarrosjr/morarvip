<?php
use Cake\Utility\Text;

$corretorSlug = strtolower(Text::slug($corretor->nome));
?>
<?php $this->assign('hasFilterDrawer', '1'); ?>
<?= $this->Html->css('listagem') ?>
<?= $this->element('property_results', [
    'imoveis' => $imoveis,
    'headerContent' => $this->element('broker_profile_card', ['corretor' => $corretor]),
]) ?>
<?= $this->element('property_filters', [
    'tipoimoveis' => $tipoimoveis,
    'filtros' => $filtros,
    'filterActionUrl' => $this->Url->build([
        'controller' => 'Index',
        'action' => 'corretor',
        'id' => (int)$corretor->id,
        'name' => $corretorSlug,
    ]),
]) ?>
