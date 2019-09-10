export default function changeAccessStatusForController (data) {
    return new Promise((resolve, reject) => {
        axios.post('/change-access-status-for-controller', data)
            .then((response) => {
                resolve(response);
            })
            .catch((error) => {
                reject(error);
            });
    });
}
