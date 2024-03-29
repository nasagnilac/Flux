<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>Checkout</h2>
<p>The checkout process is fairly simple, and when you're done you'll be ready to redeem your items in-game through our <span class="keyword">Redemption NPC</span>.</p>

<h3>Purchase Information</h3>
<p class="cart-total-text">Your current subtotal is <span class="cart-sub-total" style="color: #FFF;"><?php echo number_format($total=$server->cart->getTotal()) ?></span> credit(s).</p>
<p class="checkout-info-text">Your remaining balance after this purchase will be <span class="remaining-balance" style="color: #FFF;"><?php echo number_format($session->account->balance - $total) ?></span> credit(s).</p>
<p>After reviewing the below item information, you can proceed with your checkout by clicking the “Purchase Items” button.</p>
<p class="important" style="color: #FFF;">Note: These items are for redemption on the <span class="server-name"><?php echo htmlspecialchars($server->serverName) ?></span> server ONLY.</p>
<p>
	<form action="<?php echo $this->url ?>" method="post">
		<?php echo $this->moduleActionFormInputs($params->get('module'), 'checkout') ?>
		<input type="hidden" name="process" value="1" />
		<?php echo Flux_Security::csrfGenerate('PurchaseCheckOut', true) ?>
		<button type="submit" onclick="return confirm('Are you sure you want to continue purchasing the below item(s)?')">
			<strong>Purchase Items</strong>
		</button>
	</form>
</p>

<h3>Items Currently in Your Cart:</h3>
<p class="cart-info-text">You have <span class="cart-item-count" style="color: #FFF;"><?php echo number_format(count($items)) ?></span> item(s) in your cart.</p>
<table class="vertical-table cart">
	<?php foreach ($items as $item): ?>
	<tr>
		<td width="100">
			<?php if (($item->shop_item_use_existing && ($image=$this->itemImage($item->shop_item_nameid))) || ($image=$this->shopItemImage($item->shop_item_id))): ?>
					<img src="<?php echo $image ?>?nocache=<?php echo rand() ?>" class="shop-item-image" />
				<?php endif ?>
		</td>
		<td>
			<h4>
				<?php if ($auth->actionAllowed('item', 'view')): ?>
					<?php echo $this->linkToItem($item->shop_item_nameid, $item->shop_item_name) ?>
				<?php else: ?>
					<?php echo htmlspecialchars($item->shop_item_nameid) ?>
				<?php endif ?>
			</h4>
			<?php if ($item->shop_item_qty > 1): ?>
			<p class="shop-item-qty">Quantity: <span class="qty"><?php echo number_format($item->shop_item_qty) ?></span></p>
			<?php endif ?>
			<p class="shop-item-cost"><span class="cost" style="color: #FFF;"><?php echo number_format($item->shop_item_cost) ?></span> credits</p>
			<p><?php echo nl2br($item->shop_item_info) ?></p>
		</td>
	</tr>
	<?php endforeach ?>
</table>