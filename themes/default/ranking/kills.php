<?php if (!defined('FLUX_ROOT')) exit; ?>

<h2>Kills Ranking</h2>
<h3>
	Top 20 Most Killers 
	on <?php echo htmlspecialchars($server->serverName) ?>
</h3>
<?php if ( ! empty($pvpladder) ): ?>
<table class="horizontal-table">
	<tr>
		<th>Rank</th>
		<th>Character Name</th>
		<th>Kills</th>
		<th>Job Class</th>
		<th>Base Level</th>
		<th>Job Level</th>
	</tr>
	<?php $i=0; foreach ($pvpladder as $char): ?>
	<tr>
		<td><?php echo ++$i; ?></td>
		<td><?php echo $char->name; ?></td>
		<td><?php echo $char->kills; ?></td>
		<td><?php echo $this->jobClassText($char->class); ?></td>
		<td><?php echo $char->base_level; ?></td>
		<td><?php echo $char->job_level; ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php else: ?>
<p>There are no characters. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>