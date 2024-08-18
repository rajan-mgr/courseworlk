function toggleOption() {
    var profileMenu = document.querySelector('.profile-menu');
    if (profileMenu.style.display === 'block') {
        profileMenu.style.display = 'none';
    } else {
        profileMenu.style.display = 'block';
    }
}


window.addEventListener('click', function(event) {
    var profileIcon = document.querySelector('.profile-icon');
    var profileMenu = document.querySelector('.profile-menu');
    if (!profileIcon.contains(event.target)) {
        profileMenu.style.display = 'none';
    }
});