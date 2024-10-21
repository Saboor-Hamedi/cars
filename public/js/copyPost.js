function copyURL(url, button) {
    // Create a temporary input element
    const tempInput = document.createElement('input');
    tempInput.value = url;
    document.body.appendChild(tempInput);
    // Select the text
    tempInput.select();
    document.execCommand('copy');

    // Remove the temporary input element
    document.body.removeChild(tempInput);

    // Change the SVG icon to indicate success
    const copyIcon = button.querySelector('svg'); // Get the SVG icon within the button

    if (copyIcon) {
        // Change the stroke color to indicate the URL has been copied
        copyIcon.setAttribute("stroke", "green"); // Change to green or any color you prefer
    } else {
        console.error('Copy icon not found in the DOM');
    }

    // Create a tooltip element
    const tooltips = document.createElement('span');
    tooltips.innerText = 'Copied';
    tooltips.style.position = 'absolute';
    tooltips.style.fontSize = '8px';
    tooltips.style.color = 'black';
    tooltips.style.marginLeft = '4px';
    tooltips.style.zIndex = '1000';
    // Position the tooltip near the button
    const buttonRect = button.getBoundingClientRect();
    tooltips.style.left = `${buttonRect.left + window.scrollX}px`;
    tooltips.style.top = `${buttonRect.top + window.scrollY - tooltips.offsetHeight - 15}px`; // Position above the button

    // Append the tooltip to the body
    document.body.appendChild(tooltips);

    // Remove the tooltip after a timeout
    setTimeout(() => {
        if (copyIcon) {
            copyIcon.setAttribute('stroke', 'currentColor'); // Move back to original color
        }
        // Check if the tooltip is still in the document before removing
        if (tooltips.parentNode) {
            document.body.removeChild(tooltips); // Remove the tooltip
        }
    }, 2000); // Change back after 2 seconds
}
