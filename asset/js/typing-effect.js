let title = document.querySelector('.js-history-title');
title.innerHTML = " ";
let n = 0;
let str = 'Riviera choice agency';
let typeTimer = setInterval(function() {
  n = n + 1;
  title.innerHTML = " " + str.slice(0, n);
  if (n === str.length) {
    clearInterval(typeTimer);
    title.innerHTML = " " + str;
    n = 0;
    setInterval(function() {

      if (n === 0) {
        title.innerHTML = " " + str + "|"
        n = 1;
      } else {
        title.innerHTML = " " + str
        n = 0;
      };
    }, 500);
  };
}, 260)