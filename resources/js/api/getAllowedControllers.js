export default function getAllowedControllers () {
    return new Promise((resolve, reject) => {
        axios.post('/get-allowed-controllers')
            .then((response) => {
                resolve(response);
            })
            .catch((error) => {
                reject(error);
            });
    });
}
