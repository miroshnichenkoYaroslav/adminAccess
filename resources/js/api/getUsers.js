/**
 * Get all users.
 *
 * @return {Promise<any>}
 */
export default function getUsers () {
    return new Promise((resolve, reject) => {
        axios.post('/users')
            .then((response) => {
                resolve(response);
            })
            .catch((error) => {
                reject(error);
            });
    });
}
