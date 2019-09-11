/**
 *  Request for changing the status of access to the controller.
 *
 * @param data
 *
 * @return {Promise<any>}
 */
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
