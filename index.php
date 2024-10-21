<?php
include_once 'include/init.php';
if (isset($_SESSION['notification']) && isset($_SESSION['notification']['connexion'])) {
    $notification = "<p class='col-12 ta-center bg-" . $_SESSION['notification']['connexion']['type'] . "'>" . $_SESSION['notification']['connexion']['content'] . "</p>";
}
include_once 'include/header.php';

echo $notification;
?>
<section class=" mt-40 mb-40">
    <div class="mb-10 center">Terrains mis en avant</div>
    <h3 class="mb-30 center ">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Beatae velit
        voluptatibus
        laboriosam.</h3>
    <div class="swiper carousel-terrain">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="item">
                    <div class="image">
                        <img src="images/terrain1.jpg" alt="">
                    </div>
                    <div class="meta">
                        <p class="badge yellow">Pelouse</p>
                    </div>
                    <h3 class="mb-10">Stade des Champions</h3>
                    <p class="mb-10"><i class="fa-solid fa-map-pin"></i>123 Rue des champs</p>
                    <p class="bold yellow">100$/heure</p>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item">
                    <div class="image">
                        <img src="images/terrain1.jpg" alt="">
                    </div>
                    <div class="meta">
                        <p class="badge yellow">Pelouse</p>
                    </div>
                    <h3 class="mb-10">Stade des Champions</h3>
                    <p class="mb-10"><i class="fa-solid fa-map-pin"></i>123 Rue des champs</p>
                    <p class="bold yellow">100$/heure</p>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item">
                    <div class="image">
                        <img src="images/terrain1.jpg" alt="">
                    </div>
                    <div class="meta">
                        <p class="badge yellow">Pelouse</p>
                    </div>
                    <h3 class="mb-10">Stade des Champions</h3>
                    <p class="mb-10"><i class="fa-solid fa-map-pin"></i>123 Rue des champs</p>
                    <p class="bold yellow">100$/heure</p>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item">
                    <div class="image">
                        <img src="images/terrain1.jpg" alt="">
                    </div>
                    <div class="meta">
                        <p class="badge yellow">Pelouse</p>
                    </div>
                    <h3 class="mb-10">Stade des Champions</h3>
                    <p class="mb-10"><i class="fa-solid fa-map-pin"></i>123 Rue des champs</p>
                    <p class="bold yellow">100$/heure</p>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="item">
                    <div class="image">
                        <img src="images/terrain1.jpg" alt="">
                    </div>
                    <div class="meta">
                        <p class="badge yellow">Pelouse</p>
                    </div>
                    <h3 class="mb-10">Stade des Champions</h3>
                    <p class="mb-10"><i class="fa-solid fa-map-pin"></i>123 Rue des champs</p>
                    <p class="bold yellow">100$/heure</p>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<section class="col-12 row bg-yellow height mb-50 ">
    <div class="col-4 jc-spaceBetween">
        <p class="margin-50 white">How it Works</p>
        <p class="margin-50 white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus aperiam quam maiores hic at?
            Temporibus dignissimos officia ducimus dolore laudantium.</p>
    </div>
    <div class="col-4 jc-spaceBetween">
        <div class="cadre height-50 margin-30 transform-scale">
            <p class="pb-20 bold">Trouver un terrain</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis impedit perferendis rerum dignissimos non beatae, quidem esse iusto labore, necessitatibus enim ratione illo! Doloribus earum culpa, veniam sequi molestiae cum?</p>
        </div>
        <div class="cadre height-50 margin-30 transform-scale">
            <p class="pb-20 bold">Compléter le formulaire de réservation</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis impedit perferendis rerum dignissimos non beatae, quidem esse iusto labore, necessitatibus enim ratione illo! Doloribus earum culpa, veniam sequi molestiae cum?</p>
        </div>
    </div>
    <div class="col-4 jc-spaceBetween">
        <div class="cadre height-50 margin-30 transform-scale">
            <p class="pb-20 bold">Recevez un mail de confirmation</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis impedit perferendis rerum dignissimos non beatae, quidem esse iusto labore, necessitatibus enim ratione illo! Doloribus earum culpa, veniam sequi molestiae cum?</p>
        </div>
        <div class="cadre height-50 margin-30 transform-scale">
            <p class="pb-20 bold">Enjoy Your Game</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nobis impedit perferendis rerum dignissimos non beatae, quidem esse iusto labore, necessitatibus enim ratione illo! Doloribus earum culpa, veniam sequi molestiae cum?</p>
        </div>
    </div>
</section>
<?php
include_once 'include/footer.php';
unset($_SESSION['notification']['connexion']);
