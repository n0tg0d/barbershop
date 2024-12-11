import "./bootstrap";
Livewire.on("show-delete-confirmation", () => {
    // Show the modal
    document.getElementById("deleteModal").style.display = "block";
});

Livewire.on("close-delete-confirmation", () => {
    // Close the modal
    document.getElementById("deleteModal").style.display = "none";
});
