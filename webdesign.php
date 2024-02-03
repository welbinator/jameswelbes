<?php include "includes/header.php"; ?>

<div class="container-fluid photos">
  <h2 id="homeH2" class="text-white mb-4 text-center" data-aos="fade-up">Website Design Portfolio</h2><br>
  <div class="row align-items-stretch">



    <?php
    $query = "SELECT * FROM portfolio";
    $select_all_portfolios_query = mysqli_query($connection, $query);
    $portfolio_count = mysqli_num_rows($select_all_portfolios_query);
    $count = 1;
    while ($row = mysqli_fetch_assoc($select_all_portfolios_query)) {

      $portfolio_title = $row['portfolio_title'];
      $portfolio_tagline = $row['portfolio_tagline'];
      $portfolio_image = $row['portfolio_image'];
      $portfolio_id = $row['portfolio_id'];






    ?>


      <div class="col-6 col-md-6 col-lg-<?php randCol($count); ?>" data-aos="fade-up">
        <a data-fancybox="gallery" href="images/<?php echo $portfolio_image; ?>" class="d-block photo-item">
          <img loading="lazy" src="images/thumbnails/<?php echo $portfolio_image ?>" alt="Image" class="img-fluid">
          <div class="photo-text-more">
            <div class="photo-text-more">
              <h3 class="heading"><?php echo $portfolio_title ?></h3>
              <span class="meta"><?php echo $portfolio_tagline ?></span>

            </div>
          </div>
        </a>
      </div>


    <?php $count++;
    }

    ?>

  </div> <!-- row align-items-stretch -->
</div> <!-- container-fluid photos -->
<?php include "includes/footer.php"; ?>