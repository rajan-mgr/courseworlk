
document.addEventListener('DOMContentLoaded', function () {

    
    const bookItems = document.querySelectorAll('.books-section li');
    bookItems.forEach(item => {
        item.addEventListener('click', function () {
            const description = this.querySelector('.description');
            if (description) {
                description.style.display = description.style.display === 'none' ? 'block' : 'none';
            }
        });
    });

    
    const logoutButton = document.querySelector('.logout-button');
    if (logoutButton) {
        logoutButton.addEventListener('click', function (event) {
            const confirmed = confirm('Are you sure you want to log out?');
            if (!confirmed) {
                event.preventDefault();
            }
        });
    }
});
