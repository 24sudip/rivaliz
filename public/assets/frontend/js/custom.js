$(function(){

    // nav explore

       // Get the button and dropdown elements
const exploreButton = document.getElementById('exploreButton');
const dropdown = document.getElementById('dropdown');

// Add click event listener to toggle the dropdown
exploreButton.addEventListener('click', () => {
  if (dropdown.classList.contains('hidden')) {
    dropdown.classList.remove('hidden');
    dropdown.classList.add('visible');
  } else {
    dropdown.classList.remove('visible');
    dropdown.classList.add('hidden');
  }
});

// Close dropdown if user clicks outside of it
window.addEventListener('click', (event) => {
  if (event.target !== exploreButton && !dropdown.contains(event.target)) {
    dropdown.classList.remove('visible');
    dropdown.classList.add('hidden');
  }
});
// nav explore



})
 
// shipping addresss

 // Ensure the checkbox is unchecked on page load
 window.onload = function () {
  const checkbox = document.getElementById('quicktech-ship-toggle');
  checkbox.checked = false; // Uncheck the checkbox on load

  // Add event listener to toggle the form visibility
  checkbox.addEventListener('change', function () {
    const form = document.getElementById('quicktech-shipping-form');
    form.classList.toggle('quicktech-hidden', !this.checked);
  });
// shipping addresss

// terms and condition
  
  const termsCheckbox = document.getElementById("quicktechTermsCheckbox");
    const placeOrderButton = document.getElementById("quicktechPlaceOrderButton");

    termsCheckbox.addEventListener("change", function () {
      placeOrderButton.disabled = !termsCheckbox.checked;
    });

    // terms and condition



    // edit profile

  
    $(document).ready(function() {
      $('.edit-toggle').on('click', function(e) {
          e.preventDefault();
          $(this).closest('.card-body').find('.display-text').toggle();
          $(this).closest('.card-body').find('.edit-input').toggle();
      });
    });
  
  // address
    $(document).ready(function() {
      $('#add-new-btn').click(function() {
          $('#address-book').hide();
          $('#new-address-form').removeClass('hidden');
      });
      $('#go-back').click(function() {
          $('#new-address-form').addClass('hidden');
          $('#address-book').show();
      });
  });
  $(document).ready(function() {
    $('#add-new-btnn').click(function() {
        $('#address-book').hide();
        $('#edit-address-form').removeClass('hidden');
    });
    $('#go-backk').click(function() {
        $('#new-address-form').addClass('hidden');
        $('#address-book').show();
    });
  });
  

};









