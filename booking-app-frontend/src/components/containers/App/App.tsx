import { createContext, useEffect, useReducer } from 'react';
import { initialState } from '../../../state/initialState';
import stateReducer from '../../../state/reducer/reducer';
import Routes from '../Routes/Routes';
import { useNavigate } from "react-router-dom";
import './App.scss';
import ImageSlider from '../../components/ImageSlider/ImageSlider';
import Actions from '../../../state/Actions';

type context = { state: any, dispatch: React.Dispatch<any> }
const StateContext = createContext<context | undefined>(undefined);

function App() {
  const [state, dispatch] = useReducer(stateReducer, initialState);

  useEffect(() => {
    dispatch({ type: Actions.changeCssMainPostion, payload: "left" });
  }, []);

  const navigate = useNavigate();

  return (
    <StateContext.Provider value={{ state, dispatch }}>
      <nav className='homeNav'>
        <div className='logo'> logo</div>
        <div>
          <button onClick={() => navigate('/')}>Home</button>
          <button onClick={() => { }}>Gallery</button>
          {state.authenticated
            ? <>
              <button onClick={() => { }}>Book now!</button>
              <button onClick={() => { }}>user {state.user.firstName}</button>
              <button onClick={() => { }}>logout</button>
            </>
            : <button onClick={() => navigate('/login')}>login</button>
          }
        </div>
      </nav>
      <div className={'screen ' + state.cssMainPostion} >
        <Routes />
      </div>
      <ImageSlider />
    </StateContext.Provider>
  );
}

export default App;

export { StateContext };