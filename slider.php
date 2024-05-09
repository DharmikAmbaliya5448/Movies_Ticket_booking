<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box;}
/* body {font-family: Verdana, sans-serif;} */
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1700px;
  /* height: 200px; */
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 4s;
  transform: translateX(0px);

}
.fade:hover{
  box-shadow: 6px 6px 40px 10px #5f4b8bff;
	transform: translateZ(20px);
}

@keyframes fade {
  from {opacity: 0.8} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
</style>
</head>
<body>



<div class="slideshow-container">

<?php
// PHP code to dynamically generate slideshow images
$images = array("https://image.lexica.art/md2_webp/14579002-e772-4adb-b43d-8fc709502b9a", 
"https://lh5.googleusercontent.com/p/AF1QipMNhHBWiOLEDO1162z-gvDji4puDYcgaOXovU9E=w500-h500-k-no", 
"https://images.examples.com/wp-content/uploads/2018/09/Birthday-Invitation-Movie-Ticket-Example.jpg",
"https://static.vecteezy.com/system/resources/previews/001/227/419/original/cinema-background-concept-vector.jpg");

// $captions = array("Caption Text", "Caption Two", "Caption Three");

for ($i = 0; $i < count($images); $i++) {
    echo '<div class="mySlides fade">';
    // echo '<div class="numbertext">' . ($i + 1) . ' / ' . count($images) . '</div>';
    echo '<img src="' . $images[$i] . '" style="width: 1700px;height: 500px;">';
    // echo '<div class="text">' . $captions[$i] . '</div>';
    echo '</div>';
}
?>

</div>
<br>

<div style="text-align:center">
<?php
// PHP code to dynamically generate dots
for ($i = 0; $i < count($images); $i++) {
    echo '<span class="dot"></span>';
}
?>
</div>

<script>
let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>

</body>
</html>
