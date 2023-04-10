import { Route, Routes as RouterRoutes } from 'react-router-dom';
import Error404 from "../../components/404/Error404";
import Welcome from '../../components/Welcome/Welcome';
import AuthenticationScreen from '../AuthenticationScreen/AuthenticationScreen';

function Routes() {
    return (
        <RouterRoutes>
            <Route path="/" element={<Welcome />} />
            <Route path="/login" element={<AuthenticationScreen />} />


            <Route path="*" element={<Error404 />} />
        </RouterRoutes>
    );
}

export default Routes;
