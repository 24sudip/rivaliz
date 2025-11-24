

     @include('frontend.inc.header')


     @yield('content')


     @include('frontend.inc.footer')


    <script src="../../../assets/frontend/js/jquery-1.12.4.min.js"></script>
    <script src="../../../assets/frontend/js/bootstrap.bundle.min.js"></script>
    <script src="../../../assets/frontend/js/particles.min.js"></script>
    <script src="../../../assets/frontend/js/particles.js"></script>
    <script src="../../../assets/frontend/js/colorfulTab.min.js"></script>
    <script src="../../../assets/frontend/js/waypoint.js"></script>
    <script src="../../../assets/frontend/js/jquery.counterup.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="../../../assets/frontend/js/wow.min.js"></script>
    <script src="../../../assets/frontend/js/slick.min.js"></script>
    <script src="../../../assets/frontend/js/venobox.min.js"></script>
    <script src="../../../assets/frontend/js/custom.js"></script>

    <script>
        // register  continue with email

    document.getElementById("email-student").addEventListener("click", () => {
        document.getElementById("login-options").classList.add("d-none");
        document.getElementById("student-form").classList.remove("d-none");
      });

      document.getElementById("email-teacher").addEventListener("click", () => {
        document.getElementById("login-options").classList.add("d-none");
        document.getElementById("teacher-form").classList.remove("d-none");
      });

      document.getElementById("back-button-student").addEventListener("click", () => {
        document.getElementById("login-options").classList.remove("d-none");
        document.getElementById("student-form").classList.add("d-none");
      });

      document.getElementById("back-button-teacher").addEventListener("click", () => {
        document.getElementById("login-options").classList.remove("d-none");
        document.getElementById("teacher-form").classList.add("d-none");
      });


    // register  continue with email
    </script>

<!-- course slider -->
<script>
  // Function to initialize all Swiper sliders
  function initializeSwipers() {
    // Select all sliders on the page
    const sliders = document.querySelectorAll('.swiper');

    // Loop through each slider and initialize Swiper
    sliders.forEach((slider) => {
      new Swiper(slider, {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // Autoplay settings
        autoplay: {
          delay: 3000, // Time between transitions in milliseconds
          disableOnInteraction: false, // Continue autoplay after user interaction
        },

    // Responsive settings
breakpoints: {
  // when window width is <= 480px
  480: {
    slidesPerView: 1,
    spaceBetween: 10,
  },
  // when window width is <= 600px
  576: {
    slidesPerView: 2,
    spaceBetween: 15,
  },
  // when window width is <= 768px
  768: {
    slidesPerView: 2,
    spaceBetween: 20,
  },
  // when window width is > 768px
  1024: {
    slidesPerView: 3,
    spaceBetween: 30,
  },
},


        // Pagination
        pagination: {
          el: slider.querySelector('.swiper-pagination'),
          clickable: true,
        },

        // Navigation
        navigation: {
          nextEl: slider.querySelector('.swiper-button-next'),
          prevEl: slider.querySelector('.swiper-button-prev'),
        },

        // Scrollbar
        scrollbar: {
          el: slider.querySelector('.swiper-scrollbar'),
          draggable: true,
        },
      });
    });
  }

  // Run the initialization function on DOMContentLoaded
  document.addEventListener('DOMContentLoaded', initializeSwipers);
</script>



<!-- course slider -->

<!-- rating -->
<script>
  // Example of dynamically setting rating data
const totalRatings = 10;
const ratingData = {
   5: 1,
   4: 2,
   3: 1,
   2: 3,
   1: 1
};

const progressBars = document.querySelectorAll('.progress-bar');
const percentages = document.querySelectorAll('.d-flex span:last-child');

let totalScore = 0;

Object.keys(ratingData).forEach((rating, index) => {
   const count = ratingData[rating];
   const percentage = (count / totalRatings) * 100;
   progressBars[index].style.width = `${percentage}%`;
   percentages[index].innerText = `${percentage.toFixed(0)}%`;

   totalScore += rating * count;
});

