<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | ShoeLand</title>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- For Header icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"
        crossorigin="anonymous"></script>
</head>

<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; box-sizing: border-box;">

    <script>
        // Function to toggle the theme between light and dark mode
        function toggleTheme() {
            document.body.classList.toggle('dark-mode');
        }
    </script>
    <style>
        /* Dark Mode Styles */
        .dark-mode {
            background-color: #1e1e1e;
            color: #f0f0f0;
        }

        .dark-mode header {
            background-color: #333333;
            color: #f0f0f0;
        }

        .dark-mode h1,
        .dark-mode h2,
        .dark-mode p,
        .dark-mode a {
            color: #f0f0f0;
        }

        .dark-mode a {
            color: #ff7849;
        }

        .dark-mode .contact-info i,
        .dark-mode .fas,
        .dark-mode .fab {
            color: #ff7849;
        }

        .dark-mode .form-container {
            background: linear-gradient(135deg, #333, #222);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
        }

        .dark-mode .form-container input,
        .dark-mode .form-container textarea {
            background-color: #333;
            color: #f0f0f0;
            border: 1px solid #444;
        }

        .dark-mode .form-container button {
            background-color: #ff7849;
            background-image: linear-gradient(135deg, #ff7849, #ff5733);
        }

        .dark-mode footer {
            background-color: #333;
            color: #f0f0f0;
        }

        .dark-mode footer a {
            color: #ff7849;
        }

        .dark-mode #map {
            filter: grayscale(100%);
        }
    </style>



    <!-- Header Section -->
    <?php include '../includes/header.php'; ?>

    <!-- Main Section -->
    <main style="padding: 20px; text-align: center;">
        <h1 style="color: #ff5733;">Welcome to Shoe Land</h1>

        <!-- Contact Info Section -->
        <div class="contact-info"
            style="display: flex; flex-wrap: wrap; justify-content: space-around; align-items: center; margin: 20px 0; padding: 10px;">
            <div class="contact-item" style="display: flex; align-items: center; margin: 10px;">
                <i class="fas fa-map-marker-alt" style="font-size: 20px; margin-right: 10px; color: #ff5733;"></i>
                <p style="margin: 0;">123 Shoe Land St.,</p>
                <p style="margin: 0;">City, Country</p>
            </div>
            <div class="contact-item" style="display: flex; align-items: center; margin: 10px;">
                <i class="fas fa-phone-alt" style="font-size: 20px; margin-right: 10px; color: #ff5733;"></i>
                <p style="margin: 0;">+94 77 123 4567</p>
            </div>
            <div class="contact-item" style="display: flex; align-items: center; margin: 10px;">
                <i class="fas fa-envelope" style="font-size: 20px; margin-right: 10px; color: #ff5733;"></i>
                <p style="margin: 0;">info@shoeland.com</p>
            </div>
        </div>

        <!-- Container for Map and Form -->
        <div
            style="display: flex; flex-wrap: wrap; justify-content: space-around; align-items: flex-start; margin: 20px auto; max-width: auto;">

            <!-- Google Map -->
            <div id="map" style="width: 25%; height: 300px; margin: 10px; padding: 60px;"></div>

            <!-- Contact Form -->
            <div class="form-container"
                style="width: 25%; margin: 60px; padding: 60px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); margin-right:200px">
                <h2
                    style="text-align: center; color: #ff5733; font-family: 'Arial', sans-serif; font-size: 2rem; margin-bottom: 20px;">
                    Contact Us</h2>
                <form>
                    <!-- Name Input -->
                    <input type="text" placeholder="Your Name" required
                        style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; font-size: 1.1rem; font-family: 'Arial', sans-serif; box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);">

                    <!-- Email Input -->
                    <input type="email" placeholder="Your Email" required
                        style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; font-size: 1.1rem; font-family: 'Arial', sans-serif; box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);">

                    <!-- Message Textarea -->
                    <textarea rows="5" placeholder="Your Message" required
                        style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 8px; font-size: 1.1rem; font-family: 'Arial', sans-serif; box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);"></textarea>

                    <!-- Submit Button -->
                    <button type="submit"
                        style="width: 100%; padding: 10px; background-color: #ff5733; background-image: linear-gradient(135deg, #ff7849, #ff5733); color: white; font-size: 1.2rem; border: none; border-radius: 8px; cursor: pointer; font-family: 'Arial', sans-serif; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); transition: background 0.3s ease;">
                        Send Message
                    </button>
                </form>
            </div>


        </div>

        </div>
    </main>

    <!-- Google Maps Script -->
    <script>
        function initMap() {
            var location = { lat: 7.2008, lng: 79.8737 };  // Coordinates for 23 Alles Road, Negombo
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMw3plZxjdhXCNoGk5MYQi-AVLHl8KmGk&callback=initMap"
        async defer></script>

    <!-- Footer Section -->
    <!-- Import header -->
    <?php include '../includes/footer.php'; ?>

</body>

</html>