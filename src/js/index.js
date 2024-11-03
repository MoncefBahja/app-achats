'use strict';

// ##################################################################################################################

// Slide the banner 

// Get the slider container element and all the slider items
const sliderContainer = document.querySelector('.slider-container');
const sliderItems = sliderContainer.querySelectorAll('.slider-item');

// Set the time interval for auto-sliding in milliseconds
const intervalTime = 5000; // 5 seconds

// Set the index of the currently displayed slider item
let currentItemIndex = 0;

// Define the function to switch to the next slider item
function switchToNextItem() {
  // Hide the current item
  sliderItems[currentItemIndex].classList.remove('active');

  // Increment the item index and wrap around if necessary
  currentItemIndex = (currentItemIndex + 1) % sliderItems.length;

  // Show the next item
  sliderItems[currentItemIndex].classList.add('active');
}

// Show the first item initially
sliderItems[currentItemIndex].classList.add('active');

// Start the auto-sliding interval
setInterval(switchToNextItem, intervalTime);

// ##################################################################################################################

// mobile menu variables
const mobileMenuOpenBtn = document.querySelectorAll('[data-mobile-menu-open-btn]');
const mobileMenu = document.querySelectorAll('[data-mobile-menu]');
const mobileMenuCloseBtn = document.querySelectorAll('[data-mobile-menu-close-btn]');
const overlay = document.querySelector('[data-overlay]');

for (let i = 0; i < mobileMenuOpenBtn.length; i++) {

  // mobile menu function
  const mobileMenuCloseFunc = function () {
    mobileMenu[i].classList.remove('active');
    overlay.classList.remove('active');
  }

  mobileMenuOpenBtn[i].addEventListener('click', function () {
    mobileMenu[i].classList.add('active');
    overlay.classList.add('active');
  });

  mobileMenuCloseBtn[i].addEventListener('click', mobileMenuCloseFunc);
  overlay.addEventListener('click', mobileMenuCloseFunc);

}





// accordion variables
// const accordionBtn = document.querySelectorAll('[data-accordion-btn]');
// const accordion = document.querySelectorAll('[data-accordion]');

// for (let i = 0; i < accordionBtn.length; i++) {

//   accordionBtn[i].addEventListener('click', function () {

//     const clickedBtn = this.nextElementSibling.classList.contains('active');

//     for (let i = 0; i < accordion.length; i++) {

//       if (clickedBtn) break;

//       if (accordion[i].classList.contains('active')) {

//         accordion[i].classList.remove('active');
//         accordionBtn[i].classList.remove('active');

//       }

//     }

//     this.nextElementSibling.classList.toggle('active');
//     this.classList.toggle('active');

//   });

// }