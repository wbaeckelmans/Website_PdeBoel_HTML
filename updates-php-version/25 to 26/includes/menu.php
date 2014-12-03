<?php

$menu_def = '<?xml version="1.0" encoding="UTF-8"?>
<menu>
  <menu_item href="index.php" label="Home">
    <menu_item href="index.php" label="Home Version 1"></menu_item>
    <menu_item href="index-2.php" label="Home Version 2"></menu_item>
  </menu_item>
  <menu_item href="about-us.php" label="Templates">
  	<menu_item href="about-us.php" label="About Us"></menu_item>
    <menu_item href="services.php" label="Services"></menu_item>
	<menu_item href="testimonials.php" label="Testimonials"></menu_item>
	<menu_item href="sitemap.php" label="Sitemap"></menu_item>
	<menu_item href="404-error-page.php" label="404 Error Page"></menu_item>
	<menu_item href="search-results.php" label="Search Results"></menu_item>
	<menu_item href="full-width-page.php" label="Full Width Page"></menu_item>
	<menu_item href="page-right-sidebar.php" label="Page with Right Sidebar"></menu_item>
	<menu_item href="page-left-sidebar.php" label="Page with Left Sidebar"></menu_item>
	<menu_item href="#" label="Multi-Level Drop-Down">
		<menu_item href="#" label="Drop-Down Example"></menu_item>
		<menu_item href="#" label="Multi-Level Drop-Down">
			<menu_item href="#" label="Drop-Down Example"></menu_item>
			<menu_item href="#" label="Drop-Down Example"></menu_item>
			<menu_item href="#" label="Drop-Down Example"></menu_item>
		</menu_item>
		<menu_item href="#" label="Drop-Down Example"></menu_item>
	</menu_item>
  </menu_item>
  <menu_item href="elements.php" label="Features">
    <menu_item href="elements.php" label="Elements"></menu_item>
    <menu_item href="grid-columns.php" label="Grid Columns"></menu_item>
    <menu_item href="pricing-tables.php" label="Pricing Tables"></menu_item>
    <menu_item href="images.php" label="Images"></menu_item>
    <menu_item href="video.php" label="Video"></menu_item>
  </menu_item>
  <menu_item href="portfolio.php" label="Portfolio">
    <menu_item href="portfolio.php" label="Portfolio"></menu_item>
    <menu_item href="portfolio-item-slider.php" label="Portfolio Item &amp;ndash; Slider"></menu_item>
    <menu_item href="portfolio-item-image.php" label="Portfolio Item &amp;ndash; Image"></menu_item>
    <menu_item href="portfolio-item-embedded-video.php" label="Portfolio Item &amp;ndash; Embedded Video"></menu_item>
    <menu_item href="portfolio-item-self-hosted-video.php" label="Portfolio Item &amp;ndash; Self-Hosted Video"></menu_item>
  </menu_item>
  <menu_item href="blog.php" label="Blog">
    <menu_item href="blog.php" label="Blog Overview"></menu_item>
    <menu_item href="blog-post.php" label="Blog Post"></menu_item>
  </menu_item>
  <menu_item href="contact.php" label="Contact"></menu_item>
</menu>';


$current_page_name = get_current_page_name();
$menu = simplexml_load_string($menu_def);

if(!function_exists('translate_menu_label')){
    function translate_menu_label($label){
        return $label;
    }
}

function has_selected_child($root){
    global $current_page_name;
    $current_href = $root->attributes()->href;
    if($current_href == $current_page_name){
        return true;
    }else{
        $found = false;
        $children = $root->children();
        if(count($children)>0){
            foreach($children as $child){
                $found = has_selected_child($child);
                if($found){
                    break;
                }
            }
        }
        return $found;
    }
}

function render_main_menu($root, $index=0, $level=0) {
    $children = $root->children();
    $has_children = count($children)>0;
    if($root->getName() == 'menu'){
        echo '<ul id="navlist" class="clearfix">';
        foreach($children as $child){
            $index++;
            render_main_menu($child, $index, $level+1);
        }
        echo '</ul>';
    }else{
        echo is_array($children);
        $href = $root->attributes()->href;
        $label = translate_menu_label((string)$root->attributes()->label);
        $child_menu_id = $has_children? 'submenu'.$index : '';
        $li_class = ($level == 1 && has_selected_child($root))?' class="current"':'';
        $li_rel = $has_children?' data-rel="'.$child_menu_id.'"' : '';
        echo '<li'.$li_class.'><a href="'.$href.'"'.$li_rel.'>'.$label.'</a>';
        if($has_children){
            echo '<ul id="'.$child_menu_id.'" class="ddsubmenustyle">';
            foreach($children as $child){
                $index++;
                render_main_menu($child, $index, $level+1);
            }
            echo '</ul>';
        }
        echo '</li>';
    }
}

function render_sitemap($root) {
    $children = $root->children();
    $has_children = count($children)>0;
    if($root->getName() == 'menu'){
        echo '<ul class="arrow">';
        foreach($children as $child){
            render_sitemap($child);
        }
        echo '</ul>';
    }else{
        echo is_array($children);
        $href = $root->attributes()->href;
        $label = translate_menu_label((string)$root->attributes()->label);
        echo '<li><a href="'.$href.'">'.$label.'</a>';
        if($has_children){
            echo '<ul>';
            foreach($children as $child){
                render_sitemap($child);
            }
            echo '</ul>';
        }
        echo '</li>';
    }
}

function get_current_page_name(){
    $page_name = substr(strrchr($_SERVER['REQUEST_URI'], "/"), 1);
    if(strrpos($page_name, ".php") === false){
        return 'index.php';
    }else{
        $page_name = substr($page_name, 0, strrpos($page_name, ".php")+4);
        return $page_name;
    }
}

function print_main_menu(){
    global $menu;
    render_main_menu($menu);
}

function print_sitemap(){
    global $menu;
    render_sitemap($menu);
}
