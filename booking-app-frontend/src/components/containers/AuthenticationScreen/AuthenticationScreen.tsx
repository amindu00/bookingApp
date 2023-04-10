import React, { useContext, useEffect, useState } from 'react'
import './AuthenticationScreen.scss'
import { StateContext } from '../../containers/App/App';
import Actions from '../../../state/Actions';

function AuthenticationScreen() {
    const { dispatch } = useContext<any>(StateContext);
    const [isNewUser, setIsNewUser] = useState(false);
    // const [error, setError] = useState('');

    useEffect(() => {
        dispatch({ type: Actions.changeCssMainPostion, payload: "center" });
    }, []);

    // const showErrorMessage = (message: string) => {
    //     setError(message)
    //     setTimeout(() => { setError('') }, 3000)
    // }

    return (
        <div className='AuthenticationScreen'>
            {!isNewUser
                ? <div>
                    <h2>Login</h2>
                    <form action="" method="post">
                        <div>
                            <label htmlFor="username">Username :</label>
                            <input type="text" name="username" />
                        </div>
                        <div>
                            <label htmlFor="password">Password :</label>
                            <input type="password" name="password" />
                        </div>
                        <input className='defaultButton' type="submit" />
                    </form>
                </div>
                : <div>
                    <h2>Register</h2>
                    <form action="" method="post">
                        <div>
                            <label htmlFor="username">Username :</label>
                            <input type="text" name="username" />
                        </div>
                        <div>
                            <label htmlFor="firstName">FirstName :</label>
                            <input type="text" name="firstName" />
                        </div>
                        <div>
                            <label htmlFor="lastName">LastName :</label>
                            <input type="text" name="lastName" />
                        </div>
                        <div>
                            <label htmlFor="password">Password :</label>
                            <input type="password" name="password" />
                        </div>
                        <input className='defaultButton' type="submit" />
                    </form>
                </div>}
            <input
                type="button"
                className='defaultButton'
                value={isNewUser ? 'Have an Account? Login!' : 'Create New Account!'}
                onClick={() => setIsNewUser(!isNewUser)} />
            {/* <strong>{error}</strong> */}
        </div>
    );
}

export default AuthenticationScreen;