<?php if (!defined('FLUX_ROOT')) exit; if( $EADev['enablerss'] ) include 'rsslib.php'; ?>
<div class="index-page">
	<div class="banner">
		<div class="cycle-slideshow" data-cycle-fx="scrollHorz" data-cycle-timeout="2000">
			<img src="<?php echo $this->themePath('img/2.png'); ?>" alt="">
			<img src="<?php echo $this->themePath('img/1.png'); ?>" alt="">
			<img src="<?php echo $this->themePath('img/3.png'); ?>" alt="">
		</div>
	</div>
	<div class="welcome">
		<div class="welcomeText">
			<p>
			Prestige Ragnarok Online is a new international classic server.
			</p>

		</div>
	</div>
	<div class="index-bottom">
		<div class="news">
			<div class="tab">
				<div class="tab-links">
					<ul>
						<li><a class="active" href="#all">All</a></li> 
						<li><a href="#news">News</a></li>
						<li><a href="#updates">Updates</a></li>
						<li><a href="#events">Events</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div id="all">
						<?php if( $EADev['enablerss'] ): ?>
							<?php echo RSS_Display(array('news' => $EADev['news'], 'updates' => $EADev['updates'], 'events' => $EADev['events']), 5); ?>
						<?php endif; ?>
					</div>
					<div class="hidden" id="news">
						<?php if( $EADev['enablerss'] ): ?>
							<?php echo RSS_Display(array('news' => $EADev['news']), 5); ?>
						<?php endif; ?>
					</div>
					<div class="hidden" id="updates">
						<?php if( $EADev['enablerss'] ): ?>
							<?php echo RSS_Display(array('updates' => $EADev['news']), 5); ?>
						<?php endif; ?>
					</div>
					<div class="hidden" id="events">
						<?php if( $EADev['enablerss'] ): ?>
							<?php echo RSS_Display(array('events' => $EADev['news']), 5); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="woe">
			<div class="tab">
				<div class="tab-links">
					<ul>
						<li><a class="active" href="#low_rate">Low Rate</a></li> 
						<li><a href="#high_rate">Mid Rate</a></li>
					</ul>
				</div>
				<div class="tab-content">
					<div id="low_rate">
						<table>
						<?php foreach( $EADev['woeTimeLowRate'] as $woeTime ): $woe = explode(",", $woeTime); ?>
							<tr>
								<td><?php echo $woe[0]; ?></td>
								<td><?php echo $woe[1]; ?></td>
							</tr>
						<?php endforeach; ?>
						</table>
					</div>
					<div id="high_rate" class="hidden">
						<table>
						<?php foreach( $EADev['woeTimeMidRate'] as $woeTime ): $woe = explode(",", $woeTime); ?>
							<tr>
								<td><?php echo $woe[0]; ?></td>
								<td><?php echo $woe[1]; ?></td>
							</tr>
						<?php endforeach; ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo $this->themePath('js/jquery.cycle2.min.js'); ?>"></script>

