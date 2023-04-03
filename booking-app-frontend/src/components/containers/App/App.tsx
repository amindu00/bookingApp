import { createContext, useReducer } from 'react';
import { initialState } from '../../../state/initialState';
import stateReducer from '../../../state/reducer/reducer';
import Routes from '../Routes/Routes';
import './App.scss';

type context = { state: any, dispatch: React.Dispatch<any> }
const StateContext = createContext<context | undefined>(undefined);

function App() {
  const [state, dispatch] = useReducer(stateReducer, initialState);
  return (
    <StateContext.Provider value={{ state, dispatch }}>
      <Routes />
    </StateContext.Provider>
  );
}

export default App;

export { StateContext };