<?php
/*
Plugin Name: Rewrite
Plugin URI: http://takien.com
Description: URL rewrite management. Edit/add/backup/restore/test rewrite rule in easy way.
Author: takien
Version: 0.2.1
Author URI: http://takien.com/
*/

defined('ABSPATH') or die();

require_once(dirname(__FILE__).'/options/easy-options.php');

if(!class_exists('RewritePluginOption')) {
	class RewritePluginOption extends EasyOptions {
		function init() {
			//add_action( 'generate_rewrite_rules', array(&$this,'generate_rewrite_rules') );
			
			add_filter( 'rewrite_rules_array', array(&$this,'rewrite_rules_array') , 200, 1);
			add_action( 'admin_enqueue_scripts', array(&$this,'rewrite_plugin_enqueue_script' ) );
			add_action( 'admin_head', array(&$this,'rewrite_plugin_script'));
			add_action( 'update_option_rewrite-plugin-option',  array(&$this,'rewrite_setting_updated'), 200, 2);
		}
		
		function rewrite_rules_array($rules) {
			if(easy_options('disable_rewrite','rewrite-plugin-option')) {
				return $rules;
			}
			else {
				$new_rules = get_option('rewrite_rules_save');
				return $new_rules;
			}
		}
		
		function rewrite_setting_updated( $old,$new ) {
			global $wp_rewrite;
			$wp_rewrite->flush_rules(false);
		}
		
		function rewrite_plugin_enqueue_script($hook_suffix) {
			if(!preg_match('/(rewrite-plugin)/i',$hook_suffix)) return;
			wp_enqueue_script( 'rewrite_plugin-script', plugins_url( 'js/script.js', __FILE__),array('jquery-ui-core','jquery-ui-sortable'),'0.2.1');
		}
		
		function rewrite_plugin_script() {
			global $pagenow;
			$page = isset($_GET['page']) ? $_GET['page'] : '';
			if(('admin.php' == $pagenow) AND (preg_match('/(rewrite-plugin|rewrite-plugin-option|rewrite-plugin-about)/i',$page))) {
				?>
<!-- rewrite plugin -->
<style type="text/css">
	#rule-table {
		width:100%;
		margin-bottom:10px;
	}
	input.rule-input {
		width:100%;
		border:none;
		background:transparent;
		margin:0;
		padding:5px;
		-webkit-border-radius: none;
		-moz-border-radius: none;
		border-radius: none; 
		
	}
	input.rule-input:focus {
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;
		
	}
	#rule-table td {
		padding:0;
		vertical-align:middle
	}
	#rule-table tr:hover td {
		background:#ffffe0;
	}
	#rule-table tr.focus:hover td {
		background:transparent;
	}
	#rule-table tr.focus {
		background:#d2f0fe;
	}
	#rule-table th:last-child {
		width:20px;
	}
	#rule-table .reorder-handle {
		display:block;
		cursor:move;
		height:16px;
	}
	#rule-table tr:hover .reorder-handle {
		background:url(<?php echo plugins_url( 'img/Cursor_drag_arrow.png', __FILE__);?>) no-repeat center;
	}
	.text-center {
		text-align:center
	}
	.table-wrap {
		overflow:auto;
		height:500px;
		border:1px solid #ccc;
		padding:10px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px; 
	}
	#rule-filter {
		margin:10px 0;
	}
	.hide {
		display:none
	}

	.warning {
		width:50%;
		float:left;
		margin: 5px 0px;
		padding: 0 5px;
		background-color: rgb(255, 255, 224);
		border:1px solid rgb(230, 219, 85);
	}
	#hide-it > div {
		margin: 10px 0
	}
