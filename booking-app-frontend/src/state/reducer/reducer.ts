import Actions from "../Actions";
import { initialState } from "../initialState";


export default function stateReducer(state: any, action: any) {
    switch (action.type) {
        case (Actions.login):
            return { ...state, authenticated: true }

        case (Actions.logout):
            return { ...state, authenticated: false }

        case (Actions.changeCssMainPostion):
            return { ...state, cssMainPostion: action.payload }


        default:
            return initialState

    }

}