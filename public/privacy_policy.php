<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="http://localhost:8888/ShoeLand-Ecommerce/assets/Shoeland.png" class="logo"/>
    <title>Privacy Policy | ShoeLand </title>
    <script src="../js/darkmode.js"></script>
</head>
<body>
    <!-- Header Section -->
    <?php include '../includes/header.php'; ?>

    <!-- Privacy Policy Section -->
    <section style="padding: 40px; text-align: center;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Privacy Policy for ShoeLand</h2>
        <div style="max-width: 800px; margin: 0 auto; text-align: left;">
            <p style="margin: 20px 0;"><strong>Effective Date:</strong> 2023 Jan </p>

            <div style="margin: 20px 0;">
                <strong style="color: #ff5733;">1. Information We Collect</strong>
                <p>We collect personal information that you provide directly, such as:</p>
                <ul style="list-style-type: disc; margin-left: 20px;">
                    <li>ShoeLand</li>
                    <li>info@shoeland.lk</li>
                    <li>Phone number</li>
                    <li>Shipping address</li>
                    <li>Payment information</li>
                </ul>
                <p>We also gather information automatically when you visit our website, including your IP address,
                    browser type, and pages visited.</p>
            </div>

            <div style="margin: 20px 0;">
                <strong style="color: #ff5733;">2. How We Use Your Information</strong>
                <p>Your information is used to:</p>
                <ul style="list-style-type: disc; margin-left: 20px;">
                    <li>Process orders and manage your account</li>
                    <li>Communicate with you about your orders</li>
                    <li>Improve our products and services</li>
                    <li>Send promotional materials and updates</li>
                </ul>
            </div>

            <div style="margin: 20px 0;">
                <strong style="color: #ff5733;">3. Sharing Your Information</strong>
                <p>We do not sell your personal information. We may share your information with:</p>
                <ul style="list-style-type: disc; margin-left: 20px;">
                    <li>Service providers who help us operate our business</li>
                    <li>Legal authorities if required by law</li>
                </ul>
            </div>

            <div style="margin: 20px 0;">
                <strong style="color: #ff5733;">4. Security of Your Information</strong>
                <p>We implement reasonable security measures to protect your information, but no method of transmission
                    or electronic storage is completely secure.</p>
            </div>

            <div style="margin: 20px 0;">
                <strong style="color: #ff5733;">5. Your Rights</strong>
                <p>You have rights regarding your personal information, including the right to:</p>
                <ul style="list-style-type: disc; margin-left: 20px;">
                    <li>Access the information we hold about you</li>
                    <li>Request corrections to inaccurate or incomplete information</li>
                    <li>Request the deletion of your personal information</li>
                </ul>
                <p>To exercise these rights, please contact us at <a href="mailto:infoshoeland@gmail.com"
                        style="color: #ff5733;">infoshoeland@gmail.com</a>.</p>
            </div>

            <div style="margin: 20px 0;">
                <strong style="color: #ff5733;">6. Cookies and Tracking Technologies</strong>
                <p>We use cookies to enhance your experience on our website. You can manage your cookie preferences
                    through your browser settings.</p>
            </div>

            <div style="margin: 20px 0;">
                <strong style="color: #ff5733;">7. Changes to This Privacy Policy</strong>
                <p>We may update this Privacy Policy periodically. We will notify you of any changes by posting the new
                    policy on this page.</p>
            </div>

            <div style="margin: 20px 0;">
                <strong style="color: #ff5733;">8. Contact Us</strong>
                <p>If you have any questions about this Privacy Policy, please contact us at:</p>
                <p><strong>ShoeLand</strong><br>
                    28A/1 Galle Road<br>
                    Colombo<br>
                    <strong>Email:</strong> <a href="mailto:infoshoeland@gmail.com"
                        style="color: #ff5733;">infoshoeland@gmail.com</a><br>
                    <strong>Phone:</strong> 0777777700
                </p>
            </div>
        </div>
    </section>
    <!-- Footer Section -->
    <?php include '../includes/footer.php'; ?>

    <style>
        body {
            margin: 0;
            transition: background-color 0.3s, color 0.3s;
            color: #000;
            /* Default text color */
        }
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
</body>
</html>