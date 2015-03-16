<div class="admin ajax-load-more" id="alm-examples">	
	<div class="wrap">
		<div class="header-wrap">
   			<h2><?php echo ALM_TITLE; ?>: <strong><?php _e('Examples', ALM_NAME); ?></strong></h2>
   			<p><?php _e('A collection of everyday shortcode usages and implementation examples', ALM_NAME); ?></p>  
		</div>
		<div class="cnkt-main forceColors">
		   <div class="group">		   	
			   <span class="toggle-all"><span class="inner-wrap"><em class="collapse"><?php _e('Collapse All', ALM_NAME); ?></em><em class="expand"><?php _e('Expand All', ALM_NAME); ?></em></span></span>
			   
			   <div class="row gist" id="example-archive">
			      <h3 class="heading"><?php _e('Archive.php', ALM_NAME); ?></h3>
			      <div class="expand-wrap">
			         <p><?php _e('Shortcode for use on generic archive page.', ALM_NAME); ?></p>
			         <div class="inner">
	                  <script src="https://gist.github.com/dcooney/ebe912c7772e669f1370.js"></script>
	   		      </div>
			      </div>
			   </div>
			   
			   <div class="row gist" id="example-author">
			      <h3 class="heading"><?php _e('Author.php', ALM_NAME); ?></h3>
			      <div class="expand-wrap">
			         <p><?php _e('Shortcode for use on author archive pages.', ALM_NAME); ?></p>
			         <div class="inner">
	                  <script src="https://gist.github.com/dcooney/4d07ff95f7274f38fd3a.js"></script>
	   		      </div>
			      </div>
			   </div>
			   <div class="row gist" id="example-category">
			      <h3 class="heading"><?php _e('Category.php', ALM_NAME); ?></h3>
			      <div class="expand-wrap">
			         <p><?php _e('Shortcode for use on category archive pages.', ALM_NAME); ?></p>
			         <div class="inner">
	                  <script src="https://gist.github.com/dcooney/ae4caec3f9061dd47627.js"></script>
	   		      </div>
			      </div>
			   </div>
			   <div class="row gist" id="example-date">
			      <h3 class="heading"><?php _e('Date Archives', ALM_NAME); ?></h3>
			      <div class="expand-wrap">
			         <p><?php _e('Shortcode for use for archiving by date.', ALM_NAME); ?></p>
			         <div class="inner">
	                  <script src="https://gist.github.com/dcooney/6f74bebdd40cad9e3ee7.js"></script>
	   		      </div>
			      </div>
			   </div>
			   <div class="row gist" id="example-exclude">
			      <h3 class="heading"><?php _e('Excluding Posts', ALM_NAME); ?></h3>
	   		      <div class="expand-wrap">
	   		      <p><?php _e('Shortcode for excluding an array of posts.', ALM_NAME); ?></p>
	               <script src="https://gist.github.com/dcooney/9b037efbd166b4dba5ae.js"></script>
			      </div>
			   </div>
			   
			   <div class="row gist" id="example-tag">
			      <h3 class="heading"><?php _e('Tag.php', ALM_NAME); ?></h3>
			      <div class="expand-wrap">
			         <p><?php _e('Shortcode for use on tag archive pages.', ALM_NAME); ?></p>
			         <div class="inner">
	                  <script src="https://gist.github.com/dcooney/fc4276bebbdd05af64d1.js"></script>
	   		      </div>
			      </div>
			   </div>
			   			   
			   <div class="row no-brd">
					<p class="back2top"><a href="#wpcontent"><i class="fa fa-chevron-up"></i> <?php _e('Back to Top', ALM_NAME); ?></a></p>					
			   </div>
		   </div>
		   
	   </div>	   
	   <div class="cnkt-sidebar">
		   	
	   	<div class="cta">
				<h3><?php _e('Did you know?', ALM_NAME); ?></h3>
				<img src="<?php echo ALM_ADMIN_URL; ?>img/add-ons/shortcode-editor.jpg"><br/>
				<?php _e('<p class="addon-intro">You can generate shortcodes while editing pages!</p><p>Click the Ajax Load More icon in the content editor toolbar and the <a href="?page=ajax-load-more-shortcode-builder">shortcode builder</a> will open in an overlay window.', ALM_NAME); ?></p>
	   	</div>
	   	
	   	<?php include_once( ALM_PATH . 'admin/includes/cta/resources.php');	?>
	   	
	   </div>
	   	   
	   	
	</div>
</div>