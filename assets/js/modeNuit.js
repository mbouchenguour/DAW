document.addEventListener('DOMContentLoaded', () => {
    const modeNuit = document.getElementById('modeNuit');
    const themeStyle = document.getElementById('theme-style');
  
    let nuit = localStorage.getItem('nuit') === 'true';
  
    applyTheme();
  
    modeNuit.addEventListener('click', (event) => {
      event.preventDefault();
      switchTheme();
    });
  
    function switchTheme() {
      nuit = !nuit;
      applyTheme();
      localStorage.setItem('nuit', nuit);
    }
  
    function applyTheme() {
      if (nuit) {
        themeStyle.href = 'assets/css/indexNuit.css';
        modeNuit.textContent = 'Mode Jour';
      } else {
        themeStyle.href = 'assets/css/index2.css';
        modeNuit.textContent = 'Mode Nuit';
      }
    }
  });
  