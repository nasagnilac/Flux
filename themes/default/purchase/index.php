<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>Purchase</h2>
<link rel="stylesheet" href="<?php echo $this->themePath('css/DonationAddon.css') ?>" type="text/css" media="screen" title="" charset="utf-8" />
<p>Items in this shop are purchased using <span class="keyword">donation credits</span> and not real money.  Donation Credits are rewarded to players who <a href="<?php echo $this->url('donate') ?>">make a donation to our server</a>, helping us cover the costs of maintaining and running the server.</p>
<h2><span class="shop-server-name"><?php echo htmlspecialchars($server->serverName) ?></span> Item Shop</h2>
<p class="action">
	<a href="<?php echo $this->url('purchase', 'index') ?>"<?php if (is_null($category)) echo ' class="current-shop-category"' ?>>
		<?php echo htmlspecialchars(Flux::message('AllLabel')) ?> (<?php echo number_format($total) ?>)
	</a>
<?php foreach ($categories as $catID => $catName): ?>
	/
	<a href="<?php echo $this->url('purchase', 'index', array('category' => $catID)) ?>"<?php if (!is_null($category) && $category === (string)$catID) echo ' class="current-shop-category"' ?>>
		<?php echo htmlspecialchars($catName) ?> (<?php echo number_format($categoryCount[$catID]) ?>)
	</a>
<?php endforeach ?>
</p>
<?php if ($categoryName): ?>
<h3>Category: <?php echo htmlspecialchars($categoryName) ?></h3>
<?php endif ?>
<?php if ($items): ?>
<?php 
$evens = array();
foreach ($items as $i => $item) {
	$evens[] = $item;
}
?>
<?php if ($session->isLoggedIn()): ?>
	<?php if ($cartItems=$server->cart->getCartItemNames()): ?><p class="cart-items-text">Items in your cart: <span class="cart-item-name"><?php echo implode('</span>, <span class="cart-item-name">', array_map('htmlspecialchars', $cartItems)) ?></span>.</p><?php endif ?>
	<p class="cart-info-text">You have <span class="cart-item-count"><?php echo number_format(count($cartItems)) ?></span> item(s) in your cart.</p>
	<p class="cart-total-text">Your current subtotal is <span class="cart-sub-total"><?php echo number_format($server->cart->getTotal()) ?></span> credit(s).</p>
<?php endif ?>
<?php foreach ($evens as $i => $item): ?>
	<div class="ItemMall">
		<div class="CustomItem">
			<div class="ItemImage">
				<?php if (($item->shop_item_use_existing && ($image=$this->itemImage($item->shop_item_nameid))) || ($image=$this->shopItemImage($item->shop_item_id))): ?>
					<img src="<?php echo $image ?>?nocache=<?php echo rand() ?>" class="shop-item-image" />
				<?php endif ?>
			</div>
			<div class="ItemName">&nbsp;<?php echo htmlspecialchars($item->shop_item_name) ?></div>
			<div class="ItemDesc">
				<div class="ItemBDesc">
					<?php echo Markdown($item->shop_item_info); ?><br/>

					<?php if ( $item->shop_item_type >= 0 ): ?>
						<?php if ( $item->shop_item_type == 4 || $item->shop_item_type == 5): ?>
						<p>Location: <span class="output">
							<?php if ($locs=$this->equipLocations($item->shop_equip_location)): ?>
								<?php echo htmlspecialchars(implode(' + ', $locs)) ?>
							<?php else: ?>
								<span class="not-applicable">None</span>
							<?php endif ?></span></p>
						<?php endif ?>

					<?php if ( $item->shop_item_type == 4 ): ?>
						<p>Attack: <span class="output"><?php echo (int)$item->shop_item_defence; ?></span></p>
					<?php endif ?>

					<?php if ( $item->shop_item_type == 5 ): ?>
						<p>Defense: <span class="output"><?php echo (int)$item->shop_item_defence; ?></span></p>
					<?php endif ?>

						<p>Weight: <span class="output"><?php echo (int)$item->shop_item_weight/10; ?></span></p>

					<?php if ( $item->shop_item_type == 4 ): ?>
						<p>Weapon Level: <span class="output"><?php echo (int)$item->shop_item_defence; ?></span></p>
					<?php endif ?>

					<?php if ( $item->shop_item_type == 4 || $item->shop_item_type == 5 ): ?>
						<p>Required Level: <span class="output"><?php echo (int)$item->shop_item_defence; ?></span></p>
					<?php endif ?>

						<p>Applicable Job: <span class="output">
							<?php if ($jobs=$this->equippableJobs($item->shop_item_equipjobs)): ?>
								<?php echo htmlspecialchars(implode(' / ', $jobs)) ?>
							<?php else: ?>
								<span class="not-applicable">None</span>
							<?php endif ?></span></p>


					<?php endif; ?>

				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="ItemRate">
			<div class="ItemCost">Cost: <b><?php echo number_format($item->shop_item_cost) ?> Credits</b></div>
			<div class="Quantity">
				<?php if ($item->shop_item_qty >= 1): ?>
					Quantity: <span class="qty"><?php echo number_format($item->shop_item_qty) ?></span>
				<?php endif ?>
			</div>

		</div>
		<div class="clear"></div>
		<div class="ItemSlots">
			<?php 
				if ( (int)$item->shop_item_slot > 0 ):
				switch( (int)$item->shop_item_slot ) {
					case 0:
						echo "<div class=\"Slot0\"></div>";
						break;
					case 1:
						echo "<div class=\"Slot1\"></div>";
						break;
					case 2:
						echo "<div class=\"Slot2\"></div>";
						break;
					case 3:
						echo "<div class=\"Slot3\"></div>";
						break;
					case 4:
						echo "<div class=\"Slot4\"></div>";
						break;
				}
				endif;
			?>
		</div>
		<div class="shop_menus">
			<?php if ($auth->actionAllowed('purchase', 'add')): ?>
				<a href="<?php echo $this->url('purchase', 'add', array('id' => $item->shop_item_id)) ?>"><strong>Add to Cart</strong></a>
			<?php endif ?>
			<?php if ($auth->actionAllowed('item', 'view')): ?>
				<?php echo $this->linkToItem($item->shop_item_nameid, 'View Item') ?>
			<?php endif ?>
			<?php if ($auth->allowedToEditShopItem): ?>
				<a href="<?php echo $this->url('itemshop', 'edit', array('id' => $item->shop_item_id)) ?>">Modify</a>
			<?php endif ?>
			<?php if ($auth->allowedToDeleteShopItem): ?>
				<a href="<?php echo $this->url('itemshop', 'delete', array('id' => $item->shop_item_id, 'Session' => Flux_Security::csrfGet('Session'))) ?>"
					onclick="return confirm('Are you sure you want to remove this item from the item shop?')">Delete</a>
			<?php endif ?>
		</div>
	</div>
<?php endforeach ?>
<?php else: ?>
<p>There are currently no items for sale.</p>
<?php endif ?>