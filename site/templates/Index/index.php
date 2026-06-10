<div class="col-lg-8">
    <div class="tab-content">
        <div class="tab-pane fade active show" id="liton_product_grid">
            <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                <div class="row">
                    <?php foreach ($imoveis as $imovel): ?>
                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5 text-center---">
                            <div class="product-img">
                                <a href="product-details.html">
                                    <img
                                        src="<?= $this->Url->build('/img/imoveis/' . $imovel->foto_principal) ?>"
                                        alt="<?= h($imovel->titulo) ?>"
                                    >
                                </a>
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="<?= $this->Url->build('/img/no-photo.png') ?>" alt="#"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-info">
                                <div class="product-badge">
                                    <ul>
                                        <li class="sale-badg"><?= $imovel->negocio ?></li>
                                    </ul>
                                </div>
                                <h2 class="product-title">
                                    <a href="#"><?= $imovel->titulo ?></a>
                                </h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span><?= $imovel->quartos ?> </span>
                                        Quartos
                                    </li>
                                    <li><span><?= $imovel->banheiros ?> </span>
                                        Banheiros
                                    </li>
                                    <li><span><?= $imovel->tamanho ?>m<sup>2</sup> </span>
                                        Terreno
                                    </li>
                                    <li><span> ??? </span>
                                        Área
                                    </li>
                                </ul>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-info-bottom">
                                <div class="product-price">
                                    <span><strong>R$ </strong> <?= number_format($imovel->valor, 2, ',', '.') ?> <label></label></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="liton_product_list">
            <div class="ltn__product-tab-content-inner ltn__product-list-view">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Search Widget -->
                        <div class="ltn__search-widget mb-30">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search your keyword...">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/1.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/2.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/3.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/4.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ltn__product-item -->
                    <div class="col-lg-12">
                        <div class="ltn__product-item ltn__product-item-4 ltn__product-item-5">
                            <div class="product-img">
                                <a href="product-details.html"><img src="img/product-3/5.jpg" alt="#"></a>
                            </div>
                            <div class="product-info">
                                <div class="product-badge-price">
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badg">For Rent</li>
                                        </ul>
                                    </div>
                                    <div class="product-price">
                                        <span>$34,900<label>/Month</label></span>
                                    </div>
                                </div>
                                <h2 class="product-title"><a href="product-details.html">New Apartment Nice View</a></h2>
                                <div class="product-img-location">
                                    <ul>
                                        <li>
                                            <a href="locations.html"><i class="flaticon-pin"></i> Belmont Gardens, Chicago</a>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="ltn__list-item-2--- ltn__list-item-2-before--- ltn__plot-brief">
                                    <li><span>3 </span>
                                        Bed
                                    </li>
                                    <li><span>2 </span>
                                        Bath
                                    </li>
                                    <li><span>3450 </span>
                                        Square Ft
                                    </li>
                                </ul>
                            </div>
                            <div class="product-info-bottom">
                                <div class="real-estate-agent">
                                    <div class="agent-img">
                                        <a href="team-details.html"><img src="img/blog/author.jpg" alt="#"></a>
                                    </div>
                                    <div class="agent-brief">
                                        <h6><a href="team-details.html">William Seklo</a></h6>
                                        <small>Estate Agents</small>
                                    </div>
                                </div>
                                <div class="product-hover-action">
                                    <ul>
                                        <li>
                                            <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                <i class="flaticon-expand"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                <i class="flaticon-heart-1"></i></a>
                                        </li>
                                        <li>
                                            <a href="product-details.html" title="Product Details">
                                                <i class="flaticon-add"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
    <div class="ltn__pagination-area text-center">
        <div class="ltn__pagination">
            <ul>
                <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                <li><a href="#">1</a></li>
                <li class="active"><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">...</a></li>
                <li><a href="#">10</a></li>
                <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
        <div class="widget ltn__menu-widget">
            <h4 class="ltn__widget-title">Property Type</h4>
            <ul>
                <li>
                    <a href="shop-right-sidebar.html">
                        <label class="checkbox-item">House
                            <input type="checkbox" checked="checked">
                            <span class="checkmark"></span>
                        </label>
                        <span class="categorey-no">3,924</span>
                    </a>
                </li>
                <li>
                    <label class="checkbox-item">Single Family
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">3,610</span>
                </li>
                <li>
                    <label class="checkbox-item">Apartment
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">2,912</span>
                </li>
                <li>
                    <label class="checkbox-item">Office Villa
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">2,687</span>
                </li>
                <li>
                    <label class="checkbox-item">Luxary Home
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">1,853</span>
                </li>
                <li>
                    <label class="checkbox-item">Studio
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">893</span>
                </li>
            </ul>
            <hr>
            <h4 class="ltn__widget-title">Amenities</h4>
            <ul>
                <li>
                    <label class="checkbox-item">Dishwasher
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">3,924</span>
                </li>
                <li>
                    <label class="checkbox-item">Floor Coverings
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">3,610</span>
                </li>
                <li>
                    <label class="checkbox-item">Internet
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">2,912</span>
                </li>
                <li>
                    <label class="checkbox-item">Build Wardrobes
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">2,687</span>
                </li>
                <li>
                    <label class="checkbox-item">Supermarket
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">1,853</span>
                </li>
                <li>
                    <label class="checkbox-item">Kids Zone
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">893</span>
                </li>
            </ul>
            <hr>
            <h4 class="ltn__widget-title">Price Renge</h4>
            <ul>
                <li>
                    <label class="checkbox-item">Low Budget
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">$5,000 - $10,000</span>
                </li>
                <li>
                    <label class="checkbox-item">Medium
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">$10,000 - $30,000</span>
                </li>
                <li>
                    <label class="checkbox-item">High Budget
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">$30,000 Up</span>
                </li>
            </ul>
            <hr>
            <!-- Price Filter Widget -->
            <div class="widget--- ltn__price-filter-widget">
                <h4 class="ltn__widget-title ltn__widget-title-border---">Filter by price</h4>
                <div class="price_filter">
                    <div class="price_slider_amount">
                        <input type="submit"  value="Your range:"/> 
                        <input type="text" class="amount" name="price"  placeholder="Add Your Price" /> 
                    </div>
                    <div class="slider-range"></div>
                </div>
            </div>
            <hr>
            <h4 class="ltn__widget-title">Bed/bath</h4>
            <ul>
                <li>
                    <label class="checkbox-item">Single
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">3,924</span>
                </li>
                <li>
                    <label class="checkbox-item">Double
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">3,610</span>
                </li>
                <li>
                    <label class="checkbox-item">Up To 3
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">2,912</span>
                </li>
                <li>
                    <label class="checkbox-item">Up To 5
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">2,687</span>
                </li>
            </ul>
            <hr>
            <h4 class="ltn__widget-title">Catagory</h4>
            <ul>
                <li>
                    <label class="checkbox-item">Buying
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">3,924</span>
                </li>
                <li>
                    <label class="checkbox-item">Renting
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">3,610</span>
                </li>
                <li>
                    <label class="checkbox-item">Selling
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <span class="categorey-no">2,912</span>
                </li>
            </ul>
        </div>
        <!-- Category Widget -->
        <div class="widget ltn__menu-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
            <ul>
                <li><a href="#">Body <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Interior <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Lights <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Parts <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Tires <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Uncategorized <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                <li><a href="#">Wheel <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
            </ul>
        </div>
        <!-- Price Filter Widget -->
        <div class="widget ltn__price-filter-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
            <div class="price_filter">
                <div class="price_slider_amount">
                    <input type="submit"  value="Your range:"/> 
                    <input type="text" class="amount" name="price"  placeholder="Add Your Price" /> 
                </div>
                <div class="slider-range"></div>
            </div>
        </div>
        <!-- Top Rated Product Widget -->
        <div class="widget ltn__top-rated-product-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
            <ul>
                <li>
                    <div class="top-rated-product-item clearfix">
                        <div class="top-rated-product-img">
                            <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                        </div>
                        <div class="top-rated-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h6><a href="product-details.html">Mixel Solid Seat Cover</a></h6>
                            <div class="product-price">
                                <span>$49.00</span>
                                <del>$65.00</del>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="top-rated-product-item clearfix">
                        <div class="top-rated-product-img">
                            <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                        </div>
                        <div class="top-rated-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h6><a href="product-details.html">3 Rooms Manhattan</a></h6>
                            <div class="product-price">
                                <span>$49.00</span>
                                <del>$65.00</del>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="top-rated-product-item clearfix">
                        <div class="top-rated-product-img">
                            <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                        </div>
                        <div class="top-rated-product-info">
                            <div class="product-ratting">
                                <ul>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                </ul>
                            </div>
                            <h6><a href="product-details.html">Coil Spring Conversion</a></h6>
                            <div class="product-price">
                                <span>$49.00</span>
                                <del>$65.00</del>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Search Widget -->
        <div class="widget ltn__search-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Search Objects</h4>
            <form action="#">
                <input type="text" name="search" placeholder="Search your keyword...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <!-- Tagcloud Widget -->
        <div class="widget ltn__tagcloud-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Popular Tags</h4>
            <ul>
                <li><a href="#">Popular</a></li>
                <li><a href="#">desgin</a></li>
                <li><a href="#">ux</a></li>
                <li><a href="#">usability</a></li>
                <li><a href="#">develop</a></li>
                <li><a href="#">icon</a></li>
                <li><a href="#">Car</a></li>
                <li><a href="#">Service</a></li>
                <li><a href="#">Repairs</a></li>
                <li><a href="#">Auto Parts</a></li>
                <li><a href="#">Oil</a></li>
                <li><a href="#">Dealer</a></li>
                <li><a href="#">Oil Change</a></li>
                <li><a href="#">Body Color</a></li>
            </ul>
        </div>
        <!-- Size Widget -->
        <div class="widget ltn__tagcloud-widget ltn__size-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Product Size</h4>
            <ul>
                <li><a href="#">S</a></li>
                <li><a href="#">M</a></li>
                <li><a href="#">L</a></li>
                <li><a href="#">XL</a></li>
                <li><a href="#">XXL</a></li>
            </ul>
        </div>
        <!-- Color Widget -->
        <div class="widget ltn__color-widget d-none">
            <h4 class="ltn__widget-title ltn__widget-title-border">Product Color</h4>
            <ul>
                <li class="black"><a href="#"></a></li>
                <li class="white"><a href="#"></a></li>
                <li class="red"><a href="#"></a></li>
                <li class="silver"><a href="#"></a></li>
                <li class="gray"><a href="#"></a></li>
                <li class="maroon"><a href="#"></a></li>
                <li class="yellow"><a href="#"></a></li>
                <li class="olive"><a href="#"></a></li>
                <li class="lime"><a href="#"></a></li>
                <li class="green"><a href="#"></a></li>
                <li class="aqua"><a href="#"></a></li>
                <li class="teal"><a href="#"></a></li>
                <li class="blue"><a href="#"></a></li>
                <li class="navy"><a href="#"></a></li>
                <li class="fuchsia"><a href="#"></a></li>
                <li class="purple"><a href="#"></a></li>
                <li class="pink"><a href="#"></a></li>
                <li class="nude"><a href="#"></a></li>
                <li class="orange"><a href="#"></a></li>

                <li><a href="#" class="orange"></a></li>
                <li><a href="#" class="orange"></a></li>
            </ul>
        </div>
        <!-- Banner Widget -->
        <div class="widget ltn__banner-widget d-none">
            <a href="shop.html"><img src="img/banner/banner-2.jpg" alt="#"></a>
        </div>

    </aside>
</div>
