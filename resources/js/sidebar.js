document.addEventListener("DOMContentLoaded", () => {
    const toggles = document.querySelectorAll(".section-toggle");
    const subItems = document.querySelectorAll(".sub-item");

    // Highlight active sub-item and expand its section
    const currentUrl = window.location.href;

    // Create a URL object from the string
    let url = new URL(currentUrl);

    // Split the pathname into segments
    let pathSegments = url.pathname.split('/');

    // Keep only the first part of the path
    url.pathname = `/${pathSegments[1]}`;

    // Clear the query parameters
    url.search = '';

    // Get the updated URL as a string
    let updatedUrl = url.toString();

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
