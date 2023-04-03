import { Route, Routes as RouterRoutes } from 'react-router-dom';

import Error404 from "../../components/404/Error404";

function Routes() {
    return (
        <RouterRoutes>     
            

            <Route path="*" element={<Error404 />} />
        </RouterRoutes>
    );
}

export default Routes;
