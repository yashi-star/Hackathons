<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping for Women - Shop For Women Clothes, Shoes, Bags & More</title>
    <link rel="shortcut icon" type="image/png" href="../Common Files/image/favicon.png">
    <link rel="stylesheet" href="../Common Files/style.css">
    <script src="https://kit.fontawesome.com/24c494a6b6.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Existing styles */

.image-container {
    text-align: center;
    padding: 150px;
}

#clickableImage {
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), border-color 0.3s ease-in-out;
    padding: 10px;
    cursor: pointer;
    border: 5px solid pink;
    border-radius: 15px;
}

#clickableImage:hover {
    transform: scale(1.05);
}

#clickableImage:active {
    transform: scale(0.95);
    border-color: hotpink;
}

.container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    width: 90%;
    margin: 20px auto;
}

.image-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    width: 100%;
    padding-bottom: 100%; /* Maintain square aspect ratio */
}

.image-wrapper img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
}

.image-wrapper:hover img {
    transform: scale(1.1);
    filter: blur(5px);
}

.buttons {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    padding: 10px 0;
}

.image-wrapper:hover .buttons {
    opacity: 1;
}

.button {
    background-color: #ff4081;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-right: 10px;
}

.button:hover {
    background-color: #e91e63;
}

/* Additional style for like counter */
.buttons p {
    color: white;
    margin: 0;
    font-size: 14px;
}

    </style>
</head>
<body>
    <!-- MENU BAR -->
    <header>
        <div id="logo">
            <img src="../Common Files/image/myntra-removebg-preview.png" alt="brandLogo" id="landingPage">
        </div>
        <ul id="nav_bar">
            <li><a href="../Homepages/menHomePage.html">men</a></li>
            <li><a href="../Homepages/index.html">women</a></li>
            <li><a href="#">kids</a></li>
            <li><a href="../Homepages/homeLiving.html">home & living</a></li>
            <li><a href="#">beauty</a></li>
            <li id="studio"><a href="#">studio</a><span>new</span></li>
        </ul> 
        <div id="search">
            <input type="text" id="search_bar" placeholder="Search for products, brands and more">
            <i class="fa-solid fa-magnifying-glass" id="search_icon"></i>
        </div>
        <div id="right_icon">
            <div id="reggDropdown">
                <!-- DROPDOWN MENU TO BE CREATED FOR LOGIN AND SIGNUP -->
              <div id="drop">
                  <a href="../Profile/profile.html" class="dropList">login</a>
                  <a href="../Profile/signup.html" class="dropList">sign up</a>
              </div>

              <i class="fa-regular fa-user"></i>
              <span>profile</span>
          </div>
            <div>
                <i class="fa-regular fa-heart"></i>
                <span>wishlist</span>
            </div>
            <div>
                <i class="fa-solid fa-bag-shopping"></i>
                <span>bag</span>
            </div>
        </div>

                <!-- TOGGLE MENU -->
                <div id="toggle">
                    <i class='bx bx-menu dropbtn' onclick="myFunction()"></i>
                    <div id="myDropdown" class="dropdown-content">
                        <div class="top">
                            <a href="menHomePage.html">men</a>
                            <a href="womenHomePage.html">women</a>
                            <a href="#">kids</a>
                            <a href="homeLiving.html">home & living</a>
                            <a href="#">beauty</a>
                            <a href="#">studio</a>
                        </div> 
                        <div class="bottom">
                            <i class="fa-regular fa-user fa_user" id="profile"></i>
                            <i class="fa-regular fa-heart fa_wishlist"></i>
                            <i class="fa-solid fa-bag-shopping fa_cart"></i>
                        </div>           
                    </div>
                </div>

    </header>

    <div class="image-container" style="padding-bottom: 0%;padding-left: 130px;">
        <a href="contest.html">
            <img id="clickableImage" src="Join Our Trend-Centric (1).png" alt="Join Our Trend-Centric" style="padding-left: 5px; transition: transform 0.3s ease-in-out; cursor: pointer;">
        </a>
    </div>
   
    <div class="container" style="padding: 0%;">
        
        
    </div>
    <?php

$conn = new mysqli("localhost","root","","myntra");
// Fetch and display images
$sql = "SELECT id, image_path, likes FROM photos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="container">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="image-wrapper">';
        echo '<img src="' . $row["image_path"] . '" alt="Uploaded Image">';
        echo '<div class="buttons">';
        echo '<form method="POST" action="vote.php">';
        echo '<input type="hidden" name="photo_id" value="' . $row["id"] . '">';
        echo '<button type="submit" name="like" class="button">Like</button>';
        echo '</form>';
        echo '<p>Likes: ' . $row["likes"] . '</p>';
        echo '</div></div>';
    }
    echo '</div>';
} else {
    echo "No images found.";
}
echo '<div class="image-container" style="padding-bottom: 0%;padding-left: 130px;padding-top:0%">
        <a href="winners.html">
            <img id="clickableImage" src="win.png" alt="Join Our Trend-Centric" style="padding-left: 5px; transition: transform 0.3s ease-in-out; cursor: pointer;">
        </a>
    </div>'
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['like'])) {
    $photo_id = $_POST['photo_id'];
    $update_likes_sql = "UPDATE photos SET likes = likes + 1 WHERE id = ?";
    $stmt = $conn->prepare($update_likes_sql);
    $stmt->bind_param("i", $photo_id);
    $stmt->execute();
    $stmt->close();
    header("Location: vote.php"); // Refresh the page to show updated like count
    exit();
}
?>
</body>
</html>
