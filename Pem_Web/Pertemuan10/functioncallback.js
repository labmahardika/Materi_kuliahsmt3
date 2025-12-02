function fetchData(callback) {
    // Simulating an asynchronous operation
    setTimeout(function () {
    const data = 'Fetched data!';
    callback(data);
    }, 1000);
    }
    // Using a callback
    fetchData(function (data) {
        console.log(data);
    });
console.log('Program execution continues...');