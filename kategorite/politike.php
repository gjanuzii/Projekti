<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once '../forma/Database.php';

$db = new Database();

function displayCategorySlider($category, $subcategory, $link)
{
    global $db;

    // Use prepared statements for security
    $sql = "SELECT id, image_url, title, category, subcategory, author FROM news_db WHERE category = ? AND subcategory = ? ORDER BY id DESC LIMIT 6";
    $stmt = $db->conn->prepare($sql);
    $stmt->bind_param('ss', $category, $subcategory);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div class="' . strtolower($subcategory) . '-slider">';
        echo '<section class="ktg_slider_container">';
        echo '<div class="' . strtolower($subcategory) . '-text">';
        echo '<h1 class="' . strtolower($subcategory) . '_sliderH1">';
        
        // Adjust the category name based on subcategory
        if ($subcategory === 'ks') {
            echo 'Kosove';
        } elseif ($subcategory === 'bp') {
            echo 'Bote';
        }
        
        echo '</h1>';
        echo '</div>';
        echo '<div class="container">';
        echo '<div class="swiper card_slider">';
        echo '<div class="swiper-wrapper">';

        while ($row = $result->fetch_assoc()) {
            // Step 3: Ensure correct image paths
            echo '<div class="swiper-slide">';
            echo '<a href="../news_detail.php?id=' . $row['id'] . '" class="news-link">'; // Added link
            echo '<img src="../images/' . $row['image_url'] . '" alt="' . $row['title'] . '" class="slider-image">';
            echo '<div class="tSlider-text">';
            echo '<h2>' . $row['title'] . '</h2>';
            echo '<h3>' . $row['author'] . '</h3>'; // Change 'subcategory' to 'author'
            echo '</div>';
            echo '</a>'; // Closing the anchor tag
            echo '</div>';
        }

        echo '</div>';
        echo '<div class="swiper-pagination"></div>';
        echo '</div>';
        echo '</div>';
        echo '</section>';
        echo '</div>';
    } else {
        echo "<p>No news found for $category and $subcategory</p>";
    }

    $stmt->close();
}


$userMessage = '';
if (isset($_SESSION['id'], $_SESSION['name'])) {
    // Display a welcome message
    $userMessage = 'Je i lloguar si, ' . $_SESSION['name'] . '!';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Politike</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../style.css">

    <style>
        /* Politike */
        
    .ks-slider{
    margin: 0;
    margin-top: 100px;
    padding-top: 35px;
    padding-bottom: 30px;
    background: white;
    height: 370px;
    max-height: 370px;
    }




    .ks_htext{
    display: flex;
    flex-direction: row;
    }

    .ks_sliderH1{
    margin-left: 5%;
    color: #50577A;
    cursor: pointer;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    font-weight: bold;
    font-size: 30px;
    }

    .ks_slider_container .container{
    padding: 0 15px;
    max-width: 1230px;
    margin: 0 auto;
    margin-top: -4%;
    }

    .card_slider{
    padding: 50px 0;
    }

    .swiper-slide{
    flex: 0 0 auto;
    width: 300px;
    cursor: pointer;
    margin-top: 4%;
    }

    .slider-image{
    width: 100%;
    height: auto;
    border: 2px solid white;
    border-radius: 20px;
    }

    .tSlider-text{
    margin-top: -15px;
    text-align: left;
    padding: 3px;
    background-color: #f5f5f504;
    color: black;
    }

    .tSlider-text h2{
    font-size: 20px;
    height: 100%;
    }


    .bp_sliderH1{
        margin-left: 5%;
        color: #50577A;
        cursor: pointer;
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        font-weight: bold;
        font-size: 30px;
        }
    </style>

</head>

<body>

    <header>
        <div class="logo">Portal News</div>
        <div class="hamburger">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li>
                    <a href="../index.php" class="hA">Home</a>
                </li>
                <li>
                    <a href="bote.php" class="hA">Bote</a>
                </li>
                <li>
                    <a href="politike.php" class="hA">Politike</a>
                </li>
                <li>
                    <a href="sport.php" class="hA">Sport</a>
                </li>
                <li>
                    <a href="showbiz.php" class="hA">Showbiz</a>
                </li>
            </ul>
        </nav>
    </header>

    <section class="P_main-section">
        <div class="P_content">
            <p class="P_p">Portal News:</p>
            <h1 class="P_h1">Debat i ashper ne kuvend, opozita dhe pozita me akuza te renda ndaj njera-tjetres</h1>
        </div>
    </section>

    <?php
    displayCategorySlider("Politike", "ks", "kategorite/politike_detail.php");
    displayCategorySlider("Politike", "bp", "kategorite/politike_detail.php");
    ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="fcontainer">
            <div class="footer-section about">
                <h3 class="fH3">Rreth Nesh</h3>
                <p class="about-text">News Portal eshte portal lajmesh i krijuar ne maj te vitit 2019. Sot me nje staf
                    prej 12 anetaresh punojme 24/7 qe tiu sjellim lajmet me te reja.</p>
            </div>
            <div class="footer-section links">
                <h3 class="fH3">Faqet</h3>
                <ul class="links-list">
                    <li><a class="f-li" href="../index.php">Home</a></li>
                    <li><a class="f-li" href="bote.php">Bote</a></li>
                    <li><a class="f-li" href="politike.php">Politike</a></li>
                    <li><a class="f-li" href="sport.php">Sport</a></li>
                    <li><a class="f-li" href="showbiz.php">Showbiz</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3 class="fH3">Kontaktet</h3>
                <p class="address">Rr. Mbreteresha Teute, Mitrovice</p>
                <p class="email">Email: newsP@ubt-uni.net</p>
                <p class="phone">Phone: +1234567890</p>
                <div class="social-links">
                    <a href="https://www.facebook.com" class="social-icon"><img class="footer-img"
                            src="../images/fcb.png" alt="Facebook"></a>
                    <a href="https://www.twitter.com" class="social-icon"><img class="footer-img"
                            src="../images/twitter.png" style="margin-bottom: 3px;" alt="Twitter"></a>
                    <a href="https://www.instagram.com" class="social-icon"><img class="footer-img"
                            src="../images/insta.png" style="width: 45px; height: 30px;" alt="Instagram"></a>
                </div>
            </div>
            <div class="footer-section newsletter">
                <h3 class="fH3">Kyqu Ne Llogari</h3>
                <!-- Display welcome message or login button -->
                <?php echo isset($_SESSION['id'], $_SESSION['name']) ? '<p>Je i lloguar si, ' . $_SESSION['name'] . '!</p>' : '<a href="forma/forma.php"><button class="subscribe-btn">Llogohu</button></a>'; ?>
                <a href="../forma/forma.php"><button class="subscribe-btn" style="margin-top: 8px">Llogohu</button></a>
            </div>
        </div>
    </footer>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            hamburger = document.querySelector(".hamburger");
            let ballina = document.querySelector(".P_main-section");
            let initialMarginTop = ballina.style.marginTop;

            hamburger.onclick = function () {
                navBar = document.querySelector(".nav-bar");
                navBar.classList.toggle("active");
            }
        });

        var swiper = new Swiper(".card_slider", {
            spaceBetween: 40,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                960: {
                    slidesPerView: 4,
                },
                2024: {
                    slidesPerView: 4,
                },
            },
        });
    </script>

</body>

</html>
