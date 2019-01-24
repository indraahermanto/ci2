<div class="row">
	<div class="col-xs-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title" style="font-size:15px">Group Builder</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body" style="min-height: 450px;overflow:auto;overflow-x: hidden;">
				<div class="row">
					<!-- edit form column -->
					<div class="col-md-12 personal-info">
						<form method="POST" class="form-horizontal" role="form">
							<div class="col-lg-12">
								<h4>Group Information:</h4><br/>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Name : </label>
								<div class="col-lg-8">
									<input class="form-control" readonly type="text" value="<?=$group->name?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Tag Name : </label>
								<div class="col-lg-8">
									<input class="form-control" <?=$group->dis?> type="text" value="<?=$group->tag_name?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Description : </label>
								<div class="col-lg-8">
									<textarea name="inputDesc" <?=$group->dis?> class="form-control"><?=$group->description?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-3 control-label">Icon Class : </label>
								<div class="col-lg-8">
									<input class="form-control" <?=$group->dis?> type="text" value="<?=$group->layer_class?>">
								</div>
							</div>
							<hr>
							<div class="col-lg-12">
								<h4>Access Menu:</h4>
							</div>
							<div class="form-group">
								<div class="col-sm-10 col-sm-offset-1">
									<ol>
									<?php
									/*level 1*/
									foreach ($modules as $k_module => $module):
										$menu = $module;
										if(isset($menu->active) && $menu->active == 1) $check    = "checked";
										else $check = "";
										if(isset($menu->stat_v) && $menu->stat_v == 1) $visible  = "";
										else $visible  = "<b>{Hidden}</b>";
										if(!isset($menu->children)):
											$dis_tmp 			= $group->dis;
											if($menu->url == 'logout') $group->dis = "disabled";
											$checkbox 		= '<input '.$group->dis.' '.$check.' type="checkbox" name="inputModules[]" value="'.$menu->id.'"/>';
											$group->dis 	= $dis_tmp;
										else: $checkbox = ""; endif;
										$anchor 		= '<a href="'.site_url('settings/admin/modules/edit/'.$menu->id).'"><i class="fa fa-pencil"></i></a>';
										echo '<li>'.$checkbox.' <a href="'.site_url('settings/admin/modules/read/'.$menu->id).'">'.$menu->name."</a> ".$visible;

										if($checkbox != "") goto endLevel;
										/*level 2*/
										foreach ($menu->children as $k_childAlpa => $childAlpa):
											$menu = $childAlpa;
											echo "<ul>";
											if(isset($menu->active) && $menu->active == 1) $check    = "checked";
											else $check = "";
											if(isset($menu->stat_v) && $menu->stat_v == 1) $visible  = "";
											else $visible  = "<b>{Hidden}</b>";
											if(!isset($menu->children)) 
												$checkbox = '<input '.$group->dis.' '.$check.' type="checkbox" name="inputModules[]" value="'.$menu->id.'"/>';
											else $checkbox = "";
											$anchor 		= '<a href="'.site_url('settings/admin/modules/edit/'.$menu->id).'"><i class="fa fa-pencil"></i></a>';
											echo '<li>'.$checkbox.' <a href="'.site_url('settings/admin/modules/read/'.$menu->id).'">'.$menu->name."</a> ".$visible."</li>";
											if($checkbox != "") goto endLevelAlpha;
											/*level 3*/
											foreach ($menu->children as $k_childBeta => $childBeta):
												$menu = $childBeta;
												echo "<ul>";
												if(isset($menu->active) && $menu->active == 1) $check    = "checked";
												else $check = "";
												if(isset($menu->stat_v) && $menu->stat_v == 1) $visible  = "";
												else $visible  = "<b>{Hidden}</b>";
												if(!isset($menu->children)) 
													$checkbox = '<input '.$group->dis.' '.$check.' type="checkbox" name="inputModules[]" value="'.$menu->id.'"/>';
												else $checkbox = "";
												$anchor 		= '<a href="'.site_url('settings/admin/modules/edit/'.$menu->id).'"><i class="fa fa-pencil"></i></a>';
												echo '<li>'.$checkbox.' <a href="'.site_url('settings/admin/modules/read/'.$menu->id).'">'.$menu->name."</a> ".$visible."</li>";
												if($checkbox != "") goto endLevelBeta;
												/*level 4*/
												foreach ($menu->children as $k_childCharly => $childCharly):
													$menu = $childCharly;
													echo "<ul>";
													if(isset($menu->active) && $menu->active == 1) $check    = "checked";
													else $check = "";
													if(isset($menu->stat_v) && $menu->stat_v == 1) $visible  = "";
													else $visible  = "<b>{Hidden}</b>";
													if(!isset($menu->children)) 
														$checkbox = '<input '.$group->dis.' '.$check.' type="checkbox" name="inputModules[]" value="'.$menu->id.'"/>';
													else $checkbox = "";
													$anchor 		= '<a href="'.site_url('settings/admin/modules/edit/'.$menu->id).'"><i class="fa fa-pencil"></i></a>';
													echo '<li>'.$checkbox.' <a href="'.site_url('settings/admin/modules/read/'.$menu->id).'">'.$menu->name."</a> ".$visible."</li>";
													if($checkbox != "") goto endLevelCharly;
													endLevelCharly:
													echo "</ul>";
												endforeach;
												endLevelBeta:
												echo "</ul>";
											endforeach;
											endLevelAlpha:
											echo "</ul>";
										endforeach;
										endLevel:
										echo "</li>";
									endforeach;
									?>
									</ol>
								</div>
							</div>
							<hr>
							<div class="col-xs-offset-10 col-xs-1">
								<button class="btn btn-flat btn-success btn-sm">
									Save
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.col -->
</div>