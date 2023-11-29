document.addEventListener("DOMContentLoaded", function () {
    // setTimeout(() => {


    //     const publishSidebar = document.querySelector('.publish-sidebar');
    //     if (publishSidebar) {

    //         const publishTab = publishSidebar.querySelector('.publish-tab');

    //         if (publishTab) {

    //             const customButton = document.createElement('button');
    //             customButton.textContent = 'Trigger Update';
    //             customButton.classList.add('btn', 'btn-primary', 'mb-5', 'w-full'); // Add necessary classes

                // Insert the custom button before the .publish-tab element
                // publishSidebar.insertBefore(customButton, publishTab);
                // var cpURL = Statamic.cp_url('/');

                // const updateDataURL = `${cpURL}headless-refresh/headless-refresh-proxy`;

                // // Add click event listener to the custom button
                // customButton.addEventListener('click', function () {
                //     // Add logic here to trigger the update link
                //     fetch('https://example.com/update-data')
                //         .then(response => {
                //             if (response.ok) {
                //                 console.log('Update triggered successfully');
                //                 // Optionally display a success message or perform other actions
                //             } else {
                //                 console.error('Failed to trigger update');
                //                 // Optionally display an error message or perform other actions
                //             }
                //         })
                //         .catch(error => {
                //             console.error('Error:', error);
                //         });
                // });
    //         }
    //     }
    // }, 5000);

    function enableButton(button) {
        button.disabled = false;
    }
    
    function disableButton(button) {
        button.disabled = true;
    }
    
    var headlessButton = document.querySelector('.headless-refresh-btn');
    
    if (headlessButton) {
        headlessButton.addEventListener('click', function () {
            var cpURL = Statamic.cp_url('/');
            var button = this;
    
            disableButton(button);
    
            fetch(`${cpURL}headless-refresh/headless-refresh-proxy`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok.');
                    }
                    // Check the status directly without parsing JSON
                    if (response.status === 200) {
                        console.log('Success: Status 200 received');
                        Statamic.$toast.success('Your website is updated!');
                        // Perform additional actions for successful status (200) here
                    } else {
                        throw new Error('Unexpected status code received: ' + response.status);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Statamic.$toast.error('Error occurred. Please try again.');
                    // Handle errors as needed
                })
                .finally(() => {
                    enableButton(button);
                });
        });
    }
    
    
    
});
