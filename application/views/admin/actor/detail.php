<div class="container pageActors">
	<?php if(count($actors)): ?>
		<?php foreach($actors as $actor): ?>
			<h2 class="sub-header"><?php echo $actor->str_name; ?></h2>
		<?php endforeach; ?>
	<?php else: ?>
		<?php echo getMessage('info', 'Actor data not found.'); ?>
	<?php endif; ?>
	<div class="table-responsive">
		<?php if(is_array($casting)): ?>
			<table class="table table-striped table-movies">
				<thead>
					<tr>
						<th>Movie</th>
						<th>year</th>
						<th>Character Name</th>
						<th>Role</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($casting as $cast): ?>
					<tr>
						<td><a href="<?php echo $site_url.'admin/movie/detail/'.$cast->mvs_id; ?>"><?php echo $cast->mvs_title; ?></a></td>
						<td><?php echo $cast->mvs_year; ?></td>
						<td><?php echo $cast->char_name; ?></td>
						<td><?php echo $cast->type_id; ?></td>
					</tr>
				<?php endforeach; ?>		
				</tbody>
			</table>
		<?php else: ?>
			<?php echo getMessage('info', 'Actor's movie data not found.'); ?>
		<?php endif; ?>
	</div>
</div>