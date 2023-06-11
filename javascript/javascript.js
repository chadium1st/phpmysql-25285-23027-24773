    // const searchButton = document.querySelector('.search button');
    // const searchIcon = document.querySelector('.search button i img');
    // const searchIconHover = document.createElement('div');
    // searchIconHover.classList.add('search-icon-hover');

    // searchButton.appendChild(searchIconHover);

    // searchButton.addEventListener('mouseover', () => {
    //   searchIcon.style.display = 'none';
    //   searchIconHover.style.display = 'inline-block'; 
    // });

    // searchButton.addEventListener('mouseout', () => {
    //   searchIcon.style.display = 'inline-block';
    //   searchIconHover.style.display = 'none';
    // });
  
    function toggleSidebar() {
      var sidebar = document.querySelector('.sidebar');
      sidebar.classList.toggle('open');
  
      var button = document.querySelector('.toggle-btn');
      button.classList.toggle('active');
    }