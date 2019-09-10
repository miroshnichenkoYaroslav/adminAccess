export default function getAllControllersAndPermissions (id) {
    return new Promise((resolve, reject) => {
        axios.post('/get-all-controllers-and-permissions/' + id)
            .then((response) => {
                resolve(response);
            })
            .catch((error) => {
                reject(error);
            });
    });
}
