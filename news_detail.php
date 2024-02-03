<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>News Detail</title>
    <link rel="stylesheet" href="style.css">
    <!-- Add your CSS styles or link your stylesheet here if needed -->
    <style>
        /* Reset some default styles */
        body,
        h1,
        p {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            font-size: 16px;
        }

        /* News Detail Styles */
        .news-detail-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .detail-image {
            width: 100%;
            height: auto;
            border-bottom: 2px solid #ddd;
        }

        .news-details {
            padding: 20px;
            overflow: auto; /* Added overflow property */
        }

        .detH1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .detA {
            color: #666;
            margin-bottom: 10px;
        }

        .detD {
            line-height: 1.5;
        }

        @media only screen and (max-width: 600px) {
            .detail-container {
                padding: 10px;
            }

            .detH1 {
                font-size: 20px;
            }

            .detD {
                font-size: 14px;
            }

            .detA {
                font-size: 12px;
            }
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
                    <a href="index.php" class="hA">Home</a>
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
                    <a href="kategorite/politike.php" class="hA">Showbiz</a>
                </li>
            </ul>
        </nav>
    </header>

    <?php
    // Include your Database.php file to establish a database connection
    require_once 'forma/Database.php';

    // Check if 'id' parameter is provided in the URL
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $newsId = $_GET['id'];

        // Assuming you have a $db object for the database connection
        $db = new Database();

        // Fetch news details from the database based on the ID
        $stmt = $db->conn->prepare("SELECT * FROM news_db WHERE id = ?");
        $stmt->bind_param('i', $newsId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $newsDetails = $result->fetch_assoc();

            // Display news details
            echo '<div class="news-detail-container">';
            echo '<img src="images/' . $newsDetails['image_url'] . '" alt="' . $newsDetails['title'] . '" class="detail-image">';
            echo '<div class="news-details">';
            echo '<h1 class="detH1">' . $newsDetails['title'] . '</h1>';
            echo '<p class="detA">Author: ' . $newsDetails['author'] . '</p>';
            echo '<p class="detD">' . $newsDetails['text'] . '</p>';
            // Add more details as needed
            echo '</div>';
            echo '</div>';
        } else {
            echo '<p>News not found</p>';
        }

        // Close the statement
        $stmt->close();
    } else {
        echo '<p>Invalid news ID</p>';
    }
    ?>



<script>
document.addEventListener("DOMContentLoaded", function() {
  hamburger = document.querySelector(".hamburger");
  let news = document.querySelector(".news-detail-container");
  let initialMarginTop = news.style.marginTop; 

  if (news) {
      hamburger.onclick = function(){
          navBar = document.querySelector(".nav-bar");
          navBar.classList.toggle("active");
          
          if (navBar.classList.contains("active")) {
              news.style.marginTop = "350px"; 
          } else {
              news.style.marginTop = initialMarginTop; 
              
          }
      }
  } 
});
</script>

</body>

</html>
