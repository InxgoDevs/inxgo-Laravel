importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyBvwwFUaNnQbBaCgJe5LQR_MfCb82fJZnY",

    projectId: "inxgo-webapp",
    messagingSenderId: "884120905766",
    appId: "1:884120905766:web:cfe19bd31327b4f9f91ee7"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});