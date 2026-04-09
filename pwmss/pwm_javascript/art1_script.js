document.querySelectorAll('.article').forEach((article) => {
  const btn = article.querySelector('.btn');
  const more = article.querySelector('.more');
  const dots = article.querySelector('.dots');

  btn.addEventListener('click', function () {
    more.classList.toggle('show');
    dots.classList.toggle('hide');

    if (more.classList.contains('show')) {
      btn.innerText = 'Minimize';
    } else {
      btn.innerText = 'Read More';
    }
  });
});
