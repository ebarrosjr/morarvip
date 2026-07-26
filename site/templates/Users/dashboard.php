<?php
use Cake\Utility\Text;

$userProperties = $userProperties ?? [];
$profileUser = $profileUser ?? $this->request->getAttribute('identity');
$profileFallbackPhoto = $this->Url->build('/img/no-photo.png');
$profilePhoto = trim((string)($profileUser->foto ?? ''));
if ($profilePhoto === '') {
    $profilePhoto = $profileFallbackPhoto;
} elseif (str_starts_with($profilePhoto, '//')) {
    $profilePhoto = 'https:' . $profilePhoto;
} elseif (!preg_match('#^https?://#i', $profilePhoto) && !str_starts_with($profilePhoto, '/')) {
    $profilePhoto = IMAGE_BASE_URL . '/' . ltrim($profilePhoto, '/');
}
$profileLocation = implode(', ', array_filter([
    $profileUser->cep ?? null,
    $profileUser->numero ?? null,
    $profileUser->complemento ?? null,
]));
?>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="ltn__tab-menu-list mb-50">
                <div class="nav">                                            
                    <a class="active show" data-bs-toggle="tab" href="#ltn_tab_1_1">Dashboard <i class="fas fa-home"></i></a>
                    <a data-bs-toggle="tab" href="#ltn_tab_1_2">Profiles <i class="fas fa-user"></i></a>
                    <a data-bs-toggle="tab" href="#ltn_tab_1_5">Meus imóveis <i class="fa-solid fa-list"></i></a>
                    <a data-bs-toggle="tab" href="#ltn_tab_1_6">Imóveis que me interessam <i class="fa-solid fa-heart"></i></a>
                    <a href="/users/logout" class="text-danger">Sair <i class="fas fa-sign-out-alt"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="ltn_tab_1_1">
                    <div class="ltn__myaccount-tab-content-inner">
                        <p>Olá <strong><?= $this->request->getAttribute('identity')->get('nome') ?></strong> (não é você? <small><a href="/users/logout">Sair</a></small> )</p>
                    </div>
                </div>
                <div class="tab-pane fade" id="ltn_tab_1_2">
                    <div class="ltn__myaccount-tab-content-inner">
                        <!-- profile-area -->
                        <div class="ltn__comment-area mb-50">
                            <div class="ltn-author-introducing clearfix">
                                <div class="author-img">
                                    <img
                                        src="<?= h($profilePhoto) ?>"
                                        alt="<?= h($profileUser->nome ?? 'Usuário') ?>"
                                        referrerpolicy="no-referrer"
                                        onerror="this.onerror=null;this.src='<?= h($profileFallbackPhoto) ?>';"
                                    >
                                </div>
                                <div class="author-info">
                                    <h6>Minha conta</h6>
                                    <h2><?= h($profileUser->nome ?? 'Usuário') ?></h2>
                                    <div class="footer-address">
                                        <ul>
                                            <?php if ($profileLocation): ?>
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-placeholder"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p><?= h($profileLocation) ?></p>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                            <?php if (!empty($profileUser->telefone) || !empty($profileUser->whatsapp)): ?>
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-call"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p>
                                                        <a href="tel:<?= h(preg_replace('/\D+/', '', (string)($profileUser->telefone ?: $profileUser->whatsapp))) ?>">
                                                            <?= h($profileUser->telefone ?: $profileUser->whatsapp) ?>
                                                        </a>
                                                    </p>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                            <?php if (!empty($profileUser->email)): ?>
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-mail"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p><a href="mailto:<?= h($profileUser->email) ?>"><?= h($profileUser->email) ?></a></p>
                                                </div>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="ltn__form-box contact-form-box box-shadow white-bg">
                                <h4 class="title-2">Editar meus dados</h4>
                                <?= $this->Form->create($profileUser, ['url' => ['controller' => 'Users', 'action' => 'dashboard']]) ?>
                                    <?= $this->Form->hidden('_profile_form', ['value' => 1]) ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <?= $this->Form->text('nome', ['placeholder' => 'Nome completo', 'required' => true]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-email ltn__custom-icon">
                                                <?= $this->Form->email('email', ['placeholder' => 'E-mail', 'required' => true]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-subject ltn__custom-icon">
                                                <?= $this->Form->text('cpf', ['placeholder' => 'CPF']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-date ltn__custom-icon">
                                                <?= $this->Form->date('nascimento', ['placeholder' => 'Nascimento']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-item-phone ltn__custom-icon">
                                                <?= $this->Form->text('telefone', ['placeholder' => 'Telefone']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-item-phone ltn__custom-icon">
                                                <?= $this->Form->text('whatsapp', ['placeholder' => 'WhatsApp']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-item-subject ltn__custom-icon">
                                                <?= $this->Form->select('sexo', ['N' => 'Não informado', 'F' => 'Feminino', 'M' => 'Masculino'], ['empty' => false]) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-item-website ltn__custom-icon">
                                                <?= $this->Form->text('cep', ['placeholder' => 'CEP']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-item-subject ltn__custom-icon">
                                                <?= $this->Form->text('numero', ['placeholder' => 'Número']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-item-subject ltn__custom-icon">
                                                <?= $this->Form->text('complemento', ['placeholder' => 'Complemento']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-item-website ltn__custom-icon">
                                                <?= $this->Form->text('telegram', ['placeholder' => 'Telegram']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-item-website ltn__custom-icon">
                                                <?= $this->Form->text('instagram', ['placeholder' => 'Instagram']) ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-item input-item-website ltn__custom-icon">
                                                <?= $this->Form->text('facebook', ['placeholder' => 'Facebook']) ?>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <label class="input-info-save mb-0">
                                            <?= $this->Form->checkbox('propaganda') ?> Aceito receber comunicações do Morar.VIP
                                        </label>
                                    </p>
                                    <p>
                                        <label class="input-info-save mb-0">
                                            <?= $this->Form->checkbox('share_data') ?> Autorizo o compartilhamento dos meus dados para atendimento imobiliário
                                        </label>
                                    </p>
                                    <div class="btn-wrapper mt-0">
                                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Salvar dados</button>
                                    </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="ltn_tab_1_5">
                    <div class="ltn__myaccount-tab-content-inner">
                        <!-- properties-area -->
                        <div class="ltn__my-properties-table table-responsive">
                            <a class="js-auth-modal btn btn-sm btn-secondary" href="/imoveis/add">Incluir novo imóvel</a>
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Meus imóveis</th>
                                    <th scope="col"></th>
                                    <th scope="col">Situação</th>
                                    <th scope="col">Cadastro</th>
                                    <th scope="col">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($userProperties as $imovel): ?>
                                        <?php
                                        $defaultFotoUrl = $this->Url->build('/img/no-imovel-photo.png');
                                        $fotoUrl = $defaultFotoUrl;
                                        $firstPhoto = null;
                                        foreach ($imovel->foto_imoveis ?? [] as $foto) {
                                            if (!empty($foto->arquivo)) {
                                                $firstPhoto ??= $foto;
                                                if ((int)($foto->principal ?? 0) === 1) {
                                                    $fotoUrl = IMAGE_BASE_URL . '/' . $foto->arquivo;
                                                    break;
                                                }
                                            }
                                        }
                                        if ($fotoUrl === $defaultFotoUrl && $firstPhoto) {
                                            $fotoUrl = IMAGE_BASE_URL . '/' . $firstPhoto->arquivo;
                                        }

                                        $slug = strtolower(Text::slug($imovel->titulo ?: 'imovel'));
                                        $detailUrl = $this->Url->build([
                                            'controller' => 'Index',
                                            'action' => 'detalheImovel',
                                            'id' => (int)$imovel->id,
                                            'slug' => $slug,
                                        ]);
                                        $localizacao = $imovel->chamada ?: implode(', ', array_filter([
                                            $imovel->bairro ?? null,
                                            $imovel->cidade ?? null,
                                            $imovel->uf ?? null,
                                        ]));
                                        $publicado = (int)($imovel->show_site ?? 0) === 1;
                                        ?>
                                        <tr>
                                            <td class="ltn__my-properties-img">
                                                <?php if ($publicado): ?>
                                                    <a href="<?= h($detailUrl) ?>"><img src="<?= h($fotoUrl) ?>" alt="<?= h($imovel->titulo ?: 'Imóvel') ?>"></a>
                                                <?php else: ?>
                                                    <img src="<?= h($fotoUrl) ?>" alt="<?= h($imovel->titulo ?: 'Imóvel') ?>">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="ltn__my-properties-info">
                                                    <h6 class="mb-10">
                                                        <?php if ($publicado): ?>
                                                            <a href="<?= h($detailUrl) ?>"><?= h($imovel->titulo ?: 'Imóvel #' . $imovel->id) ?></a>
                                                        <?php else: ?>
                                                            <?= h($imovel->titulo ?: 'Imóvel #' . $imovel->id) ?>
                                                        <?php endif; ?>
                                                    </h6>
                                                    <?php if ($localizacao): ?>
                                                        <small><i class="icon-placeholder"></i> <?= h($localizacao) ?></small>
                                                    <?php endif; ?>
                                                    <div class="product-ratting">
                                                        <small><?= h($imovel->tipo_imovei->nome ?? 'Imóvel') ?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= $publicado ? 'Publicado' : 'Não publicado' ?></td>
                                            <td><?= $imovel->created ? h($imovel->created->i18nFormat('dd/MM/yyyy')) : '-' ?></td>
                                            <td>
                                                <a class="me-2" href="<?= $this->Url->build(['controller' => 'Imoveis', 'action' => 'view', $imovel->id]) ?>" title="Visualizar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="me-2 js-auth-modal" href="<?= $this->Url->build(['controller' => 'Imoveis', 'action' => 'edit', $imovel->id]) ?>" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?= $this->Form->postLink(
                                                    '<i class="fas fa-trash"></i>',
                                                    ['controller' => 'Imoveis', 'action' => 'delete', $imovel->id],
                                                    [
                                                        'class' => 'text-danger',
                                                        'escape' => false,
                                                        'title' => 'Remover',
                                                        'confirm' => 'Remover este imóvel? Esta ação não poderá ser desfeita.',
                                                    ]
                                                ) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (empty($userProperties)): ?>
                                        <tr>
                                            <td colspan="5">Nenhum imóvel encontrado para sua conta.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="ltn_tab_1_6">
                    <div class="ltn__myaccount-tab-content-inner">
                        <!-- favorite-area -->
                        <div class="ltn__my-properties-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Imóveis favoritos</th>
                                        <th scope="col"></th>
                                        <th scope="col">Data</th>
                                        <th scope="col">Desfavoritar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4"><div class="text-center alert-info">Em breve</div></td>
                                    </tr>
                                    <!-- tr>
                                        <td class="ltn__my-properties-img">
                                            <a href="product-details.html"><img src="img/product-3/2.jpg" alt="#"></a>
                                        </td>
                                        <td>
                                            <div class="ltn__my-properties-info">
                                                <h6 class="mb-10"><a href="product-details.html">sdfasdfdsfsdafs</a></h6>
                                                <small><i class="icon-placeholder"></i> Brooklyn, New York, United States</small>
                                                <div class="product-ratting">
                                                    <ul>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                        <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                        <li><a href="#"><i class="far fa-star"></i></a></li>
                                                        <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Feb 22, 2022</td>
                                        <td><a href="#"><i class="fa-solid fa-trash-can"></i></a></td>
                                    </tr -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