const averageRating = (totalScore / totalRatings).toFixed(1);
document.querySelector('.rating-count').innerText = averageRating;
document.querySelector('.text-center p').innerText = `Rated ${averageRating} out of ${totalRatings} Ratings`;
</script>


<!-- rating -->
<!-- exam start -->

<script>
  // Retrieve questions from HTML
  const questions = [];
  document.querySelectorAll("#quicktech-questions div").forEach(div => {
      questions.push({
          question: div.getAttribute("data-question"),
          options: div.getAttribute("data-options").split(",")
      });
  });

  let currentQuestionIndex = 0;
  const progress = document.getElementById("quicktech-progress");
  const questionElement = document.getElementById("quicktech-question");
  const optionsElement = document.getElementById("quicktech-options");
  const prevButton = document.getElementById("quicktech-prevBtn");
  const nextButton = document.getElementById("quicktech-nextBtn");
  const submitButton = document.getElementById("quicktech-submitBtn");
  const confirmSubmitButton = document.getElementById("quicktech-confirmSubmitBtn");
  const previewList = document.getElementById("quicktech-previewList");
  const questionNavElement = document.getElementById("quicktech-questionNav");

  const selectedOptions = new Array(questions.length).fill(null);

  function displayQuestion() {
      const currentQuestion = questions[currentQuestionIndex];
      questionElement.textContent = currentQuestion.question;
      progress.textContent = `Question ${currentQuestionIndex + 1} of ${questions.length}`;
      optionsElement.innerHTML = "";

      currentQuestion.options.forEach((option, index) => {
          const radio = document.createElement("input");
          radio.type = "radio";
          radio.id = `quicktech-option${index}`;
          radio.name = "answer";
          radio.value = option;
          radio.classList.add("quicktech-input");

          if (selectedOptions[currentQuestionIndex] === option) {
              radio.checked = true;
          }

          const label = document.createElement("label");
          label.htmlFor = `quicktech-option${index}`;
          label.textContent = option;

          const optionDiv = document.createElement("div");
          optionDiv.classList.add("quicktech-option");
          optionDiv.appendChild(radio);
          optionDiv.appendChild(label);

          optionsElement.appendChild(optionDiv);
      });

      updateButtons();
      updateActiveNav();
  }

  function changeQuestion(step) {
      saveSelectedOption();
      currentQuestionIndex += step;
      displayQuestion();
  }

  function saveSelectedOption() {
      const selectedOption = document.querySelector('input[name="answer"]:checked');
      if (selectedOption) {
          selectedOptions[currentQuestionIndex] = selectedOption.value;
      }
      updateActiveNav();
  }

  function submitQuestionnaire() {
      saveSelectedOption();
      const allAnswered = selectedOptions.every(option => option !== null);

      if (allAnswered) {
          previewList.innerHTML = "";
          selectedOptions.forEach((answer, index) => {
              const li = document.createElement("li");
              li.textContent = `${questions[index].question}: ${answer}`;
              previewList.appendChild(li);
          });

          const previewModal = new bootstrap.Modal(document.getElementById('quicktech-previewModal'));
          previewModal.show();
      } else {
          alert("Please answer all questions before submitting.");
      }
  }

  function confirmSubmit() {
    saveSelectedOption();

    // Create a hidden form for submission
    const form = document.createElement("form");
    form.method = "POST";
    form.action = "{{ route('quizresult.submit') }}";

    // CSRF Token
    const csrfToken = document.createElement("input");
    csrfToken.type = "hidden";
    csrfToken.name = "_token";
    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    form.appendChild(csrfToken);

    // Add answers & questions to form
    selectedOptions.forEach((answer, index) => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = `answers[${index}]`;
        input.value = answer;
        form.appendChild(input);
    });

    questions.forEach((question, index) => {
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = `questions[${index}]`;
        input.value = question.question;
        form.appendChild(input);
    });

    const quizIdInput = document.createElement("input");
