const express = require('express');
const path    = require('path');

const app  = express();
const PORT = process.env.PORT || 3000;

// Serve all static files from the repo root
app.use(express.static(path.join(__dirname)));

// Fallback — always serve index.html for any unmatched route
app.get('*', (req, res) => {
  res.sendFile(path.join(__dirname, 'index.html'));
});

app.listen(PORT, '0.0.0.0', () => {
  console.log(`TGModz running at http://0.0.0.0:${PORT}`);
});
