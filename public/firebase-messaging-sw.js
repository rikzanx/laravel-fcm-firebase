// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyCF6HHsxiAWdb23F5_6tKMTjq2a9-fr61Q",
  authDomain: "pertama-1927.firebaseapp.com",
  databaseURL: "https://pertama-1927.firebaseio.com",
  projectId: "pertama-1927",
  storageBucket: "pertama-1927.appspot.com",
  messagingSenderId: "296911380481",
  appId: "1:296911380481:web:17fc1dc1a1918e75e76000"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});