quizIdInput.type = "hidden";
quizIdInput.name = "quiz_id";
quizIdInput.value = document.getElementById("quizIdHidden").value;
form.appendChild(quizIdInput);
    // Submit form (Redirects automatically)
    document.body.appendChild(form);
    form.submit();
}



  function generateQuestionNav() {
      questionNavElement.innerHTML = "";
      questions.forEach((q, index) => {
          const li = document.createElement("li");
          li.innerHTML = `<a href="#" id="quicktech-nav-${index}" onclick="jumpToQuestion(${index})">Question ${index + 1}</a> <span id="quicktech-tick-${index}" class="quicktech-tick" style="display: none;">✔</span>`;
          li.classList.add("quicktech-nav-item");
          questionNavElement.appendChild(li);
      });
      updateActiveNav();
  }

  function jumpToQuestion(index) {
      saveSelectedOption();
      currentQuestionIndex = index;
      displayQuestion();
  }

  function updateActiveNav() {
      document.querySelectorAll(".quicktech-nav-item").forEach((item, index) => {
          const tick = document.getElementById(`quicktech-tick-${index}`);
          tick.style.display = selectedOptions[index] !== null ? "inline" : "none";
          item.classList.toggle("active", index === currentQuestionIndex);
      });
  }

  function updateButtons() {
      prevButton.style.display = currentQuestionIndex > 0 ? "inline-block" : "none";
      nextButton.style.display = currentQuestionIndex < questions.length - 1 ? "inline-block" : "none";
      submitButton.style.display = currentQuestionIndex === questions.length - 1 ? "inline-block" : "none";
  }

  nextButton.addEventListener("click", () => changeQuestion(1));
  prevButton.addEventListener("click", () => changeQuestion(-1));
  submitButton.addEventListener("click", submitQuestionnaire);
  confirmSubmitButton.addEventListener("click", confirmSubmit);

  generateQuestionNav();
  displayQuestion();
</script>






<!-- exam start -->

  <!-- profile -->

  <script>
    document.querySelectorAll('.edit-toggle').forEach(toggle => {
      toggle.addEventListener('click', function (e) {
          e.preventDefault();
          const parentCard = this.closest('.card-body');
          const displayText = parentCard.querySelector('.display-text');
          const editInput = parentCard.querySelector('.edit-input');

          // Toggle visibility of display text and input field
          displayText.style.display = 'none';
          editInput.style.display = 'flex';
      });
  });

  </script>

  <script>
    // Select elements
  const addNewBtn = document.getElementById("add-new-btn");
  const addNewForm = document.getElementById("new-address-form");
  const editBtn = document.getElementById("add-new-btnn");
  const editForm = document.getElementById("edit-address-form");
  const goBackBtns = document.querySelectorAll(".back-link");
  const addressBook = document.getElementById("address-book");

  // Function to hide all forms
  function hideAllForms() {
    addNewForm.classList.add("hidden");
    editForm.classList.add("hidden");
    addressBook.classList.remove("hidden");
  }

  // Add New Button Click
  addNewBtn.addEventListener("click", () => {
    hideAllForms();
    addNewForm.classList.remove("hidden");
    addressBook.classList.add("hidden");
  });

  // Edit Button Click
  editBtn.addEventListener("click", () => {
    hideAllForms();
    editForm.classList.remove("hidden");
    addressBook.classList.add("hidden");
  });

  // Go Back Button Click
  goBackBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      hideAllForms();
    });
  });

</script>
<!-- profile -->

<!-- profile dropdown -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const dropdownToggle = document.getElementById('navbarDropdown');
  const dropdownMenu = document.getElementById('dropdownMenu');
  const profileDropdown = document.getElementById('profileDropdown');

  // Toggle dropdown on click
  dropdownToggle.addEventListener('click', function (event) {
    event.preventDefault();
    dropdownMenu.classList.toggle('show'); // Toggle the dropdown menu visibility
  });

  // Close the dropdown if clicked outside
  document.addEventListener('click', function (event) {
    if (!profileDropdown.contains(event.target)) {
      dropdownMenu.classList.remove('show'); // Hide dropdown if clicked outside
    }
  });
});
</script>
<!-- profile dropdown -->

{{-- Toatsr js --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
 }
 @endif
</script>
@include('frontend.inc.script')
</body>
</html>
