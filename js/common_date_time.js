async function getCommonDateTime() {
  try {
    // Use the local date and time directly
    const localDateTime = new Date();

    // Define options for date and time formatting
    const options = { 
      year: 'numeric', 
      month: 'short', 
      day: '2-digit', 
      hour: '2-digit', 
      minute: '2-digit', 
      hour12: true
    };

    // Format the local date and time
    const formattedTimeLocal = localDateTime.toLocaleString('en-GB', options);
    
    // Extracting formatted components to construct the desired format
    const day = formattedTimeLocal.slice(0, 2);
    const month = formattedTimeLocal.slice(3, 6);
    const year = formattedTimeLocal.slice(7, 11);
    const time = formattedTimeLocal.slice(12);

    // Construct the final formatted date-time string
    const formattedTimeCustom = `${day}-${month}-${year}, ${time}`;

    // Update the HTML element with the local time
    // document.getElementById('dateTime').innerHTML = `${formattedTimeCustom}`;
    
    // Return the formatted time
    return formattedTimeCustom;
  } catch (error) {
    console.error('Error getting local time:', error);
    // Handle any errors that might occur (though unlikely with local time)
    return 'Error getting local time';
  }
}

getCommonDateTime();
// Update the exact time every second (1000 milliseconds)
setInterval(getCommonDateTime, 1000);
