<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SHDC Driver Page</title>
    <style>
       body {
    font-family: Courier, monospace;
    margin: 0;
    padding: 0;
    background-color: #1a1a1a; /* Dark background color */
    color: #fff; /* Text color */
     display: flex;
    align-items: center;
    justify-content: center;
     flex-direction: column;
     text-align: center
}

        h1 {
            margin-bottom: 20px;
        }

        #time-date-container {
            font-size: 14px;
            color: #888;
        }

        #location-container {
            font-size: 14px;
            color: #888;
        }

        #camera-container {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        #preview {
            width: 320px;
            height: 240px;
        }

        #image-container {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        #canvas {
            width: 320px;
            height: 240px;
        }

        #captured-image {
            margin-top: 20px;
            max-width: 320px;
            max-height: 240px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        }

        #capture-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #capture-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Customer Prof</h1>

    <div id="time-date-container" style="color: black;"></div><!-- Container for time and date -->

    <div id="camera-container">
        <video id="preview" autoplay></video>

        <div id="image-container">
            <canvas id="canvas"></canvas>
            <p id="date-time"></p>
        </div>
    </div>

    <button id="capture-button">Take Photo</button>

    <script>
        const captureButton = document.getElementById('capture-button');
        const preview = document.getElementById('preview');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        const imageContainer = document.getElementById('image-container');
        const dateTimeContainer = document.getElementById('time-date-container');

        // Get user media
        navigator.mediaDevices.getUserMedia({ video: true })
            .then((stream) => {
                preview.srcObject = stream;
            })
            .catch((error) => {
                console.log('Error accessing camera:', error);
            });

        // Capture image
        captureButton.addEventListener('click', () => {
            canvas.width = preview.videoWidth;
            canvas.height = preview.videoHeight;
            context.drawImage(preview, 0, 0, canvas.width, canvas.height);

            const now = new Date();
            const dateTimeText = 'Captured on: ' + now.toLocaleString();

            // Draw the yellow background rectangle behind the text
            context.fillStyle = 'yellow';
            context.fillRect(0, canvas.height - 80, canvas.width, 80);

            // Draw the date and time text onto the canvas
            context.font = 'bold 17px Arial'; // Added 'bold' for font weight
            context.fillStyle = 'black';
            context.fillText(dateTimeText, 10, canvas.height - 40);

            // Get location
            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                const locationText = `Latitude: ${latitude.toFixed(4)}, Longitude: ${longitude.toFixed(4)}`;
                context.font = 'bold 17px Arial';
                context.fillStyle = 'black';
                context.fillText(locationText, 10, canvas.height - 10);
            });

            imageContainer.style.display = 'flex';
        });

        // Update time and date
        function updateTimeDate() {
            const now = new Date();
            const dateTimeText = now.toLocaleString();
            dateTimeContainer.textContent = dateTimeText;
        }

        // Update time and date every second
        setInterval(updateTimeDate, 1000);
    </script>
</body>
</html>