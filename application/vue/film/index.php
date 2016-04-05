<div class="container">

    <div class="jumbotron">
        <h1>Film</h1>
        <p>Ouverture prochaine</p>
        <ul>
        <?php foreach ($this->films as $prod): ?>
        		<li><?=$prod->titre ?></li>
        <?php endforeach ?>
        </ul>
    </div>

</div>
