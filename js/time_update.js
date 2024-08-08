let formattedTimeGlobal = '';

function updateExactTime() {
  try {
    const localDateTime = new Date();
    
    // Define options for date and time formatting
    const options = { 
      weekday: 'long', 
      year: 'numeric', 
      month: 'long', 
      day: 'numeric', 
      hour: 'numeric', 
      minute: 'numeric', 
      second: 'numeric', 
      timeZone: 'Asia/Kolkata' 
    };

    // Format the date and time
    formattedTimeGlobal = localDateTime.toLocaleString('en-US', options);

    // Update the HTML element with the exact time
    document.getElementById('dateTime').innerHTML = `${formattedTimeGlobal}`;
    
    // Return the formatted time
    return formattedTimeGlobal;
  } catch (error) {
    console.error('Error fetching exact time:', error);
  }
}

updateExactTime();
// Update the exact time every second (1000 milliseconds)
setInterval(updateExactTime, 1000);
