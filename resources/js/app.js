// resources/js/app.js
require('./bootstrap');

// Fetch notifications
function fetchNotifications() {
    axios.get('/notifications')
        .then(response => {
            const notificationsList = document.getElementById('notificationsList');
            const notificationCount = document.getElementById('notificationCount');
            const notifications = response.data.notifications;

            // Clear existing notifications
            notificationsList.innerHTML = '';

            // Display new notifications
            notifications.forEach(notification => {
                const notificationItem = document.createElement('div');
                notificationItem.classList.add('notification');
                notificationItem.textContent = notification.message;
                notificationsList.appendChild(notificationItem);
            });

            // Update notification count
            notificationCount.textContent = notifications.length;
        })
        .catch(error => {
            console.error('Error fetching notifications', error);
        });
}

// Fetch notifications on page load
fetchNotifications();

// Fetch notifications every 30 seconds (adjust as needed)
setInterval(fetchNotifications, 30000);
import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
});

// Now you can listen for events
Echo.channel('job-requests.' + userId)
    .listen('NewJobRequest', (event) => {
        console.log('New job request received:', event);
        // Perform actions when a new job request is received
    });
