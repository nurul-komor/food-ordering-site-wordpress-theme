<?php

/**
 *  Template Name: Items
 */
?>
<?php wp_head(); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<body>
    <?php include('navbar.php') ?>
    <h2 class="text-center">Items</h2>
    <Br>
    <Br>
    <Br>
    <div class="container ">
        <div class="row">
            <div class="col-md-3">
                Categories:
                <ul>
                    <?php
                    $categories =   get_categories(['texonomy' => 'product_categories',  'hide_empty' => false,]);

                    ?>
                    <?php foreach ($categories as $category) : ?>
                    <?= '<li><a href="' . get_term_link($category) . '">' . $category->name . '</a></li>'; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="custom-posts col-md-3">
                        <?php
                        $args = array(
                            'post_type' => 'products', // Replace 'books' with your custom post type name
                            'posts_per_page' => -1 // -1 to show all posts, you can set a specific number
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                        ?>

                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top"
                                src="<?= wp_get_attachment_url(get_post_meta(get_the_id(), 'thumbnail', true)) ?>"
                                alt="<?= wp_get_attachment_url(get_post_meta(get_the_id(), 'thumbnail', true)) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= the_title() ?></h5>
                                <p class="card-text"><?= the_content() ?></p>
                                <div class="flex justify-content-between">
                                    <p>Price: <?= get_post_meta(get_the_id(), 'price', true) ?></p>
                                    <p>
                                        Size: <?= get_post_meta(get_the_id(), 'size', true) ?>
                                    </p>
                                </div>
                                <script>
                                $("#addToCart").on('submit', function(e) {
                                    e.preventDefault();
                                });
                                </script>
                                <form id="addToCart">
                                    <input type="hidden" name="food_id" value="<?= get_the_id() ?>" />
                                    <button class="btn btn-primary">Add To Cart</button>
                                </form>
                            </div>
                        </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        else :
                            echo 'No posts found';
                        endif;
                        ?>
                    </div>


                </div>
            </div>
            <div class="col-md-3">
                Cart:
            </div>
        </div>
    </div>
</body>
<?php wp_footer(); ?>