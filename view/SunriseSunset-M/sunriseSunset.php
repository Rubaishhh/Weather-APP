<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Weather Snapshot - Weather App</title>
    <link rel="stylesheet" href="../../asset/css/shareFeature.css">
</head>
<body>
   <header>
        <h1>Share Weather </h1>
      </header>
    
      <div class="card">
        <h2> Message </h2>
        <textarea id="customMessage" rows="4" placeholder="Add a personal note..."></textarea>
        <button onclick="generateSnapshot()">Generate Snapshot</button>
        <div id="snapshot"></div>
        <button onclick="shareContent()">Share</button>
      </div>
      <script src="../../asset/js/shareFeature.js"></script>
</body>
</html>