<?php 
//Page: This page creates a custom searchform, overrides the built in wordpress search form
//MAINTAIN/ALWAYS use method="get" and action="home_url('/')" name="s" to avoid complications in your
//new searchform template  in  wordpress
?>
<!--this form returns the result in index.php by default
make a search.php if u want to have a unique/different php file output -->
<div class="search-container pull-right">
<form role="search" method="get" action="searchvideos.php" class="navbar-form form-inline">
	<input type="search" id="video-search" class="form-control" placeholder="Search Videos" 
	value="<?php echo get_search_query() ?>" name="s" title="Search" />
	<span><button class="btn btn-default" type="submit" value="submit"><span class="glyphicon glyphicon-search"><span></button></span>
</form>
</div>

<?php 
//function: home_url() - gets the home url, needs echo
//function: get_search_query() - returns the query string.
?>
