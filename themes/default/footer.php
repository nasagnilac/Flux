<?php if (!defined('FLUX_ROOT')) exit; ?>
				</div> <!-- containerRight -->
			</div> <!-- container -->
			<div id="footer">
				<div class="container">
					<div class="footerLinks">
						<ul>
							<li><a href="<?php echo $this->url('main','download'); ?>">Downloads</a></li>
							<li><a href="<?php echo $this->url('account','create'); ?>">Register</a></li>
							<li><a href="<?php echo $this->url('account','view'); ?>">Account Panel</a></li>
							<li><a href="<?php echo $EADev['forum']; ?>" target="_blank">Forum</a></li>
							<li><a href="<?php echo $this->url('server','info'); ?>">Server Info</a></li>
							<li><a href="<?php echo $this->url('donate'); ?>">Donations</a></li>
							<li><a href="<?php echo $this->url('main','staff'); ?>">Server Staffs</a></li>
							<li><a href="<?php echo $this->url('ranking','character'); ?>">Rankings</a></li>
							<li><a href="<?php echo $this->url('main','knowledgebase'); ?>">Knowledgebase</a></li>
							<li><a href="<?php echo $EADev['rms']; ?>" target="_blank">Write us a review</a></li>
							<li><a href="<?php echo $this->url('main','contact'); ?>">Contact Us</a></li>
						</ul>
					</div>
					<div class="copyright">
						© Copyright 2015-2016 <span class="orange">Prestige Ragnarok Online</span><br/>
						Ragnarok Online and all related contents are all property of Gravity.
						<div class="logos">
							<ul>
								<li><a href="<?php echo $this->url('main'); ?>"><img src="<?php echo $this->themePath('img/logoFooter.png'); ?>" alt=""></a></li>
								<li><a href="<?php echo $this->url('main'); ?>"><img src="<?php echo $this->themePath('img/s1Lykos.png'); ?>" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<!-- Start of LiveChat (www.livechatinc.com) code -->
<script type="text/javascript">
window.__lc = window.__lc || {};
window.__lc.license = 7028161;
(function() {
  var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
  lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
})();
</script>
<!-- End of LiveChat code -->