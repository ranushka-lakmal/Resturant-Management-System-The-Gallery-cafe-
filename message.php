<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== TRUE) {
    echo '<script>alert("You must be logged in to view messages."); window.location.href="login.php";</script>';
    exit();
}

// Database connection
include 'dbCon.php';
$con = connect();

// Get user ID from session
$user_id = $_SESSION['id'];

// Fetch sent messages
$sentMessagesQuery = "SELECT * FROM messages WHERE user_id = ? ORDER BY created_at DESC";
$sentStmt = $con->prepare($sentMessagesQuery);
$sentStmt->bind_param("i", $user_id);
$sentStmt->execute();
$sentMessages = $sentStmt->get_result();

// Fetch received messages
$receivedMessagesQuery = "SELECT * FROM messages WHERE user_id <> ? ORDER BY created_at DESC";
$receivedStmt = $con->prepare($receivedMessagesQuery);
$receivedStmt->bind_param("i", $user_id);
$receivedStmt->execute();
$receivedMessages = $receivedStmt->get_result();

include 'template/header.php'; 
?>

<body>
    <?php include 'template/nav-bar.php'; ?>

    <!-- Hero Section -->
    <section class="home-slider owl-carousel" style="height: 400px;">
        <div class="slider-item" style="background-image: url('images/message.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center justify-content-center">
                    <div class="col-md-10 col-sm-12 ftco-animate text-center" style="padding-bottom: 25%;">
                        <p class="breadcrumbs">
                            <span class="mr-2"><a href="index.php">Home</a></span> 
                            <span>Messages</span>
                        </p>
                        <h1 class="mb-3">Your Messages</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h3>Sent Messages</h3>
                    <div class="message-container" id="sent-messages">
                        <?php if ($sentMessages->num_rows > 0) { ?>
                            <?php while ($message = $sentMessages->fetch_assoc()) { ?>
                                <div class="message">
                                    <div class="message-header">
                                        <strong><?php echo htmlspecialchars($message['user_name']); ?></strong>
                                        <span class="message-date"><?php echo date('Y-m-d H:i', strtotime($message['created_at'])); ?></span>
                                    </div>
                                    <div class="message-body">
                                        <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="no-message">
                                <p>No Sent Messages</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <h3>Received Messages</h3>
                    <div class="message-container" id="received-messages">
                        <?php if ($receivedMessages->num_rows > 0) { ?>
                            <?php while ($message = $receivedMessages->fetch_assoc()) { ?>
                                <div class="message">
                                    <div class="message-header">
                                        <strong><?php echo htmlspecialchars($message['user_name']); ?></strong>
                                        <span class="message-date"><?php echo date('Y-m-d H:i', strtotime($message['created_at'])); ?></span>
                                    </div>
                                    <div class="message-body">
                                        <p><?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="no-message">
                                <p>No Received Messages</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'template/footer.php'; ?>
    <?php include 'template/script.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to fetch messages via AJAX
        function fetchMessages() {
            $.ajax({
                url: 'fetch-messages.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        console.error(data.error);
                        return;
                    }
                    updateMessages('sent-messages', data.sent);
                    updateMessages('received-messages', data.received);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching messages: ", error);
                }
            });
        }

        // Function to update message containers
        function updateMessages(containerId, messages) {
            const container = $("#" + containerId);
            container.empty(); // Clear the container

            if (messages.length > 0) {
                messages.forEach(function(message) {
                    container.append(`
                        <div class="message">
                            <div class="message-header">
                                <strong>${message.user_name}</strong>
                                <span class="message-date">${new Date(message.created_at).toLocaleString()}</span>
                            </div>
                            <div class="message-body">
                                <p>${message.message.replace(/(?:\r\n|\r|\n)/g, '<br>')}</p>
                            </div>
                        </div>
                    `);
                });
            } else {
                container.append(`
                    <div class="no-message">
                        <p>No Messages</p>
                    </div>
                `);
            }
        }

        // Fetch messages every 5 seconds
        setInterval(fetchMessages, 5000);
        fetchMessages(); // Initial fetch on page load
    </script>

    <style>
        .message-container {
            max-height: 400px; /* Set max height */
            overflow-y: auto; /* Enable vertical scroll */
            padding: 10px;
            background-color: #ffffff; /* White background */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            animation: fadeIn 0.5s ease-in-out; /* Fade in animation */
        }

        .message {
            border-bottom: 1px solid #e0e0e0; /* Divider line */
            padding: 10px 0; /* Padding around messages */
            transition: background-color 0.3s; /* Smooth background color transition */
        }

        .message:last-child {
            border-bottom: none; /* Remove last message divider */
        }

        .message:hover {
            background-color: #f9f9f9; /* Highlight on hover */
        }

        .message-header {
            display: flex; /* Use flexbox for header */
            justify-content: space-between; /* Space between items */
            align-items: center; /* Center items vertically */
        }

        .message-date {
            font-size: 0.85em; /* Smaller font for date */
            color: #888; /* Light gray color for date */
        }

        @keyframes fadeIn {
            from {
                opacity: 0; /* Start transparent */
            }
            to {
                opacity: 1; /* End fully visible */
            }
        }

        h3 {
            margin-bottom: 20px; /* Add margin below headings */
            color: #333; /* Darker color for headings */
        }

        .no-message {
            text-align: center; /* Center text for no message */
            padding: 20px; /* Padding around the message */
            font-size: 1.2em; /* Slightly larger font size */
            color: #777; /* Light gray color */
            background-color: #f8f8f8; /* Light background for no messages */
            border: 1px dashed #ccc; /* Dashed border for emphasis */
            border-radius: 8px; /* Rounded corners */
            margin-top: 20px; /* Margin on top */
        }
    </style>
</body>
</html>
