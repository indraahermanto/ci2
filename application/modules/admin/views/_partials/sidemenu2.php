<ul class="sidebar-menu">

	<li class="header">MAIN NAVIGATION</li>

	<?php foreach ($menu as $parent => $parent_params): ?>
		<?php if ( empty($page_auth[$parent_params['url']]) || $this->ion_auth->in_group($page_auth[$parent_params['url']]) ): ?>
		<?php if ( empty($parent_params['children']) ): ?>

			<?php $active = ($current_uri==$parent_params['url'] || $ctrler==$parent); ?>
			<li class='<?php if ($active) echo 'active'; ?>'>
				<a href='<?php echo site_url($parent_params['url']); ?>'>
					<em class='<?php echo $parent_params['icon']; ?>'></em> <?php echo $parent_params['name']; ?>
				</a>
			</li>

		<?php else: ?>

			<?php $parent_active = ($ctrler==$parent); ?>
			<li class='treeview <?php if ($parent_active) echo 'active'; ?>'>
				<a href='#'>
					<em class='<?php echo $parent_params['icon']; ?>'></em> <span><?php echo $parent_params['name']; ?></span> <span class="pull-right-container"><em class='fa fa-angle-left pull-right'></em></span>
				</a>
				<ul class='treeview-menu'>
					<?php foreach ($parent_params['children'] as $name => $url): ?>
						<?php if ( empty($page_auth[$url]) || $this->ion_auth->in_group($page_auth[$url]) ): ?>
						<?php $child_active = ($current_uri==$url); ?>
						<li <?php if ($child_active) echo 'class="active"'; ?>>
							<a href='<?php echo site_url($url); ?>'><em class='fa fa-circle-o'></em> <?php echo $name; ?></a>
						</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</li>

		<?php endif; ?>
		<?php endif; ?>

	<?php endforeach; ?>
	
	<?php if ( !empty($useful_links) ): ?>
		<li class="header">USEFUL LINKS</li>
		<?php foreach ($useful_links as $link): ?>
			<?php if ($this->ion_auth->in_group($link['auth']) ): ?>
			<li>
				<a href="<?php echo starts_with($link['url'], 'http') ? $link['url'] : base_url($link['url']); ?>" target='<?php echo $link['target']; ?>'>
					<em class="fa fa-circle-o <?php echo $link['color']; ?>"></em> <?php echo $link['name']; ?>
				</a>
			</li>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

</ul>
