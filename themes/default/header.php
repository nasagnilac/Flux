<?php if (!defined('FLUX_ROOT')) exit; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<?php if (isset($metaRefresh)): ?>
		<meta http-equiv="refresh" content="<?php echo $metaRefresh['seconds'] ?>; URL=<?php echo $metaRefresh['location'] ?>" />
		<?php endif ?>
		<title><?php echo Flux::config('SiteTitle'); if (isset($title)) echo ": $title" ?></title>
		<link rel="stylesheet" href="<?php echo $this->themePath('css/flux.css') ?>" type="text/css" media="screen" title="" charset="utf-8" />
		<link rel="stylesheet" href="<?php echo $this->themePath('css/style.css') ?>" type="text/css" media="screen" title="" charset="utf-8" />
		<link href="<?php echo $this->themePath('css/flux/unitip.css') ?>" rel="stylesheet" type="text/css" media="screen" title="" charset="utf-8" />
		<?php if (Flux::config('EnableReCaptcha')): ?>
		<link href="<?php echo $this->themePath('css/flux/recaptcha.css') ?>" rel="stylesheet" type="text/css" media="screen" title="" charset="utf-8" />
		<?php endif ?>
		<script type="text/javascript" src="<?php echo $this->themePath('js/jquery-1.8.3.min.js') ?>"></script>
		<script type="text/javascript" src="<?php echo $this->themePath('js/flux.datefields.js') ?>"></script>
		<script type="text/javascript" src="<?php echo $this->themePath('js/flux.unitip.js') ?>"></script>
		<script type="text/javascript" src="<?php echo $this->themePath('js/eadev.js') ?>"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.money-input').keyup(function() {
					var creditValue = parseInt($(this).val() / <?php echo Flux::config('CreditExchangeRate') ?>, 10);
					if (isNaN(creditValue))
						$('.credit-input').val('?');
					else
						$('.credit-input').val(creditValue);
				}).keyup();
				$('.credit-input').keyup(function() {
					var moneyValue = parseFloat($(this).val() * <?php echo Flux::config('CreditExchangeRate') ?>);
					if (isNaN(moneyValue))
						$('.money-input').val('?');
					else
						$('.money-input').val(moneyValue.toFixed(2));
				}).keyup();
				processDateFields();
			});
			function reload(){
				window.location.href = '<?php echo $this->url ?>';
			}
		</script>
		<script type="text/javascript">
			function updatePreferredServer(sel){
				var preferred = sel.options[sel.selectedIndex].value;
				document.preferred_server_form.preferred_server.value = preferred;
				document.preferred_server_form.submit();
			}
			function updatePreferredTheme(sel){
				var preferred = sel.options[sel.selectedIndex].value;
				document.preferred_theme_form.preferred_theme.value = preferred;
				document.preferred_theme_form.submit();
			}
			var spinner = new Image();
			spinner.src = '<?php echo $this->themePath('img/spinner.gif') ?>';
			function refreshSecurityCode(imgSelector){
				$(imgSelector).attr('src', spinner.src);
				var clean = <?php echo Flux::config('UseCleanUrls') ? 'true' : 'false' ?>;
				var image = new Image();
				image.src = "<?php echo $this->url('captcha') ?>"+(clean ? '?nocache=' : '&nocache=')+Math.random();
				$(imgSelector).attr('src', image.src);
			}
			function toggleSearchForm()
			{
				$('.search-form').slideToggle('fast');
			}
		</script>
		<?php if (Flux::config('EnableReCaptcha') && Flux::config('ReCaptchaTheme')): ?>
		<script type="text/javascript">
			 var RecaptchaOptions = {
			    theme : '<?php echo Flux::config('ReCaptchaTheme') ?>'
			 };
		</script>
		<?php endif ?>
	</head>
	<body>
		<?php 
			$_servers = $this->getServerNames();
			$EADev = include 'main/EADevConfig.php'; 
		?>
		<div id="wrapper">
			<div id="header">
				<div class="topBar">
					<div class="container">
						<div class="serverName">
							<a href="<?php echo $this->url('main'); ?>"><img src="<?php echo $this->themePath('img/serverNameTop.png'); ?>" alt=""></a>
						</div>
						<div class="navigation">
							<ul>
								<li><a href="<?php echo $this->url('main') ?>"><span>Main Menu</span></a></li>
								<li class='has-sub'>
									<a href="<?php echo $this->url('account','login') ?>"><span>Account Panel</span></a>
									<ul>
										<li><a href='<?php echo $this->url('account','create'); ?>'><span>Register</span></a></li>
										<li><a href='<?php echo $this->url('account','login'); ?>'><span>Login</span></a></li>
										<li><a href='<?php echo $this->url('account','logout'); ?>'><span>Logout</span></a></li>
									</ul>
								</li>
								<li class='has-sub'>
									<a href="<?php echo $this->url('account','login') ?>"><span>Donations</span></a>
									<ul>
										<li><a href='<?php echo $this->url('purchase'); ?>'><span>Purchase</span></a></li>
										<li><a href='<?php echo $this->url('donate'); ?>'><span>Donate</span></a></li>
									</ul>
								</li>
								<li class='has-sub'>
									<a href='#'><span>Ranking</span></a>
									<ul>
										<li class='has-sub'><a href='#'><span>Low Rate</span></a>
											<ul>
												<li><a href='<?php echo $this->url('ranking','character'); ?>'><span>Character Rankings</span></a></li>
												<li class='last'><a href='<?php echo $this->url('ranking','guild'); ?>'><span>Guild Rankings</span></a></li>
											</ul>
										</li>
										<li class='has-sub'><a href='#'><span>Mid Rate</span></a>
											<ul>
												<li><a href='<?php echo $this->url('ranking','character&preferred_server=' . str_replace(" ", "+", $_servers[1])); ?>'><span>Character Rankings</span></a></li>
												<li class='last'><a href='<?php echo $this->url('ranking','guild&preferred_server=' . str_replace(" ", "+", $_servers[1])); ?>'><span>Guild Rankings</span></a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li class='has-sub'>
									<a href="<?php echo $this->url('pages','content&path=info'); ?>"><span>Information</span></a>
									<ul>
										<li><a href="<?php echo $this->url('server','info'); ?>"><span>Server Info.</span></a>
										</li>
										<li><a href="<?php echo $this->url('server','status'); ?>"><span>Server Status</span></a> </li> 
										<li><a href="<?php echo $this->url('castle'); ?>"><span>Castles</span></a></li>
									</ul>
								</li>
								<li class='last has-sub'>
									<a href="<?php echo $EADev['world_map']; ?>"><span>World Map</span></a>
									<ul>
										<li><a href="<?php echo $this->url('main'); ?>"><span>Link 1</span></a>
										</li>
										<li><a href="<?php echo $this->url('main'); ?>"><span>Link 2</span></a> </li> 
										<li><a href="<?php echo $this->url('main'); ?>"><span>Link 3</span></a></li>
									</ul>
								</li>
							</ul>
						</div>
						<div class="serverStatus">
							<?php include 'main/status.php'; ?>
						</div>
					</div>
				</div>
				<div class="logo">
					<a href="<?php echo $this->url('main'); ?>"><img src="<?php echo $this->themePath('img/logo.png'); ?>" alt=""></a>
				</div>
			</div>
			<div class="container">
				<div class="containerLeft">
					<div class="linkButtons">
						<ul>
							<li><a href="<?php echo $this->url('main','download'); ?>"><img src="<?php echo $this->themePath('img/buttons.png'); ?>" alt=""></a></li>
							<li><a href="<?php echo $this->url('account','create'); ?>"><img src="<?php echo $this->themePath('img/buttons.png'); ?>" alt=""></a></li>
							<li><a href="<?php echo $this->url('account','view'); ?>"><img src="<?php echo $this->themePath('img/buttons.png'); ?>" alt=""></a></li>
						</ul>
					</div>
					<div class="leftBottom">
						<div class="fourLinks">
							<ul>
								<li><a href="<?php echo $EADev['forum']; ?>" target="_blank">Forum</a></li>
								<li><a href="<?php echo $this->url('server','info'); ?>">Server Info</a></li>
								<li><a href="<?php echo $this->url('donate'); ?>">Donations</a></li>
								<li><a href="<?php echo $this->url('main','staff'); ?>">Server Staffs</a></li>
							</ul>
						</div>
						<div class="quickLinks">
							<ul>
								<li><a href="<?php echo $this->url('service','tos'); ?>">Server Rules</a></li>
								<li><a href="<?php echo $this->url('ranking','character'); ?>">Ranking Info</a></li>
								<li><a href="<?php echo $this->url('item'); ?>">Item Database</a></li>
								<li><a href="<?php echo $this->url('monster'); ?>">Monster Database</a></li>
								<li><a href="<?php echo $EADev['rms']; ?>" target="_blank">Write us a Review</a></li>
							</ul>
						</div>
						<div class="fbBtn">
							<a href="<?php echo $EADev['facebook']; ?>"><img src="<?php echo $this->themePath('img/facebookLikeBg.png'); ?>" alt=""></a>
						</div>
					</div>
				</div>
				<div class="containerRight">
					<?php if ($message=$session->getMessage()): ?>
						<p class="message"><?php echo htmlspecialchars($message) ?></p>
					<?php endif ?>
					<?php include $this->themePath('main/submenu.php', true) ?>
					<?php include $this->themePath('main/pagemenu.php', true) ?>
					<?php if (in_array($params->get('module'), array('donate', 'purchase'))) include $this->themePath('main/balance.php', true) ?>