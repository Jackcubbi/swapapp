const header = document.querySelector(".page-header");
const toggleClass = "is-sticky";

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset;
  if (currentScroll > 100) {
    header.classList.add(toggleClass);
  } else {
    header.classList.remove(toggleClass);
  }
});


document.addEventListener('DOMContentLoaded', function () {
  // Функция для подтверждения предложений обмена
  const tradeLinks = document.querySelectorAll('a[href^="trade.php"]');
  tradeLinks.forEach(link => {
    link.addEventListener('click', function (event) {
      const confirmation = confirm('Вы уверены, что хотите предложить обмен этим товаром?');
      if (!confirmation) {
        event.preventDefault();
      }
    });
  });

  // Всплывающее уведомление при успешных действиях
  const notification = document.querySelector('.notification');
  if (notification) {
    setTimeout(() => {
      notification.style.display = 'none';
    }, 3000);
  }
});


document.addEventListener('DOMContentLoaded', function () {
  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.nav-dot');

  // Проверка на наличие слайдов и точек навигации
  if (slides.length > 0 && dots.length > 0) {
    function showSlide(index) {
      const totalSlides = slides.length;
      currentSlide = (index + totalSlides) % totalSlides;

      var slider = document.querySelector('.slider');
      if (slider) {
        // Корректный расчет процента для трансформации
        const slideWidth = 100 / totalSlides;
        slider.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
      }

      dots.forEach(dot => dot.classList.remove('active'));
      if (dots[currentSlide]) {
        dots[currentSlide].classList.add('active');
      }
    }

    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => showSlide(index));
    });

    // Автоматическая смена слайдов каждые 5 секунд
    setInterval(() => {
      showSlide(currentSlide + 1);
    }, 5000);

    showSlide(0);
  } else {
    console.log('Слайды или точки навигации не найдены на этой странице.');
  }
});

