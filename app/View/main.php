<div class="container">
   <label style="color: rgba(166,83,239,0.55)"><h1>Catalog</h1></label>
    <div class="card-deck">
        <?php foreach ($products as $product): ?>
        <div class="card text-center">
            <a href="#">
                <div class="card-header">
                    Hit!
                </div>
                <img class="card-img-top" src="<?php echo $product['image_link']; ?>" alt="Card image">
                <div class="card-body">
                    <p class="card-text text-muted"><label style="color: #050505"> <h1><?php echo $product['name']; ?></h1>> </label></p>
                    <a href="#"><h5 class="card-title">Very long item name</h5></a>
                    <div class="card-footer">
                        <label style="color: #111111"> <h1><?php echo $product['price']; ?></h1>> </label>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <a href="http://localhost:81/login"><button> <label style="color: blueviolet"><h1>Loqout</h1></button></label></a>
</div>

<style>
    body {
        font-style: sans-serif;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    h3 {
        line-height: 3em;
    }

    .card {
        max-width: 16rem;
    }

    .card:hover {
        box-shadow: 1px 2px 10px lightgray;
        transition: 0.2s;
    }

    .card-header {
        font-size: 13px;
        color: gray;
        background-color: white;
    }

    .text-muted {
        font-size: 11px;
    }

    .card-footer{
        font-weight: bold;
        font-size: 18px;
        background-color: white;
    }
</style>