// public/js/firebase-config.js

const firebaseConfig = {
    aapiKey: "AIzaSyBvwwFUaNnQbBaCgJe5LQR_MfCb82fJZnY",
  authDomain: "inxgo-webapp.firebaseapp.com",
  projectId: "inxgo-webapp",
  storageBucket: "inxgo-webapp.appspot.com",
  messagingSenderId: "884120905766",
  appId: "1:884120905766:web:cfe19bd31327b4f9f91ee7",
  measurementId: "G-P99CD4NYZH",
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

messaging.requestPermission().then(() => {
    console.log('Notification permission granted.');
    return messaging.getToken();
}).then((token) => {
    console.log('FCM Token:', token);
    // Send this token to your Laravel backend to associate it with the user.
}).catch((error) => {
    console.error('Error getting permission or token:', error);
});
messaging.onMessage((payload) => {
    console.log('Received message:', payload);
    // Handle the incoming message, e.g., display a notification.
});
