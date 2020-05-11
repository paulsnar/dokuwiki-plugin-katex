(function() {
  "use strict";

  function render() {
    var katex = window.katex;
    var targets = document.getElementsByClassName('dwkatex--render');
    for (var i = targets.length - 1; i >= 0; i--) {
      var target = targets[i];
      var source = target.textContent;
      if (target.classList.contains('dwkatex--block')) {
        source = '\\displaystyle ' + source;
      }
      try {
        katex.render(source, target);
      } catch (e) {
        target.textContent = source;
        target.classList.add('dwkatex--error');
        var error = document.createElement('span');
        error.className = 'dwkatex--error-details';
        error.textContent = e.message;
        target.appendChild(error);
      }
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    if (window.katex !== undefined) {
      render();
    } else {
      document.getElementById('dwkatex--script')
        .addEventListener('load', render);
    }
  });
})();
