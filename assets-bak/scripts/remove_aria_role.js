document.addEventListener('DOMContentLoaded', function () {
  const nav = document.querySelector('#header-nav');
  if (nav) {
	nav.removeAttribute('role');
  }
});
 