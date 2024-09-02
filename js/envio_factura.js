













fetch('../php/xml.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
})
.then(response => response.json())
.then(result => {
    console.log(result);
    if (result.error) {
        throw new Error(result.error);
    }
})
.catch(error => {
    console.error('Error:', error);
});