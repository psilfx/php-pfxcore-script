<?php defined( "exec" ) or die(); ?>
<?php
	$modelArticle  = $exec->GetModelByName( 'article' );
	$modelCategory = $exec->GetModelByName( 'category' );
	
	$article      = $modelArticle->GetArticleByName( 'ест' );
	$categories   = $modelArticle->GetArticleCategories( $article[ 'id' ] );
	$categories_d = $modelCategory->GetCategoriesByIds( $categories );
	$category     = $modelCategory->GetCategoryById( 1 );
	
	$exec->WriteTempData( 'category' , $category );
	//print_r( $category );
?>