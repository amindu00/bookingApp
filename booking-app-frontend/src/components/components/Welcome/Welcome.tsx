import React, { useContext } from 'react'
import { StateContext } from '../../containers/App/App';
import { useNavigate } from 'react-router-dom';
import './Welcome.scss'

function Welcome() {
    const { state } = useContext<any>(StateContext);
    var nRooms: number = 10;
    const navigate = useNavigate();

    return (
        <div className='Welcome'>
            <h1>Welcome to the Hotel Chamber!</h1>
            <h3>Currently we have {nRooms} available accommodation for today</h3>
            {state.authenticated
                ? <a href="default.asp">Book now!</a>
                : <p><button className='defaultButton' onClick={() => navigate('/login')}>login</button> to book now!</p>
            }
        </div >
    )
}

export default Welcome;