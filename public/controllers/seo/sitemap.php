<?php
	//header('Content-Type: text/plain');
	require './controllers/tpl.php';
	
	$sitemap_content = $api->get('/sitemap');

	function sitemap_has_data($map, $sc) {
		return sizeof($sc['contents'][$map]);
	}

	function sitemap_exists($map, $sc) {
		if (!in_array($map, $sc['maps'])) {
			return false;
		}
		return true;
	}

	function model_base($map) {
		if(CONFIG['models'][$map] == '') {
			return SITE_URL.'';
		}
		return SITE_URL . CONFIG['models'][$map] . '/';
	}

	function formatted_date($raw_date) {
		$date = new DateTime($raw_date);
		return $date->format('Y-m-d');
	}
	
	header("Content-type: text/xml");
?>
<?php if ($route_vars['map'] && intval($route_vars['map'] > 0) && sitemap_exists($route_vars['map'], $sitemap_content)) { ?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		<?php 
			foreach ($sitemap_content['contents'][$route_vars['map']] as $url) { 
				if($url['slug'] == 'home' || $url['slug'] == 'homepage') { 
					$clean_url = SITE_URL;
				} else {
					$clean_url = model_base($url['model_type']) . $url['slug'];
				}
		?>
			<url>
				<loc><?php echo $clean_url; ?></loc>
				<lastmod><?php echo formatted_date($url['updated_at']); ?></lastmod>
			</url>
		<?php } ?>
	</urlset>
<?php } else if (!$route_vars['map']) { ?>
	<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		<?php foreach ($sitemap_content['maps'] as $m) { ?>
			<sitemap>
				<loc><?php echo SITE_URL; ?>sitemaps/<?php echo $m; ?>.xml</loc>
			</sitemap>
		<?php } ?>
	</sitemapindex>
<?php } else { 
	header("Content-type: text/html");
	get_handler('tpl/404', $data); 
} ?>