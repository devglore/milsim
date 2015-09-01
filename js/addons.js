$(document).ready(
    function () {

        //visa feedback meddelandet en stund för att sedan låta det försvinna igen
        $( "#message" ).show(callback);
        function callback() {
            setTimeout(function() {
                $( "#message" ).fadeOut();
            }, 1500 );
        }

        // Variable to hold request
        var request;
        
        function RemoveFireteamButtonEvents() {
            //Remove Fireteam button
            $('.removeFireteamButton').click(
                function(e) {
                    e.preventDefault();

                    $(this).parents('.fireteams').remove();
                }
            );
        }
        
        //Add Fireteam button
        $('.addFireteamButton').click(
            function(e) {
                e.preventDefault();
                
                // Abort any pending request
                if (request) {
                    request.abort();
                }

                // Fire off the request to /form.php
                request = $.ajax({
                    url: "process.php?addFireteam=true",
                    type: "get"
                });

                // Callback handler that will be called on success
                request.done(function (response, textStatus, jqXHR){
                    // Log a message to the console
                    $('#fireteams').append(response);
                    RemoveFireteamButtonEvents();
                });

                // Callback handler that will be called on failure
                request.fail(function (jqXHR, textStatus, errorThrown){
                    // Log the error to the console
                    console.error(
                        "The following error occurred: "+
                        textStatus, errorThrown
                    );
                });

                // Callback handler that will be called regardless
                // if the request failed or succeeded
                request.always(function () {
                }); 
                
            }
        );        

        RemoveFireteamButtonEvents();
    }
);