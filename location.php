<?php
require_once 'header.php';
?>

<content>
    <div class="location-page">
        <div class="container">
            <div class="map">
                <div style="position:relative;overflow:hidden;">
                    <div class="loading-circle">
                        <div class="lds-ring">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <iframe src="https://yandex.ru/map-widget/v1/-/CCUJnSDhCD" width="100%" height="600" frameborder="0" allowfullscreen="true" style="position:relative;">
                    </iframe>
                </div>
            </div>
    
            <div class="contacts">
                <div class="address">
                    <p class="contact-title">Адрес</p>
                    <p>Котовск, улица Посконкина, 2А</p>
                </div>
                <div class="phone-number">
                    <p class="contact-title">Номер телефона</p>
                    <p>8 (800) 770-79-99</p>
                </div>
                <div class="email">
                    <p class="contact-title">Email</p>
                    <p>copy-star@yandex.ru</p>
                </div>
            </div>
        </div>
    </div>
</content>

<?php
require_once 'footer.php';
?>