</style>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		setTimeout(function() {
			$(window).resize();
		},10);
		
		$(window).resize(function() {
			var offset = 400;
			$('.table-wrap').height($(window).height()-offset);
		});
		$('.rule-input').each(function() {
			$(this).focus(function() {
				$(this).parents('tr').addClass('focus');
			}).blur(function() {
				$(this).parents('tr').removeClass('focus');
			});;
			$(this).after('<span class="hide">'+$(this).val()+'</span>');
		});
		
		/**
		 * Filter 
		 */
		
	
		$('#rule_filter').on('keyup keydown keypress blur change click focus propertychange', function() {
			var val = $(this).val();
			if(val.length > 0) {
				$('#rule-table tr:not(.tablehead)').not(':contains('+val+')').hide();
			}
			else {
				$('#rule-table tr').show();
			}
			$(window).resize();
			
		});	
		/**
		 * Test
		 */
		
		$('#rule_test').on('keyup keydown keypress blur change click focus propertychange', function() {
			var val = $(this).val();
			var site_url = '<?php echo home_url();?>/';
			val = val.replace(site_url,'');
			if(val.length > 0) {
				$('.rule-pattern').each(function() {
					var rule = $(this).val();
					
					var thisRegex = new RegExp(rule);
					
					if(!thisRegex.test(val)){
						$(this).parents('tr').hide();
					}
					else {
						$(this).parents('tr').show();
					}
				});
			}
			else {
				$('#rule-table tr').show();
			}
			$(window).resize();
			
		});
		$('#clear_filter').click(function(e) {
			$('#rule_filter,#rule_test').val('');
			$('#rule-table tr').show();
			e.preventDefault();
		});

		$('#toggle_monospace').on('change', function(e) {
			if(this.checked == true){
				$('.rule-input').css('font-family','monospace');
			}
			else {
				$('.rule-input').css('font-family','inherit');
			}
		});
		
		//Add rule
		$('#rule-add').click(function(e) {
		
		$('#clear_filter').trigger('click');
		var row = parseInt($('#rule-table tr:last').data().row)+1;
			$('#rule-table tbody').append('<tr id="rule-row-'+row+'" data-row="'+row+'"><td><input placeholder="Type rule here" class="rule-input rule-pattern" value="" name="rule_pattern['+row+']" type="text">	</td><td class="text-center"> &raquo; </td><td><input placeholder="Type match here" class="rule-input rule-match" value="" name="rule_match['+row+']" type="text"><span class="hide"></span></td><td><div class="reorder-handle"></div></td></tr>');
			$('.table-wrap').scrollTop($('#rule-table').height());
			$('#toggle_monospace').trigger('change');
			$('table tr:nth-child(odd)').addClass('alternate');
			$(window).resize();
			e.preventDefault();
		});
		//backup
		$('#rule-backup').click(function () {
			$('#backup-backup-box').toggle();
			$('#backup-restore-box').hide();
		});
		$('#rule-restore').click(function () {
			$('#backup-backup-box').hide();
			$('#backup-restore-box').toggle();
			$(window).resize();
		});
		$('table tr:nth-child(odd)').addClass('alternate');
	});
