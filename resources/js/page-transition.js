// Page content transition (only main content area)
document.addEventListener('DOMContentLoaded', function () {
    const contentWrapper = document.querySelector('.content-wrapper');

    if (!contentWrapper) return;

    // Ensure parent has proper background
    const main = contentWrapper.closest('main');
    if (main) {
        main.style.backgroundColor = 'transparent';
    }

    // Add fade-in on page load
    contentWrapper.style.opacity = '0';
    contentWrapper.style.transform = 'translateY(10px)';
    contentWrapper.style.transition = 'opacity 0.3s ease-in-out, transform 0.3s ease-in-out';

    setTimeout(() => {
        contentWrapper.style.opacity = '1';
        contentWrapper.style.transform = 'translateY(0)';
    }, 10);

    // Add fade-out on page navigation (only for internal links in main content)
    const links = document.querySelectorAll('a:not([target="_blank"]):not([href^="#"]):not([href^="javascript:"])');

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');

            // Skip if it's a hash link, external, or download
            if (!href || href === '#' || href.startsWith('javascript:') || this.hasAttribute('download')) {
                return;
            }

            // Skip if it's an external link
            if (this.hostname !== window.location.hostname) {
                return;
            }

            // Skip if link is in sidebar or header (to avoid double transition)
            if (this.closest('aside') || this.closest('header')) {
                return;
            }

            e.preventDefault();

            contentWrapper.style.opacity = '0';
            contentWrapper.style.transform = 'translateY(-10px)';

            setTimeout(() => {
                window.location.href = href;
            }, 300);
        });
    });
});
