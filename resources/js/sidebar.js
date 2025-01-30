document.addEventListener("DOMContentLoaded", () => {
    const toggles = document.querySelectorAll(".section-toggle");
    const subItems = document.querySelectorAll(".sub-item");

    // Get the current URL
    const currentUrl = window.location.href;

    // Create a URL object from the current URL
    let url = new URL(currentUrl);

    // Dynamically find the base path and resource path
    // Example: "/Laban/new/public/warehouses?page=2" -> "/Laban/new/public/warehouses"
    let pathSegments = url.pathname.split('/').filter(segment => segment); // Remove empty segments

    if (pathSegments.length > 1) {
        if (pathSegments.indexOf('edit') > -1) {
            const index = pathSegments.indexOf('edit');
            pathSegments.splice(index, 1);
        }
        if (pathSegments.indexOf('create') > -1) {
            const index = pathSegments.indexOf('create');
            pathSegments.splice(index, 1);
        }

        // Check if the last segment is a parameter (like ID or pagination)
        const lastSegment = pathSegments[pathSegments.length - 1];

        // Regex to check if the last segment is numeric or if a query exists
        if (/^\d+$/.test(lastSegment) || url.search) {
            // Remove the last segment if it's a number or a query exists
            pathSegments.pop();
        }
        const lastSegmentAfterPop = pathSegments[pathSegments.length - 1];

        if (lastSegmentAfterPop.startsWith('edit') || lastSegmentAfterPop.startsWith('create')) {
            // Remove the last segment if it's an action
            pathSegments.pop();
        }

        // Reconstruct the pathname
        url.pathname = `/${pathSegments.join('/')}`;
    }

    // Ensure the query parameters and fragments are cleared
    url.search = ''; // Remove query parameters
    url.hash = '';   // Remove any hash fragments

    // Get the updated URL as a string
    let updatedUrl = url.toString();

    // Highlight active sub-item and expand its section
    subItems.forEach((subItem) => {
        if (subItem.href === updatedUrl) {
            subItem.classList.add("bg-cyan-200", "font-bold");

            const parentSection = subItem.closest(".sidebar-section");
            if (parentSection) {
                const toggle = parentSection.querySelector(".section-toggle");
                if (toggle) {
                    toggle.checked = true;
                }
            }
        }

        // Prevent collapsing parent section on sub-item click
        subItem.addEventListener("click", () => {
            const parentSection = subItem.closest(".sidebar-section");
            if (parentSection) {
                parentSection.querySelector(".section-toggle").checked = true;
            }
        });
    });

    // Collapse other sections when one is expanded
    toggles.forEach((toggle) => {
        toggle.addEventListener("change", () => {
            if (toggle.checked) {
                toggles.forEach((otherToggle) => {
                    if (otherToggle !== toggle) {
                        otherToggle.checked = false;
                    }
                });
            }
        });
    });
});
