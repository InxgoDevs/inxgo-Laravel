const express = require('express');
const app = express();

// Define a route handler for the root URL
app.get('/', (req, res) => {
  res.send('Hello, Socket.IO server is running!');
});

// Start the server and listen on port 3000
const server = app.listen(3000, () => {
  console.log('Socket.IO server listening on port 3000');
});
