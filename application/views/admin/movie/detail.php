<div class="container pageMovie">
<div class="headHolder">
	<div class="posterHolder">
		<!-- <img src="<?php //echo ($movie->mvs_poster != 0) ? $site_url.'data/movies/thumbs/'.$movie->mvs_slug.'_175X240_.jpg' : $site_url.'images/placeHolder.jpg'; ?>" alt="<?php echo $movie->mvs_title; ?>" /> -->
		</div>
	<div class="topHolder">
		<h2 class="sub-header"><?php echo $movie->mvs_title; ?></h2>
		<div class="covers">
			<ul></ul>
			<div class="clearfix"></div>
			<div class="coversNav"><a href="javascript:void(0);" class="btn btn-default btnMore">Load More</a></div>
		</div>
	</div>
	<div class="btnHolder">
		<a href="javascript:void(0);" class="btn btn-default btnCovers">Covers</a>
		<a href="javascript:history.go(-1)" class="btn btn-default btnBack">Back</a>
	</div>
	<div class="clearfix"></div>
</div>
<div class="googleSearch"><a target="_blank" href="https://www.google.com.tr/search?q=<?php echo str_replace(' ', '+', $movie->mvs_title); ?>+movie+<?php echo $movie->mvs_year; ?>&hl=en-US&tbs=isz:l,imgo:1&tbm=isch" class="btn btn-default">Search On Google</a></div>
<?php echo form_open(); ?>
	<div class="input-group mnCover">
	  <span class="input-group-addon">Manual Cover</span>
	  <?php echo form_input(array('name' => 'mvs_cover_mn', 'value' => '', 'id' => 'mvs_cover_mn', 'class' => 'form-control')); ?>
	  <span class="input-group-addon">
			<div class="btn-group btn-group-sm" role="group">
				<button type="button" class="btn btn-default" rel="top">TOP</button>
				<button type="button" class="btn btn-default" rel="middle">MIDDLE</button>
				<button type="button" class="btn btn-default" rel="bottom">BOTTOM</button>
			</div>
		</span>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Cover</span>
	  <?php echo form_input(array('name' => 'mvs_cover', 'value' => ($movie->mvs_cover == 1) ? $site_url.'data/covers/'.$movie->mvs_slug.'.jpg' : '', 'id' => 'mvs_cover', 'class' => 'form-control')); ?>
	  <span class="input-group-addon"><?php echo ($movie->mvs_cover == 1) ? '<a target="_blank" href="'.$site_url.'data/covers/'.$movie->mvs_slug.'.jpg">Show Cover</a>' : ''; ?></span>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">IMDB ID</span>
	  <?php echo form_input(array('name' => 'mvs_imdb_id', 'value' => $movie->mvs_imdb_id, 'id' => 'mvs_imdb_id', 'class' => 'form-control')); ?>
	  <span class="input-group-addon"><a target="_blank" href="<?php echo 'http://www.imdb.com/title/'.$movie->mvs_imdb_id; ?>">Go to IMDB</a></span>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Slug</span>
	  <?php echo form_input(array('name' => 'mvs_slug', 'value' => $movie->mvs_slug, 'id' => 'mvs_slug', 'class' => 'form-control')); ?>
	  <span class="input-group-addon"><a target="_blank" href="<?php echo $site_url.'movie/'.$movie->mvs_slug; ?>">Go to Page</a></span>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Title</span>
	  <?php echo form_input(array('name' => 'mvs_title', 'value' => $movie->mvs_title, 'id' => 'mvs_title', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Original Title</span>
	  <?php echo form_input(array('name' => 'mvs_org_title', 'value' => $movie->mvs_org_title, 'id' => 'mvs_org_title', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Year</span>
	  <?php echo form_input(array('name' => 'mvs_year', 'value' => $movie->mvs_year, 'id' => 'mvs_year', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Runtime</span>
	  <?php echo form_input(array('name' => 'mvs_runtime', 'value' => $movie->mvs_runtime, 'id' => 'mvs_runtime', 'class' => 'form-control')); ?>
	  <span class="input-group-addon">minutes</span>
	</div>
	<div class="input-group groupMulti genreGroup" rel="genres">
	  <span class="input-group-addon">Genres</span>
	  <?php echo form_multiselect('genres', $genres, explode("|", $movie->gnr_id), 'id="gnr_id" class="form-control"'); ?>
	  <span class="input-group-addon selections"></span>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Auidience</span>
	  <?php echo form_input(array('name' => 'aud_id', 'value' => $movie->aud_id, 'id' => 'aud_id', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Release Date</span>
	  <?php echo form_input(array('name' => 'mvs_rel_date', 'value' => $movie->mvs_rel_date, 'id' => 'mvs_rel_date', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Plot</span>
	  <?php echo form_textarea(array('name' => 'mvs_plot', 'value' => $movie->mvs_plot, 'id' => 'mvs_plot', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Cast</span>
		<div class="castHolder form-control">
			<ul class="list-group">
				<?php foreach($casts as $cast):?>
					<li class="list-group-item"><?php echo '<span class="actor"><a href="#'.$cast->str_id.'">'.$cast->str_name.'</a></span><span class="character">'.$cast->char_name.'</span>'; ?></li>
				<?php endforeach; ?>
			</ul>
			<div class="floatFixer"></div>
		</div>
	</div>
	<div class="input-group groupMulti" rel="countries">
	  <span class="input-group-addon">Country</span>
	  <?php echo form_multiselect('countries', $countries, explode("|", $movie->cntry_id), 'id="cntry_id" class="form-control"'); ?>
	  <span class="input-group-addon selections selectedCountries"></span>
	</div>
	
	<div class="input-group groupMulti" rel="langs">
	  <span class="input-group-addon">Languages</span>
	  <?php echo form_multiselect('langs', $langs, explode("|", $movie->lang_id), 'id="lang_id" class="form-control"'); ?>
	  <span class="input-group-addon selections selectedLangs"></span>
	</div>
	
	<div class="input-group">
	  <span class="input-group-addon">Production</span>
	  <?php echo form_input(array('name' => 'mvs_prod', 'value' => $movie->mvs_prod, 'id' => 'mvs_prod', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Awards</span>
	  <?php echo form_input(array('name' => 'mvs_awards', 'value' => $movie->mvs_awards, 'id' => 'mvs_awards', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Box Office</span>
	  <?php echo form_input(array('name' => 'mvs_box_ofc', 'value' => $movie->mvs_box_ofc, 'id' => 'mvs_box_ofc', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">IMDB Rate</span>
	  <?php echo form_input(array('name' => 'mvs_imdb_rate', 'value' => $movie->mvs_imdb_rate, 'id' => 'mvs_imdb_rate', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Metascore</span>
	  <?php echo form_input(array('name' => 'mvs_metascore', 'value' => $movie->mvs_metascore, 'id' => 'mvs_metascore', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Tomato Meter</span>
	  <?php echo form_input(array('name' => 'mvs_tmt_meter', 'value' => $movie->mvs_tmt_meter, 'id' => 'mvs_tmt_meter', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Official Website</span>
	  <?php echo form_input(array('name' => 'mvs_website', 'value' => $movie->mvs_website, 'id' => 'mvs_website', 'class' => 'form-control')); ?>
	</div>
	<div class="input-group">
	  <span class="input-group-addon">Qaptured Note</span>
	  <?php echo form_textarea(array('name' => 'adm_mvs_note', 'value' => $movie->adm_mvs_note, 'id' => 'adm_mvs_note', 'class' => 'form-control')); ?>
	</div>
<?php echo form_close(); ?>
</div>