</script>
				<?php
			}
		}
		
		function page() {
	?>
	<div class="wrap">
		<?php 
		$icon = $this->icon_big;?>
		<div class="icon32"><img src="<?php echo $icon;?>" /></div>
		<?php 

			$navs = apply_filters($this->tab_nav(),'');
			if(!empty($navs)) {
				echo '<h2 class="nav-tab-wrapper">';
				if(is_array($navs)){
					foreach($navs as $nav){
						$class = ( $nav['slug'] == $_GET['page'] ) ? ' nav-tab-active' : '';
						echo '<a class="nav-tab '.$class.'" href="?page='.$nav['slug'].'">'.$nav['name'].'</a>';
					}
				}
				echo '</h2>';
			}
			else {
			?>
			<h2><?php echo $this->page_title;?></h2>
		<?php }
		if( 'rewrite-plugin' == $this->menu_slug ) {
			 if ( get_option('permalink_structure') ) {
				$this->rewrite_plugin_page();
			 }
			 else { ?>
				<div class="updated settings-error"> 
					<p><strong>Permalink Disabled.</strong> It seems that you didn't enable permalink for this blog. <a href="<?php echo admin_url('/options-permalink.php');?>">Click here</a> to activate permalink and go back to this page.</p>
				</div>
			 <?php
			 }
		}
		else if( 'rewrite-plugin-about' == $this->menu_slug ) {
			$this->page_about();
		}
		else {
			if(isset($_GET['settings-updated'])) {
			
			?>
			<div id="setting-error-settings_updated" class="updated settings-error"> 
				<p><strong>Settings saved.</strong></p>
			</div>
			<?php }
			echo apply_filters('easy_option_'.$this->menu_slug.'_before_form','');
		?>
		
		<form method="post" action="options.php">
			<?php 
				wp_nonce_field('update-options'); 
				settings_fields($this->menu_slug.'_option_field');?>
			<?php
				if(!empty($this->fields)){
					echo $this->form($this->fields);
				}
				
			?>
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="<?php echo $this->menu_slug.'_option_field';?>" value="<?php echo $this->group;?>" />
			<p><input type="submit" class="button-primary" value="Save" /> </p>
		</form>
		<?php 
			echo apply_filters('easy_option_'.$this->menu_slug.'_after_form','');
		}
		?>
		
		
	</div>
	<?php
		}
		function page_about() {
		?>
			<h2>Rewrite</h2>
			<p>WordPress URL rewrite management</p>
			<p>Version: 0.2.1 <br/>
			Author: takien<br/>
			Author URI : <a target="_blank" href="http://takien.com">http://takien.com</a><br/>
			Donate : <a target="_blank" href="http://takien.com/donate">Click here</a><br/>
			Follow me : <a target="_blank" href="http://twitter.com/cektkp">@cektkp</a> <br/>
			Plugin page : <a target="_blank" href="http://wordpress.org/extend/plugins/rewrite">http://wordpress.org/extend/plugins/rewrite</a></p>
			
		<?php
		}
		function rewrite_plugin_page() {
			global $wp_rewrite;
			
			$message = '';
			
			if(isset($_POST['rule-save'])) {
				$newrule = array_combine (  $_POST['rule_pattern']  , $_POST['rule_match'] );
				$newrule = array_filter($newrule);
				$rules   = $newrule;
				update_option( 'rewrite_rules_save', $newrule ); 
				$message = 'Rule saved.';
			}
			
			if(isset($_POST['rule-flush'])) {
				$wp_rewrite->flush_rules(false);
				$message = 'Rule flushed.';
			}

			if(isset($_POST['rule-save-and-flush'])) {
				if( (!$_POST['rule_pattern']) OR ! $_POST['rule_match']) {
					$message = 'Empty rule pairs.';
				}
				else {
					$newrule = array_combine (  $_POST['rule_pattern']  , $_POST['rule_match'] );
					$newrule = array_filter($newrule);
					$rules   = $newrule;
					update_option( 'rewrite_rules_save', $newrule ); 
					
					$wp_rewrite->flush_rules(false);
					$message = 'Rule saved and flushed.';
				}
			}
			
			if(isset($_POST['restore-backup'])) {
				$backup_name = $_POST['saved-backup'];
				$to_restore  = get_option('rewrite_rules_backup');
				update_option( 'rewrite_rules_save', $to_restore[$backup_name]['content'] ); 
				$message = 'Backup <strong>'.$backup_namme.'</strong> restored.';
			}
			
			if(isset($_POST['delete-backup'])) {
				$backup_name = $_POST['saved-backup'];
				$backup      = get_option('rewrite_rules_backup');
				unset($backup[$backup_name]);
				update_option( 'rewrite_rules_backup', $backup ); 
				$message = 'Backup <strong>'.$backup_name.'</strong> deleted.';
			}
			
			if(isset($_POST['backup-backup'])) {
				$date        = date('Y-m-d H:i:s');
				$backup_name = $_POST['backup-name'] ? $_POST['backup-name'] : 'backup-'.$date;
				$newrule     = array_combine (  $_POST['rule_pattern']  , $_POST['rule_match'] );
				$oldbackup   = get_option('rewrite_rules_backup',Array());
				$oldbackup[$backup_name]['content'] = $newrule;
				$oldbackup[$backup_name]['date']    = $date;
				update_option( 'rewrite_rules_backup', $oldbackup) ; 
				$message = 'Backup <strong>'.$backup_name.'</strong> sucess.';
			}
			
			
			//rules to be displayed in table.
			$rules   = get_option( 'rewrite_rules_save' , $wp_rewrite->wp_rewrite_rules() );
			
			
			if($message) { ?>
			<div class="updated settings-error"> 
				<p><?php echo $message;?></p>
			</div>
			<?php } ?>
			<form id="rule-filter" action="">
			<label for="">Filter:</label> <input class="regular-text" type="text" id="rule_filter" name="rule_filter" placeholder="Type text to filter rule" />
			<label for="">Test:</label>   <input class="regular-text" type="text" id="rule_test" name="rule_test" placeholder="Type URL here to test match" /> <button id="clear_filter" class="button">Clear</button> 
			<label><input type="checkbox" id="toggle_monospace"/> Toggle Monospace font</label>
			</form>
			<form method="post" action="admin.php?page=rewrite-plugin">
				<div class="table-wrap">
					<table class="widefat" id="rule-table">
					<thead>
						<tr class="tablehead">
							<th>Rule Pattern</th>
							<th></th>
							<th>Match</th>
							<th>Reorder</th>
						</tr>
					</thead>
					<tbody><?php
						$i = 0;
						foreach ( (array)$rules as $key => $val ) { $i++;
						?>
							<tr id="rule-row-<?php echo $i;?>" data-row="<?php echo $i;?>">
							<td>
								<input class="rule-input rule-pattern" type="text" value="<?php echo stripslashes($key);?>" name="rule_pattern[<?php echo $i;?>]"/>
							</td>
							<td class="text-center"> &raquo; </td>
							<td>
								<input class="rule-input rule-match" type="text" value="<?php echo $val;?>" name="rule_match[<?php echo $i;?>]"/>
							</td>
							<td>
								<div class="reorder-handle"></div>
							</td>
							</tr>
						<?php
						}
						?></tbody>
						
					</table>
				</div>
				<div id="hide-it">
					<div id="backup-backup-box" class="hide">
						Give name for this backup: <input class="regular-text" type="text" name="backup-name" /> <input class="button" type="submit" name="backup-backup" value="Back up"/>
					</div>
					<div id="backup-restore-box" class="<?php echo (isset($_POST['delete-backup']) OR isset($_POST['backup-backup']))  ? '': 'hide';?>">
						<?php
								$backups = get_option('rewrite_rules_backup',Array());
								if(!empty($backups)) {
								?>
								<p>Select your backup to restore:</p>
								<table class="widefat" style="width:50%;margin-bottom:10px;">
								<thead>
									<tr>
										<th>Backup name</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody><?php
											foreach($backups as $key=>$val) {
												echo '<tr><td>
													<label><input type="radio" name="saved-backup" value="'.$key.'"/> '.$key.'</label>
												</td><td>'.$val['date'].'</td>
												</tr>';
											}
											?>
								</tbody>
								</table>
								<input type="submit" class="button" name="restore-backup" value="Restore selected backup" />
								<input type="submit" class="button" name="delete-backup" value="Delete selected backup" />
								<?php
								}
								else {
									echo '<p>No backup</p>';
								}
							?>
					</div>
				</div>
				<p>
					<input id="rule-add" type="button" class="button" value="+ Add rule"/>
					<input id="rule-backup" type="button" class="button" value="Backup rules"/>
					<input id="rule-restore" type="button" class="button" value="Restore backup"/>
					<input id="rule-flush" name="rule-flush" type="submit" class="button" value="Flush rules"/>
					<input id="rule-save" name="rule-save" type="submit" class="button" value="Save"/>
					<input id="rule-save-and-flush" name="rule-save-and-flush" type="submit" class="button button-primary" value="Save & Flush Rules"/>
				</p>
				<div class="warning message"><p><strong>ATTENTION</strong>: By using this plugin, it's assumed that you know what you are doing. Rewrite is a sensitive thing. Doing it wrong may cause your site isn't accessible. Alaways make backup before editing.</p></div>
			</form>
			<?php
		}
	}
}

