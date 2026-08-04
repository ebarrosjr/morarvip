<?php
/**
 * @var \App\View\AppView $this
 */
$this->Paginator->setTemplates([
    'first' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'last' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active" aria-current="page"><span class="page-link">{{text}}</span></li>',
    'prevActive' => '<li class="page-item"><a class="page-link" rel="prev" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>',
    'nextActive' => '<li class="page-item"><a class="page-link" rel="next" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>',
    'ellipsis' => '<li class="page-item disabled"><span class="page-link">...</span></li>',
]);
?>
<div class="d-flex align-items-center justify-content-between flex-wrap gap-3 p-3 pagination-style-1">
    <p class="mb-0 text-muted fs-12">
        <?= $this->Paginator->counter('Página {{page}} de {{pages}}, exibindo {{current}} registro(s) de {{count}} no total') ?>
    </p>
    <nav aria-label="Paginação da listagem">
        <ul class="pagination mb-0">
            <?= $this->Paginator->first('Primeira') ?>
            <?= $this->Paginator->prev('Anterior') ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('Próxima') ?>
            <?= $this->Paginator->last('Última') ?>
        </ul>
    </nav>
</div>
