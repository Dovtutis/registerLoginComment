<main>
    <article>
        <div id="main-page-image-container"></div>
        <div class="container800">
            <div id="services-container">
                <div class="service-card">
                    <img src="./assets/crossfit.jpg" alt="crossfit">
                    <h4>Crossfit</h4>
                    <p>More than a workout, CrossFit is a lifestyle and the world's leading platform for
                        their health and fitness through effective training and nutritional strategies.
                    </p>
                </div>
                <div class="service-card">
                    <img src="./assets/gym.jpg" alt="crossfit">
                    <h4>Gym</h4>
                    <p>A gym - physical exercises and activities performed inside, often using equipment,
                        especially when done as a subject at school.
                    </p>
                </div>
                <div class="service-card">
                    <img src="./assets/yoga.jpg" alt="crossfit">
                    <h4>Yoga</h4>
                    <p>Yoga: A relaxing form of exercise that was developed in India and involves assuming and
                        holding postures that stretch the limbs and muscles
                    </p>
                </div>
            </div>
        </div>
        <div id="index-map-container"></div>
    </article>
</main>
<footer>
    <div id="index-footer-container">
        © 2021. Dovydas Tutinas, all rights reserved.
    </div>
</footer>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXC16cM8Abdvn9z1kLu6n320eJMudnse8&callback=initMap&libraries=&v=weekly" async></script>
<script>

    function initMap() {
        const location = {lat: 54.7229221, lng: 25.3371089};
        const map = new google.maps.Map(document.getElementById("index-map-container"), {
            zoom: 15,
            center: location,
        });
        const marker = new google.maps.Marker({
            position: location,
            map: map,
        });
    }
</script>