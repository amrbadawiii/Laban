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

    if (pathSegments.length > 0) {
        // Check if the last segment is a parameter (like ID or pagination) or query
        const lastSegment = pathSegments[pathSegments.length - 1];

        // Regex to check if the last segment is numeric or contains query parameters
        if (/^\d+$/.test(lastSegment) || url.search) {
            // Remove the last segment if it's a number or query exists
            url.pathname = `/${pathSegments.slice(0, -1).join('/')}`;
        }
    }

    // Clear the query parameters and fragments
    url.search = ''; // Remove query parameters
    url.hash = '';   // Remove any hash fragments

    // Get the updated URL as a string
    let updatedUrl = url.toString();

    // Highlight active sub-item and expand its section
    subItems.forEach((subItem) => {
        console.log(subItem.href + '_-' + updatedUrl);
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
        subItem.addEventListener("click", (event) => {
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
