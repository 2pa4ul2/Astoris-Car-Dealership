window.onload = () => {
    const tab_switchers = document.querySelectorAll('[data-switcher]');

    for (let i = 0; i < tab_switchers.length; i++) {
        const tab_switcher = tab_switchers[i];
        const page_id = tab_switcher.dataset.tab;

        tab_switcher.addEventListener('click', () => {
            // Remove the active class from the currently active tab
            document.querySelector('.tabs .tab-item.is-active').classList.remove('is-active');
            // Add the active class to the clicked tab's parent
            tab_switcher.parentNode.classList.add('is-active');

            // Remove the active class from the currently active page
            document.querySelector('.pages .page.is-active').classList.remove('is-active');
            // Add the active class to the new page
            document.querySelector(`.pages .page[data-page="${page_id}"]`).classList.add('is-active');

            // Store the current page id in the session with AJAX
            fetch('store_page.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'currentPage=' + page_id,
            });
        });
    }
}