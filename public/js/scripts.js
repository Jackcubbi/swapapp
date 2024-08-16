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


let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.nav-dot');

function showSlide(index) {
  const totalSlides = slides.length;
  currentSlide = (index + totalSlides) % totalSlides;
  document.querySelector('.slider').style.transform = 'translateX(-${currentSlide * 33.33}%)';

  dots.forEach(dot => dot.classList.remove('active'));
  dots[currentSlide].classList.add('active');
}

dots.forEach((dot, index) => {
  dot.addEventListener('click', () => showSlide(index));
});

// Автоматическая смена слайдов каждые 5 секунд
setInterval(() => {
  showSlide(currentSlide + 1);
}, 5000);

showSlide(0); 