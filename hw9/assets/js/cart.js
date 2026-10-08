// JavaScript Document
/**
 * Assignment 8: JavaScript Shopping Cart
 * Author: Sam Adams
 * Description: Handles dynamic item creation, verification, counting, and extra credit deletions.
 */

// Wait for the DOM structure to fully load before attaching events
document.addEventListener('DOMContentLoaded', () => {
    
    // Select the necessary DOM elements for interactive usage
    const itemInput = document.getElementById('item-input');
    const addItemBtn = document.getElementById('add-item-btn');
    const shoppingList = document.getElementById('shopping-list');
    const itemCountBadge = document.getElementById('item-count');

    /**
     * Updates the item counter badge to reflect the current total rows
     */
    function updateCount() {
        // Collect all <li> elements nested inside our specific shopping list container
        const totalItems = shoppingList.getElementsByTagName('li').length;
        
        // Inject the count into the inner text of the Bootstrap badge element
        itemCountBadge.textContent = totalItems;
    }

    /**
     * Captures user input, validates it, constructs a list entry, and clears the form
     */
    function addItem() {
        // Capture the text entry and trim leading/trailing empty whitespace
        const itemName = itemInput.value.trim();

        // Ensure that text is not null or an empty string
        if (itemName === "" || itemName === null) {
            alert("Please enter a valid shopping item name.");
            return; // Terminate execution so an empty field isn't added
        }

        // generate a new <li> element
        const listItem = document.createElement('li');
        
        // Apply list alignment and custom cursor rules
        listItem.className = "list-group-item d-flex justify-content-between align-items-center";
        listItem.style.cursor = "pointer";
        listItem.style.fontFamily = "'Open Sans', sans-serif";
        listItem.style.transition = "background-color 0.2s ease";

        // Create a span to hold the text cleanly separate from extra credit hooks
        const textSpan = document.createElement('span');
        textSpan.textContent = itemName;
        listItem.appendChild(textSpan);

        // interactive deletion text hint
        const deleteHint = document.createElement('small');
        deleteHint.className = "text-muted pull-right";
        deleteHint.style.fontSize = "11px";
        deleteHint.style.color = "#999";
        deleteHint.textContent = "(click item text to remove)";
        listItem.appendChild(deleteHint);

        // Hover feedback layout via JavaScript interactions
        listItem.addEventListener('mouseenter', () => {
            listItem.style.backgroundColor = "#fcf8e3"; // subtle warning/delete color tint
        });
        listItem.addEventListener('mouseleave', () => {
            listItem.style.backgroundColor = "#fff";
        });

        // Click handler on item level to clean it out from the display
        listItem.addEventListener('click', function() {
            // Remove the node element completely from the active layout context
            listItem.remove();
            
            // Re-invoke the counting algorithm to dynamically change UI values
            updateCount();
        });

        // Inject the newly formatted element at the tail of our active collection parent
        shoppingList.appendChild(listItem);

        // Reset the layout container field clean on success
        itemInput.value = "";

        // Trigger updating script functionality to show changes to the counter element
        updateCount();
    }

    // Connect button element click interface to add logic sequence safely
    addItemBtn.addEventListener('click', addItem);

    // Allow triggering submission inside input directly via Enter key
    itemInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
            addItem();
        }
    });
});