/**
 * Get ID current user.
 *
 * @return {Promise<any>}
 */
export default function loadMeID () {
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
