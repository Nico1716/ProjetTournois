import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import './vendor/bootstrap/dist/css/bootstrap.min.css';


let highlight = document.querySelector('#highlights-btn');
let upcoming = document.querySelector('#upcoming-btn');

highlight.addEventListener('click', function(){
  highlight.classList.add('active');
  upcoming.classList.remove('active');
});

upcoming.addEventListener('click', function(){
  highlight.classList.remove('active');
  upcoming.classList.add('active');
});




/*
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.selector-button');
    buttons.forEach(btn => {
      btn.addEventListener('click', function() {
        buttons.forEach(b => b.classList.remove('active')); // Remove 'active' from all buttons
        btn.classList.add('active'); // Add 'active' to the clicked button
        switchContent(btn.id);
      });
    });
  
    function switchContent(buttonId) {
      if (buttonId === 'highlights-btn') {
        document.getElementById('highlights-content').style.display = 'block';
        document.getElementById('upcoming-content').style.display = 'none';
      } else if (buttonId === 'upcoming-btn') {
        document.getElementById('highlights-content').style.display = 'none';
        document.getElementById('upcoming-content').style.display = 'block';
      }
    }
  
  });
*/
 // switchContent(highlights-btn);