   <!-- Page Content -->
    <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Film
                    <small>du tur-fu !</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->

	 <?php 
	 $row=0;
	 $div=true;
	 foreach ($this->films as $prod): 
	 	if (($div) AND ($row%3==0)) {
	 		$div = false;
	 		 echo '<div class="row">';
	 	}
	 	?>
	 	 	<div class="col-md-4 portfolio-item">
                <a href="#">
                    <img class="img-responsive" src="public/images/produits/"<?=$prod->titre ?>".jpg" alt="">
                </a>
                <h3>
                    <a href="#"><?=$prod->titre ?></a>
                </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae.</p>
            </div>
	 	<?php
	 	$row= $row+1;
	 	if (!($div) AND ($row%3==0)) {
	 		 echo '</div>';
	 		 $div= true;
	 	}
        endforeach ?>        

        <hr>

        <!-- Pagination -->
        <div class="row text-center">
            <div class="col-lg-12">
                <ul class="pagination">
                    <li>
                        <a href="#">&laquo;</a>
                    </li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
                    <li>
                        <a href="#">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->