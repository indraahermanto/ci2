<?php
$text   = "";
$module = $this->session->userdata('menus');
$url    = $this->url;
$select = "";
foreach ($module as $k_menu => $menu) {
  if(substr_count($current_uri, $menu->url)){
    $menu->select  = "active";
  }else $menu->select  = "";
  if(isset($menu->data) && count($menu->data) > 0){
    foreach ($menu->data as $k_men => $men) {
      if(substr_count($current_uri, $men->url)){
        $menu->select  = "active";
        $men->select  = "active";
      }else $men->select  = "";
      if(isset($men->data) && count($men->data) > 0){
        foreach ($men->data as $k_me => $me) {
          if(substr_count($current_uri, $me->url)){
            $menu->select  = "active";
            $men->select  = "active";
            $me->select  = "active";
          }else $me->select  = "";
          if(isset($me->data) && count($me->data) > 0){
            foreach ($me->data as $k_m => $m) {
              if(substr_count($current_uri, $m->url)){
                $menu->select  = "active";
                $men->select  = "active";
                $me->select  = "active";
                $m->select  = "active";
              }else $m->select  = "";
            }
          }
        }
      }
    }
  }
}
?>
<ul class="sidebar-menu">
  <li class="header"><?=$this->mUserPanel?></li>
  <li class="<?php if(count($url) == 1 && $url[1] == 'main') echo 'active' ?>">
    <a href="<?=site_url('main')?>"><em class="fa fa-home"></em> <span>Home</span></a>
  </li>
<?php
if(count($module) > 0){
  foreach ($module as $k_submodule => $submodule) {
    if(!isset($submodule->data)){
      $select = $submodule->select;
      if(substr($submodule->url, 0, 4) == 'main') $url_ext = $submodule->url;
      else $url_ext = "/".$submodule->url;
      $text .= "<li class='".$submodule->select."'>";
      $text .= "<a href='".site_url($url_ext)."'><em class='fa ".$submodule->class."'></em> <span>".ucwords($submodule->name)."</span></a>";
      $text .= "</li>";
    }else{
      $text .= "<li class='treeview ".$submodule->select."'>";
      $text .= "<a href='#''>";
      $text .= "<em class='fa ".$submodule->class."'></em> <span>".ucwords($submodule->name)."</span>";
      $text .= "<span class='pull-right-container'>";
      $text .= "<em class='fa fa-angle-left pull-right'></em>";
      $text .= "</span></a>";
      $text .= "<ul class='treeview-menu'> ";
      foreach ($submodule->data as $k_sub_a => $sub_a) {
        if(!isset($sub_a->data)){
          if(substr($submodule->url, 0, 4) == 'main') $url_ext = $sub_a->url;
          else $url_ext = "/".$sub_a->url;
          $text .= "<li class='".$sub_a->select."'><a href='".site_url($url_ext)."'><em class='fa ".$sub_a->class."'></em> ".ucwords($sub_a->name)."</a></li>";
        }else{
          $text .= "<li class='treeview ".$sub_a->select."'>";
          $text .= "<a href='#'><em class='fa ".$sub_a->class."'></em> ".ucwords($sub_a->name);
          $text .= "<span class='pull-right-container'>";
          $text .= "<em class='fa fa-angle-left pull-right'></em>";
          $text .= "</span></a>";
          $text .= "<ul class='treeview-menu'>";
          foreach ($sub_a->data as $k_sub_b => $sub_b) {
            if(!isset($sub_b->data)){
              if(substr($submodule->url, 0, 4) == 'main') $url_ext = $sub_b->url;
              else $url_ext = "/".$sub_b->url;
              $text .= "<li class='".$sub_b->select."'><a href='".site_url($url_ext)."'><em class='fa ".$sub_b->class."'></em> ".ucwords($sub_b->name)."</a></li>";
            }else{
              $text .= "<li class='treeview ".$sub_b->select."'>";
              $text .= "<a href='#'><em class='fa ".$sub_b->class."'></em> ".ucwords($sub_b->name);
              $text .= "<span class='pull-right-container'>";
              $text .= "<em class='fa fa-angle-left pull-right'></em>";
              $text .= "</span></a>";
              $text .= "<ul class='treeview-menu'>";
              foreach ($sub_b->data as $k_sub_c => $sub_c) {
                if(!isset($sub_c->data)){
                  if(substr($submodule->url, 0, 4) == 'main') $url_ext = $sub_c->url;
                  else $url_ext = "/".$sub_c->url;
                  $text .= "<li class='".$sub_c->select."'><a href='".site_url($url_ext)."'><em class='fa ".$sub_c->class."'></em> ".ucwords($sub_c->name)."</a></li>";
                }
              }
              $text .= "</ul></li>";
            }
          }
          $text .= "</ul></li>";
        }
      }
      $text .= "</ul></li>";
    }
  }
}

echo $text;