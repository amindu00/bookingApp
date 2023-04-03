import Actions from "../Actions";
import { initialState } from "../initialState";


export default function stateReducer(state:any, action:any) {
    switch (action.type) {
        case (Actions.login):
            return { ...state, authenticated: true }

        case (Actions.logout):
            return { ...state, authenticated: false }

        case (Actions.setTheme):
            return { ...state, theme: action.payload }

        case (Actions.setToBlogs):
            return { ...state, blogs: action.payload }

        case (Actions.addToBlogs):
            return { ...state, blogs: [...state.blogs, action.payload] }

        default:
            return initialState

    }

}