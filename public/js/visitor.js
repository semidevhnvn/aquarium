function displayDatetime () {
    setTimeout(() => {
        var date = new Date();
        var datetimeElement = document.querySelector("#datetime");
        datetimeElement.innerHTML = date.toUTCString();
        displayDatetime();
    }, 1000)
}

displayDatetime();
