<?php
use Cake\Utility\Text;

$userProperties = $userProperties ?? [];
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
                                    <img src="img/blog/author.jpg" alt="Author Image">
                                </div>
                                <div class="author-info">
                                    <h6>Agent of Property</h6>
                                    <h2>Rosalina D. William</h2>
                                    <div class="footer-address">
                                        <ul>
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-placeholder"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p>Brooklyn, New York, United States</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-call"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p><a href="tel:+0123-456789">+0123-456789</a></p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="footer-address-icon">
                                                    <i class="icon-mail"></i>
                                                </div>
                                                <div class="footer-address-info">
                                                    <p><a href="mailto:example@example.com">example@example.com</a></p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="ltn__form-box contact-form-box box-shadow white-bg">
                                <h4 class="title-2">Get A Quote</h4>
                                <form id="contact-form" action="mail.php" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" name="name" placeholder="Enter your name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-email ltn__custom-icon">
                                                <input type="email" name="email" placeholder="Enter email address">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item">
                                                <select class="nice-select" style="display: none;">
                                                    <option>Select Service Type</option>
                                                    <option>Property Management </option>
                                                    <option>Mortgage Service </option>
                                                    <option>Consulting Service</option>
                                                    <option>Home Buying</option>
                                                    <option>Home Selling</option>
                                                    <option>Escrow Services</option>
                                                </select><div class="nice-select" tabindex="0"><span class="current">Select Service Type</span><ul class="list"><li data-value="Select Service Type" class="option selected">Select Service Type</li><li data-value="Property Management" class="option">Property Management </li><li data-value="Mortgage Service" class="option">Mortgage Service </li><li data-value="Consulting Service" class="option">Consulting Service</li><li data-value="Home Buying" class="option">Home Buying</li><li data-value="Home Selling" class="option">Home Selling</li><li data-value="Escrow Services" class="option">Escrow Services</li></ul></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-phone ltn__custom-icon">
                                                <input type="text" name="phone" placeholder="Enter phone number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-item input-item-textarea ltn__custom-icon">
                                        <textarea name="message" placeholder="Enter message"></textarea>
                                    </div>
                                    <p><label class="input-info-save mb-0"><input type="checkbox" name="agree"> Save my name, email, and website in this browser for the next time I comment.</label></p>
                                    <div class="btn-wrapper mt-0">
                                        <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">get a free service</button>
                                    </div>
                                    <p class="form-messege mb-0 mt-20"></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="ltn_tab_1_5">
                    <div class="ltn__myaccount-tab-content-inner">
                        <!-- properties-area -->
                        <div class="ltn__my-properties-table table-responsive">
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
                                                <?php if ($publicado): ?>
                                                    <a href="<?= h($detailUrl) ?>">Ver detalhes</a>
                                                <?php else: ?>
                                                    <span>-</span>
                                                <?php endif; ?>
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
                                    <th scope="col">Top Property</th>
                                    <th scope="col"></th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
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
                                    <td><a href="#">Edit</a></td>
                                    <td><a href="#"><i class="fa-solid fa-trash-can"></i></a></td>
                                    </tr>
                                    <tr>
                                    <td class="ltn__my-properties-img">
                                        <a href="product-details.html"><img src="img/product-3/3.jpg" alt="#"></a>
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
                                    <td><a href="#">Edit</a></td>
                                    <td><a href="#"><i class="fa-solid fa-trash-can"></i></a></td>
                                    </tr>
                                    <tr>
                                    <td class="ltn__my-properties-img">
                                        <a href="product-details.html"><img src="img/product-3/7.jpg" alt="#"></a>
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
                                    <td><a href="#">Edit</a></td>
                                    <td><a href="#"><i class="fa-solid fa-trash-can"></i></a></td>
                                    </tr>
                                </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