$rewrite_plugin['icon_large'] = plugins_url( 'options/images/icon-setting-large.png' , __FILE__  );
$rewrite_plugin['icon_small'] = plugins_url( 'options/images/icon-setting-small.png' , __FILE__  );

$rewrite_plugin_option = new RewritePluginOption(Array(
    'group'             => 'rewrite-plugin', 
    'menu_name'         => 'Rewrite', 
    'page_title'        => 'Rewrite', 
    'menu_slug'         => 'rewrite-plugin', 
    'menu_location'     => 'add_menu_page', 
    'icon_big'          => $rewrite_plugin['icon_large'], 
    'icon_small'        => $rewrite_plugin['icon_small'], 
	'menu_position'     => 82,
	'add_tab'           => 1
));

$rewrite_plugin_config = new RewritePluginOption(Array(
   'group'              => 'rewrite-plugin-option', 
    'menu_name'         => 'Option', 
    'menu_slug'         => 'rewrite-plugin-option', 
    'menu_location'     => 'add_sub_menu_page', 
    'icon_big'          => $rewrite_plugin['icon_large'],
    'icon_small'        => $rewrite_plugin['icon_small'], 
	'parent_slug'       => 'rewrite-plugin',
	'add_tab'           => 1
));
$rewrite_plugin_config->fields = Array(
	Array(
	'name'         => 'disable_rewrite',
	'label'        => 'Disable rewrite',
	'type'         => 'checkbox',
	'description'  => 'Check this option to bypass rewrite from this plugin and use default WordPress rewrite instead.')
);

$rewrite_plugin_config = new RewritePluginOption(Array(
    'group'             => 'rewrite-plugin-about', 
    'menu_name'         => 'About', 
    'menu_slug'         => 'rewrite-plugin-about', 
    'menu_location'     => 'add_sub_menu_page', 
    'icon_big'          => $rewrite_plugin['icon_large'],
    'icon_small'        => $rewrite_plugin['icon_small'], 
	'parent_slug'       => 'rewrite-plugin',
	'add_tab'           => 1
));