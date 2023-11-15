

function convertCreatedTime(time, id) {
    let options = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: false
      };
      console.log(time);
    time = new Intl.DateTimeFormat('sv', options).format(new Date(time));
    document.getElementById('created' + id).innerHTML = time;
}

function convertEditedTime(time, id) {
    let options = {
        year: 'numeric',
        month: 'numeric',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: false
      };
      console.log(time);
    time = new Intl.DateTimeFormat('sv', options).format(new Date(time));
    document.getElementById('edited' + id).innerHTML = time;
}