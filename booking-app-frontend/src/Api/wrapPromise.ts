let status: string = 'pending';
let result: Response;

export default function wrapPromise(promise: () => Promise<Response>) {

    let suspend = promise().then(res => {
        status = 'fulfilled';
        result = res;
    })
        .catch(err => {
            status = 'error';
            result = err;
        });

    return {
        read() {
            if (status === 'pending') {
                throw suspend;
            }
            if (status === 'error') {
                throw result;
            }
            if (status === 'fulfilled') {
                return result;
            }
        }
    };
}
