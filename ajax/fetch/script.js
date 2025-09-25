document.addEventListener('DOMContentLoaded', () => {
  const titleEl = document.getElementById('article-title');
  const imageEl = document.getElementById('article-image');
  const textEl = document.getElementById('article-text');
  const errorEl = document.getElementById('error-message');

  
  function showError(message) {
    errorEl.textContent = message;
    errorEl.style.display = 'block';
  }

  // Скрываем ошибку при успешной загрузке
  function hideError() {
    errorEl.style.display = 'none';
  }


  fetch('data.php')
    .then(response => {
      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      hideError();

      // Проверяем наличие каждого поля
      if (data.title !== undefined) {
        titleEl.textContent = data.title;
      } else {
        showError('Не удалось загрузить заголовок.');
      }

      if (data.image !== undefined) {
        imageEl.src = data.image;
      } else {
        showError('Не удалось загрузить изображение.');
      }

      if (data.text !== undefined) {
        textEl.textContent = data.text;
      } else {
        showError('Не удалось загрузить текст статьи.');
      }
    })
    .catch(error => {
      console.error('Ошибка при загрузке данных:', error);
      showError('Не удалось загрузить данные статьи. Попробуйте позже.');
    });
});