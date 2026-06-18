<pre>
    Você está logado como: <?= $this->request->getAttribute('identity')->get('nome') ?>
    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Sair</a>
<?php
// var_dump($this->request->getAttribute('identity'));
?>
</pre>