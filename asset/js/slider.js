//functionale     
    let slideIndex = 1;
    showSlides(slideIndex);

// Next/previous controllers
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

// l'elements pour controler l'images 
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      //verification la quantité du fotos dans le slider
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      //si il n'as pas sur la page
      if (slides.length > 0) {
        slides[slideIndex-1].style.display = "block";
      }
      
    }