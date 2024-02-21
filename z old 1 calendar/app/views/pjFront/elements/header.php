<?php
if($show_header == 1)
{ 
	?>
	<br>
				
	<div class="clearfix">
		<?php
		if($show_categories == 1)
		{ 
			?>
			<div class="dropdown pull-left">
				<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
					<span id="pjPecDropDown_<?php echo $index;?>" class="pjIcDropdownInner">-- <?php __('front_all_categories');?> --</span>
					<span class="caret"></span>
				</button>
					
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
					<li role="presentation"><a class="pjPecCategory" role="menuitem" tabindex="-1" href="#" data-id="0">-- <?php __('front_all_categories');?> --</a></li>
					<?php
					foreach($tpl['category_arr'] as $v)
					{	
						?><li role="presentation"><a class="pjPecCategory" role="menuitem" tabindex="-1" href="#" data-id="<?php echo $v['id']?>"><?php echo pjSanitize::html($v['category'])?></a></li><?php
					} 
					?>
				</ul>
			</div>
			<?php
		} 
		if($show_icons == 1)
		{
			?>		
			<div class="btn-group pull-right" role="group" aria-label="...">
				<?php
				if($tpl['option_arr']['o_enable_list_view'] == 'Yes')
				{ 
					?><a href="#" data-mode="list" class="btn btn-default pjPecViewMode<?php echo $default_view == 'list' ? ' active' : null;?>"><span class="glyphicon glyphicon-list"></span></a><?php
				} 
				?>
			 	<a href="#" data-mode="calendar" class="btn btn-default pjPecViewMode<?php echo $default_view == 'calendar' ? ' active' : null;?>"><span class="glyphicon glyphicon-calendar"></span></a>
			 	<?php
			 	if($tpl['option_arr']['o_enable_monthly_view'] == 'Yes')
			 	{ 
				 	?><a href="#" data-mode="monthly" class="btn btn-default pjPecViewMode<?php echo $default_view == 'monthly' ? ' active' : null;?>"><span class="glyphicon glyphicon-th-list"></span></a><?php
			 	} 
				?>
			</div>
			<?php
		} 
		?>
	</div>
	<?php
} 
?>