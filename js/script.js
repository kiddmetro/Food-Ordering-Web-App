
// IMAGE SLIDE
var currentIndex = 0;
var sliderContainer = document.getElementById('slider-container');
var images = Array.from(sliderContainer.getElementsByTagName('img'));

setInterval(function() {
  currentIndex = (currentIndex + 1) % images.length;
  changeImage();
}, 2000); // Change image every 2 seconds

function changeImage() {
  images.forEach(function(img, index) {
    if (index === currentIndex) {
      img.style.transform = 'translateX(0)';
    } else {
      img.style.transform = 'translateX(-100%)';
    }
  });
}

// NAVBAR/HEADER
const navToggle = document.querySelector(".nav-toggle");
const navMenu = document.querySelector(".nav-wrap");

navToggle.addEventListener("click", () =>{
  navMenu.classList.toggle("active");
})


// // ADD TO CART OVERLAY
// function showPopup() {
//   document.getElementById('overlay').style.display = 'block';
//   document.getElementById('popup').style.display = 'block';
// }

// function closePopup() {
//   document.getElementById('overlay').style.display = 'none';
//   document.getElementById('popup').style.display = 'none';
// }

// function addToCart() {
//   var productName = document.querySelector('.dish-title').innerText;
//   var portion = document.querySelector('#portion').value;
//   var price = document.querySelector('.dish-price').innerText;
// }

//   // Send an AJAX request to add the item to the cart on the server
//   var xhr = new XMLHttpRequest();
//   xhr.open('POST', 'add_to_cart.php');
//   xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   xhr.onload = function() {
//       if (xhr.status === 200) {
//           // Optionally, show a success message to the user
//           alert("Item added to cart!");
//           closePopup();
//       } else {
//           // Handle the error case
//           alert("Failed to add item to cart. Please try again.");
//       }
//   };
//   xhr.send('name=' + encodeURIComponent(productName) +
//            '&portion=' + encodeURIComponent(portion) +
//            '&price=' + encodeURIComponent(price));
// }

// function showPopup() {
//   // Get the dish card content
//   var dishCard = event.target.closest('.dish-card');
//   var dishInfo = dishCard.querySelector('.dish-info').innerHTML;
//   var dishImage = dishCard.querySelector('.dish-image').outerHTML;

//   // Set the dish card content and image in the popup
//   var popupContent = dishImage + dishInfo;
//   document.getElementById('popup-content').innerHTML = popupContent;

//   // Show the popup
//   document.getElementById('overlay').style.display = 'block';
//   document.getElementById('popup').style.display = 'block';
// }

// function showDiseases() {
//   var healthChallenge = document.getElementById('health-challenges').value;
//   var diseaseOptions = document.getElementById('disease-options');

//   // Clear existing options
//   while (diseaseOptions.firstChild) {
//     diseaseOptions.removeChild(diseaseOptions.firstChild);
//   }

//   if (healthChallenge === "obesity") {
//     // No sub-diseases for obesity, hide the diseases dropdown
//     document.getElementById('diseases').style.display = 'none';
//   } else if (healthChallenge === "diabetes") {
//     addOption(diseaseOptions, "Diabetes 1");
//     addOption(diseaseOptions, "Diabetes 2");
//     document.getElementById('diseases').style.display = 'block';
//   } else if (healthChallenge === "cardiovascular") {
//     addOption(diseaseOptions, "Hypertension");
//     addOption(diseaseOptions, "Stroke");
//     document.getElementById('diseases').style.display = 'block';
//   } else {
//     // For other health challenges, hide the diseases dropdown
//     document.getElementById('diseases').style.display = 'none';
//   }
//   // Add more conditions for other health challenges and their respective diseases
//   else if (healthChallenge === "kidney") { ... }
//   else if (healthChallenge === "other") { ... }
// }

// function addOption(selectElement, optionText) {
//   var option = document.createElement('option');
//   option.text = optionText;
//   selectElement.add(option);
// }





// function addToCart(menuId) {
//   // Display the overlay
//   var overlay = document.createElement("div");
//   overlay.className = "overlay";
//   document.body.appendChild(overlay);

//   // Create the modal box
//   var modalBox = document.createElement("div");
//   modalBox.className = "modal-box";
//   modalBox.innerHTML = "<h3>Item added to cart!</h3><p>Click OK to continue shopping.</p>";
//   overlay.appendChild(modalBox);

//   // Create the close button
//   var closeButton = document.createElement("span");
//   closeButton.className = "close-btn";
//   closeButton.innerHTML = "&times;";
//   closeButton.addEventListener("click", function() {
//       overlay.remove();
//   });
//   modalBox.appendChild(closeButton);

//   // Redirect to the index page after a delay
//   setTimeout(function() {
//       window.location.href = "./index.php";
//   }, 3000);

//   // Submit the form
//   var form = document.getElementById("add-to-cart-form-" + menuId);
//   form.submit();
// }


function addToCart(menuId) {
  // Display the overlay
  var overlay = document.createElement("div");
  overlay.className = "overlay";
  document.body.appendChild(overlay);

  // Create the modal box
  var modalBox = document.createElement("div");
  modalBox.className = "modal-box";
  modalBox.innerHTML = " <i class='fa fa-check-circle' style='font-size: 70px; color: green; margin:0 0 10px 10px; '></i><h3 >Item added to cart!</h3>";
  overlay.appendChild(modalBox);

  // Create the close button
  var closeButton = document.createElement("span");
  closeButton.className = "close-btn";
  closeButton.innerHTML = "&times;";
  closeButton.addEventListener("click", function() {
      overlay.remove();
  });
  modalBox.appendChild(closeButton);

  // Redirect to the index page after a delay
  setTimeout(function() {
      window.location.href = "./index.php";
  }, 9000);

  // Submit the form
  var form = document.getElementById("add-to-cart-form-" + menuId);
  form.submit();
}