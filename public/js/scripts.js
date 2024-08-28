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

document.addEventListener("DOMContentLoaded", function () {
  // Функция для подтверждения предложений обмена
  const tradeLinks = document.querySelectorAll('a[href^="trade.php"]');
  tradeLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      const confirmation = confirm(
        "Вы уверены, что хотите предложить обмен этим товаром?"
      );
      if (!confirmation) {
        event.preventDefault();
      }
    });
  });

  // Всплывающее уведомление при успешных действиях
  const notification = document.querySelector(".notification");
  if (notification) {
    setTimeout(() => {
      notification.style.display = "none";
    }, 3000);
  }
});

document.addEventListener("DOMContentLoaded", function () {
  let currentSlide = 0;
  const slides = document.querySelectorAll(".slide");
  const dots = document.querySelectorAll(".nav-dot");

  // Проверка на наличие слайдов и точек навигации
  if (slides.length > 0 && dots.length > 0) {
    function showSlide(index) {
      const totalSlides = slides.length;
      currentSlide = (index + totalSlides) % totalSlides;

      var slider = document.querySelector(".slider");
      if (slider) {
        // Корректный расчет процента для трансформации
        const slideWidth = 100 / totalSlides;
        slider.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
      }

      dots.forEach((dot) => dot.classList.remove("active"));
      if (dots[currentSlide]) {
        dots[currentSlide].classList.add("active");
      }
    }

    dots.forEach((dot, index) => {
      dot.addEventListener("click", () => showSlide(index));
    });

    // Автоматическая смена слайдов каждые 5 секунд
    setInterval(() => {
      showSlide(currentSlide + 1);
    }, 5000);

    showSlide(0);
  }
});

//Remove item from my account
document.addEventListener("DOMContentLoaded", function () {
  const deleteButtons = document.querySelectorAll(".delete-btn");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const itemId = this.getAttribute("data-id");

      Swal.fire({
        title: "Вы уверены?",
        text: "Это действие нельзя будет отменить!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Да, удалить!",
        cancelButtonText: "Отмена",
      }).then((result) => {
        if (result.isConfirmed) {
          fetch("delete_item.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
              id: itemId,
            }),
          })
            .then((response) => response.text())
            .then((result) => {
              if (result === "success") {
                Swal.fire("Удалено!", "Ваш товар был удален.", "success").then(
                  () => {
                    // Удаляем карточку товара из DOM
                    this.closest(".item-card").remove();
                  }
                );
              } else if (result === "in_trade") {
                Swal.fire(
                  "Ошибка!",
                  "Этот товар не может быть удалён, так как он участвует в обмене.",
                  "error"
                );
              } else {
                Swal.fire(
                  "Ошибка!",
                  "Произошла ошибка при удалении товара.",
                  "error"
                );
              }
            })
            .catch((error) => {
              console.error("Ошибка:", error);
              Swal.fire(
                "Ошибка!",
                "Произошла ошибка при выполнении запроса.",
                "error"
              );
            });
        }
      });
    });
  });
});

//Checking on logout
document.addEventListener("DOMContentLoaded", function () {
  const logoutButton = document.querySelector(".logout-btn");

  if (logoutButton) {
    logoutButton.addEventListener("click", function (event) {
      event.preventDefault(); // Останавливаем стандартное действие по ссылке

      Swal.fire({
        title: "Вы точно уверены, что хотите выйти?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Да",
        cancelButtonText: "Нет",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = this.href; // Переходим по ссылке для выхода
        }
      });
    });
  }
});
