/**
 * Main script for slideshow and password visibility toggle
 * Includes: password toggle logic, slideshow with automatic and manual control, feature animations
 */

// password
document.getElementById('togglePassword').addEventListener('click', function() {
  const passwordInput = document.getElementById('password');
  const icon = this.querySelector('i');

  if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('bi-eye');
      icon.classList.add('bi-eye-slash');
      this.setAttribute('aria-label', 'Hide password');
  } else {
      passwordInput.type = 'password';
      icon.classList.remove('bi-eye-slash');
      icon.classList.add('bi-eye');
      this.setAttribute('aria-label', 'Show password');
  }
});
//slides
document.addEventListener('DOMContentLoaded', function () {
    // Password visibility toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = togglePassword?.querySelector('i');

    if (togglePassword && passwordInput && eyeIcon) {
      togglePassword.addEventListener('click', function () {
        // Toggle input type
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Swap icon classes
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
      });
    }

    // Slideshow logic
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slide-dot');
    const prevBtn = document.querySelector('.prev-slide');
    const nextBtn = document.querySelector('.next-slide');
    let currentSlide = 0;
    let slideInterval;

    // Start slideshow
    function startSlideShow() {
      slideInterval = setInterval(() => {
        nextSlide();
      }, 7000); // 7 seconds per slide
    }

    // Stop slideshow
    function stopSlideShow() {
      clearInterval(slideInterval);
    }

    // Display specific slide
    function showSlide(n) {
      slides.forEach(slide => slide.classList.remove('active'));
      dots.forEach(dot => dot.classList.remove('active'));
      slides[n].classList.add('active');
      dots[n].classList.add('active');
      animateFeatures(n);
      currentSlide = n;
    }

    // Feature animation per slide
    function animateFeatures(slideIndex) {
      const features = slides[slideIndex].querySelectorAll('.feature-item');
      features.forEach((feature, index) => {
        setTimeout(() => {
          feature.classList.add('visible');
        }, index * 300);
      });

      slides.forEach((slide, idx) => {
        if (idx !== slideIndex) {
          slide.querySelectorAll('.feature-item').forEach(f => f.classList.remove('visible'));
        }
      });
    }

    // Next slide logic
    function nextSlide() {
      let newIndex = (currentSlide + 1) % slides.length;
      showSlide(newIndex);
    }

    // Previous slide logic
    function prevSlide() {
      let newIndex = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(newIndex);
    }

    // Event listeners
    nextBtn?.addEventListener('click', () => {
      stopSlideShow();
      nextSlide();
      startSlideShow();
    });

    prevBtn?.addEventListener('click', () => {
      stopSlideShow();
      prevSlide();
      startSlideShow();
    });

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        stopSlideShow();
        showSlide(index);
        startSlideShow();
      });
    });

    // Init first slide and autoplay
    showSlide(currentSlide);
    startSlideShow();
  });
 // main.js - JavaScript for slideshow interaction and animation

// Wait for the DOM to fully load
document.addEventListener('DOMContentLoaded', function () {
    /**
     * PASSWORD TOGGLE FUNCTIONALITY
     * Allows the user to toggle password visibility by clicking an eye icon
     */
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = togglePassword?.querySelector('i');

    if (togglePassword && passwordInput && eyeIcon) {
      togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('bi-eye');
        eyeIcon.classList.toggle('bi-eye-slash');
      });
    }

    /**
     * SLIDESHOW FUNCTIONALITY
     * Handles displaying and transitioning between slides
     */
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slide-dot');
    const prevBtn = document.querySelector('.prev-slide');
    const nextBtn = document.querySelector('.next-slide');
    let currentSlide = 0;
    let slideInterval;

    // Show a specific slide by index
    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.remove('active');
        dots[i]?.classList.remove('active');
      });

      slides[index].classList.add('active');
      dots[index]?.classList.add('active');

      animateFeatures(index);
      currentSlide = index;
    }

    // Animate features within the slide with staggered delay
    function animateFeatures(slideIndex) {
      const features = slides[slideIndex].querySelectorAll('.feature-item');
      features.forEach((feature, index) => {
        setTimeout(() => {
          feature.classList.add('visible');
        }, index * 300);
      });

      // Reset visibility on other slides
      slides.forEach((slide, index) => {
        if (index !== slideIndex) {
          slide.querySelectorAll('.feature-item').forEach((feature) => {
            feature.classList.remove('visible');
          });
        }
      });
    }

    // Show next slide
    function nextSlide() {
      let newIndex = (currentSlide + 1) % slides.length;
      showSlide(newIndex);
    }

    // Show previous slide
    function prevSlide() {
      let newIndex = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(newIndex);
    }

    // Start automatic slideshow
    function startSlideShow() {
      slideInterval = setInterval(nextSlide, 7000); // change every 7 seconds
    }

    // Stop automatic slideshow
    function stopSlideShow() {
      clearInterval(slideInterval);
    }

    // Event listeners for navigation arrows
    nextBtn?.addEventListener('click', () => {
      stopSlideShow();
      nextSlide();
      startSlideShow();
    });

    prevBtn?.addEventListener('click', () => {
      stopSlideShow();
      prevSlide();
      startSlideShow();
    });

    // Event listeners for slide dots
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        stopSlideShow();
        showSlide(index);
        startSlideShow();
      });
    });

    // Initialize first slide
    showSlide(currentSlide);
    startSlideShow();
  });
    