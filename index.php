<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'forma/Database.php';

$db = new Database();

function displayCategorySlider($category, $buttonText, $link)
{
    global $db;

    // Step 1: Use prepared statements for security
    $sql = "SELECT id, image_url, title, category, subcategory, author FROM news_db WHERE category = ? ORDER BY id DESC LIMIT 6";
    $stmt = $db->conn->prepare($sql);
    $stmt->bind_param('s', $category);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Step 2: Output HTML and make sure paths to images are correct
        echo '<div class="' . strtolower($category) . '-slider">';
        echo '<section class="ktg_slider_container">';
        echo '<div class="' . strtolower($category) . '_htext">';
        echo '<a class="' . strtolower($category) . '_sliderH1" href="' . $link . '">';
        echo '<h1 class="' . strtolower($category) . '_sliderH1">' . strtoupper($category) . '</h1>';
        echo '</a>';
        echo '<a href="' . $link . '" class="btnHref">';
        // Step 3: Correct the button closing tag
        echo '<button class="' . strtolower($category) . '_sliderBtn" >' . $buttonText . ' →</button>';
        echo '</a>';
        echo '</div>';
        echo '<div class="container">';
        echo '<div class="swiper card_slider">';
        echo '<div class="swiper-wrapper">';

        while ($row = $result->fetch_assoc()) {
            // Step 3: Ensure correct image paths
            echo '<div class="swiper-slide">';
            echo '<a href="news_detail.php?id=' . $row['id'] . '" class="news-link">'; // Added link
            echo '<img src="images/' . $row['image_url'] . '" alt="' . $row['title'] . '" class="slider-image">';
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
        echo "<p>No news found for $category</p>";
    }
    // Step 5: Close the statement
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="style.css">
    
    
    
    <style>
      .bote-slider{
margin: 0;
margin-top: 100px;
padding-top: 35px;
padding-bottom: 30px;
background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
url("images/Bota_bg.jpg") center/cover no-repeat;
height: 370px;
max-height: 370px;
}


.btnHref{
color: white;
text-decoration: none;
}

.bote_htext{
display: flex;
flex-direction: row;
}

.bote_sliderH1{
margin-left: 45%;
color: white;
cursor: pointer;
font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
font-weight: bold;
font-size: 30px;
}

.bote_sliderBtn{
margin-top: 1%;
margin-left: 550px;
color: white;
cursor: pointer;
border: 3px solid white;
border-radius: 50px;
padding: 3px;
background-color: transparent;
height: 45px;
font-weight: bold;
font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}

.bote_sliderBtn:hover{
background-color: rgba(0, 0, 0, 0.420);
}


.bote_slider_container .container{
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
color: white;
}

.tSlider-text h2{
font-size: 20px;
height: 100%;
}


/*showbiz*/


.showbiz-slider{
  margin: 0;
  margin-top: 200px;
  padding-top: 35px;
  padding-bottom: 30px;
  background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
  url("images/Showbiz_bg.jpg") center/cover no-repeat;
  height: 370px;
  max-height: 370px;
  }
  
  
  .showbiz_htext{
  display: flex;
  flex-direction: row;
  }
  
  .showbiz_sliderH1{
  margin-left: 43%;
  color: white;
  cursor: pointer;
  font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
  font-weight: bold;
  font-size: 30px;
  }
  
  
  .showbiz_sliderBtn{
  margin-top: 1%;
  margin-left: 550px;
  color: white;
  cursor: pointer;
  border: 3px solid white;
  border-radius: 50px;
  padding: 3px;
  background-color: transparent;
  height: 45px;
  font-weight: bold;
  font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
  }
  
  .showbiz_sliderBtn:hover{
  background-color: rgba(0, 0, 0, 0.420);
  }

  .sport_sliderBtn{
    margin-left: 550px;
  }

  .politike_sliderBtn{
    margin-left: 550px;
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
                    <a href="index.html" class="hA">Home</a>
                </li>
                <li>
                    <a href="kategorite/bote.php" class="hA">Bote</a>
                </li>
                <li>
                    <a href="kategorite/politike.php" class="hA">Politike</a>
                </li>
                <li>
                    <a href="kategorite/sport.php" class="hA">Sport</a>
                </li>
                <li>
                    <a href="kategorite/showbiz.php" class="hA">Showbiz</a>
                </li>
            </ul>
        </nav>
    </header>

    <!--ballina-->
    <div class="ballina">
        <!--slideri-->
        <div class="slider">
            <div class="slider-container">
                <div class="slide">
                    <h1 class="h1S">Memli Krasniqi flet per kohen e tij si reper</h1>

                </div>
                <div class="slide">
                    <h1 class="h1S">Rritet numri i qytetareve qe nderrojne targat ne KS</h1>
                </div>
                <div class="slide">
                    <h1 class="h1S">Deshmitari ne Hage jep deshmine para prokurorit</h1>
                </div>
                <div class="slide">
                    <h1 class="h1S">Xherdan Shaqiri kthehet ne trajnim me Chicago pas lendimit</h1>
                </div>
            </div>
            <div class="btn-container">
                <button type="button" class="prevBtn">
                    <
                </button>
                <button type="button" class="nextBtn">
                    >
                </button>
            </div>
        </div>

        <!--left-->
        <div class="left">
            <h1 class="leftH">Me Te Rejat</h1>
            <div class="main-left">
                <div class="mini-left">
                    <img src="images/zielensky.jpg" alt="Image 1" class="mini-image">
                    <div class="mini-text">
                        <h2>Zielensky ne Argjentine</h2>
                        <p>Presidenti ukrainas pritet ta takoje presidentin Argjentinas</p>
                        <h3>Politike</h3>
                    </div>
                </div>
                <div class="mini-left">
                    <img src="images/lajmi2.jpg" alt="Image 2" class="mini-image">
                    <div class="mini-text">
                        <h2>Targat ks</h2>
                        <p>Rritet numri i ndrrimit te Targave</p>
                        <h3>Politike</h3>
                    </div>
                </div>
                <div class="mini-left">
                    <img src="images/lajmi1.png" alt="Image 1" class="mini-image">
                    <div class="mini-text">
                        <h2>Memli Krasniqi</h2>
                        <p>Memli Krasniqi flet per te kaluaren</p>
                        <h3>Politike</h3>
                    </div>
                </div>
                <div class="mini-left">
                    <img src="images/lajmi4.jpg" alt="Image 1" class="mini-image">
                    <div class="mini-text">
                        <h2>Shaqiri rikthehet</h2>
                        <p>Shaqiri rikthehet ne Chicago pas lendimit</p>
                        <h3>Sport</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--top lajemt slideri-->

    <div class="bg-slider">
        <section class="slider_container">
            <h1 class="sliderH1">ME TE REJAT</h1>
            <div class="container">
                <div class="swiper card_slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="images/lajmi4.jpg" alt="Image 1" class="slider-image">
                            <div class="tSlider-text">
                                <h2>Shaqiri rikthehet pas lendimit</h2>
                                <h3>Sport</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="images/zielensky.jpg" alt="Image 1" class="slider-image">
                            <div class="tSlider-text">
                                <h2>Zielensky Ne Argjentine</h2>
                                <h3>Politike</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="images/Tahiri.jpg" alt="Image 1" class="slider-image">
                            <div class="tSlider-text">
                                <h2>Tahiri akuzon Kurtin</h2>
                                <h3>Politike</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="images/fhoxha.png" alt="Image 1" class="slider-image">
                            <div class="tSlider-text">
                                <h2>Ylli i ri Dardan</h2>
                                <h3>Sport</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="images/konferenca.jpg" alt="Image 1" class="slider-image">
                            <div class="tSlider-text">
                                <h2>Strategjite diplomatike te Kosoves</h2>
                                <h3>Politike</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="images/lajmi4.jpg" alt="Image 1" class="slider-image">
                            <div class="tSlider-text">
                                <h2>Rritet numri i targave KS</h2>
                                <h3>Politike</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="images/messi.jpg" alt="Image 1" class="slider-image">
                            <div class="tSlider-text">
                                <h2>Dokumentar per Messin</h2>
                                <h3>Sport</h3>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <img src="images/lajmi1.png" alt="Image 1" class="slider-image">
                            <div class="tSlider-text">
                                <h2>Memli Krasniqi flet per te kaluaren</h2>
                                <h3>Politike</h3>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    </div>

    <?php
    displayCategorySlider('Bote', 'Shih Me Shume', 'kategorite/bote.php');
    displayCategorySlider('Politike', 'Shih Me Shume', 'kategorite/politike.php');
    displayCategorySlider('Sport', 'Shih Me Shume', 'kategorite/sport.php');
    displayCategorySlider('Showbiz', 'Shih Me Shume', 'kategorite/showbiz.php');
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
                    <li><a class="f-li" href="index.php">Home</a></li>
                    <li><a class="f-li" href="kategorite/bote.php">Bote</a></li>
                    <li><a class="f-li" href="kategorite/politike.php">Politike</a></li>
                    <li><a class="f-li" href="kategorite/sport.php">Sport</a></li>
                    <li><a class="f-li" href="kategorite/showbiz.php">Showbiz</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3 class="fH3">Kontaktet</h3>
                <p class="address">Rr. Mbreteresha Teute, Mitrovice</p>
                <p class="email">Email: newsP@ubt-uni.net</p>
                <p class="phone">Phone: +1234567890</p>
                <div class="social-links">
                    <a href="https://www.facebook.com" class="social-icon"><img class="footer-img" src="images/fcb.png"
                            alt="Facebook"></a>
                    <a href="https://www.twitter.com" class="social-icon"><img class="footer-img" src="images/twitter.png"
                            style="margin-bottom: 3px;" alt="Twitter"></a>
                    <a href="https://www.instagram.com" class="social-icon"><img class="footer-img" src="images/insta.png"
                            style="width: 45px; height: 30px;" alt="Instagram"></a>
                </div>
            </div>
            <div class="footer-section newsletter">
                <h3 class="fH3">Kyqu Ne Llogari</h3>
                <!-- Display welcome message or login button -->
                <?php echo isset($_SESSION['id'], $_SESSION['name']) ? '<p>Je i lloguar si, ' . $_SESSION['name'] . '!</p>' : '<a href="forma/forma.php"><button class="subscribe-btn">Llogohu</button></a>'; ?>
                <a href="forma/forma.php"><button class="subscribe-btn" style="margin-top: 8px">Llogohu</button></a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="index.js"></script>



</body>

</html>
