<!-- <div id="cart" class="btn-group btn-block">
  <button type="button" data-toggle="dropdown" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i class="fa fa-shopping-cart"></i> <span id="cart-total"><?php echo $text_items; ?></span></button>
  <ul class="dropdown-menu pull-right">
    <?php if ($products || $vouchers) { ?>
    <li>
      <table class="table table-striped">
        <?php foreach ($products as $product) { ?>
        <tr>
          <td class="text-center"><?php if ($product['thumb']) { ?>
            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumbnail" /></a>
            <?php } ?></td>
          <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
            <?php if ($product['option']) { ?>
            <?php foreach ($product['option'] as $option) { ?>
            <br />
            - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small>
            <?php } ?>
            <?php } ?>
            <?php if ($product['recurring']) { ?>
            <br />
            - <small><?php echo $text_recurring; ?> <?php echo $product['recurring']; ?></small>
            <?php } ?></td>
          <td class="text-right">x <?php echo $product['quantity']; ?></td>
          <td class="text-right"><?php echo $product['total']; ?></td>
          <td class="text-center"><button type="button" onclick="cart.remove('<?php echo $product['cart_id']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher) { ?>
        <tr>
          <td class="text-center"></td>
          <td class="text-left"><?php echo $voucher['description']; ?></td>
          <td class="text-right">x&nbsp;1</td>
          <td class="text-right"><?php echo $voucher['amount']; ?></td>
          <td class="text-center text-danger"><button type="button" onclick="voucher.remove('<?php echo $voucher['key']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
        </tr>
        <?php } ?>
      </table>
    </li>
    <li>
      <div>
        <table class="table table-bordered">
          <?php foreach ($totals as $total) { ?>
          <tr>
            <td class="text-right"><strong><?php echo $total['title']; ?></strong></td>
            <td class="text-right"><?php echo $total['text']; ?></td>
          </tr>
          <?php } ?>
        </table>
        <p class="text-right"><a href="<?php echo $cart; ?>"><strong><i class="fa fa-shopping-cart"></i> <?php echo $text_cart; ?></strong></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $checkout; ?>"><strong><i class="fa fa-share"></i> <?php echo $text_checkout; ?></strong></a></p>
      </div>
    </li>
    <?php } else { ?>
    <li>
      <p class="text-center"><?php echo $text_empty; ?></p>
    </li>
    <?php } ?>
  </ul>
</div>
 -->


<div id="top-cart" class='top-cart-block col-md-1 nopadding'>
    <a href="" id="top-cart-trigger"><img alt='Mini Market' src="../bizweb.dktcdn.net/100/052/691/themes/208078/assets/cart_bg1403.png?1489466644763" ><span class='top_cart_qty'>0</span>
    </a>
    <div class="top-cart-content">
       <div class="top-cart-title">
          <h4>Giỏ hàng</h4>
       </div>
       <div class="top-cart-items">
       </div>
       <div class="top-cart-action clearfix">
          <span class="fleft top-checkout-price"><?php echo $text_items; ?></span>
          <input type="hidden" class="top_cart_total_price_not_format" value="0" />
          <button onclick='window.location.href="https://mini-market.bizwebvietnam.net/cart"' class="button button-small nomargin fright">Xem giỏ hàng</button>
       </div>
    </div>   
    
    <!-- 
    <div class="top-cart-content">
		<div class="top-cart-title">
			<h4>Giỏ hàng</h4>
		</div>
		<div class="top-cart-items">
			
		<div class="top-cart-item clearfix"> <input type="hidden" class="item_id" value="2121693"> <input type="hidden" class="item_qty" value="1"> <input type="hidden" class="item_unit_price_not_formated" value="13900000"><div class="top-cart-item-image"> <a href="/tivi-led-samsung-ua40j6300akxxv"><img src="//bizweb.dktcdn.net/100/052/691/products/10021724-samsung-ua32j6300akxxv-1.jpg?v=1454323523903" alt="Tivi Led Samsung Ua40j6300"></a></div><div class="top-cart-item-desc"><a href="/tivi-led-samsung-ua40j6300akxxv">Tivi Led Samsung Ua40j6300</a><span class="top-cart-item-price">13.900.000₫</span><span class="top-cart-item-quantity">x 1</span><a class="top_cart_item_remove" onclick="deleteCart(2121693);"><i class="fa fa-times-circle"></i></a> </div></div></div>
		<div class="top-cart-action clearfix">
			<span class="fleft top-checkout-price">13.900.000₫</span>
			<input type="hidden" class="top_cart_total_price_not_format" value="13900000">
			<button onclick="window.location.href=&quot;/cart&quot;" class="button button-small nomargin fright">Xem giỏ hàng</button>
		</div>

	</div>
    -->
</div>

