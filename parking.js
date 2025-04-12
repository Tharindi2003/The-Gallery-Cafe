document.addEventListener('DOMContentLoaded', () => {
    let selectedSlot = null;

    // Add click event listeners to available slots
    document.querySelectorAll('.available').forEach(slot => {
        slot.addEventListener('click', () => {
            if (selectedSlot) {
                selectedSlot.classList.remove('selected');
            }
            slot.classList.add('selected');
            selectedSlot = slot;
        });
    });

    // Booking button action
    document.getElementById('book-slot').addEventListener('click', () => {
        if (selectedSlot) {
            const slotId = selectedSlot.id;
            
            // Send data to PHP using AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'book_slot.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    alert('Slot booked successfully!');
                    // Change slot appearance to reserved
                    selectedSlot.classList.remove('available');
                    selectedSlot.classList.add('reserved');
                    selectedSlot = null;
                } else {
                    alert('Booking failed!');
                }
            };
            xhr.send('slotId=' + slotId);
        } else {
            alert('Please select a slot first!');
        }
    });
});
