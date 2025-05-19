// JavaScript Logic for Video Loop
document.addEventListener("DOMContentLoaded", function () {
    const menVideo = document.getElementById("menCategoryVideo");
    const womenVideo = document.getElementById("womenCategoryVideo");
    const kidVideo = document.getElementById("kidCategoryVideo");

    // Function to start playing all videos
    function playAllVideos() {
        menVideo.play();
        womenVideo.play();
        kidVideo.play();
    }

    // Function to restart all videos
    function restartAllVideos() {
        menVideo.currentTime = 0;
        womenVideo.currentTime = 0;
        kidVideo.currentTime = 0;
        playAllVideos(); // Play all videos again
    }

    // Event listeners for when each video ends
    menVideo.addEventListener("ended", restartAllVideos);
    womenVideo.addEventListener("ended", restartAllVideos);
    kidVideo.addEventListener("ended", restartAllVideos);

    // Start playing all videos
    playAllVideos();
});

//  JavaScript Pop message for Subscribe to our newsletter 
document.getElementById('subscribeButton').addEventListener('click', function () {
    const email = document.getElementById('emailInput').value;

    if (email) {
        // Make an AJAX request to subscribe.php
        fetch('subscribe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email: email }),
        })
            .then(response => response.json())
            .then(data => {
                // Show success or error message
                if (data.success) {
                    Swal.fire({
                        title: 'Subscribed!',
                        text: 'Thank you for subscribing to our newsletter.',
                        icon: 'success',
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error',
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    title: 'Error!',
                    text: 'Something went wrong. Please try again later.',
                    icon: 'error',
                });
            });
    } else {
        Swal.fire({
            title: 'Warning!',
            text: 'Please enter a valid email address.',
            icon: 'warning',
        });
    }
});