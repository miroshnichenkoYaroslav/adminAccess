export default function loadMe () {
    return new Promise((resolve, reject) => {
        axios.post('/load-me')
            .then((response) => {
                resolve(response);
            })
            .catch((error) => {
                reject(error);
            });
    });
}
