document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('qsearch');
  
    searchInput.addEventListener('input', function () {
      const searchValue = this.value.trim().toLowerCase();
      const questionBlocks = document.querySelectorAll('.question-block');
  
      questionBlocks.forEach(function (block) {
        const questionTitle = block.querySelector('.qtitle h1').textContent.toLowerCase();
        const content = block.querySelector('.content p').textContent.toLowerCase();
  
        if (questionTitle.includes(searchValue) || content.includes(searchValue)) {
          block.style.display = 'block';
        } else {
          block.style.display = 'none';
        }
      });
    });
  });
  