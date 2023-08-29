<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PHP-OpenAI-integration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #chat-messages {
            max-height: 500px;
            height: 500px;
            overflow-y: auto;
        }

        #user-input {
            height: 55px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 offset-md-0 p-4">
                <center>
                    <h2>PHP OPEN AI INTIGRATION</h2>
                </center>
                <div class="card" style="border-radius:20px">
                    <div class="card-body" style="background-color: rgb(116,172,156); border-radius:20px">
                        <h5 class="card-title">OpenAI Chatbot</h5>
                        <div id="chat-messages" class="mb-3" style="background-color: white; border-radius:20px">
                            <!-- Chat messages will be displayed here -->
                        </div>
                        <form id="chat-form">
                            @method('post')
                            @csrf
                            <div class="form-group">
                                <input type="text" id="user-input" class="form-control"
                                    placeholder="Type your message...">
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function updateChatMessages(userInput, botResponse) {
            const chatMessages = document.getElementById("chat-messages");

            const userMessage = document.createElement("div");
            userMessage.className = "alert alert-primary";
            userMessage.textContent = "You: " + userInput;

            const botMessage = document.createElement("div");
            botMessage.className = "alert alert-secondary";
            botMessage.textContent = "Bot: " + botResponse;

            chatMessages.appendChild(userMessage);
            chatMessages.appendChild(botMessage);

            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        $(document).ready(function() {
            $("#chat-form").submit(function(event) {
                event.preventDefault();

                const userInput = $("#user-input").val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('response') }}",
                    data: {
                        userInput: userInput,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        const botResponse = response;
                        updateChatMessages(userInput, botResponse);
                        $("#user-input").val("");
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
