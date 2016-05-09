<!-- <div class="container">    
  <div class="jumbotron">
		<div class="row">
		    <a href="<?php echo URL; ?>film">		    
			    <div class="col-md-15 col-sm-3 film">
					
			    </div>
			</a>		    
			<a href="<?php echo URL; ?>serie">		    
			    <div class="col-md-15 col-sm-3 serie">
					
			    </div>
			</a>		    
			<a href="<?php echo URL; ?>musique">		    
			    <div class="col-md-15 col-sm-3 musique">
					
			    </div>
			</a>		    
			<a href="<?php echo URL; ?>bd">		    
			    <div class="col-md-15 col-sm-3 bd">
					
			    </div>
			</a>
		    <a href="<?php echo URL; ?>jeu">		    
			    <div class="col-md-15 col-sm-3 jeu">
					
			    </div>
			</a>
		</div>
  </div>
</div> -->
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <h1 class="lead">Tur-Fu Shop</h1>
                <img class="img-responsive" src="public/images/meme.jpg" alt="">
            </br>
                <div class="list-group">
                <?php foreach ($this->categorie as $cat): ?>
                    <a href="#" class="list-group-item"><?=$cat->nom ?></a>
                <?php endforeach ?>    
                </div>
            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="public/images/slide1.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="public/images/slide2.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="public/images/slide3.jpg" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

                 <?php 
                     $row=0;
                     $div=true;
                     foreach ($this->produits as $prod): 
                        if (($div) AND ($row%3==0)) {
                            $div = false;
                             echo '<div class="row">';
                        }
                    ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src="<?=$prod->url ?>" alt="">
                            <div class="caption">
                                <h4 class="pull-right"><?=$prod->prix ?> €</h4>
                                <h4><a href="#"><?=$prod->titre ?></a>
                                </h4>
                                <p><?=$prod->description ?></p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right"><?=$prod->stock ?></p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                        </div>
                    </div>

                <?php
                    $row= $row+1;
                    if (!($div) AND ($row%3==0)) {
                         echo '</div>';
                         $div= true;
                    }
                    endforeach 
                ?>  
            </div>

        </div>

    </div>
    <!-- /.container -->